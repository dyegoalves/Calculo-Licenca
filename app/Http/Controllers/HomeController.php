<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function bootstrap(){
        return view("bootstrap");
	}

	public function teste()
	{
		return view('errors.503');
	}

}
