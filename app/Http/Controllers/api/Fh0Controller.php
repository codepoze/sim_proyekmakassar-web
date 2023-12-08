<?php

namespace App\Http\Controllers\api;

use App\Models\Fh0;
use App\Http\Controllers\Controller;
use App\Http\Resources\Fh0Resource;
use App\Models\Fh0Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Fh0Controller extends Controller
{
    public function index()
    {
        $fh0 = Fh0::all();

        return Fh0Resource::collection($fh0);
    }

    public function show($id)
    {
    }

    public function saveData(Request $request, $id_fh0 = null)
    {
        DB::beginTransaction();
        try {
            // Validasi input dari request
            $validator = Validator::make($request->all(), [
                'id_kontrak_ruas_item' => 'required',
                'nma_pekerjaan'        => 'required',
                "panjang"              => 'required',
                "titik_core"           => 'required',
                "l_1"                  => 'required',
                "l_2"                  => 'required',
                "l_3"                  => 'required',
                "l_4"                  => 'required',
                "tki_1"                => 'required',
                "tki_2"                => 'required',
                "tki_3"                => 'required',
                "tte_1"                => 'required',
                "tte_2"                => 'required',
                "tte_3"                => 'required',
                "tka_1"                => 'required',
                "tka_2"                => 'required',
                "tka_3"                => 'required',
                "berat_bersih"         => 'required',
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response([
                    'message' => 'Gagal menyimpan data, validasi tidak sesuai',
                    'errors'  => $validator->errors(),
                ], Response::HTTP_BAD_REQUEST); // Kode status 400 untuk Bad Request
            }

            // Buat instance model Fh0 untuk menambahkan data
            $data = [
                "id_kontrak_ruas_item" => $request->input('id_kontrak_ruas_item'),
                "nma_pekerjaan"        => $request->input('nma_pekerjaan'),
                "panjang"              => trim($request->input('panjang')),
                "titik_core"           => trim($request->input('titik_core')),
                "l_1"                  => trim($request->input('l_1')),
                "l_2"                  => trim($request->input('l_2')),
                "l_3"                  => trim($request->input('l_3')),
                "l_4"                  => trim($request->input('l_4')),
                "tki_1"                => trim($request->input('tki_1')),
                "tki_2"                => trim($request->input('tki_2')),
                "tki_3"                => trim($request->input('tki_3')),
                "tte_1"                => trim($request->input('tte_1')),
                "tte_2"                => trim($request->input('tte_2')),
                "tte_3"                => trim($request->input('tte_3')),
                "tka_1"                => trim($request->input('tka_1')),
                "tka_2"                => trim($request->input('tka_2')),
                "tka_3"                => trim($request->input('tka_3')),
                "berat_bersih"         => trim($request->input('berat_bersih')),
                "by_users"             => Auth::id()
            ];

            // Simpan data ke dalam database
            $fh0 = Fh0::updateOrCreate(
                ['id_fh0' => $id_fh0],
                $data
            );

            if ($fh0) {
                $id_fh0 = Fh0::orderBy('created_at', 'desc')->value('id_fh0');
                $fh0_foto = Fh0Foto::updateOrCreate(
                    [
                        "id_fh0"      => $id_fh0,
                        "foto"        => add_picture($request->file('foto'))
                    ]
                );

                if($fh0_foto) {
                    DB::commit();
                    return response(
                        ['title' => 'Berhasil!', 'text' => 'Berhasil menyimpan data!', 'type' => 'success', 'button' => 'Ok!'],
                        Response::HTTP_CREATED
                    ); // Kode status 201 untuk Created
                }
            }

            // Jika gagal menyimpan data
            return response(
                ['title' => 'Gagal!', 'text' => 'Gagal menyimpan data!', 'type' => 'error', 'button' => 'Ok!'],
                Response::HTTP_OK
            ); // Kode status 500 untuk Internal Server Error
        } catch (\Exception $e) {
            DB::rollback();
            return response(
                ['title' => 'Gagal!', 'text' => 'Terjadi kesalahan saat menyimpan data!', 'type' => 'error', 'button' => 'Ok!'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            ); // Kode status 500 untuk Internal Server Error
        }
    }

    public function delete($id_fh0)
    {
        // Temukan data berdasarkan id_fh0
        $fh0 = Fh0::find($id_fh0);

        // Jika data tidak ditemukan
        if (!$fh0) {
            return response([
                'message' => 'Data tidak ditemukan',
            ], Response::HTTP_NOT_FOUND); // Kode status 404 untuk Not Found
        }

        // Hapus data
        if ($fh0->delete()) {
            return response([
                'message' => 'Berhasil hapus data',
            ], Response::HTTP_OK); // Kode status 200 untuk OK
        }

        // Jika gagal menghapus data
        return response([
            'message' => 'Gagal hapus data',
        ], Response::HTTP_INTERNAL_SERVER_ERROR); // Kode status 500 untuk Internal Server Error
    }
}
