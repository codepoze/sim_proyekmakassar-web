<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\MenuAction;
use App\Models\MenuBody;
use App\Models\MenuHead;
use App\Models\Role;
use App\Models\RoleAction;
use App\Models\RoleBody;
use App\Models\RoleMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleMenuController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
    }

    public function index()
    {
        return Template::load('admin', 'Role Menu', 'role/menu', 'view');
    }

    public function create()
    {
        $data = [
            'menu_head'   => MenuHead::all(),
            'menu_body'   => MenuBody::all(),
            'menu_action' => MenuAction::all(),
        ];

        return Template::load('admin', 'Create Role Menu', 'role/menu', 'add', $data);
    }

    public function update($id)
    {
        $id_role = my_decrypt($id);

        $data = [
            'role'        => Role::find($id_role),
            'role_menu'   => DB::select("SELECT mh.id_menu_head, mh.nama, rm.id_menu_head AS role_menu FROM menu_heads AS mh LEFT JOIN( SELECT a.id_menu_head FROM role_menus AS a WHERE a.id_role = '$id_role') AS rm ON mh.id_menu_head = rm.id_menu_head ORDER BY mh.id_menu_head"),
            'role_body'   => DB::select("SELECT mb.id_menu_body, mh.id_menu_head, mb.nama, rb.id_menu_body AS role_body FROM menu_bodies AS mb LEFT JOIN( SELECT a.id_menu_body FROM role_bodies AS a WHERE a.id_role = '$id_role') AS rb ON mb.id_menu_body = rb.id_menu_body LEFT JOIN menu_heads AS mh ON mb.id_menu_head = mh.id_menu_head ORDER BY mb.id_menu_body"),
            'role_action' => DB::select("SELECT ma.id_menu_head, ma.id_menu_action, ma.nama, rm.id_menu_action AS role_action FROM menu_actions AS ma LEFT JOIN( SELECT a.id_menu_action FROM role_actions AS a WHERE a.id_role = '$id_role') AS rm ON ma.id_menu_action = rm.id_menu_action ORDER BY ma.id_menu_action")
        ];

        return Template::load('admin', 'Update Role Menu', 'role/menu', 'upd', $data);
    }

    public function get_data_dt()
    {
        $data = Role::rightJoin('role_menus as rm', 'roles.id_role', '=', 'rm.id_role')
            ->select('roles.id_role', 'roles.nama', 'roles.role')
            ->groupBy('roles.id_role')
            ->orderBy('roles.id_role', 'asc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.role.menu.update', my_encrypt($row->id_role)) . '" class="btn btn-sm btn-relief-primary"><i data-feather="edit"></i>&nbsp;Ubah</a>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_role) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_role' => 'required',
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

        $id_role        = $request->id_role;
        $id_menu_head   = $request->id_menu_head;
        $id_menu_body   = $request->id_menu_body;
        $id_menu_action = $request->id_menu_action;

        if ($request->param === 'add') {
            foreach ($id_menu_head as $key => $value) {
                $role_menu[] = [
                    'id_role'      => $id_role,
                    'id_menu_head' => $value,
                    'by_users'     => $this->session['id_users'],
                ];
            }

            RoleMenu::insert($role_menu);

            if (isset($id_menu_body)) {
                foreach ($id_menu_body as $key => $value) {
                    $role_body[] = [
                        'id_role'      => $id_role,
                        'id_menu_body' => $value,
                        'by_users'     => $this->session['id_users'],
                    ];
                }

                RoleBody::insert($role_body);
            }

            if (isset($id_menu_action)) {
                foreach ($id_menu_action as $key => $value) {
                    $role_action[] = [
                        'id_role'        => $id_role,
                        'id_menu_action' => $value,
                        'status'         => '1',
                        'by_users'       => $this->session['id_users'],
                    ];
                }

                RoleAction::insert($role_action);
            }

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } else {
            RoleMenu::whereIdRole($id_role)->delete();

            foreach ($id_menu_head as $key => $value) {
                $role_menu[] = [
                    'id_role'      => $id_role,
                    'id_menu_head' => $value,
                    'by_users'     => $this->session['id_users'],
                ];
            }

            RoleMenu::insert($role_menu);

            if (isset($id_menu_body)) {
                RoleBody::whereIdRole($id_role)->delete();

                foreach ($id_menu_body as $key => $value) {
                    $role_body[] = [
                        'id_role'      => $id_role,
                        'id_menu_body' => $value,
                        'by_users'     => $this->session['id_users'],
                    ];
                }

                RoleBody::insert($role_body);
            }

            if (isset($id_menu_action)) {
                RoleAction::whereIdRole($id_role)->delete();

                foreach ($id_menu_action as $key => $value) {
                    $role_action[] = [
                        'id_role'        => $id_role,
                        'id_menu_action' => $value,
                        'status'         => '1',
                        'by_users'       => $this->session['id_users'],
                    ];
                }

                RoleAction::insert($role_action);
            }

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        $checking = is_valid_user($this->session['id_users'], $request->password);
        if ($checking) {
            try {
                $role_menu   = RoleMenu::whereIdRole(my_decrypt($request->id));
                $role_body   = RoleBody::whereIdRole(my_decrypt($request->id));
                $role_action = RoleAction::whereIdRole(my_decrypt($request->id));

                $role_menu->delete();
                $role_body->delete();
                $role_action->delete();

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
