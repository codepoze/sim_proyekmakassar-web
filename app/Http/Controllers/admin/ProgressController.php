<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Dokumentasi;
use App\Models\KontrakRuasItem;
use App\Models\Opname;
use App\Models\Progress;

class ProgressController extends Controller
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
            'progress'          => Progress::whereIdKontrakRuasItem($id_kontrak_ruas_item)->get()
        ];

        return Template::load('admin', 'Backup Data', 'kontrak/progress', 'backupdata', $data);
    }

    public function dokumentasi()
    {
        $id_kontrak_ruas_item = my_decrypt(last(request()->segments()));

        $dokumentasi_ruas_item = Dokumentasi::whereIdKontrakRuasItem($id_kontrak_ruas_item)->whereTipe('progress')->get();

        $data = [
            'dokumentasi' => $dokumentasi_ruas_item
        ];

        return Template::load('admin', 'Dokumentasi', 'kontrak/progress', 'dokumentasi', $data);
    }

    public function opname()
    {
        $id_kontrak_ruas_item = my_decrypt(last(request()->segments()));

        $opname_ruas_item = Opname::whereIdKontrakRuasItem($id_kontrak_ruas_item)->whereTipe('progress')->get();
        
        $data = [
            'opname' => $opname_ruas_item  
        ];

        return Template::load('admin', 'Opname', 'kontrak/progress', 'opname', $data);
    }
}
