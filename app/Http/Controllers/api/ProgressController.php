<?php

namespace App\Http\Controllers\api;

use App\Models\Progress;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProgressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProgressController extends Controller
{
  public function index()
  {
    $progress = Progress::all();

    return ProgressResource::collection($progress);
  }

  public function show($id)
  {
  }

  public function saveData(Request $request, $id_progress = null)
  {
    // Validasi input dari request
    $validator = Validator::make($request->all(), [
      'id_kontrak_ruas_item' => 'required',
      'nma_pekerjaan' => 'required',
      "panjang" => 'required',
      "titik_core" => 'required',
      "l_1" => 'required',
      "l_2" => 'required',
      "l_3" => 'required',
      "l_4" => 'required',
      "tki_1" => 'required',
      "tki_2" => 'required',
      "tki_3" => 'required',
      "tte_1" => 'required',
      "tte_2" => 'required',
      "tte_3" => 'required',
      "tka_1" => 'required',
      "tka_2" => 'required',
      "tka_3" => 'required',
      "berat_bersih" => 'required',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
      return response([
          'message' => 'Gagal menyimpan data, validasi tidak sesuai',
          'errors' => $validator->errors(),
      ], Response::HTTP_BAD_REQUEST); // Kode status 400 untuk Bad Request
    }

    // Buat instance model Progress untuk menambahkan data
    $data = [
      "id_kontrak_ruas_item" => $request->input('id_kontrak_ruas_item'),
      "nma_pekerjaan" => $request->input('nma_pekerjaan'),
      "panjang" => $request->input('panjang'),
      "titik_core" => $request->input('titik_core'),
      "l_1" => $request->input('l_1'),
      "l_2" => $request->input('l_2'),
      "l_3" => $request->input('l_3'),
      "l_4" => $request->input('l_4'),
      "tki_1" => $request->input('tki_1'),
      "tki_2" => $request->input('tki_2'),
      "tki_3" => $request->input('tki_3'),
      "tte_1" => $request->input('tte_1'),
      "tte_2" => $request->input('tte_2'),
      "tte_3" => $request->input('tte_3'),
      "tka_1" => $request->input('tka_1'),
      "tka_2" => $request->input('tka_2'),
      "tka_3" => $request->input('tka_3'),
      "berat_bersih" => $request->input('berat_bersih'),
    ];

    $progress = Progress::updateOrCreate(
        ['id_progress' => $id_progress],
        $data
    );

    // Simpan data ke dalam database
    if ($progress) {
        return response([
            'message' => 'Berhasil menyimpan data',
        ], Response::HTTP_CREATED); // Kode status 201 untuk Created
    }

    // Jika gagal menyimpan data
    return response([
        'message' => 'Gagal menyimpan data',
    ], Response::HTTP_INTERNAL_SERVER_ERROR); // Kode status 500 untuk Internal Server Error
  }

  public function delete($id_progress)
  {
    // Temukan data berdasarkan id_progress
    $progress = Progress::find($id_progress);

    // Jika data tidak ditemukan
    if (!$progress) {
        return response([
            'message' => 'Data tidak ditemukan',
        ], Response::HTTP_NOT_FOUND); // Kode status 404 untuk Not Found
    }

    // Hapus data
    if ($progress->delete()) {
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