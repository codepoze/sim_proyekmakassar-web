<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Adendum;
use App\Models\AdendumRuasItem;
use App\Models\KontrakRuas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdendumRuasItemController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
        detect_role_access($this->session);
    }

    public function show(Request $request)
    {
        $data = AdendumRuasItem::find(my_decrypt($request->id));

        $response = [
            'id_adendum_ruas_item' => $data->id_adendum_ruas_item,
            'id_adendum_ruas'      => $data->id_adendum_ruas,
            'id_ruas_item'         => $data->id_ruas_item,
            'id_satuan'            => $data->id_satuan,
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
            'id_ruas_item'  => 'required',
            'id_satuan'     => 'required',
            'volume'        => 'required',
            'harga_hps'     => 'required',
            'harga_kontrak' => 'required',
        ];

        $message = [
            'id_ruas_item.required'  => 'Ruas Item tidak boleh kosong!',
            'id_satuan.required'     => 'Satuan tidak boleh kosong!',
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
            AdendumRuasItem::updateOrCreate(
                [
                    'id_adendum_ruas_item' => $request->id_adendum_ruas_item,
                ],
                [
                    'id_adendum_ruas' => $request->id_adendum_ruas,
                    'id_ruas_item'    => $request->id_ruas_item,
                    'id_satuan'       => $request->id_satuan,
                    'volume'          => $request->volume,
                    'harga_hps'       => remove_separator($request->harga_hps),
                    'harga_kontrak'   => remove_separator($request->harga_kontrak),
                    'by_users'        => $this->session['id_users'],
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
                $data = AdendumRuasItem::find(my_decrypt($request->id));

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

    public function finish(Request $request)
    {
        $id = my_decrypt($request->id);

        $adendum = Adendum::findOrFail($id);

        $nil_kontrak_awal = 0;
        $nil_kontrak_akhir = 0;

        foreach ($adendum->toAdendumRuas as $key => $value) {
            $nil_kontrak_akhir += $value->toAdendumRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });

            $kontrak_ruas = KontrakRuas::with(['toKontrakRuasItem'])->where('id_kontrak_ruas', '!=', $value->id_kontrak_ruas)->first();
            foreach ($kontrak_ruas->toKontrakRuasItem as $key => $value) {
                $nil_kontrak_awal += $value->volume * $value->harga_kontrak;
            }
        }

        $nil_kontrak = ($nil_kontrak_awal + $nil_kontrak_akhir);

        $adendum->nil_adendum_kontrak = $nil_kontrak;
        $adendum->save();

        $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success', 'url' => route_role('admin.adendum.det', ['id' => my_encrypt($id)])];

        return Response::json($response);
    }
}
