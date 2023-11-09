<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\PaketRuas;
use App\Models\PaketRuasItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaketRuasItemController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
        detect_role_access($this->session);
    }

    public function index($id)
    {
        $data = [
            'id_paket'   => $id,
            'paket_ruas' => PaketRuas::with('toPaketRuasItem')->whereIdPaket($id)->get()
        ];

        return Template::load('admin', 'Paket Ruas', 'paket_ruas', 'view', $data);
    }

    // public function get_data_dt()
    // {
    //     $data = Penyedia::orderBy('id_penyedia', 'desc')->get();

    //     return DataTables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function ($row) {
    //             return '
    //                 <button type="button" id="upd" data-id="' . my_encrypt($row->id_penyedia) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
    //                 <button type="button" id="del" data-id="' . my_encrypt($row->id_penyedia) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
    //             ';
    //         })
    //         ->make(true);
    // }

    public function show(Request $request)
    {
        $response = PaketRuasItem::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rule = [
            'id_satuan'     => 'required',
            'nama'          => 'required',
            'volume'        => 'required',
            'harga_hps'     => 'required',
            'harga_kontrak' => 'required',
        ];

        $message = [
            'id_satuan.required'     => 'Satuan tidak boleh kosong!',
            'nama.required'          => 'Nama tidak boleh kosong!',
            'volume.required'        => 'Volume tidak boleh kosong!',
            'harga_hps.required'     => 'Harga HPS tidak boleh kosong!',
            'harga_kontrak.required' => 'Harga Kontrak tidak boleh kosong!',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            PaketRuasItem::updateOrCreate(
                [
                    'id_paket_ruas_item' => $request->id_paket_ruas_item,
                ],
                [
                    'id_paket_ruas' => $request->id_paket_ruas,
                    'id_satuan'     => $request->id_satuan,
                    'nama'          => $request->nama,
                    'volume'        => $request->volume,
                    'harga_hps'     => remove_separator($request->harga_hps),
                    'harga_kontrak' => remove_separator($request->harga_kontrak),
                    'by_users'      => $this->session['id_users'],
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
                $data = PaketRuasItem::find(my_decrypt($request->id));

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
