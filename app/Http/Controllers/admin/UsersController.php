<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
    }

    public function index()
    {
        return Template::load('admin', 'Users', 'users', 'view');
    }

    public function get_data_dt()
    {
        $data = User::with(['toRole'])->orderBy('id_users', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('active', function ($row) {
                $status = ($row->active == 'y') ? '<i data-feather="check"></i>&nbsp;<span>Aktif</span>' : '<i data-feather="x"></i>&nbsp;<span>Tidak Aktif</span>';
                $button = ($row->active == 'y') ? 'btn-relief-success' : 'btn-relief-danger';

                return '
                    <button type="button" id="sts" data-id="' . my_encrypt($row->id_users) . '" class="btn btn-sm ' . $button . '">' . $status . '</button>
                ';
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" id="res-pass" data-id="' . my_encrypt($row->id_users) . '" class="btn btn-sm btn-relief-warning"><i data-feather="refresh-cw"></i>&nbsp;<span>Reset Password</span></button>';
            })
            ->rawColumns(['active', 'action'])
            ->make(true);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_role' => 'required',
            'nik'     => 'required|numeric|digits:16|unique:users,username',
            'nama'    => 'required',
            'email'   => 'required|email',
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
            $id_users = get_acak_id(User::class, 'id_users');

            $users = new User();
            $users->id_users = $id_users;
            $users->id_role  = $request->id_role;
            $users->username = $request->nik;
            $users->nama     = $request->nama;
            $users->email    = $request->email;
            $users->active   = 'y';
            $users->password = Hash::make('12345678');
            $users->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function active(Request $request)
    {
        $checking = is_valid_user($this->session['id_users'], $request->password);
        if ($checking) {
            try {
                $users = User::find(my_decrypt($request->id));
                $users->active = ($users->active == 'y') ? 'n' : 'y';
                $users->save();

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
            } catch (\Exception $e) {
                $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
            }
        } else {
            $response = ['title' => 'Maaf!', 'text' => 'Password Anda Salah!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
        }
        return Response::json($response);
    }

    public function reset_password(Request $request)
    {
        $checking = is_valid_user($this->session['id_users'], $request->password);
        if ($checking) {
            try {
                $users = User::find(my_decrypt($request->id));
                $users->password = Hash::make('12345678');
                $users->save();

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Kembalikan!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
            } catch (\Exception $e) {
                $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Kembalikan!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
            }
        } else {
            $response = ['title' => 'Maaf!', 'text' => 'Password Anda Salah!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
        }
        return Response::json($response);
    }
}
