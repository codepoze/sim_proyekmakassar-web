<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\RuasItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RuasItemController extends Controller
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
        $tipe = [
            [
                'value' => 'pbj',
                'text'  => 'Penyiapan Badan Jalan',
            ],
            [
                'value' => 'lpa',
                'text'  => 'Lpa',
            ],
            [
                'value' => 'lpb',
                'text'  => 'LpB',
            ],
            [
                'value' => 'ac_bc',
                'text'  => 'AC BC Aspal',
            ],
            [
                'value' => 'ac_wc',
                'text'  => 'AC WC Aspal',
            ],
            [
                'value' => 'lc',
                'text'  => 'LC Beton',
            ],
            [
                'value' => 'rigid',
                'text'  => 'RIGID Beton',
            ],
            [
                'value' => 'timbunan',
                'text'  => 'Timbunan Pilihan',
            ],
            [
                'value' => 'paving',
                'text'  => 'Paving',
            ],
            [
                'value' => 'k_precast',
                'text'  => 'Kastin Precast',
            ],
            [
                'value' => 'k_cor',
                'text'  => 'Kastin Cor',
            ],
            [
                'value' => 'pas_batu',
                'text'  => 'Pas Batu',
            ],
        ];

        $data = [
            'tipe' => $tipe
        ];

        return Template::load('admin', 'Ruas Item', 'ruas_item', 'view', $data);
    }

    public function get_data_dt()
    {
        $data = RuasItem::orderBy('id_ruas_item', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tipe', function ($row) {
                return strtoupper(str_replace('_', ' ', $row->tipe));
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_ruas_item) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_ruas_item) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function get_all(Request $request)
    {
        $data = RuasItem::select('id_ruas_item AS id', 'nama', 'tipe')->orderBy('id_ruas_item', 'asc')->get();

        $response = [];
        foreach ($data as $key => $value) {
            $response[] = [
                'id'       => $value->id,
                'text'     => $value->nama . ' - ' . strtoupper(str_replace('_', ' ', $value->tipe)),
                'selected' => ($request->id == $value->id ? true : false)
            ];
        }

        return Response::json($response);
    }

    public function show(Request $request)
    {
        $response = RuasItem::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rule = [
            'nama' => 'required',
            'tipe' => 'required',
        ];

        $message = [
            'nama.required' => 'Nama Perusahaan tidak boleh kosong!',
            'tipe.required' => 'Tipe Ruas Item tidak boleh kosong!',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            RuasItem::updateOrCreate(
                [
                    'id_ruas_item' => $request->id_ruas_item,
                ],
                [
                    'nama'     => $request->nama,
                    'tipe'     => $request->tipe,
                    'by_users' => $this->session['id_users'],
                ]
            );

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
                $data = RuasItem::find(my_decrypt($request->id));

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
