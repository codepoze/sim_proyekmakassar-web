<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Dokumentasi;
use App\Models\Fh0;
use App\Models\KontrakRuasItem;
use App\Models\Opname;

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
            'kontrak_ruas_item' => KontrakRuasItem::find($id_kontrak_ruas_item),
            'fh0'               => Fh0::whereIdKontrakRuasItem($id_kontrak_ruas_item)->get(),
        ];

        return Template::load('admin', 'Fh0 Ruas', 'kontrak/fh0', 'backupdata', $data);
    }

    public function dokumentasi()
    {
        $id_kontrak_ruas_item = my_decrypt(last(request()->segments()));

        $dokumentasi_ruas_item = Dokumentasi::whereIdKontrakRuasItem($id_kontrak_ruas_item)->whereTipe('fh0')->get();

        $data = [
            'dokumentasi' => $dokumentasi_ruas_item
        ];

        return Template::load('admin', 'Dokumentasi', 'kontrak/fh0', 'dokumentasi', $data);
    }

    public function opname()
    {
        $id_kontrak_ruas_item = my_decrypt(last(request()->segments()));

        $opname_ruas_item = Opname::whereIdKontrakRuasItem($id_kontrak_ruas_item)->whereTipe('fh0')->get();

        $data = [
            'opname' => $opname_ruas_item
        ];

        return Template::load('admin', 'Opname', 'kontrak/fh0', 'opname', $data);
    }
}
