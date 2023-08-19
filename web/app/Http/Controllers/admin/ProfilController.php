<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'), 'admin');
    }

    public function index()
    {
        $data = [
            'user' => User::find($this->session['id_users']),
        ];
        return Template::load('admin', 'Profil', 'profil', 'view', $data);
    }

    public function save_picture(Request $request)
    {
        try {
            $user = User::find($this->session['id_users']);

            // hapus foto
            del_picture($user->foto);

            // nama foto
            $nama_foto = add_picture($request->i_foto);

            $user->foto = $nama_foto;

            $request->session()->put('foto', $nama_foto);

            $user->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Foto Profil Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Foto Profil Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function save_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'i_nama'     => 'required',
            'i_email'    => 'required',
            'i_username' => 'required',
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
            $user = User::find($this->session['id_users']);

            $user->nama     = $request->i_nama;
            $user->email    = $request->i_email;
            $user->username = $request->i_username;
            $user->save();

            $request->session()->put('nama', $request->i_nama);

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function save_security(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'i_pass_lama'      => 'required',
            'i_pass_baru'      => 'required',
            'i_pass_baru_lagi' => 'required',
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

        $user = User::find($this->session['id_users']);

        if (Hash::check($request->i_pass_lama, $user->password)) {
            if ($request->i_pass_baru === $request->i_pass_baru_lagi) {
                try {
                    $user->password = Hash::make($request->i_pass_baru);
                    $user->save();

                    $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
                } catch (\Exception $e) {
                    $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
                }
            } else {
                $response = ['title' => 'Gagal!', 'text' => 'Password baru dan konfirmasi password baru tidak sama!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
            }
        } else {
            $response = ['title' => 'Gagal!', 'text' => 'Password lama yang Anda masukkan tidak sama!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
        }

        return Response::json($response);
    }
}
