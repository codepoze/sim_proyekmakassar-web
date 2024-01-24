<?php

namespace App\Http\Controllers\api;

use App\Models\Dokumentasi;
use App\Http\Controllers\Controller;
use App\Models\DokumentasiFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DokumentasiController extends Controller
{
  public function index()
  {
    $dok = Dokumentasi::all();

    return response()->json($dok);
  }

  public function saveData(Request $request, $id_dok = null)
  {
    DB::beginTransaction();
    try {
      $data = [
        "id_kontrak_ruas_item" => $request->input('id_kontrak_ruas_item'),
        "keterangan" => $request->input('keterangan')
      ];

      $dok = Dokumentasi::updateOrCreate(
        ["id_dokumentasi" => $id_dok],
        $data
      );

      // Log::info('Debugging Information', ['dok' => $data]);

      if ($dok) {
        $images = $request->image;

        if ($images) {
          $id_dok = $dok->id_dok;

          for ($i = 0; $i < count($images); $i++) {
            $parseImage  = base64_decode($request->image_loc[$i]);

            file_put_contents(upload_path('picture') . '/' . $request->image[$i], $parseImage);

            DokumentasiFoto::updateOrCreate(
              [
                "id_dokumentasi" => $id_dok,
                "foto"   => $request->image[$i]
              ]
            );
          }
        }
      }

      DB::commit();
      return response(
        [
          'title'   => 'Berhasil!',
          'text'    => 'Berhasil menyimpan data!',
          'type'    => 'success',
          'button'  => 'Ok!'
        ],
        Response::HTTP_CREATED
      );
    } catch (\Exception $e) {
      DB::rollback();
      return response(
        [
          'title'   => 'Gagal!',
          'text'    => 'Terjadi kesalahan saat menyinmpan data!',
          'type'    => 'error',
          'button'  => 'Ok!'
        ], 
        Response::HTTP_INTERNAL_SERVER_ERROR
      );
    }
  }

  public function delete($id_dok)
  {
      $dok = Dokumentasi::find($id_dok);

      if (!$dok) {
          return response([
              'message' => 'Data tidak ditemukan',
          ], Response::HTTP_NOT_FOUND); 
      }

      if ($dok->delete()) {
          return response([
              'message' => 'Berhasil hapus data',
          ], Response::HTTP_OK);
      }

      return response([
          'message' => 'Gagal hapus data',
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
  }
}