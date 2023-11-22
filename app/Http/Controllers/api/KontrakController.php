<?php

namespace App\Http\Controllers\api;

use App\Models\Kontrak;
use App\Http\Controllers\Controller;
use App\Http\Resources\KontrakResource;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class KontrakController extends Controller
{
    public function index()
    {
        $kontrak = Kontrak::all();

        return KontrakResource::collection($kontrak);
    }

    public function show($id)
    {
        $teknis_lap = User::with(['toTeknisLap'])->findOrFail($id);

        $kontrak = Kontrak::whereIdTeknislap($teknis_lap->toTeknisLap->id_teknislap)->latest()->get();

        return KontrakResource::collection($kontrak);
    }
}
