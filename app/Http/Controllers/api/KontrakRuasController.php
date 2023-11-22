<?php

namespace App\Http\Controllers\api;

use App\Models\KontrakRuas;
use App\Http\Controllers\Controller;
use App\Http\Resources\KontrakRuasResource;
use Illuminate\Http\Request;

class KontrakRuasController extends Controller
{
  public function index()
  {
    $kontrak = KontrakRuas::all();

    return KontrakRuasResource::collection($kontrak);
  }

  public function show($id)
  {
    $kontrak = KontrakRuas::findOrFail($id);

    return new KontrakRuasResource($kontrak);
  }

  public function showKontrakRuasByIdKontrak($id)
  {
    $kontrakRuas = KontrakRuas::whereIdKontrak($id)->latest()->get();

    return KontrakRuasResource::collection($kontrakRuas);
  }
}