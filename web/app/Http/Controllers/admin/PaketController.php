<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Paket;
use App\Models\Role;
use App\Models\Ruas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
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

    public function add($id)
    {
        $data = [
            'id_kegiatan' => $id,
        ];

        return Template::load('admin', 'Tambah Paket', 'paket', 'add', $data);
    }

    public function get_data_dt(Request $request)
    {
        $query = Paket::query();

        if ($request->id_kegiatan) {
            $query->whereIdKegiatan($request->id_kegiatan);
        }

        $data = $query->with(['toKegiatan', 'toPerusahaan', 'toTeknislap.toUser'])->orderBy('id_paket', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nilai_total_ruas', function ($row) {
                $nilai_total_ruas = 0;
                foreach ($row->toRuas as $key => $value) {
                    $nilai_total_ruas += $value->nilai_ruas;
                }
                return $nilai_total_ruas;
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_paket) . '" class="btn btn-action btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
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

        foreach ($data['nilai_ruas'] as $key => $value) {
            $data['nilai_ruas_' . $key] = $value;
            $data['lat_' . $key]        = $value;
            $data['long_' . $key]       = $value;
        }

        $rules = [
            'id_perusahaan'    => 'required',
            'id_teknislap'     => 'required',
            'no_spmk'          => 'required',
            'no_kontrak'       => 'required',
            'nil_kontrak'      => 'required',
            'waktu_kontrak'    => 'required',
            'lokasi_pekerjaan' => 'required',
            'schedule'         => 'required',
            'laporan'          => 'required|mimes:pdf',
            'doc_kontrak'      => 'required|mimes:pdf',
            'foto_lokasi'      => 'required|mimes:png,jpg,jpeg',
        ];

        $messages = [
            'id_perusahaan.required'    => 'Perusahaan tidak boleh kosong!',
            'id_teknislap.required'     => 'Teknis lapangan tidak boleh kosong!',
            'no_spmk.required'          => 'No SPMK tidak boleh kosong!',
            'no_kontrak.required'       => 'No Kontrak tidak boleh kosong!',
            'nil_kontrak.required'      => 'Nilai Kontrak tidak boleh kosong!',
            'waktu_kontrak.required'    => 'Waktu Kontrak tidak boleh kosong!',
            'lokasi_pekerjaan.required' => 'Lokasi Pekerjaan tidak boleh kosong!',
            'schedule.required'         => 'Schedule tidak boleh kosong!',
            'laporan.required'          => 'Laporan tidak boleh kosong!',
            'laporan.mimes'             => 'Laporan harus berupa pdf!',
            'doc_kontrak.required'      => 'Dokumen Kontrak tidak boleh kosong!',
            'doc_kontrak.mimes'         => 'Dokumen Kontrak harus berupa pdf!',
            'foto_lokasi.required'      => 'Foto Lokasi tidak boleh kosong!',
            'foto_lokasi.mimes'         => 'Foto Lokasi harus berupa png, jpg, jpeg!',
        ];

        foreach ($data['nilai_ruas'] as $key => $value) {
            $rules['nilai_ruas_' . $key] = 'required|numeric';
            $rules['lat_' . $key]        = 'required';
            $rules['long_' . $key]       = 'required';

            $messages['nilai_ruas_' . $key . '.required'] = 'Nilai Ruas tidak boleh kosong!';
            $messages['nilai_ruas_' . $key . '.numeric']  = 'Nilai Ruas harus berupa angka!';
            $messages['lat_' . $key . '.required']        = 'Latitude tidak boleh kosong!';
            $messages['long_' . $key . '.required']       = 'Longitude tidak boleh kosong!';
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
                    'id_kegiatan'      => my_decrypt($request->id_kegiatan),
                    'id_perusahaan'    => $request->id_perusahaan,
                    'id_teknislap'     => $request->id_teknislap,
                    'no_spmk'          => $request->no_spmk,
                    'no_kontrak'       => $request->no_kontrak,
                    'nil_kontrak'      => $request->nil_kontrak,
                    'waktu_kontrak'    => $request->waktu_kontrak,
                    'lokasi_pekerjaan' => $request->lokasi_pekerjaan,
                    'schedule'         => $request->schedule,
                    'laporan'          => $laporan,
                    'doc_kontrak'      => $doc_kontrak,
                    'foto_lokasi'      => $foto_lokasi,
                    'by_users'         => $this->session['id_users'],
                ]);

                $id_paket = $paket->id_paket;

                foreach ($data['nilai_ruas'] as $key => $value) {
                    Ruas::create([
                        'id_paket'    => $id_paket,
                        'nilai_ruas'  => $value,
                        'lat'         => $data['lat_' . $key],
                        'long'        => $data['long_' . $key],
                        'by_users'    => $this->session['id_users'],
                    ]);
                }
            } else {
                // ubah

                dd($data);
            }

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
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
}
