<?php

namespace App\Http\Controllers;

use App\Processo;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ConsultarController extends Controller
{

    public function index()
    {
       $bloqueio = 'sim';
       return view("sistema.consultas.consultarprocesso")->with(compact('bloqueio'));
    }


    public function fazerconsultarprocesso()
    {
        $processo = DB::table('processos')->where('num_processo', Input::get("num_processo"))->first();
        $processo  = Processo::find($processo->id);
        $empredimento = $processo->empreendimento;
        $empresa = $empredimento->empresa;
        $subatividade = $empredimento->subatividade->descricao;
        $subatividade = $empredimento->atividade->descricao;

        return back()
            ->with(compact('empresa'))
				  	->withInput();

    }


}
