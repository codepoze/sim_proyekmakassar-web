<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
            'progress' => Progress::whereIdKontrakRuasItem($id_kontrak_ruas_item)->get()
        ];

        return Template::load('admin', 'Progress Ruas', 'kontrak/progress', 'view', $data);
    }
}
