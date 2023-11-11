<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // untuk cek session
        checking_role_session($this->session, session()->has('roles'));

        $data = [
            'title' => "Login"
        ];

        return view('login', $data);
    }

    public function check(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // untuk check users
        $checking = [
            'username' => $username,
            'password' => $password,
            'active'   => 'y'
        ];

        if (Auth::attempt($checking)) {
            // untuk data users
            $users = User::with(['toRole'])->find(Auth::id());

            // untuk mengaktifkan session
            $request->session()->put('id', $users->id);
            $request->session()->put('id_users', $users->id_users);
            $request->session()->put('id_role', $users->id_role);
            $request->session()->put('nama', $users->nama);
            $request->session()->put('foto', $users->foto);
            $request->session()->put('roles', $users->toRole->role);

            // untuk check role
            $check = Role::whereRole($users->toRole->role)->first();
            if ($check !== null) {
                return redirect()->intended('admin');
            } else {
                return redirect()->intended('/');
            }
        } else {
            $request->session()->put('error', '<span><strong>Username</strong> atau <strong>Password</strong> Anda salah!</span>');
            return redirect()->intended('/');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->intended('/');
    }
}
