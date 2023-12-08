<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KontrakRencanaResource;
use App\Models\KontrakRencana;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class KontrakRencanaController extends Controller
{
    public function show($id)
    {
        $kontrak_rencana = KontrakRencana::whereIdKontrak($id)->where('bobot', '!=', 0)->orderBy('bobot', 'asc')->get();

        return KontrakRencanaResource::collection($kontrak_rencana);
    }
}
