<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Role;
use App\Models\TeknislapAnggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TeknislapAnggotaController extends Controller
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
        return Template::load('admin', 'Anggota Tekni Lapangan', 'teknislap/anggota', 'view');
    }

    public function get_data_dt(Request $request)
    {
        $query = TeknislapAnggota::query();
        if ($request->id_teknislap) {
            $query->whereIdTeknislap($request->id_teknislap);
        }

        $data = $query->with(['toTeknislap.toUser', 'toUser'])->orderBy('id_teknislap_anggota', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_teknislap_anggota) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_teknislap_anggota) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $data = TeknislapAnggota::with(['toUser'])->find(my_decrypt($request->id));

        $response = [
            'id_teknislap_anggota' => $data->id_teknislap_anggota,
            'id_teknislap'         => $data->id_teknislap,
            'id_users'             => $data->id_users,
            'nik'                  => $data->toUser->username,
            'nama'                 => $data->toUser->nama,
            'email'                => $data->toUser->email,
            'telepon'              => $data->telepon,
            'alamat'               => $data->alamat,
        ];

        return Response::json($response);
    }

    public function save(Request $request)
    {
        if ($request->id_teknislap_anggota === null) {
            $rule = [
                'nik'     => 'required|numeric|digits:16|unique:users,username',
                'nama'    => 'required',
                'email'   => 'required|email',
                'telepon' => 'required|numeric|digits_between:10,13',
                'alamat'  => 'required',
            ];

            $message = [
                'nik.required'     => 'NIK tidak boleh kosong!',
                'nik.numeric'      => 'NIK harus berupa angka!',
                'nik.digits'       => 'NIK harus 16 digit!',
                'nik.unique'       => 'NIK sudah terdaftar!',
                'nama.required'    => 'Nama tidak boleh kosong!',
                'email.required'   => 'Email tidak boleh kosong!',
                'email.email'      => 'Email tidak valid!',
                'telepon.required' => 'Telepon tidak boleh kosong!',
                'telepon.numeric'  => 'Telepon harus berupa angka!',
                'telepon.digits'   => 'Telepon harus 10-13 digit!',
                'alamat.required'  => 'Alamat tidak boleh kosong!',
            ];
        } else {
            $rule = [
                'nik'     => 'required|numeric|digits:16',
                'nama'    => 'required',
                'email'   => 'required|email',
                'telepon' => 'required|numeric|digits_between:10,13',
                'alamat'  => 'required',
            ];

            $message = [
                'nik.required'     => 'NIK tidak boleh kosong!',
                'nik.numeric'      => 'NIK harus berupa angka!',
                'nik.digits'       => 'NIK harus 16 digit!',
                'nama.required'    => 'Nama tidak boleh kosong!',
                'email.required'   => 'Email tidak boleh kosong!',
                'email.email'      => 'Email tidak valid!',
                'telepon.required' => 'Telepon tidak boleh kosong!',
                'telepon.numeric'  => 'Telepon harus berupa angka!',
                'telepon.digits'   => 'Telepon harus 10-13 digit!',
                'alamat.required'  => 'Alamat tidak boleh kosong!',
            ];
        }

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            $role = Role::whereRole('pengawas')->first();

            if ($request->id_teknislap_anggota === null) {
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

                TeknislapAnggota::create([
                    'id_teknislap_anggota' => get_acak_id(TeknislapAnggota::class, 'id_teknislap_anggota'),
                    'id_teknislap'         => $request->id_teknislap,
                    'id_users'             => $id_users,
                    'telepon'              => $request->telepon,
                    'alamat'               => $request->alamat,
                    'by_users'             => $this->session['id_users'],
                ]);
            } else {
                // ubah
                $teknislap_anggota = TeknislapAnggota::findOrfail($request->id_teknislap_anggota);
                $teknislap_anggota->update([
                    'id_teknislap' => $request->id_teknislap,
                    'telepon'      => $request->telepon,
                    'alamat'       => $request->alamat,
                    'by_users'     => $this->session['id_users'],
                ]);

                $users = User::find($teknislap_anggota->id_users);
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
                $data = TeknislapAnggota::find(my_decrypt($request->id));

                $users = User::find($data->id_users);
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
