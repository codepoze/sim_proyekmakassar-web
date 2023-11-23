<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\KontrakRuas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class KontrakRuasController extends Controller
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
        $id_kontrak = my_decrypt(last(request()->segments()));
        
        $data = [
            'id_kontrak'   => $id_kontrak,
            'kontrak_ruas' => KontrakRuas::with('toKontrakRuasItem')->whereIdKontrak($id_kontrak)->get()
        ];

        return Template::load('admin', 'Kontrak Ruas', 'kontrak/ruas', 'view', $data);
    }

    public function del(Request $request)
    {
        try {
            $data = KontrakRuas::find(my_decrypt($request->id));

            del_picture($data->foto);

            $data->delete();

            $response = ['status' => true,'title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['status' => false,'title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }
}
