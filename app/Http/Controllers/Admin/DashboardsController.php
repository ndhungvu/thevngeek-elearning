<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class DashboardsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index
     *
     * @author vu.ndh@neo-lab.vn
     * @created 28/11/2016
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return view('admins.dashboard');
    }
}
