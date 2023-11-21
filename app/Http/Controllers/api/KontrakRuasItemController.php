<?php

namespace App\Http\Controllers\api;

use App\Models\KontrakRuasItem;
use App\Http\Controllers\Controller;
use App\Http\Resources\KontrakRuasItemResource;
use Illuminate\Http\Request;

class KontrakRuasItemController extends Controller
{
  public function index()
  {
    $kontrak = KontrakRuasItem::all();

    return KontrakRuasItemResource::collection($kontrak);
  }

  public function show($id)
  {
    $kontrak = KontrakRuasItem::findOrFail($id);

    return new KontrakRuasItemResource($kontrak);
  }

  public function showKontrakRuasItemByIdKontrakRuas($id)
  {
    $kontrakRuasItem = KontrakRuasItem::where('id_kontrak_ruas', $id)->get();

    return KontrakRuasItemResource::collection($kontrakRuasItem);
  }
}