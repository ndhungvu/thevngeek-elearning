<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\ClientController;

class HomeController extends ClientController
{
	public function getIndex() {
		return view('clients.home');
	}
}
