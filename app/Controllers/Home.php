<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
	    $data = [
	        'title'     => 'Hackaton - Covid 19'
	    ];
		return view('dashboard/index', $data);
	}
}
