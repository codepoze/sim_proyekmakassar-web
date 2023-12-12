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
use Illuminate\Support\Facades\DB;

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
        $get_kontrak = [];

        $kontrak = Kontrak::get();
        foreach ($kontrak as $key => $val_satu) {
            $total_kontrak  = 0;
            foreach ($val_satu->toKontrakRuas as $key => $val_dua) {
                $total_kontrak += $val_dua->toKontrakRuasItem->sum(function ($item) {
                    return $item->volume * $item->harga_kontrak;
                });
            }
            
            $total_progress = 0;
            foreach ($val_satu->toKontrakRencana as $key => $val_tiga) {
                $total_progress += count_progress($val_satu->id_kontrak, $val_tiga->id_kontrak_rencana, $total_kontrak);
            }

            if ($total_progress <= 100) {
                $get_kontrak[] = [
                    'id_kontrak'     => $val_satu->id_kontrak,
                    'no_kontrak'     => $val_satu->no_kontrak,
                    'total_kontrak'  => $total_kontrak,
                    'total_progress' => (int) $total_progress
                ];
            }
        }

        $data = [
            'count_kegiatan'             => Kegiatan::count(),
            'count_paket'                => Paket::count(),
            'count_kontrak'              => Kontrak::count(),
            'count_pptk'                 => Pptk::count(),
            'count_kord_teknis_lapangan' => Teknislap::count(),
            'count_angg_teknis_lapangan' => TeknislapAngg::count(),
            'get_kontrak'                => $get_kontrak
        ];

        return Template::load('admin', 'Dashboard', 'dashboard', 'view', $data);
    }
}
