<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ConsultarController extends Controller
{

    public function index()
    {
       return view("sistema.consultas.consultarprocesso");
    }



}
