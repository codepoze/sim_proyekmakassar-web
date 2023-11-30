<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\KontrakRuasItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class KontrakRuasItemController extends Controller
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

    public function show(Request $request)
    {
        $data = KontrakRuasItem::find(my_decrypt($request->id));

        $response = [
            'id_kontrak_ruas_item' => $data->id_kontrak_ruas_item,
            'id_kontrak_ruas'      => $data->id_kontrak_ruas,
            'id_satuan'            => $data->id_satuan,
            'nama'                 => $data->nama,
            'volume'               => $data->volume,
            'harga_hps'            => create_separator($data->harga_hps),
            'harga_kontrak'        => create_separator($data->harga_kontrak),
            'by_users'             => $data->by_users,
        ];

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
            KontrakRuasItem::updateOrCreate(
                [
                    'id_kontrak_ruas_item' => $request->id_kontrak_ruas_item,
                ],
                [
                    'id_kontrak_ruas' => $request->id_kontrak_ruas,
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
                $data = KontrakRuasItem::find(my_decrypt($request->id));

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
