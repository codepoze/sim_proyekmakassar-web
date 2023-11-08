<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\PaketRuas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaketRuasController extends Controller
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

    public function del(Request $request)
    {
        try {
            $data = PaketRuas::find(my_decrypt($request->id));

            $data->delete();

            $response = ['status' => true,'title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['status' => false,'title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }
}
