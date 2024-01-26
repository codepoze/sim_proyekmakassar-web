<?php

namespace App\Http\Controllers\api;

use App\Models\Opname;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class OpnameController extends Controller
{
  public function index()
  {
    $opname = Opname::all();

    return response()->json($opname);
  }

  public function show($id_opname)
  {
    $opname = Opname::find($id_opname);

    if ($opname) {
        return response($opname->file)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'inline; filename="' . $opname->id_kontrak_ruas_item . '"');
    }

    return response(
      [
        'title'   => '404!',
        'text'    => 'Data Tidak Ditemukan!',
        'type'    => 'error',
        'button'  => 'Ok!'
      ], 
      Response::HTTP_NOT_FOUND
    );
  }

  public function saveData(Request $request, $id_opname = null)
  {
    DB::beginTransaction();
    try {
      $file = $request->file('file');

      if ($file) {
        $fileContents = file_get_contents($file->getRealPath());

        Opname::updateOrCreate([
            "id_kontrak_ruas_item" => $request->input('id_kontrak_ruas_item'),
            "tipe"                 => $request->input('tipe'),
            'file'                 => $fileContents,
        ]);

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
      }
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

  public function delete($id_opname)
  {
      $opname = Opname::find($id_opname);

      if (!$opname) {
          return response([
              'message' => 'Data tidak ditemukan',
          ], Response::HTTP_NOT_FOUND); 
      }

      if ($opname->delete()) {
          return response([
              'message' => 'Berhasil hapus data',
          ], Response::HTTP_OK);
      }

      return response([
          'message' => 'Gagal hapus data',
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
  }
}