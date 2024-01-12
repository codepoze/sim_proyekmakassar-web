<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Download App"
        ];

        return view('download', $data);
    }
}
