<?php

namespace App\Http\Controllers\api;

use App\Models\Kontrak;
use App\Http\Controllers\Controller;
use App\Http\Resources\KontrakResource;
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
        $kontrak = Kontrak::whereIdTeknislap($id)->latest()->get();

        return KontrakResource::collection($kontrak);
    }
}
