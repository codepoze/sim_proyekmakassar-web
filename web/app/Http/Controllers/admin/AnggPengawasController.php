<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\AnggPengawas;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AnggPengawasController extends Controller
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
        return Template::load('admin', 'Anggota Pengawas', 'pengawas/anggota', 'view');
    }

    public function get_data_dt(Request $request)
    {
        $query = AnggPengawas::query();

        if ($request->id_kord_pengawas) {
            $query->whereIdKordPengawas($request->id_kord_pengawas);
        }

        $data = $query->with(['toKordPengawas.toUser', 'toUser'])->orderBy('id_angg_pengawas', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_angg_pengawas) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_angg_pengawas) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $data = AnggPengawas::with(['toUser'])->find(my_decrypt($request->id));

        $response = [
            'id_angg_pengawas' => $data->id_angg_pengawas,
            'id_users'         => $data->id_users,
            'nik'              => $data->toUser->username,
            'nama'             => $data->toUser->nama,
            'email'            => $data->toUser->email,
            'telepon'          => $data->telepon,
            'alamat'           => $data->alamat,
        ];

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'     => 'required|numeric|digits:16|unique:users,username',
            'nama'    => 'required',
            'email'   => 'required|email',
            'telepon' => 'required|numeric|digits_between:10,13',
            'alamat'  => 'required',
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
            $role = Role::whereRole('pengawas')->first();

            if ($request->id_angg_pengawas === null) {
                // tambah
                $id_users = get_acak_id(User::class, 'id_users');

                $users = new User();
                $users->id_users = $id_users;
                $users->id_role  = $role->id_role;
                $users->username = $request->nik;
                $users->nama     = $request->nama;
                $users->email    = $request->email;
                $users->active   = 'y';
                $users->password = Hash::make('12345678');
                $users->save();

                $angg_pengawas = new AnggPengawas();
                $angg_pengawas->id_kord_pengawas = $request->id_kord_pengawas;
                $angg_pengawas->id_users         = $id_users;
                $angg_pengawas->telepon          = $request->telepon;
                $angg_pengawas->alamat           = $request->alamat;
                $angg_pengawas->by_users         = $this->session['id_users'];
                $angg_pengawas->save();
            } else {
                // ubah
                $angg_pengawas = AnggPengawas::find($request->id_angg_pengawas);
                $angg_pengawas->telepon  = $request->telepon;
                $angg_pengawas->alamat   = $request->alamat;
                $angg_pengawas->by_users = $this->session['id_users'];
                $angg_pengawas->save();

                $users = User::find($angg_pengawas->id_users);
                $users->username = $request->nik;
                $users->nama     = $request->nama;
                $users->email    = $request->email;
                $users->save();
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
                $angg_pengawas = AnggPengawas::find(my_decrypt($request->id));

                $users = User::find($angg_pengawas->id_users);
                $users->delete();

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
