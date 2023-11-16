<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Kegiatan;
use App\Models\User;
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

    public function get_data_dt()
    {
        $query = Kegiatan::query();

        if ($this->session['roles'] == 'pptk') {
            $pptk = User::with(['toPptk'])->find($this->session['id_users']);

            $query->whereIdPptk($pptk->toPptk->id_pptk);
        }

        $data = $query->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tgl', function ($row) {
                return tgl_indo($row->tgl);
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_kegiatan) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_kegiatan) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function get_all(Request $request)
    {
        $data = Kegiatan::select('id_kegiatan AS id', 'nama AS text')->orderBy('id_kegiatan', 'asc')->get();

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
        $response = Kegiatan::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rule = [
            'nama'    => 'required',
            'tgl'     => 'required',
            'id_pptk' => 'required',
        ];

        $message = [
            'nama.required'    => 'Nama Perusahaan tidak boleh kosong!',
            'tgl.required'     => 'Tanggal Kegiatan tidak boleh kosong!',
            'id_pptk.required' => 'PPTK tidak boleh kosong!',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

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
                    'id_pptk'  => $request->id_pptk,
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
                $data = Kegiatan::find(my_decrypt($request->id));

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
