<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Pdf;
use App\Libraries\Template;
use App\Models\Kegiatan;
use App\Models\Paket;
use App\Models\PaketRuas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaketController extends Controller
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
        return Template::load('admin', 'Paket', 'paket', 'view');
    }

    public function add()
    {
        $id = my_decrypt(last(request()->segments()));

        $data = [
            'id_kegiatan' => $id,
        ];

        return Template::load('admin', 'Tambah Paket', 'paket', 'add', $data);
    }

    public function upd()
    {
        $id = last(request()->segments());

        $data = [
            'id_paket' => $id,
            'paket'    => Paket::findOrFail(my_decrypt($id)),
        ];

        return Template::load('admin', 'Ubah Paket', 'paket', 'upd', $data);
    }

    public function det()
    {
        $id = last(request()->segments());

        $paket = Paket::findOrFail(my_decrypt($id));

        $nil_kontrak = 0;
        foreach ($paket->toPaketRuas as $key => $value) {
            $nil_kontrak += $value->toPaketRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });
        }

        $data = [
            'id_paket'    => $id,
            'paket'       => $paket,
            'nil_kontrak' => $nil_kontrak
        ];

        return Template::load('admin', 'Detail Paket', 'paket', 'det', $data);
    }

    public function print()
    {
        $id = last(request()->segments());

        $paket = Paket::findOrFail(my_decrypt($id));

        $nil_kontrak = 0;
        foreach ($paket->toPaketRuas as $key => $value) {
            $nil_kontrak += $value->toPaketRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });
        }

        $data = [
            'id_paket'    => $id,
            'paket'       => $paket,
            'nil_kontrak' => $nil_kontrak
        ];

        Pdf::printPdf('Rencana Anggaran Biaya', 'admin.paket.print', 'legal', 'landscape', $data);
    }

    public function get_data_dt(Request $request)
    {
        $query = Paket::query();

        if ($request->id_kegiatan) {
            $query->whereIdKegiatan($request->id_kegiatan);
        }

        if ($this->session['roles'] == 'pptk') {
            $pptk = User::with(['toPptk'])->find($this->session['id_users']);

            $query->whereHas('toKegiatan', function ($q) use ($pptk) {
                $q->whereIdPptk($pptk->toPptk->id_pptk);
            });
        }

        $data = $query->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nil_kontrak', function ($row) {
                $result = 0;
                foreach ($row->toPaketRuas as $key => $value) {
                    $result += $value->toPaketRuasItem->sum(function ($item) {
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
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route_role('admin.paket.det', ['id' => my_encrypt($row->id_paket)]) . '" class="btn btn-action btn-sm btn-relief-info"><i data-feather="info"></i>&nbsp;Detail</a>&nbsp;
                    <a href="' . route_role("admin.paket.upd", ['id' => my_encrypt($row->id_paket)]) . '" class="btn btn-action btn-sm btn-relief-primary"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></a>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_paket) . '" class="btn btn-action btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function save(Request $request)
    {
        $post = $request->all();

        $data = [];
        foreach ($post as $key => $value) {
            $data[$key] = $value;
        }

        if ($request->id_paket === null) {
            // tambah
            $rules = [
                "id_penyedia"       => 'required',
                "pj_penyedia"       => 'required',
                "id_konsultan"      => 'required',
                "pj_konsultan"      => 'required',
                "id_teknislap"      => 'required',
                "nma_paket"         => 'required',
                "no_spmk"           => 'required',
                "no_kontrak"        => 'required',
                "tgl_kontrak_mulai" => 'required',
                "tgl_kontrak_akhir" => 'required',
                "thn_anggaran"      => 'required',
                "nil_pagu"          => 'required',
                "kd_rekening"       => 'required',
                "sumber_dana"       => 'required',
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
                'nma_paket.required'         => 'Nama Paket tidak boleh kosong!',
                'no_spmk.required'           => 'Nomor SPMK tidak boleh kosong!',
                'no_kontrak.required'        => 'Nomor Kontrak tidak boleh kosong!',
                'tgl_kontrak_mulai.required' => 'Tgl Kontrak Mulai tidak boleh kosong!',
                'tgl_kontrak_akhir.required' => 'Tgl Kontrak Akhir tidak boleh kosong!',
                'thn_anggaran.required'      => 'Tahun Anggaran tidak boleh kosong!',
                'nil_pagu.required'          => 'Nilai Pagu tidak boleh kosong!',
                'kd_rekening.required'       => 'Kode Rekening tidak boleh kosong!',
                'sumber_dana.required'       => 'Sumber Dana tidak boleh kosong!',
                'laporan.required'           => 'Laporan tidak boleh kosong!',
                'laporan.mimes'              => 'Laporan harus berupa pdf!',
                'doc_kontrak.required'       => 'Dokumen Kontrak tidak boleh kosong!',
                'doc_kontrak.mimes'          => 'Dokumen Kontrak harus berupa pdf!',
                'foto_lokasi.required'       => 'Foto Lokasi tidak boleh kosong!',
                'foto_lokasi.mimes'          => 'Foto Lokasi harus berupa png, jpg, jpeg!',
            ];

            foreach ($data['nama_ruas'] as $key => $value) {
                $data['nama_ruas_' . $key] = $value;
            }
        } else {
            // ubah
            $rules = [
                "id_penyedia"       => 'required',
                "pj_penyedia"       => 'required',
                "id_konsultan"      => 'required',
                "pj_konsultan"      => 'required',
                "id_teknislap"      => 'required',
                "nma_paket"         => 'required',
                "no_spmk"           => 'required',
                "no_kontrak"        => 'required',
                "tgl_kontrak_mulai" => 'required',
                "tgl_kontrak_akhir" => 'required',
                "thn_anggaran"      => 'required',
                "nil_pagu"          => 'required',
                "kd_rekening"       => 'required',
                "sumber_dana"       => 'required',
            ];

            $messages = [
                'id_penyedia.required'       => 'Penyedia tidak boleh kosong!',
                'pj_penyedia.required'       => 'Pj Penyedia tidak boleh kosong!',
                'id_konsultan.required'      => 'Konsultan tidak boleh kosong!',
                'pj_konsultan.required'      => 'Pj Konsultan tidak boleh kosong!',
                'id_teknislap.required'      => 'Teknis Lapangan tidak boleh kosong!',
                'nma_paket.required'         => 'Nama Paket tidak boleh kosong!',
                'no_spmk.required'           => 'Nomor SPMK tidak boleh kosong!',
                'no_kontrak.required'        => 'Nomor Kontrak tidak boleh kosong!',
                'tgl_kontrak_mulai.required' => 'Tgl Kontrak Mulai tidak boleh kosong!',
                'tgl_kontrak_akhir.required' => 'Tgl Kontrak Akhir tidak boleh kosong!',
                'thn_anggaran.required'      => 'Tahun Anggaran tidak boleh kosong!',
                'nil_pagu.required'          => 'Nilai Pagu tidak boleh kosong!',
                'kd_rekening.required'       => 'Kode Rekening tidak boleh kosong!',
                'sumber_dana.required'       => 'Sumber Dana tidak boleh kosong!',
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

            foreach ($data['nama_ruas'] as $key => $value) {
                $data['id_paket_ruas_' . $key]    = $data['id_paket_ruas'][$key];
                $data['nama_ruas_' . $key] = $value;
            }
        }

        foreach ($data['nama_ruas'] as $key => $value) {
            $rules['nama_ruas_' . $key] = 'required';

            $messages['nama_ruas_' . $key . '.required'] = 'Nilai Ruas tidak boleh kosong!';
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            if ($request->id_paket === null) {
                // tambah
                $laporan     = add_pdf($request->laporan);
                $doc_kontrak = add_pdf($request->doc_kontrak);
                $foto_lokasi = add_picture($request->foto_lokasi);

                $paket = Paket::create([
                    'id_kegiatan'       => $request->id_kegiatan,
                    'id_penyedia'       => $request->id_penyedia,
                    'id_konsultan'      => $request->id_konsultan,
                    'id_teknislap'      => $request->id_teknislap,
                    'nma_paket'         => $request->nma_paket,
                    'pj_penyedia'       => $request->pj_penyedia,
                    'pj_konsultan'      => $request->pj_konsultan,
                    'no_spmk'           => $request->no_spmk,
                    'no_kontrak'        => $request->no_kontrak,
                    'tgl_kontrak_mulai' => $request->tgl_kontrak_mulai,
                    'tgl_kontrak_akhir' => $request->tgl_kontrak_akhir,
                    'thn_anggaran'      => $request->thn_anggaran,
                    'nil_pagu'          => $request->nil_pagu,
                    'kd_rekening'       => $request->kd_rekening,
                    'sumber_dana'       => $request->sumber_dana,
                    'laporan'           => $laporan,
                    'doc_kontrak'       => $doc_kontrak,
                    'foto_lokasi'       => $foto_lokasi,
                    'by_users'          => $this->session['id_users'],
                ]);

                $id_paket = $paket->id_paket;

                foreach ($data['nama_ruas'] as $key => $value) {
                    PaketRuas::create([
                        'id_paket' => $id_paket,
                        'nama'     => $value,
                        'by_users' => $this->session['id_users'],
                    ]);
                }

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success', 'url' => route_role('admin.paket.ruas.index', ['id' => my_encrypt($id_paket)])];
            } else {
                // ubah
                $id_paket = my_decrypt($request->id_paket);
                $paket    = Paket::find($id_paket);

                if ($request->change_picture_lokasi === 'on') {
                    $foto_lokasi        = upd_picture($request->foto_lokasi, $paket->foto_lokasi);
                    $paket->foto_lokasi = $foto_lokasi;
                }

                if ($request->change_kontrak === 'on') {
                    $doc_kontrak        = upd_pdf($request->doc_kontrak, $paket->doc_kontrak);
                    $paket->doc_kontrak = $doc_kontrak;
                }

                if ($request->change_report === 'on') {
                    $laporan        = upd_pdf($request->laporan, $paket->laporan);
                    $paket->laporan = $laporan;
                }

                $paket->id_penyedia       = $request->id_penyedia;
                $paket->id_konsultan      = $request->id_konsultan;
                $paket->id_teknislap      = $request->id_teknislap;
                $paket->nma_paket         = $request->nma_paket;
                $paket->pj_penyedia       = $request->pj_penyedia;
                $paket->pj_konsultan      = $request->pj_konsultan;
                $paket->no_spmk           = $request->no_spmk;
                $paket->no_kontrak        = $request->no_kontrak;
                $paket->tgl_kontrak_mulai = $request->tgl_kontrak_mulai;
                $paket->tgl_kontrak_akhir = $request->tgl_kontrak_akhir;
                $paket->thn_anggaran      = $request->thn_anggaran;
                $paket->nil_pagu          = $request->nil_pagu;
                $paket->kd_rekening       = $request->kd_rekening;
                $paket->sumber_dana       = $request->sumber_dana;
                $paket->by_users          = $this->session['id_users'];
                $paket->save();

                $check_ruas = PaketRuas::whereIdPaket($id_paket)->get()->count();
                $data_ruas  = [];
                foreach ($data['nama_ruas'] as $key => $value) {
                    $id_ruas_paket = (int) $data['id_paket_ruas_' . $key];
                    $nama          = $data['nama_ruas_' . $key];

                    if ($id_ruas_paket !== 0) {
                        $data_ruas[] = $id_ruas_paket;

                        $ruas = PaketRuas::find($id_ruas_paket);
                        $ruas->update([
                            'nama'     => $nama,
                            'by_users' => $this->session['id_users'],
                        ]);
                    } else {
                        PaketRuas::create([
                            'id_paket' => $id_paket,
                            'nama'     => $nama,
                            'by_users' => $this->session['id_users'],
                        ]);
                    }
                }

                if (count($data['nama_ruas']) < $check_ruas) {
                    PaketRuas::whereNotIn('id_ruas_paket', $data_ruas)->whereIdPaket($id_paket)->delete();
                }

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success', 'url' => route_role('admin.paket.ruas.index', ['id' => my_encrypt($id_paket)])];
            }
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        $checking = is_valid_user($this->session['id_users'], $request->password);
        if ($checking) {
            try {
                $data = Paket::find(my_decrypt($request->id));

                // del_pdf($data->laporan);
                // del_pdf($data->doc_kontrak);
                // del_picture($data->foto_lokasi);

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
}
