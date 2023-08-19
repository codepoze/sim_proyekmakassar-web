<?php

/**
 * Laravel Template Library
 *
 * Create template format in Laravel
 *
 * @packge     Laravel
 * @subpackage Libraries
 * @category   Libraries
 * @author     Alan Saputra Lengkoan
 * @license    MIT License
 */

namespace App\Libraries;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Template
{
    // untuk load view
    public static function load($role, $title, $module, $view, array $data = [])
    {
        $id_role = Session::get('id_role');

        $menu_head = DB::select("SELECT rm.id_role_menu, rm.id_role, rm.id_menu_head, mh.nama, mh.icon, mh.path, mh.status, mh.jenis FROM role_menus AS rm LEFT JOIN menu_heads AS mh ON rm.id_menu_head = mh.id_menu_head WHERE rm.id_role = '$id_role' AND mh.status = '1' ORDER BY mh.id_menu_head");
        $menu_body = DB::select("SELECT rb.id_role_body, rb.id_role, rb.id_menu_body, mb.id_menu_head, mb.nama, mb.icon, mb.path FROM role_bodies AS rb LEFT JOIN menu_bodies AS mb ON rb.id_menu_body = mb.id_menu_body WHERE rb.id_role = '$id_role' ORDER BY mb.id_menu_body");

        // untuk judul halaman
        $data['title']      = $title;
        // untuk breadcrumb
        $data['breadcrumb'] = Breadcrumbs::render(Route::currentRouteName());
        // untuk menu head
        $data['menu_head_role']  = $menu_head;
        // untuk menu body
        $data['menu_body_role']  = $menu_body;

        return view("{$role}/{$module}/{$view}", $data);
    }
}
