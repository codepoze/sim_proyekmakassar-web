<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
    }

    public function index()
    {
        return Template::load('admin', 'Dashboard', 'dashboard', 'view');
    }
}
