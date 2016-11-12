<?php

namespace App\Http\Controllers;
use App\Atividade;
use App\Calculo;
use App\Empreendimento;
use App\Empresa;
use App\Porte;
use App\Processo;
use App\Subatividade;
use App\User;
use App\Usuario;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Input;
use Image;
use Redirect;
use Validator;

class CadastrosController extends Controller
{
    //Acessa a view sistema ->cadastro->usuarios
    public function cadastro_usuario()
    {
        return view("sistema.cadastros.usuarios", compact('titulo'));
    }
    //Acessa a view sistema ->cadastro->profile
    public function profile()
    {
        return view('sistema.cadastros.profile' , ['user' => Auth::user()]);
    }
    //Salvar foto de perfil do usuario autenticado
    public function salvar_imagem( Request $request)
    {
        $rules = array(
            'imagem' => 'required|max:10000|image|mimes:jpeg,png,jpg'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('profile')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('imagem')){
            $avatar = $request->file('imagem');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(200,200)->save(public_path('/upload/avatars/'.$filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return view('sistema.cadastros.profile' , ['user' => Auth::user()]);
    }

    //Cadastrar processo
    public function cadastrarprocesso()
    {

			$numprocesso = Input::get("num_processo");
			$numprocessocount = Processo::where('num_processo', $numprocesso)->count();

        if($numprocessocount < 1){
					DB::statement('SET FOREIGN_KEY_CHECKS=0');
  					$processonumero = new Processo();
            $processonumero->num_processo = Input::get('num_processo');
					  $processonumero->situacao =  Input::get('situacao');
					  $processonumero->user_id  =  intval($this->analistatemmenosprocesso());
					  $processonumero->save();
				  	DB::statement('SET FOREIGN_KEY_CHECKS=1');
          return true;
        }
				else{
            return false;
        }
    }

		//Pega sempre o ultimo cara que tem menos processo;
		public function analistatemmenosprocesso()
		{

			$analista = [];
			foreach(User::all() as $users)
			{
				$analista[$users->id] = count($users->processo);
			}
			arsort($analista);
			foreach ($analista as $chave => $valor)
			{
				$analista[$chave] = $valor;
			}
			$temmenosprocesso =  array_keys($analista);
			return end($temmenosprocesso);
		}

    //Cadastrar Empresa
    public function cadastrarempresa(){

        $CNPJ = Input::get("CNPJ");
        $CNPJcount = Empresa::where('CNPJ', $CNPJ)->count();

        if($CNPJcount < 1){
            $empresa = new Empresa(Input::all());
            $empresa->save();
            return true;
        }
        else{
            return false;
        }

    }
    //Cadastrar Empreendimento
    public function cadastrarempreendimento()
    {
        //Obtrencao de dados para cadastro do Empreendimento
        $basedecalculo01    = Input::get("basedecalculo01");
        $basedecalculo02    = Input::get("basedecalculo02");
        $processo_id        = Processo::where('num_processo', Input::get("num_processo"))->get(['id']);
        $empresa_id         = Empresa::where('CNPJ', Input::get("CNPJ"))->get(['id']);
        $porte_id           = Porte::where('tamanho', Input::get("portedaempresa"))->get(['id']);
        $atividade_id       = Atividade::where('id', Input::get("atividade"))->get(['id']);
        $subatividade_id    = Subatividade::where('id', Input::get("subatividade"))->get(['id']);

        //Cadastra Empreedimento e seus relacionamentos
        $empreedimento = new Empreendimento();
        $empreedimento->basedecalculo01 = $basedecalculo01;
        $empreedimento->basedecalculo02 = $basedecalculo02;
        $empreedimento->processo_id     = $processo_id[0]->id;
        $empreedimento->empresa_id      = $empresa_id[0]->id;
        $empreedimento->porte_id        = $porte_id[0]->id;
        $empreedimento->atividade_id    = $atividade_id[0]->id;
        $empreedimento->subatividade_id = $subatividade_id[0]->id;
        $empreedimento->save();
        $this->cadastrarcalculo($processo_id);
        return true;

    }
    //Cadastrar Calculo
    public function cadastrarcalculo( $processo_id )
    {
        $calculo  = new Calculo();
        $calculo->processo_id = $processo_id[0]->id;
				$valorlincenca = Input::get("valordalicenca");
				$valorlincenca = str_replace(".","" , $valorlincenca);
				$valorlincenca = str_replace(",","." , $valorlincenca);
			  $calculo->valor =  $valorlincenca ;
        $calculo->save();
    }


}
