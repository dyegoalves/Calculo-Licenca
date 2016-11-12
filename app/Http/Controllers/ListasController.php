<?php

namespace App\Http\Controllers;

use App\Processo;
use Illuminate\Http\Request;

use App\Http\Requests;


class ListasController extends Controller
{
	public function listartodosprocessos()
	{
		$processos =  Processo::all();
		return view("sistema.listar.todosprocessos" , compact('processos'));

	}

}
