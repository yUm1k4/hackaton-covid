<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$nasional = json_decode(file_get_contents('https://api.kawalcorona.com/indonesia'), true);
		$data = [
			'title'     => 'Hackaton - Covid 19',
			'nasional'	=> $nasional,
		];
		return view('dashboard/index', $data);
	}
}
