<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Penyedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PenyediaController extends Controller
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
        return Template::load('admin', 'Penyedia', 'penyedia', 'view');
    }

    public function get_data_dt()
    {
        $data = Penyedia::orderBy('id_penyedia', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_penyedia) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_penyedia) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function get_all(Request $request)
    {
        $data = Penyedia::select('id_penyedia AS id', 'nama AS text')->orderBy('id_penyedia', 'asc')->get();

        $response = [];
        foreach ($data as $key => $value) {
            $response[] = [
                'id'       => $value->id,
                'text'     => $value->text,
                'selected' => ($request->id == $value->id ? true : false)
            ];
        }

        return Response::json($response);
    }

    public function show(Request $request)
    {
        $response = Penyedia::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rule = [
            'nama'    => 'required',
            'telepon' => 'required|numeric|digits_between:10,13',
            'alamat'  => 'required',
        ];

        $message = [
            'nama.required'          => 'Nama Perusahaan tidak boleh kosong!',
            'telepon.required'       => 'Telepon Perusahaan tidak boleh kosong!',
            'telepon.numeric'        => 'Telepon Perusahaan harus berupa angka!',
            'telepon.digits_between' => 'Telepon Perusahaan harus berupa angka dan minimal 10 digit dan maksimal 13 digit!',
            'alamat.required'        => 'Alamat Perusahaan tidak boleh kosong!',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            Penyedia::updateOrCreate(
                [
                    'id_penyedia' => $request->id_penyedia,
                ],
                [
                    'nama'     => $request->nama,
                    'telepon'  => $request->telepon,
                    'alamat'   => $request->alamat,
                    'by_users' => $this->session['id_users'],
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
                $data = Penyedia::find(my_decrypt($request->id));

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
