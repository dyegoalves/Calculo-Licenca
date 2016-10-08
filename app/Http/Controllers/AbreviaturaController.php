<?php

namespace App\Http\Controllers;
use App\Abreviatura;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class AbreviaturaController extends Controller
{
    public function show_abreviaturas( Abreviatura $abreviatura)
    {
        $showAbreviaturas = $abreviatura->all();
        return view('sistema.dicionario.abreviaturas', compact("showAbreviaturas"));
    }

    //Acessa a pagina cadastros de Abreviaturas
    public function getcadastro_abreviaturas()
    {
        return view('sistema.cadastros.abreviaturas');
    }

    //Cadastrar a Abreviatura atraves do metodo POST
    public function postcadastro_abreviaturas(Abreviatura $abreviatura , Request $resquest)
    {
         $rules = [
            'Abreviatura' => 'required',
            'Descricao' => 'required',
         ];

         $validator = Validator::make($resquest->all(), $rules);

         if($validator->fails()) {
            return redirect('cadastro-abreviaturas')
                           ->withErrors($validator)
                           ->withInput();
         }

         $countAbrev = $abreviatura ->where('abrev', '=', $resquest['Abreviatura'])
                                    ->count();
         if($countAbrev < 1 )
         {
             $abreviatura->abrev = $resquest->get('Abreviatura');
             $abreviatura->desc = $resquest->get('Descricao');
             $abreviatura->save();
             $msg = "Registro cadastrado com sucesso!";
             return view('sistema.cadastros.abreviaturas',compact('msg'));
         }
         else
         {
             $msgerro = "Abreviatura ja cadastrada no sistema";
             return view('sistema.cadastros.abreviaturas',compact('msgerro'));
         }
    }


}
