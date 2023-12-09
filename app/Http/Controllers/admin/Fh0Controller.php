<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Fh0;

class Fh0Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
        detect_role_access($this->session);
    }

    public function index()
    {
        $id_kontrak_ruas_item = my_decrypt(last(request()->segments()));
        
        $data = [
            'fh0' => Fh0::whereIdKontrakRuasItem($id_kontrak_ruas_item)->get(),
        ];

        return Template::load('admin', 'Fh0 Ruas', 'kontrak/fh0', 'view', $data);
    }
}
