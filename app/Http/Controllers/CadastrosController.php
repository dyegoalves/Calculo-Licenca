<?php

namespace App\Http\Controllers;
use App\Atividade;
use App\Processo;
use App\Subatividade;
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
    //Redenriza a pagina de cadastro atividade e subatividade
    public function atividade_subatividade(Atividade $atividade ){
        $descricao_atividade = $atividade->getQuery()->orderBy('codigo' , 'ASC')->get();
        return view('sistema.cadastros.atividade-subatividade' , compact('descricao_atividade'));
    }
    //Metodo de Cadastro de uma atividadade
    public function atividade(Atividade $atividade , Request $requestAtv ){
        $atv_codigo  = $requestAtv->input('atv_codigo');
        $atv_descricao = $requestAtv->input('atv_descricao');

        $rules = array(
            'atv_codigo' => 'required',
            'atv_descricao' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('pag-atividade-sub')
                ->withErrors($validator)
                ->withInput();
        }

        $countAct = $atividade ->where('codigo', '=', $atv_codigo)
            ->count();

        //Verifica se existe atividade cadastrada, caso não cadastra, se existir um cadastro, msg de erro.
        if($countAct < 1 )
        {
            $atividade->codigo = $atv_codigo;
            $atividade->descricao =$atv_descricao;
            $atividade->save();
            $msg =  "Atividade codigo: {$atv_codigo} cadastrada com sucesso!";
            return Redirect::route('pag-atividade-sub')->with( 'msg', $msg );

        }
        else
        {
            $msgerro = "Atividade codigo: {$atv_codigo} já cadastrada no sistema";
            return Redirect::route('pag-atividade-sub') ->with( 'msgerro', $msgerro );
        }
    }
    //Metodo de Cadastro de uma subatividadade
    public function subatividade(Subatividade $subatividade , Request $requestAtv){

        $subatv_codigo  = $requestAtv->input('subatv_codigo');
        $subatv_descricao = $requestAtv->input('subatv_descricao');
        $ppd_id = $requestAtv->input('sub_ppd_id');
        $descricao_atividade = $requestAtv->input('descricao_atividade');

        $rules = array(
            'subatv_codigo' => 'required',
            'subatv_descricao' => 'required',
            'sub_ppdid ' => 'required',
            'descricao_atividade' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('pag-atividade-sub')
                ->withErrors($validator)
                ->withInput();
        }

        $countAct = $subatividade ->where('codigo', '=', $subatv_codigo)
            ->count();

        //Verifica se existe atividade cadastrada, caso não cadastra, se existir um cadastro, msg de erro.
        if($countAct < 1 )
        {
            $subatividade->codigo = $subatv_codigo;
            $subatividade->descricao =$subatv_descricao;
            $subatividade->atividades_id = intval($descricao_atividade);
            $subatividade->ppd_id = intval($ppd_id);
            $subatividade->save();

            $msgsub = "Subatividade codigo: {$subatv_codigo}  cadastrada com sucesso!";
            return Redirect::route('pag-atividade-sub')->with( 'msgsub', $msgsub );

        }
        else
        {
            $msgsuberro = "Subatividade codigo: {$subatv_codigo} já cadastrada no sistema";
            return Redirect::route('pag-atividade-sub') ->with( 'msgsuberro', $msgsuberro );
        }
    }


}
