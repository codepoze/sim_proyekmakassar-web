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

        // $kontrak = DB::select("SELECT k.id_kontrak, k.no_kontrak FROM kontrak AS k ");

        if ($this->session['roles'] == 'pptk') {
            $pptk    = Pptk::whereIdUsers($this->session['id_users'])->first();
            $kontrak = DB::select("SELECT k.id_kegiatan, p.id_paket, ko.id_kontrak, ko.no_kontrak FROM kegiatan AS k LEFT JOIN paket AS p ON p.id_kegiatan = k.id_kegiatan LEFT JOIN kontrak AS ko ON ko.id_paket = p.id_paket WHERE k.id_pptk = '$pptk->id_pptk'");
        } else {
            $kontrak = DB::select("SELECT k.id_kontrak, k.no_kontrak FROM kontrak AS k ");
        }

        foreach ($kontrak as $key => $value_satu) {
            $kontrak_ruas_item = DB::select("SELECT k.id_kontrak, kr.id_kontrak_ruas, kri.id_kontrak_ruas_item, kri.volume, kri.harga_hps, kri.harga_kontrak FROM kontrak AS k LEFT JOIN kontrak_ruas AS kr ON kr.id_kontrak = k.id_kontrak LEFT JOIN kontrak_ruas_item AS kri ON kri.id_kontrak_ruas = kr.id_kontrak_ruas WHERE k.id_kontrak = '$value_satu->id_kontrak'");
            $total_kontrak = 0;
            foreach ($kontrak_ruas_item as $key => $value_dua) {
                $total_kontrak += $value_dua->volume * $value_dua->harga_kontrak;
            }

            $kontrak_rencana = DB::select("SELECT k.id_kontrak, kr.id_kontrak_rencana FROM kontrak AS k LEFT JOIN kontrak_rencana AS kr ON kr.id_kontrak = k.id_kontrak WHERE k.id_kontrak = '$value_satu->id_kontrak'");
            $total_progress = 0;
            foreach ($kontrak_rencana as $key => $value_tiga) {
                $total_progress += count_progress($value_satu->id_kontrak, $value_tiga->id_kontrak_rencana, $total_kontrak);
            }

            $get_kontrak[] = [
                'id_kontrak'     => my_encrypt($value_satu->id_kontrak),
                'no_kontrak'     => $value_satu->no_kontrak,
                'total_kontrak'  => $total_kontrak,
                'total_progress' => (int) $total_progress
            ];
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
