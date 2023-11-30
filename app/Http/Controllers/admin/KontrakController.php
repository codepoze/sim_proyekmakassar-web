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

    public function progress()
    {
        $id = last(request()->segments());

        $kontrak = Kontrak::findOrFail(my_decrypt($id));

        $kontrak_rencana = KontrakRencana::whereIdKontrak(my_decrypt($id))->get();

        $get_kontrak_rencana = [];
        $rencana_komulatif = 0;
        $realisasi_komulatif = 0;
        foreach ($kontrak_rencana as $key => $value) {
            $rencana_komulatif += $value->bobot;
            $realisasi_komulatif += $this->_count_progress(my_decrypt($id), $value->id_kontrak_rencana);

            $get_kontrak_rencana[] = [
                'minggu_ke'           => "Minggu ke-" . $value->minggu_ke,
                'rencana'             => $value->bobot,
                'rencana_komulatif'   => $rencana_komulatif,
                'realisasi'           => $this->_count_progress(my_decrypt($id), $value->id_kontrak_rencana),
                'realisasi_komulatif' => $realisasi_komulatif,
                'devisiasi'           => ($realisasi_komulatif - $rencana_komulatif)
            ];
        }

        $data = [
            'id_kontrak'      => $id,
            'kontrak'         => $kontrak,
            'kontrak_rencana' => $get_kontrak_rencana
        ];

        return Template::load('admin', 'Progress Kontrak', 'kontrak', 'progress', $data);
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

        $get = KontrakRencana::whereIdKontrak($id_kontrak)->get();

        foreach ($get as $key => $value) {
            $response[] = [
                'category' => "Minggu ke-" . $value->minggu_ke,
                'value1'   => $value->bobot,
                'value2'   => $this->_count_progress($id_kontrak, $value->id_kontrak_rencana),
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
                "pj_penyedia"       => 'required',
                "id_konsultan"      => 'required',
                "pj_konsultan"      => 'required',
                "id_teknislap"      => 'required',
                "jns_kontrak"       => 'required',
                "no_spmk"           => 'required',
                "no_kontrak"        => 'required',
                "tgl_kontrak_mulai" => 'required',
                "tgl_kontrak_akhir" => 'required',
                "thn_anggaran"      => 'required',
                "nil_pagu"          => 'required',
                "kd_rekening"       => 'required',
                "id_fund"           => 'required',
                'laporan'           => 'required|mimes:pdf',
                'doc_kontrak'       => 'required|mimes:pdf',
                'foto_lokasi'       => 'required|mimes:png,jpg,jpeg',
            ];

            $messages = [
                'id_penyedia.required'       => 'Penyedia tidak boleh kosong!',
                'pj_penyedia.required'       => 'Pj Penyedia tidak boleh kosong!',
                'id_konsultan.required'      => 'Konsultan tidak boleh kosong!',
                'pj_konsultan.required'      => 'Pj Konsultan tidak boleh kosong!',
                'id_teknislap.required'      => 'Teknis Lapangan tidak boleh kosong!',
                'jns_kontrak.required'       => 'Nama Paket tidak boleh kosong!',
                'no_spmk.required'           => 'Nomor SPMK tidak boleh kosong!',
                'no_kontrak.required'        => 'Nomor Kontrak tidak boleh kosong!',
                'tgl_kontrak_mulai.required' => 'Tgl Kontrak Mulai tidak boleh kosong!',
                'tgl_kontrak_akhir.required' => 'Tgl Kontrak Akhir tidak boleh kosong!',
                'thn_anggaran.required'      => 'Tahun Anggaran tidak boleh kosong!',
                'nil_pagu.required'          => 'Nilai Pagu tidak boleh kosong!',
                'kd_rekening.required'       => 'Kode Rekening tidak boleh kosong!',
                'id_fund.required'           => 'Sumber Dana tidak boleh kosong!',
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
                "pj_penyedia"       => 'required',
                "id_konsultan"      => 'required',
                "pj_konsultan"      => 'required',
                "id_teknislap"      => 'required',
                "jns_kontrak"       => 'required',
                "no_spmk"           => 'required',
                "no_kontrak"        => 'required',
                "tgl_kontrak_mulai" => 'required',
                "tgl_kontrak_akhir" => 'required',
                "thn_anggaran"      => 'required',
                "nil_pagu"          => 'required',
                "kd_rekening"       => 'required',
                "id_fund"           => 'required',
            ];

            $messages = [
                'id_penyedia.required'       => 'Penyedia tidak boleh kosong!',
                'pj_penyedia.required'       => 'Pj Penyedia tidak boleh kosong!',
                'id_konsultan.required'      => 'Konsultan tidak boleh kosong!',
                'pj_konsultan.required'      => 'Pj Konsultan tidak boleh kosong!',
                'id_teknislap.required'      => 'Teknis Lapangan tidak boleh kosong!',
                'jns_kontrak.required'       => 'Nama Paket tidak boleh kosong!',
                'no_spmk.required'           => 'Nomor SPMK tidak boleh kosong!',
                'no_kontrak.required'        => 'Nomor Kontrak tidak boleh kosong!',
                'tgl_kontrak_mulai.required' => 'Tgl Kontrak Mulai tidak boleh kosong!',
                'tgl_kontrak_akhir.required' => 'Tgl Kontrak Akhir tidak boleh kosong!',
                'thn_anggaran.required'      => 'Tahun Anggaran tidak boleh kosong!',
                'nil_pagu.required'          => 'Nilai Pagu tidak boleh kosong!',
                'kd_rekening.required'       => 'Kode Rekening tidak boleh kosong!',
                'id_fund.required'           => 'Sumber Dana tidak boleh kosong!',
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
                    'no_spmk'           => $request->no_spmk,
                    'no_kontrak'        => $request->no_kontrak,
                    'jns_kontrak'       => $request->jns_kontrak,
                    'tgl_kontrak_mulai' => $request->tgl_kontrak_mulai,
                    'tgl_kontrak_akhir' => $request->tgl_kontrak_akhir,
                    'thn_anggaran'      => $request->thn_anggaran,
                    'nil_pagu'          => remove_separator($request->nil_pagu),
                    'kd_rekening'       => $request->kd_rekening,
                    'sumber_dana'       => $request->sumber_dana,
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
                $kontrak->no_spmk           = $request->no_spmk;
                $kontrak->no_kontrak        = $request->no_kontrak;
                $kontrak->jns_kontrak       = $request->jns_kontrak;
                $kontrak->tgl_kontrak_mulai = $request->tgl_kontrak_mulai;
                $kontrak->tgl_kontrak_akhir = $request->tgl_kontrak_akhir;
                $kontrak->thn_anggaran      = $request->thn_anggaran;
                $kontrak->nil_pagu          = remove_separator($request->nil_pagu);
                $kontrak->kd_rekening       = $request->kd_rekening;
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

    public function _count_progress($id_kontrak, $id_kontrak_rencana)
    {
        $get = DB::select("SELECT k.id_kontrak, kr.id_kontrak_ruas, kri.id_kontrak_ruas_item, p.id_progress, p.id_kontrak_rencana, p.panjang, p.titik_core, p.l_1, p.l_2, p.l_3, p.l_4, p.tki_1, p.tki_2, p.tki_3, p.tte_1, p.tte_2, p.tte_3, p.tka_1, p.tka_2, p.tka_3, p.berat_bersih FROM kontrak AS k LEFT JOIN kontrak_ruas AS kr ON kr.id_kontrak = k.id_kontrak LEFT JOIN kontrak_ruas_item AS kri ON kri.id_kontrak_ruas = kr.id_kontrak_ruas LEFT JOIN progress AS p ON p.id_kontrak_ruas_item = kri.id_kontrak_ruas_item WHERE k.id_kontrak = '$id_kontrak' AND p.id_kontrak_rencana = '$id_kontrak_rencana'");

        $volume = 0;
        foreach ($get as $key => $value) {
            $lebar = (($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / 3) / 100;

            $tebal_kiri = (($value->tki_1 + $value->tki_2 + $value->tki_3) / 3) / 100;
            $tebal_tengah = (($value->tte_1 + $value->tte_2 + $value->tte_3) / 3) / 100;
            $tebal_kanan = (($value->tka_1 + $value->tka_2 + $value->tka_3) / 3) / 100;
            $sum_tebal = (($tebal_kiri + $tebal_tengah + $tebal_kanan) / 3);

            $count = ($value->panjang * $lebar * $sum_tebal * $value->berat_bersih);
            $volume += round($count, 2);
        }

        return $volume;
    }
}
