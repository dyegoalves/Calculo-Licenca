<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function sistema_inicio()
	{
		return view("sistema.admin.inicio");
	}

	public function resetsenha()
	{
		return view("sistema.admin.resetsenha");
	}

	public function permissaodeacessorota()
	{
		return view("sistema.admin.permissaodeacessorota");
	}

}
