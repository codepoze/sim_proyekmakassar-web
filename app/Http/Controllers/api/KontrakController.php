<?php

namespace App\Http\Controllers\api;

use App\Models\Kontrak;
use App\Http\Controllers\Controller;
use App\Http\Resources\KontrakResource;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
  public function index()
  {
    $kontrak = Kontrak::all();

    return KontrakResource::collection($kontrak);
  }

  public function show($id)
  {
    $kontrak = Kontrak::with('toPenyedia:id_penyedia,nama')->with('toKonsultan:id_konsultan,nama')->findOrFail($id);

    return new KontrakResource($kontrak);
  }
}