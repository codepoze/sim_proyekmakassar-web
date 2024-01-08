<?php

namespace App\Exports;

use App\Models\Kontrak;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KontrakExport implements FromView
{
    public function view(): View
    {
        $id = last(request()->segments());

        $kontrak = Kontrak::findOrFail(my_decrypt($id));

        return view('admin.kontrak.excel', [
            'kontrak' => $kontrak
        ]);
    }
}
