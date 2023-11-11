<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

if (!function_exists('checking_role_session')) {
    function checking_role_session($session, $has_roles, $roles = 'users')
    {
        if ($has_roles) {
            $users = get_users_detail($session['id_users']);
            if ($users->toRole->role !== $roles) {
                return redirect()->away('/admin')->send();
            }
        }
    }
}

if (!function_exists('detect_role_session')) {
    function detect_role_session($session, $has_roles)
    {
        // untuk cek session
        if ($has_roles && checking_session($session)) {
            // untuk roles user
            $users = get_users_detail($session['id_users']);
            if ($users->toRole->role !== $session['roles']) {
                return redirect()->away('/logout')->send();
            } else {
                checking_role_session($session, $has_roles, $session['roles']);
            }
        } else {
            return redirect('/')->send();
        }
    }
}

if (!function_exists('detect_role_access')) {
    function detect_role_access($session)
    {
        if (checking_session($session)) {
            $users = get_users_detail($session['id_users']);
            $uri   = request()->segments();

            foreach ($uri as $key => $value) {
                if (count($uri) > 1) {
                    if ($key == 1) {
                        $id_role = $users->id_role;
                        $path    = "/{$value}";
                        $access  = DB::select("SELECT rm.id_role_menu, rm.id_role, rm.id_menu_head, mh.nama, mh.path FROM role_menus AS rm LEFT JOIN menu_heads AS mh ON rm.id_menu_head = mh.id_menu_head WHERE rm.id_role = '$id_role' AND mh.path = '$path' ORDER BY mh.id_menu_head");
                        if (count($access) == 0) {
                            return redirect()->away('/admin')->send();
                        }
                    }
                }
            }
        } else {
            return redirect('/')->send();
        }
    }
}

if (!function_exists('checking_session')) {
    function checking_session($session)
    {
        if (empty($session['id_users'])) {
            return false;
        } else {
            $users  = get_users_detail($session['id_users']);
            $roles  = get_roles();
            $search = in_array($users->toRole->role, $roles);

            if ($search) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('get_users_detail')) {
    function get_users_detail($id)
    {
        $users = User::with(['toRole'])->find($id);
        if ($users) {
            return $users;
        }
    }
}

if (!function_exists('get_roles')) {
    function get_roles()
    {
        $get   = Role::all();
        $roles = [];
        foreach ($get as $value) {
            $roles[] = $value->role;
        }
        return $roles;
    }
}

if (!function_exists('is_valid_user')) {
    function is_valid_user($id_users, $password)
    {
        $get = User::whereIdUsers($id_users)->get();
        if (count($get) > 0) {
            $row        = $get->first();
            $check_pass = is_valid_password($password, $row->password);
            if ($check_pass) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('is_valid_password')) {
    function is_valid_password($pass_input, $pass_get)
    {
        if (Hash::check($pass_input, $pass_get)) {
            return true;
        } else {
            return false;
        }
    }
}
