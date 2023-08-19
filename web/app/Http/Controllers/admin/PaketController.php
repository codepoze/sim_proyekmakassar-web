<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Paket;
use App\Models\Role;
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

    public function get_data_dt(Request $request)
    {
        $query = Paket::query();

        if ($request->id_kegiatan) {
            $query->whereIdKegiatan($request->id_kegiatan);
        }

        $data = $query->with(['toKegiatan', 'toPerusahaan', 'toKordPengawas.toUser'])->orderBy('id_paket', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
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

        foreach ($post as $key => $value) {
            $data[$key] = $value;
        }

        $data['foto_lokasi']      = $request->file('foto_lokasi');
        $data['doc_administrasi'] = $request->file('doc_administrasi');
        $data['doc_kontrak']      = $request->file('doc_kontrak');

        $rules = [
            'id_perusahaan'    => 'required',
            'id_kord_pengawas' => 'required',
            'nama_paket'       => 'required',
            'nama_pekerjaan'   => 'required',
            'lama_pekerjaan'   => 'required',
            'nilai_kontrak'    => 'required|numeric',
            'nomor_kontrak'    => 'required',
            'nomor_spk'        => 'required',
            'nama_lokasi'      => 'required',
            'ruas_jalan'       => 'required',
            'nilai_peruas'     => 'required|numeric',
            'nilai_total_ruas' => 'required|numeric',
            'titik_kordinat'   => 'required',
            'schedule'         => 'required',
            'foto_lokasi'      => 'required|mimes:png,jpg,jpeg',
            'doc_administrasi' => 'required|mimes:pdf',
            'doc_kontrak'      => 'required|mimes:pdf',
        ];

        $messages = [
            'id_perusahaan.required'    => 'Perusahaan harus diisi!',
            'id_kord_pengawas.required' => 'Koordinator harus diisi!',
            'nama_paket.required'       => 'Nama Paket harus diisi!',
            'nama_pekerjaan.required'   => 'Nama Pekerjaan harus diisi!',
            'lama_pekerjaan.required'   => 'Lama Pekerjaan harus diisi!',
            'nilai_kontrak.required'    => 'Nilai Kontrak harus diisi!',
            'nilai_kontrak.numeric'     => 'Nilai Kontrak harus berupa angka!',
            'nomor_kontrak.required'    => 'Nomor Kontrak harus diisi!',
            'nomor_spk.required'        => 'Nomor SPK harus diisi!',
            'nama_lokasi.required'      => 'Nama Lokasi harus diisi!',
            'ruas_jalan.required'       => 'Ruas Jalan harus diisi!',
            'nilai_peruas.required'     => 'Nilai Per Ruas harus diisi!',
            'nilai_peruas.numeric'      => 'Nilai Per Ruas harus berupa angka!',
            'nilai_total_ruas.required' => 'Nilai Total Ruas harus diisi!',
            'nilai_total_ruas.numeric'  => 'Nilai Total Ruas harus berupa angka!',
            'titik_kordinat.required'   => 'Titik Kordinat harus diisi!',
            'schedule.required'         => 'Schedule harus diisi!',
            'foto_lokasi.required'      => 'Foto Lokasi harus diisi!',
            'foto_lokasi.mimes'         => 'Foto Lokasi harus berupa file gambar!',
            'doc_administrasi.required' => 'Dokumen Administrasi harus diisi!',
            'doc_administrasi.mimes'    => 'Dokumen Administrasi harus berupa file pdf!',
            'doc_kontrak.required'      => 'Dokumen Kontrak harus diisi!',
            'doc_kontrak.mimes'         => 'Dokumen Kontrak harus berupa file pdf!',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $response = [
                'title'  => 'Gagal!',
                'text'   => 'Data gagal ditambahkan!',
                'type'   => 'error',
                'button' => 'Ok!',
                'class'  => 'danger',
                'errors' => $validator->errors()
            ];

            return Response::json($response);
        }

        try {
            if ($request->id_paket === null) {
                // tambah
                $foto_lokasi      = add_picture($request->foto_lokasi);
                $doc_administrasi = add_pdf($request->doc_administrasi);
                $doc_kontrak      = add_pdf($request->doc_kontrak);

                $paket = new Paket();
                $paket->id_kegiatan      = $request->id_kegiatan;
                $paket->id_perusahaan    = $request->id_perusahaan;
                $paket->id_kord_pengawas = $request->id_kord_pengawas;
                $paket->nama_paket       = $request->nama_paket;
                $paket->nama_pekerjaan   = $request->nama_pekerjaan;
                $paket->lama_pekerjaan   = $request->lama_pekerjaan;
                $paket->nilai_kontrak    = $request->nilai_kontrak;
                $paket->nomor_kontrak    = $request->nomor_kontrak;
                $paket->nomor_spk        = $request->nomor_spk;
                $paket->nama_lokasi      = $request->nama_lokasi;
                $paket->ruas_jalan       = $request->ruas_jalan;
                $paket->nilai_peruas     = $request->nilai_peruas;
                $paket->nilai_total_ruas = $request->nilai_total_ruas;
                $paket->titik_kordinat   = $request->titik_kordinat;
                $paket->schedule         = $request->schedule;
                $paket->foto_lokasi      = $foto_lokasi;
                $paket->doc_administrasi = $doc_administrasi;
                $paket->doc_kontrak      = $doc_kontrak;
                $paket->by_users         = $this->session['id_users'];
                $paket->save();
            } else {
                // ubah
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
                $paket = Paket::find(my_decrypt($request->id));

                $foto_lokasi      = $paket->foto_lokasi;
                $doc_administrasi = $paket->doc_administrasi;
                $doc_kontrak      = $paket->doc_kontrak;

                del_picture($foto_lokasi);
                del_pdf($doc_administrasi);
                del_pdf($doc_kontrak);

                $paket->delete();

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
