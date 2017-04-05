<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\ClientController;

class TutorialController extends ClientController
{
	public function getIndex() {
		return view('clients.tutorial.index');
	}

	public function getDetail($slug) {
		return view('clients.tutorial.detail');
	}
}
