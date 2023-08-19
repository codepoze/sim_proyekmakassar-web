<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\MenuHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MenuHeadController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
    }

    public function index()
    {
        return Template::load('admin', 'Menu Head', 'menu/head', 'view');
    }

    public function get_data_dt()
    {
        $data = MenuHead::orderBy('id_menu_head', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jenis', function ($row) {
                return ucfirst($row->jenis);
            })
            ->addColumn('status', function ($row) {
                return '<span class="badge bg-' . config('constants.status')[$row->status][0] . '">' . config('constants.status')[$row->status][1] . '</span>';
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_menu_head) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_menu_head) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function get_all(Request $request)
    {
        $query = MenuHead::query();

        if ($request->jenis) {
            $query->whereJenis($request->jenis);
        }

        $response = $query->select('id_menu_head AS id', 'nama AS text')->orderBy('id_menu_head', 'desc')->get();

        return Response::json($response);
    }

    public function show(Request $request)
    {
        $response = MenuHead::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
            'icon'   => 'required',
            'path'   => 'required',
            'status' => 'required',
            'jenis'  => 'required',
        ]);

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
            MenuHead::updateOrCreate(
                [
                    'id_menu_head' => $request->id_menu_head,
                ],
                [
                    'nama'     => $request->nama,
                    'icon'     => $request->icon,
                    'path'     => $request->path,
                    'status'   => $request->status,
                    'jenis'    => $request->jenis,
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
                $menu_head = MenuHead::find(my_decrypt($request->id));

                $menu_head->delete();

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
