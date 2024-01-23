<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\KontrakRuasItem;
use App\Models\Ph0;

class Ph0Controller extends Controller
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
            'kontrak_ruas_item' => KontrakRuasItem::find($id_kontrak_ruas_item),
            'ph0'               => Ph0::whereIdKontrakRuasItem($id_kontrak_ruas_item)->get(),
        ];

        return Template::load('admin', 'Ph0 Ruas', 'kontrak/ph0', 'view', $data);
    }
}
