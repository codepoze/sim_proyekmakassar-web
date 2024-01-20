<?php

namespace App\Http\Controllers\api;

use App\Models\Ph0;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ph0Resource;
use App\Models\Ph0Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Ph0Controller extends Controller
{
    public function index()
    {
        $ph0 = Ph0::all();

        return Ph0Resource::collection($ph0);
    }

    public function show($id)
    {
    }

    public function saveData(Request $request, $id_ph0 = null)
    {
        DB::beginTransaction();
        try {
            // Buat instance model Ph0 untuk menambahkan data
            $data = [
                "id_kontrak_ruas_item" => $request->input('id_kontrak_ruas_item'),
                "nma_pekerjaan"        => $request->input('nma_pekerjaan'),
                "panjang"              => trim($request->input('panjang')),

                "titik_core"  => trim($request->input('titik_core')),
                "penambahan"  => trim($request->input('penambahan')),
                "pengurangan" => trim($request->input('pengurangan')),
                "l_1"         => trim($request->input('l_1')),
                "l_2"         => trim($request->input('l_2')),
                "l_3"         => trim($request->input('l_3')),
                "l_4"         => trim($request->input('l_4')),
                "t1_1"        => trim($request->input('t1_1')),
                "t1_2"        => trim($request->input('t1_2')),
                "t1_3"        => trim($request->input('t1_3')),
                "t2_1"        => trim($request->input('t2_1')),
                "t2_2"        => trim($request->input('t2_2')),
                "t2_3"        => trim($request->input('t2_3')),
                "t3_1"        => trim($request->input('t3_1')),
                "t3_2"        => trim($request->input('t3_2')),
                "t3_3"        => trim($request->input('t3_3')),
                "berat_jenis" => trim($request->input('berat_jenis')),

                "by_users" => Auth::id()
            ];

            // Simpan data ke dalam database
            $ph0 = Ph0::updateOrCreate(
                ['id_ph0' => $id_ph0],
                $data
            );

            if ($ph0) {
                $images = $request->image;

                if ($images) {
                    $id_ph0 = $ph0->id_ph0;

                    for ($i = 0; $i < count($images); $i++) {
                        $parseImage  = base64_decode($request->image_loc[$i]);

                        file_put_contents(upload_path('picture') . '/' . $request->image[$i], $parseImage);

                        Ph0Foto::updateOrCreate(
                            [
                                "id_ph0" => $id_ph0,
                                "foto"   => $request->image[$i]
                            ]
                        );
                    }
                }
            }

            DB::commit();
            return response(
                ['title' => 'Berhasil!', 'text' => 'Berhasil menyimpan data!', 'type' => 'success', 'button' => 'Ok!'],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            DB::rollback();
            return response(
                ['title' => 'Gagal!', 'text' => 'Terjadi kesalahan saat menyimpan data!', 'type' => 'error', 'button' => 'Ok!'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            ); // Kode status 500 untuk Internal Server Error
        }
    }

    public function delete($id_ph0)
    {
        // Temukan data berdasarkan id_ph0
        $ph0 = Ph0::find($id_ph0);

        // Jika data tidak ditemukan
        if (!$ph0) {
            return response([
                'message' => 'Data tidak ditemukan',
            ], Response::HTTP_NOT_FOUND); // Kode status 404 untuk Not Found
        }

        // Hapus data
        if ($ph0->delete()) {
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
