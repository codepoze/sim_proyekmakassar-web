<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
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
        return Template::load('admin', 'Kegiatan', 'kegiatan', 'view');
    }

    public function detail($id)
    {
        $id_kegiatan = my_decrypt($id);

        $data = [
            'id'       => $id,
            'kegiatan' => Kegiatan::find($id_kegiatan),
        ];

        return Template::load('admin', 'Detail Kegiatan', 'kegiatan', 'det', $data);
    }

    public function get_data_dt()
    {
        $data = Kegiatan::orderBy('id_kegiatan', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tgl', function ($row) {
                return tgl_indo($row->tgl);
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.kegiatan.detail', my_encrypt($row->id_kegiatan)) . '" class="btn btn-sm btn-relief-info"><i data-feather="info"></i>&nbsp;Detail</a>&nbsp;
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_kegiatan) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_kegiatan) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = Kegiatan::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tgl'  => 'required',
        ]);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            Kegiatan::updateOrCreate(
                [
                    'id_kegiatan' => $request->id_kegiatan,
                ],
                [
                    'nama'     => $request->nama,
                    'tgl'      => $request->tgl,
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
                $kegiatan = Kegiatan::find(my_decrypt($request->id));

                $kegiatan->delete();

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
