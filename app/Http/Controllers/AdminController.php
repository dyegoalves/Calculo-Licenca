<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{

   /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function sistema_inicio(){
        return view("sistema.admin.inicio");
    }


}
