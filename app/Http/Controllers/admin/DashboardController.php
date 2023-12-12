<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Kegiatan;
use App\Models\Kontrak;
use App\Models\Paket;
use App\Models\Pptk;
use App\Models\Teknislap;
use App\Models\TeknislapAngg;

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
        $data = [
            'count_kegiatan'             => Kegiatan::count(),
            'count_paket'                => Paket::count(),
            'count_kontrak'              => Kontrak::count(),
            'count_pptk'                 => Pptk::count(),
            'count_kord_teknis_lapangan' => Teknislap::count(),
            'count_angg_teknis_lapangan' => TeknislapAngg::count(),
        ];

        return Template::load('admin', 'Dashboard', 'dashboard', 'view', $data);
    }
}
