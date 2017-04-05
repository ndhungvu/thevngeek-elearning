<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public $viewPrefix = 'admins.';

    protected $lang = array(
        'prefix' => 'admin/',
        'replacements' => array(),
    );

	public function __construct()
    {
        //
    }
}
