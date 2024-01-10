<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Adendum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdendumController extends Controller
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
        return Template::load('admin', 'Adendum', 'adendum', 'view');
    }

    public function get_data_dt()
    {
        $data = Adendum::orderBy('id_adendum', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tgl_adendum', function ($row) {
                return tgl_indo($row->tgl_adendum);
            })
            ->addColumn('jenis', function ($row) {
                if ($row->jenis == 'cco') {
                    return 'ADENDUM CCO';
                } else if ($row->jenis == 'optimasi') {
                    return 'ADENDUM OPTIMASI/PERUBAHAN NILAI KONTRAK';
                } else if ($row->jenis == 'perpanjangan') {
                    return 'ADENDUM PERPANJANGAN WAKTU/PEMBERIAN KESEMPATAN';
                }
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_adendum) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_adendum) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = Adendum::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rules['id_kontrak']  = 'required';
        $rules['no_adendum']  = 'required';
        $rules['tgl_adendum'] = 'required';
        $rules['jenis']       = 'required';

        $message['id_kontrak.required']  = 'Kontrak harus diisi!';
        $message['no_adendum.required']  = 'No. Adendum harus diisi!';
        $message['tgl_adendum.required'] = 'Tgl. Adendum harus diisi!';
        $message['jenis.required']       = 'Jenis Adendum harus diisi!';

        if ($request->jenis === 'optimasi') {
            $rules['nil_adendum_kontrak'] = 'required';

            $message['nil_adendum_kontrak.required'] = 'Nilai Adendum Kontrak harus diisi!';
        } else if ($request->jenis === 'perpanjangan') {
            $rules['tgl_adendum_mulai'] = 'required';
            $rules['tgl_adendum_akhir'] = 'required';

            $message['tgl_adendum_mulai.required'] = 'Tgl. Adendum Mulai harus diisi!';
            $message['tgl_adendum_akhir.required'] = 'Tgl. Adendum Akhir harus diisi!';
        }

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            Adendum::updateOrCreate(
                [
                    'id_adendum' => $request->id_adendum,
                ],
                [
                    'id_kontrak'          => $request->id_kontrak,
                    'no_adendum'          => $request->no_adendum,
                    'tgl_adendum'         => $request->tgl_adendum,
                    'jenis'               => $request->jenis,
                    'nil_adendum_kontrak' => remove_separator($request->nil_adendum_kontrak),
                    'tgl_adendum_mulai'   => $request->tgl_adendum_mulai,
                    'tgl_adendum_akhir'   => $request->tgl_adendum_akhir,
                    'by_users'            => $this->session['id_users'],
                ]
            );

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
                $data = Adendum::find(my_decrypt($request->id));

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
