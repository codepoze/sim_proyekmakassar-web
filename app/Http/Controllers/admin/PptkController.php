<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Pptk;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PptkController extends Controller
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
        return Template::load('admin', 'PPTK', 'pptk', 'view');
    }

    public function get_data_dt()
    {
        $data = Pptk::orderBy('id_pptk', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_pptk) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_pptk) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->rawColumns(['jumlah_anggota', 'action'])
            ->make(true);
    }

    public function get_all(Request $request)
    {
        $data = Pptk::orderBy('id_pptk', 'desc')->get();

        $response = [];
        foreach ($data as $key => $value) {
            $response[] = [
                'id'       => $value->id_pptk,
                'text'     => $value->toUser->nama,
                'selected' => ($request->id == $value->id_pptk ? true : false)
            ];
        }

        return Response::json($response);
    }

    public function show(Request $request)
    {
        $data = Pptk::find(my_decrypt($request->id));

        $response = [
            'id_pptk'  => $data->id_pptk,
            'nip'      => $data->nip,
            'nik'      => $data->toUser->username,
            'nama'     => $data->toUser->nama,
            'email'    => $data->toUser->email,
        ];

        return Response::json($response);
    }

    public function save(Request $request)
    {
        if ($request->id_pptk === null) {
            $rule = [
                'nik'     => 'required|numeric|digits:16|unique:users,username',
                'nip'     => 'required|numeric|digits:16|unique:pptk,nip',
                'nama'    => 'required',
                'email'   => 'required|email',
            ];

            $message = [
                'nik.required'     => 'NIK tidak boleh kosong!',
                'nik.numeric'      => 'NIK harus berupa angka!',
                'nik.digits'       => 'NIK harus 16 digit!',
                'nik.unique'       => 'NIK sudah terdaftar!',
                'nip.required'     => 'NIP tidak boleh kosong!',
                'nip.numeric'      => 'NIP harus berupa angka!',
                'nip.digits'       => 'NIP harus 16 digit!',
                'nama.required'    => 'Nama tidak boleh kosong!',
                'email.required'   => 'Email tidak boleh kosong!',
                'email.email'      => 'Email tidak valid!',
            ];
        } else {
            $rule = [
                'nik'     => 'required|numeric|digits:16',
                'nip'     => 'required|numeric|digits:16',
                'nama'    => 'required',
                'email'   => 'required|email',
            ];

            $message = [
                'nik.required'     => 'NIK tidak boleh kosong!',
                'nik.numeric'      => 'NIK harus berupa angka!',
                'nik.digits'       => 'NIK harus 16 digit!',
                'nip.required'     => 'NIP tidak boleh kosong!',
                'nip.numeric'      => 'NIP harus berupa angka!',
                'nip.digits'       => 'NIP harus 16 digit!',
                'nama.required'    => 'Nama tidak boleh kosong!',
                'email.required'   => 'Email tidak boleh kosong!',
                'email.email'      => 'Email tidak valid!',
            ];
        }

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            $role = Role::whereRole('pptk')->first();

            if ($request->id_pptk === null) {
                // tambah
                $id_users = get_acak_id(User::class, 'id_users');

                User::create([
                    'id_users' => $id_users,
                    'id_role'  => $role->id_role,
                    'username' => $request->nik,
                    'nama'     => $request->nama,
                    'email'    => $request->email,
                    'active'   => 'y',
                    'password' => Hash::make('12345678'),
                ]);

                Pptk::create([
                    'id_users' => $id_users,
                    'nip'      => $request->nip,
                    'by_users' => $this->session['id_users'],
                ]);
            } else {
                // ubah
                $pptk = Pptk::find($request->id_pptk);
                $pptk->update([
                    'nip'      => $request->nip,
                    'by_users' => $this->session['id_users'],
                ]);

                $users = User::find($pptk->id_users);
                $users->update([
                    'username' => $request->nik,
                    'nama'     => $request->nama,
                    'email'    => $request->email,
                ]);
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
                $pptk = Pptk::find(my_decrypt($request->id));

                $data = User::find($pptk->id_users);
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
