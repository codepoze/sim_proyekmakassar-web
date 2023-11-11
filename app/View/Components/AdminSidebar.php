<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class AdminSidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $menu_head_role;
    public $menu_body_role;

    public function __construct()
    {
        $id_role = Session::get('id_role');

        $menu_head = DB::select("SELECT rm.id_role_menu, rm.id_role, rm.id_menu_head, mh.nama, mh.icon, mh.path, mh.status, mh.jenis FROM role_menus AS rm LEFT JOIN menu_heads AS mh ON rm.id_menu_head = mh.id_menu_head WHERE rm.id_role = '$id_role' AND mh.status = '1' ORDER BY mh.id_menu_head");
        $menu_body = DB::select("SELECT rb.id_role_body, rb.id_role, rb.id_menu_body, mb.id_menu_head, mb.nama, mb.icon, mb.path FROM role_bodies AS rb LEFT JOIN menu_bodies AS mb ON rb.id_menu_body = mb.id_menu_body WHERE rb.id_role = '$id_role' ORDER BY mb.id_menu_body");

        $this->menu_head_role = $menu_head;
        $this->menu_body_role = $menu_body;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.admin-sidebar');
    }
}
