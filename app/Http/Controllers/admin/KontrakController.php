<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Pdf;
use App\Libraries\Template;
use App\Models\Kontrak;
use App\Models\KontrakRencana;
use App\Models\KontrakRuas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KontrakController extends Controller
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
        return Template::load('admin', 'Kontrak', 'kontrak', 'view');
    }

    public function add()
    {
        $id = my_decrypt(last(request()->segments()));

        $data = [
            'id_paket' => $id,
        ];

        return Template::load('admin', 'Tambah Kontrak', 'kontrak', 'add', $data);
    }

    public function upd()
    {
        $id = last(request()->segments());

        $data = [
            'id_kontrak'  => $id,
            'kontrak'     => Kontrak::findOrFail(my_decrypt($id)),
        ];

        return Template::load('admin', 'Ubah Kontrak', 'kontrak', 'upd', $data);
    }

    public function det()
    {
        $id = last(request()->segments());

        $kontrak = Kontrak::findOrFail(my_decrypt($id));

        $nil_kontrak = 0;
        foreach ($kontrak->toKontrakRuas as $key => $value) {
            $nil_kontrak += $value->toKontrakRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });
        }

        $nil_hps = 0;
        foreach ($kontrak->toKontrakRuas as $key => $value) {
            $nil_hps += $value->toKontrakRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_hps;
            });
        }

        $data = [
            'id_kontrak'  => $id,
            'kontrak'     => $kontrak,
            'nil_hps'     => $nil_hps,
            'nil_kontrak' => $nil_kontrak
        ];

        return Template::load('admin', 'Detail Kontrak', 'kontrak', 'det', $data);
    }

    public function rincian()
    {
        $id = last(request()->segments());

        $kontrak = Kontrak::findOrFail(my_decrypt($id));

        $kontrak_rencana = KontrakRencana::whereIdKontrak(my_decrypt($id))->get();

        $total_kontrak = 0;
        foreach ($kontrak->toKontrakRuas as $key => $value) {
            $total_kontrak += $value->toKontrakRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });
        }

        $get_kontrak_rencana = [];
        $rencana_komulatif = 0;
        $realisasi_komulatif = 0;
        foreach ($kontrak_rencana as $key => $value) {
            $rencana_komulatif += $value->bobot;
            $realisasi_komulatif += count_progress(my_decrypt($id), $value->id_kontrak_rencana, $total_kontrak);

            $get_kontrak_rencana[] = [
                'minggu_ke'           => "Minggu ke-" . $value->minggu_ke,
                'rencana'             => $value->bobot,
                'rencana_komulatif'   => $rencana_komulatif,
                'realisasi'           => count_progress(my_decrypt($id), $value->id_kontrak_rencana, $total_kontrak),
                'realisasi_komulatif' => $realisasi_komulatif,
                'devisiasi'           => ($realisasi_komulatif - $rencana_komulatif)
            ];
        }

        $data = [
            'id_kontrak'      => $id,
            'kontrak'         => $kontrak,
            'kontrak_rencana' => $get_kontrak_rencana
        ];

        return Template::load('admin', 'Rincian Kontrak', 'kontrak', 'rincian', $data);
    }

    public function print()
    {
        $id = last(request()->segments());

        $kontrak = Kontrak::findOrFail(my_decrypt($id));

        $nil_kontrak = 0;
        foreach ($kontrak->toKontrakRuas as $key => $value) {
            $nil_kontrak += $value->toKontrakRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });
        }

        $nil_hps = 0;
        foreach ($kontrak->toKontrakRuas as $key => $value) {
            $nil_hps += $value->toKontrakRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_hps;
            });
        }

        $data = [
            'id_kontrak'  => $id,
            'kontrak'     => $kontrak,
            'nil_hps'     => $nil_hps,
            'nil_kontrak' => $nil_kontrak
        ];

        Pdf::printPdf('Rencana Anggaran Biaya', 'admin.kontrak.print', 'legal', 'landscape', $data);
    }

    public function get_data_dt(Request $request)
    {
        $query = Kontrak::query();

        if ($request->id_paket) {
            $query->whereIdPaket(my_decrypt($request->id_paket));
        }

        if ($this->session['roles'] == 'pptk') {
            $pptk = User::with(['toPptk'])->find($this->session['id_users']);

            $query->whereHas('toPaket.toKegiatan', function ($q) use ($pptk) {
                $q->whereIdPptk($pptk->toPptk->id_pptk);
            });
        }

        $data = $query->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nil_kontrak', function ($row) {
                $result = 0;
                foreach ($row->toKontrakRuas as $key => $value) {
                    $result += $value->toKontrakRuasItem->sum(function ($item) {
                        return $item->volume * $item->harga_kontrak;
                    });
                }
                return rupiah($result);
            })
            ->addColumn('nil_pagu', function ($row) {
                return rupiah($row->nil_pagu);
            })
            ->addColumn('waktu_kontrak', function ($row) {
                return count_day_excluding_weekends_holiday($row->tgl_kontrak_akhir, $row->tgl_kontrak_mulai) . ' Hari';
            })
            ->addColumn('jenis_kontrak', function ($row) {
                return ucfirst($row->jns_kontrak);
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route_role('admin.kontrak.det', ['id' => my_encrypt($row->id_kontrak)]) . '" class="btn btn-action btn-sm btn-relief-info"><i data-feather="info"></i>&nbsp;Detail</a>&nbsp;
                    <a href="' . route_role("admin.kontrak.upd", ['id' => my_encrypt($row->id_kontrak)]) . '" class="btn btn-action btn-sm btn-relief-primary"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></a>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_kontrak) . '" class="btn btn-action btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function get_chart_progress(Request $request)
    {
        $id_kontrak = my_decrypt($request->id);

        $kontrak = Kontrak::findOrFail($id_kontrak);

        $kontrak_rencana = KontrakRencana::whereIdKontrak($id_kontrak)->get();

        $total_kontrak = 0;
        foreach ($kontrak->toKontrakRuas as $key => $value) {
            $total_kontrak += $value->toKontrakRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });
        }

        foreach ($kontrak_rencana as $key => $value) {
            $response[] = [
                'category' => "Minggu ke-" . $value->minggu_ke,
                'value1'   => $value->bobot,
                'value2'   => count_progress($id_kontrak, $value->id_kontrak_rencana, $total_kontrak),
            ];
        }

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $post = $request->all();

        $data = [];
        foreach ($post as $key => $value) {
            $data[$key] = $value;
        }

        if ($request->id_kontrak === null) {
            // tambah
            $rules = [
                "id_penyedia"       => 'required',
                "id_konsultan"      => 'required',
                "id_teknislap"      => 'required',
                "id_fund"           => 'required',
                "pj_penyedia"       => 'required',
                "pj_konsultan"      => 'required',
                "kd_rekening"       => 'required',
                "no_spmk"           => 'required',
                "tgl_spmk"          => 'required',
                "no_ba_mc0"         => 'required',
                "tgl_ba_mc0"        => 'required',
                "no_ba_kntb"        => 'required',
                "tgl_ba_kntb"       => 'required',
                "no_sppbj"          => 'required',
                "tgl_sppbj"         => 'required',
                "no_ba_rp2k"        => 'required',
                "tgl_ba_rp2k"       => 'required',
                "no_sp"             => 'required',
                "tgl_sp"            => 'required',
                "no_ba_plp"         => 'required',
                "tgl_ba_plp"        => 'required',
                "no_kontrak"        => 'required',
                "tgl_kontrak"       => 'required',
                "tgl_kontrak_mulai" => 'required',
                "tgl_kontrak_akhir" => 'required',
                "nil_kontrak"       => 'required',
                "nil_pagu"          => 'required',
                "thn_anggaran"      => 'required',
                "pembuat_kontrak"   => 'required',
                "laporan"           => 'required|mimes:pdf',
                "doc_kontrak"       => 'required|mimes:pdf',
                "foto_lokasi"       => 'required|mimes:png,jpg,jpeg',
            ];

            $messages = [
                'id_penyedia.required'       => 'Penyedia tidak boleh kosong!',
                'id_konsultan.required'      => 'Konsultan tidak boleh kosong!',
                'id_teknislap.required'      => 'Teknis Lapangan tidak boleh kosong!',
                'id_fund.required'           => 'Funding tidak boleh kosong!',
                'pj_penyedia.required'       => 'Penanggungjawab Penyedia tidak boleh kosong!',
                'pj_konsultan.required'      => 'Penanggungjawab Konsultan tidak boleh kosong!',
                'kd_rekening.required'       => 'Kode Rekening tidak boleh kosong!',
                'no_spmk.required'           => 'Nomor SPMK tidak boleh kosong!',
                'tgl_spmk.required'          => 'Tanggal SPMK tidak boleh kosong!',
                'no_ba_mc0.required'         => 'Nomor BA MC0 tidak boleh kosong!',
                'tgl_ba_mc0.required'        => 'Tanggal BA MC0 tidak boleh kosong!',
                'no_ba_kntb.required'        => 'Nomor BA KNTB tidak boleh kosong!',
                'tgl_ba_kntb.required'       => 'Tanggal BA KNTB tidak boleh kosong!',
                'no_sppbj.required'          => 'Nomor SPPBJ tidak boleh kosong!',
                'tgl_sppbj.required'         => 'Tanggal SPPBJ tidak boleh kosong!',
                'no_ba_rp2k.required'        => 'Nomor BA RP2K tidak boleh kosong!',
                'tgl_ba_rp2k.required'       => 'Tanggal BA RP2K tidak boleh kosong!',
                'no_sp.required'             => 'Nomor SP tidak boleh kosong!',
                'tgl_sp.required'            => 'Tanggal SP tidak boleh kosong!',
                'no_ba_plp.required'         => 'Nomor BA PLP tidak boleh kosong!',
                'tgl_ba_plp.required'        => 'Tanggal BA PLP tidak boleh kosong!',
                'no_kontrak.required'        => 'Nomor Kontrak tidak boleh kosong!',
                'tgl_kontrak.required'       => 'Tanggal Kontrak tidak boleh kosong!',
                'tgl_kontrak_mulai.required' => 'Mulai Kontrak tidak boleh kosong!',
                'tgl_kontrak_akhir.required' => 'Akhir Kontrak tidak boleh kosong!',
                'nil_kontrak.required'       => 'Nilai Kontrak tidak boleh kosong!',
                'nil_pagu.required'          => 'Nilai Pagu tidak boleh kosong!',
                'thn_anggaran.required'      => 'Tahun Anggaran tidak boleh kosong!',
                'pembuat_kontrak.required'   => 'Pembuat Kontrak tidak boleh kosong!',
                'laporan.required'           => 'Laporan tidak boleh kosong!',
                'laporan.mimes'              => 'Laporan harus berupa pdf!',
                'doc_kontrak.required'       => 'Dokumen Kontrak tidak boleh kosong!',
                'doc_kontrak.mimes'          => 'Dokumen Kontrak harus berupa pdf!',
                'foto_lokasi.required'       => 'Foto Lokasi tidak boleh kosong!',
                'foto_lokasi.mimes'          => 'Foto Lokasi harus berupa png, jpg, jpeg!',
            ];

            foreach ($data['nama_ruas'] as $key => $value) {
                $rules['foto_' . $key] = 'required|mimes:png,jpg,jpeg';
                $rules['nama_ruas_' . $key] = 'required';

                $messages['foto_' . $key . '.required'] = 'Gambar Ruas tidak boleh kosong!';
                $messages['foto_' . $key . '.mimes'] = 'Gambar Ruas harus berupa file PNG, JPG, atau JPEG!';
                $messages['nama_ruas_' . $key . '.required'] = 'Nilai Ruas tidak boleh kosong!';
            }

            foreach ($data['nama_ruas'] as $key => $value) {
                $data['foto_' . $key] = $data['foto'][$key] ?? null;
                $data['nama_ruas_' . $key] = $value;
            }

            if ($data['tgl_kontrak_mulai'] != '' || $data['tgl_kontrak_akhir'] != '') {
                if (empty($data['bobot_rencana'])) {
                    $response = ['title' => 'Gagal!', 'text'  => 'Bobot Rencana tidak boleh kosong!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger'];

                    return Response::json($response);
                } else {
                    foreach ($data['bobot_rencana'] as $key => $value) {
                        $rules['bobot_rencana_' . $key] = 'required';

                        $messages['bobot_rencana_' . $key . '.required'] = 'Bobot Rencana tidak boleh kosong!';
                    }

                    foreach ($data['bobot_rencana'] as $key => $value) {
                        $data['bobot_rencana_' . $key] = $value;
                    }
                }
            }
        } else {
            // ubah
            $rules = [
                "id_penyedia"       => 'required',
                "id_konsultan"      => 'required',
                "id_teknislap"      => 'required',
                "id_fund"           => 'required',
                "pj_penyedia"       => 'required',
                "pj_konsultan"      => 'required',
                "kd_rekening"       => 'required',
                "no_spmk"           => 'required',
                "tgl_spmk"          => 'required',
                "no_ba_mc0"         => 'required',
                "tgl_ba_mc0"        => 'required',
                "no_ba_kntb"        => 'required',
                "tgl_ba_kntb"       => 'required',
                "no_sppbj"          => 'required',
                "tgl_sppbj"         => 'required',
                "no_ba_rp2k"        => 'required',
                "tgl_ba_rp2k"       => 'required',
                "no_sp"             => 'required',
                "tgl_sp"            => 'required',
                "no_ba_plp"         => 'required',
                "tgl_ba_plp"        => 'required',
                "no_kontrak"        => 'required',
                "tgl_kontrak"       => 'required',
                "tgl_kontrak_mulai" => 'required',
                "tgl_kontrak_akhir" => 'required',
                "nil_kontrak"       => 'required',
                "nil_pagu"          => 'required',
                "thn_anggaran"      => 'required',
                "pembuat_kontrak"   => 'required',
            ];

            $messages = [
                'id_penyedia.required'       => 'Penyedia tidak boleh kosong!',
                'id_konsultan.required'      => 'Konsultan tidak boleh kosong!',
                'id_teknislap.required'      => 'Teknis Lapangan tidak boleh kosong!',
                'id_fund.required'           => 'Funding tidak boleh kosong!',
                'pj_penyedia.required'       => 'Pembuat Kontrak tidak boleh kosong!',
                'pj_konsultan.required'      => 'Pembuat Kontrak tidak boleh kosong!',
                'kd_rekening.required'       => 'Kode Rekening tidak boleh kosong!',
                'no_spmk.required'           => 'Nomor SPMK tidak boleh kosong!',
                'tgl_spmk.required'          => 'Tanggal SPMK tidak boleh kosong!',
                'no_ba_mc0.required'         => 'Nomor BA MC0 tidak boleh kosong!',
                'tgl_ba_mc0.required'        => 'Tanggal BA MC0 tidak boleh kosong!',
                'no_ba_kntb.required'        => 'Nomor BA KNTB tidak boleh kosong!',
                'tgl_ba_kntb.required'       => 'Tanggal BA KNTB tidak boleh kosong!',
                'no_sppbj.required'          => 'Nomor SPPBJ tidak boleh kosong!',
                'tgl_sppbj.required'         => 'Tanggal SPPBJ tidak boleh kosong!',
                'no_ba_rp2k.required'        => 'Nomor BA RP2K tidak boleh kosong!',
                'tgl_ba_rp2k.required'       => 'Tanggal BA RP2K tidak boleh kosong!',
                'no_sp.required'             => 'Nomor SP tidak boleh kosong!',
                'tgl_sp.required'            => 'Tanggal SP tidak boleh kosong!',
                'no_ba_plp.required'         => 'Nomor BA PLP tidak boleh kosong!',
                'no_kontrak.required'        => 'Nomor Kontrak tidak boleh kosong!',
                'tgl_kontrak.required'       => 'Tanggal Kontrak tidak boleh kosong!',
                'tgl_kontrak_mulai.required' => 'Tgl Mulai Kontrak tidak boleh kosong!',
                'tgl_kontrak_akhir.required' => 'Tgl Akhir Kontrak tidak boleh kosong!',
                'nil_kontrak.required'       => 'Nilai Kontrak tidak boleh kosong!',
                'nil_pagu.required'          => 'Nilai Pagu tidak boleh kosong!',
                'thn_anggaran.required'      => 'Tahun Anggaran tidak boleh kosong!',
                'pembuat_kontrak.required'   => 'Pembuat Kontrak tidak boleh kosong!',
            ];

            if ($request->change_picture_lokasi === 'on') {
                // untuk tambah rule
                $rules['foto_lokasi'] = 'required|mimes:png,jpg,jpeg';

                // untuk tambah message
                $messages['foto_lokasi.required'] = 'Gambar harus diisi!';
                $messages['foto_lokasi.mimes']    = 'Gambar harus berupa file PNG, JPG, atau JPEG!';
            }

            if ($request->change_kontrak === 'on') {
                // untuk tambah rule
                $rules['doc_kontrak'] = 'required|mimes:pdf';

                // untuk tambah message
                $messages['doc_kontrak.required'] = 'Dokumen Free harus diisi!';
                $messages['doc_kontrak.mimes']    = 'Dokumen Free harus format pdf!';
            }

            if ($request->change_report === 'on') {
                // untuk tambah rule
                $rules['laporan'] = 'required|mimes:pdf';

                // untuk tambah message
                $messages['laporan.required'] = 'Dokumen Pro harus diisi!';
                $messages['laporan.mimes']    = 'Dokumen Pro harus format pdf!';
            }

            $id_ruas_paket = $data['id_kontrak_ruas'];

            rsort($id_ruas_paket);

            foreach ($id_ruas_paket as $key => $value) {
                // untuk data
                $data['id_kontrak_ruas_' . $key] = $value;
                $data['nama_ruas_' . $key] = $data['nama_ruas_' . $key];

                // untuk validasi
                $rules['nama_ruas_' . $key] = 'required';
                $messages['nama_ruas_' . $key . '.required'] = 'Nilai Ruas tidak boleh kosong!';

                if ((int) $value === 0) {
                    // untuk validasi
                    $rules['foto_' . $key] = 'required|mimes:png,jpg,jpeg';

                    $messages['foto_' . $key . '.required'] = 'Gambar Ruas tidak boleh kosong!';
                    $messages['foto_' . $key . '.mimes'] = 'Gambar Ruas harus berupa file PNG, JPG, atau JPEG!';
                } else {
                    if (isset($data['change_picture_ruas_' . $key]) && $data['change_picture_ruas_' . $key] === 'on') {
                        // untuk validasi
                        $rules['foto_' . $key] = 'required|mimes:png,jpg,jpeg';

                        $messages['foto_' . $key . '.required'] = 'Gambar Ruas tidak boleh kosong!';
                        $messages['foto_' . $key . '.mimes'] = 'Gambar Ruas harus berupa file PNG, JPG, atau JPEG!';
                    }
                }
            }

            if ($data['tgl_kontrak_mulai'] != '' || $data['tgl_kontrak_akhir'] != '') {
                if (isset($data['bobot_rencana'])) {
                    foreach ($data['bobot_rencana'] as $key => $value) {
                        $rules['bobot_rencana_' . $key] = 'required';

                        $messages['bobot_rencana_' . $key . '.required'] = 'Bobot Rencana tidak boleh kosong!';
                    }

                    foreach ($data['bobot_rencana'] as $key => $value) {
                        $data['bobot_rencana_' . $key] = $value;
                    }
                }
            }
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        DB::beginTransaction();
        try {
            if ($request->id_kontrak === null) {
                // tambah
                $laporan     = add_pdf($request->laporan);
                $doc_kontrak = add_pdf($request->doc_kontrak);
                $foto_lokasi = add_picture($request->foto_lokasi);

                $kontrak = Kontrak::create([
                    'id_paket'          => $request->id_paket,
                    'id_penyedia'       => $request->id_penyedia,
                    'id_konsultan'      => $request->id_konsultan,
                    'id_teknislap'      => $request->id_teknislap,
                    'id_fund'           => $request->id_fund,
                    'pj_penyedia'       => $request->pj_penyedia,
                    'pj_konsultan'      => $request->pj_konsultan,
                    'kd_rekening'       => $request->kd_rekening,
                    'no_spmk'           => $request->no_spmk,
                    'tgl_spmk'          => $request->tgl_spmk,
                    'no_ba_mc0'         => $request->no_ba_mc0,
                    'tgl_ba_mc0'        => $request->tgl_ba_mc0,
                    'no_ba_kntb'        => $request->no_ba_kntb,
                    'tgl_ba_kntb'       => $request->tgl_ba_kntb,
                    'no_sppbj'          => $request->no_sppbj,
                    'tgl_sppbj'         => $request->tgl_sppbj,
                    'no_ba_rp2k'        => $request->no_ba_rp2k,
                    'tgl_ba_rp2k'       => $request->tgl_ba_rp2k,
                    'no_sp'             => $request->no_sp,
                    'tgl_sp'            => $request->tgl_sp,
                    'no_ba_plp'         => $request->no_ba_plp,
                    'tgl_ba_plp'        => $request->tgl_ba_plp,
                    'no_ba_plp'         => $request->no_ba_plp,
                    'tgl_ba_plp'        => $request->tgl_ba_plp,
                    'no_kontrak'        => $request->no_kontrak,
                    'tgl_kontrak'       => $request->tgl_kontrak,
                    'tgl_kontrak_mulai' => $request->tgl_kontrak_mulai,
                    'tgl_kontrak_akhir' => $request->tgl_kontrak_akhir,
                    'nil_kontrak'       => remove_separator($request->nil_kontrak),
                    'nil_pagu'          => remove_separator($request->nil_pagu),
                    'thn_anggaran'      => $request->thn_anggaran,
                    'pembuat_kontrak'   => $request->pembuat_kontrak,
                    'laporan'           => $laporan,
                    'doc_kontrak'       => $doc_kontrak,
                    'foto_lokasi'       => $foto_lokasi,
                    'by_users'          => $this->session['id_users'],
                ]);

                $id_kontrak = $kontrak->id_kontrak;

                foreach ($data['nama_ruas'] as $key => $value) {
                    $foto = add_picture($data['foto_' . $key]);

                    KontrakRuas::create([
                        'id_kontrak' => $id_kontrak,
                        'foto'       => $foto,
                        'nama'       => $value,
                        'by_users'   => $this->session['id_users'],
                    ]);
                }

                foreach ($data['bobot_rencana'] as $key => $value) {
                    KontrakRencana::create([
                        'id_kontrak' => $id_kontrak,
                        'minggu_ke'  => $key + 1,
                        'bobot'      => $value,
                    ]);
                }

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success', 'url' => route_role('admin.kontrak.ruas.index', ['id' => my_encrypt($id_kontrak)])];
            } else {
                // ubah
                $id_kontrak = my_decrypt($request->id_kontrak);
                $kontrak    = Kontrak::find($id_kontrak);

                if ($request->change_picture_lokasi === 'on') {
                    $foto_lokasi          = upd_picture($request->foto_lokasi, $kontrak->foto_lokasi);
                    $kontrak->foto_lokasi = $foto_lokasi;
                }

                if ($request->change_kontrak === 'on') {
                    $doc_kontrak          = upd_pdf($request->doc_kontrak, $kontrak->doc_kontrak);
                    $kontrak->doc_kontrak = $doc_kontrak;
                }

                if ($request->change_report === 'on') {
                    $laporan          = upd_pdf($request->laporan, $kontrak->laporan);
                    $kontrak->laporan = $laporan;
                }

                $kontrak->id_penyedia       = $request->id_penyedia;
                $kontrak->id_konsultan      = $request->id_konsultan;
                $kontrak->id_teknislap      = $request->id_teknislap;
                $kontrak->id_fund           = $request->id_fund;
                $kontrak->pj_penyedia       = $request->pj_penyedia;
                $kontrak->pj_konsultan      = $request->pj_konsultan;
                $kontrak->kd_rekening       = $request->kd_rekening;
                $kontrak->no_spmk           = $request->no_spmk;
                $kontrak->tgl_spmk          = $request->tgl_spmk;
                $kontrak->no_ba_mc0         = $request->no_ba_mc0;
                $kontrak->tgl_ba_mc0        = $request->tgl_ba_mc0;
                $kontrak->no_ba_kntb        = $request->no_ba_kntb;
                $kontrak->tgl_ba_kntb       = $request->tgl_ba_kntb;
                $kontrak->no_sppbj          = $request->no_sppbj;
                $kontrak->tgl_sppbj         = $request->tgl_sppbj;
                $kontrak->no_ba_rp2k        = $request->no_ba_rp2k;
                $kontrak->tgl_ba_rp2k       = $request->tgl_ba_rp2k;
                $kontrak->no_sp             = $request->no_sp;
                $kontrak->tgl_sp            = $request->tgl_sp;
                $kontrak->no_ba_plp         = $request->no_ba_plp;
                $kontrak->tgl_ba_plp        = $request->tgl_ba_plp;
                $kontrak->no_ba_plp         = $request->no_ba_plp;
                $kontrak->tgl_ba_plp        = $request->tgl_ba_plp;
                $kontrak->no_kontrak        = $request->no_kontrak;
                $kontrak->tgl_kontrak       = $request->tgl_kontrak;
                $kontrak->tgl_kontrak_mulai = $request->tgl_kontrak_mulai;
                $kontrak->tgl_kontrak_akhir = $request->tgl_kontrak_akhir;
                $kontrak->nil_kontrak       = remove_separator($request->nil_kontrak);
                $kontrak->nil_pagu          = remove_separator($request->nil_pagu);
                $kontrak->thn_anggaran      = $request->thn_anggaran;
                $kontrak->pembuat_kontrak   = $request->pembuat_kontrak;
                $kontrak->by_users          = $this->session['id_users'];
                $kontrak->save();

                $id_ruas_paket = $data['id_kontrak_ruas'];

                rsort($id_ruas_paket);

                foreach ($id_ruas_paket as $key => $value) {
                    $nama = $data['nama_ruas_' . $key];

                    if ((int) $value !== 0) {
                        $ruas = KontrakRuas::find($value);

                        if (isset($data['change_picture_ruas_' . $key]) && $data['change_picture_ruas_' . $key] === 'on') {
                            $foto       = upd_picture($data['foto_' . $key], $ruas->foto);
                            $ruas->foto = $foto;
                        }

                        $ruas->nama = $nama;
                        $ruas->by_users = $this->session['id_users'];
                        $ruas->save();
                    } else {
                        $foto = add_picture($data['foto_' . $key]);

                        KontrakRuas::create([
                            'id_kontrak' => $id_kontrak,
                            'foto'       => $foto,
                            'nama'       => $nama,
                            'by_users'   => $this->session['id_users'],
                        ]);
                    }
                }

                if (isset($data['id_kontrak_rencana'])) {
                    $id_kontrak_rencana = $data['id_kontrak_rencana'];

                    $check_rencana = KontrakRencana::whereIdKontrak($id_kontrak)->get()->count();
                    $data_rencana  = [];
                    foreach ($id_kontrak_rencana as $key => $value) {
                        $bobot = $data['bobot_rencana_' . $key];

                        if ((int) $value !== 0) {
                            $data_rencana[] = $value;

                            $rencana = KontrakRencana::find($value);

                            $rencana->minggu_ke = $key + 1;
                            $rencana->bobot     = $bobot;
                            $rencana->save();
                        } else {
                            KontrakRencana::create([
                                'id_kontrak' => $id_kontrak,
                                'minggu_ke'  => $key + 1,
                                'bobot'      => $bobot,
                            ]);
                        }
                    }

                    if (count($id_kontrak_rencana) < $check_rencana) {
                        KontrakRencana::whereNotIn('id_kontrak_rencana', $data_rencana)->whereIdKontrak($id_kontrak)->delete();
                    }
                }

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success', 'url' => route_role('admin.kontrak.ruas.index', ['id' => my_encrypt($id_kontrak)])];
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        $checking = is_valid_user($this->session['id_users'], $request->password);
        if ($checking) {
            try {
                $data = Kontrak::find(my_decrypt($request->id));

                del_pdf($data->laporan);
                del_pdf($data->doc_kontrak);
                del_picture($data->foto_lokasi);

                $data->delete();

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
            } catch (\Exception $e) {
                $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
            }
        } else {
            $response = ['title' => 'Maaf!', 'text' => 'Password Anda Salah!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
        }
        return Response::json($response);
    }

    public function rencana(Request $request)
    {
        $tgl_kontrak_mulai = date("Y-m-d", strtotime($request->tgl_kontrak_mulai));
        $tgl_kontrak_akhir = date("Y-m-d", strtotime($request->tgl_kontrak_akhir));
        $count_weeks       = count_weeks($tgl_kontrak_akhir, $tgl_kontrak_mulai);

        $html = '';
        $ke = 1;

        if (empty($request->id_kontrak)) {
            for ($i = 0; $i < $count_weeks; $i++) {
                $html .= '<div class="col-12">';
                $html .= '<div class="field-input mb-1 row">';
                $html .= '<div class="col-sm-3">';
                $html .= '<label class="col-form-label" for="bobot_rencana_' . $i . '">Minggu ke-' . $ke . '&nbsp;*</label>';
                $html .= '</div>';
                $html .= '<div class="col-sm-9">';
                $html .= '<input type="text" class="form-control form-control-sm" id="bobot_rencana_' . $i . '" name="bobot_rencana[]" placeholder="Masukkan bobot Minggu ke-' . $ke . '" />';
                $html .= '<div class="invalid-feedback"></div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';

                $ke++;
            }
        } else {
            $kontrak_rencana = KontrakRencana::where('id_kontrak', my_decrypt($request->id_kontrak))->get()->toArray();

            for ($i = 0; $i < $count_weeks; $i++) {
                $id_kontrak_rencana = $kontrak_rencana[$i]['id_kontrak_rencana'] ?? 0;
                $bobot              = $kontrak_rencana[$i]['bobot'] ?? '';

                $html .= '<input type="hidden" name="id_kontrak_rencana[]" value="' . $id_kontrak_rencana . '" />';
                $html .= '<div class="col-12">';
                $html .= '<div class="field-input mb-1 row">';
                $html .= '<div class="col-sm-3">';
                $html .= '<label class="col-form-label" for="bobot_rencana_' . $i . '">Minggu ke-' . $ke . '&nbsp;*</label>';
                $html .= '</div>';
                $html .= '<div class="col-sm-9">';
                $html .= '<input type="text" class="form-control form-control-sm" id="bobot_rencana_' . $i . '" name="bobot_rencana[]" placeholder="Masukkan bobot Minggu ke-' . $ke . '" value="' . $bobot . '" />';
                $html .= '<div class="invalid-feedback"></div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';

                $ke++;
            }
        }

        return $html;
    }
}
