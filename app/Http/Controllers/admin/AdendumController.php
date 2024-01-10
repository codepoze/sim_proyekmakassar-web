<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Adendum;
use App\Models\AdendumRuas;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdendumController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk deteksi session
        detect_role_session($this->session, session()->has('roles'));
        detect_role_access($this->session);
    }

    public function index()
    {
        return Template::load('admin', 'Adendum', 'adendum', 'view');
    }

    public function det()
    {
        $id = last(request()->segments());

        $adendum = Adendum::findOrFail(my_decrypt($id));

        $nil_kontrak = 0;
        foreach ($adendum->toAdendumRuas as $key => $value) {
            $nil_kontrak += $value->toAdendumRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_kontrak;
            });
        }

        $nil_hps = 0;
        foreach ($adendum->toAdendumRuas as $key => $value) {
            $nil_hps += $value->toAdendumRuasItem->sum(function ($item) {
                return $item->volume * $item->harga_hps;
            });
        }

        $data = [
            'id_adendum'  => $id,
            'adendum'     => $adendum,
            'nil_hps'     => $nil_hps,
            'nil_kontrak' => $nil_kontrak
        ];

        return Template::load('admin', 'Detail Adendum', 'adendum', 'det', $data);
    }

    public function cco()
    {
        $id_adendum = my_decrypt(last(request()->segments()));

        $data = [
            'id_adendum'   => $id_adendum,
            'adendum_ruas' => AdendumRuas::whereIdAdendum($id_adendum)->get()
        ];

        return Template::load('admin', 'Adendum Ruas', 'adendum/cco', 'view', $data);
    }

    public function get_data_dt()
    {
        $data = Adendum::orderBy('id_adendum', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tgl_adendum', function ($row) {
                return tgl_indo($row->tgl_adendum);
            })
            ->addColumn('jenis', function ($row) {
                if ($row->jenis == 'cco') {
                    return 'ADENDUM CCO';
                } else if ($row->jenis == 'optimasi') {
                    return 'ADENDUM OPTIMASI/PERUBAHAN NILAI KONTRAK';
                } else if ($row->jenis == 'perpanjangan') {
                    return 'ADENDUM PERPANJANGAN WAKTU/PEMBERIAN KESEMPATAN';
                }
            })
            ->addColumn('action', function ($row) {                
                return '
                    <a href="' . route_role('admin.adendum.det', ['id' => my_encrypt($row->id_adendum)]) . '" class="btn btn-action btn-sm btn-relief-info"><i data-feather="info"></i>&nbsp;Detail</a>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_adendum) . '" class="btn btn-action btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = Adendum::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        $rules['id_kontrak']  = 'required';
        $rules['no_adendum']  = 'required';
        $rules['tgl_adendum'] = 'required';
        $rules['jenis']       = 'required';

        $message['id_kontrak.required']  = 'Kontrak harus diisi!';
        $message['no_adendum.required']  = 'No. Adendum harus diisi!';
        $message['tgl_adendum.required'] = 'Tgl. Adendum harus diisi!';
        $message['jenis.required']       = 'Jenis Adendum harus diisi!';

        if ($request->jenis === 'cco') {
            $rules['id_kontrak_ruas'] = 'required';

            $message['id_kontrak_ruas.required'] = 'Kontrak Ruas harus diisi!';
        } else if ($request->jenis === 'optimasi') {
            $rules['nil_adendum_kontrak'] = 'required';

            $message['nil_adendum_kontrak.required'] = 'Nilai Adendum Kontrak harus diisi!';
        } else if ($request->jenis === 'perpanjangan') {
            $rules['tgl_adendum_mulai'] = 'required';
            $rules['tgl_adendum_akhir'] = 'required';

            $message['tgl_adendum_mulai.required'] = 'Tgl. Adendum Mulai harus diisi!';
            $message['tgl_adendum_akhir.required'] = 'Tgl. Adendum Akhir harus diisi!';
        }

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            $adendum = new Adendum();

            $adendum->id_kontrak  = $request->id_kontrak;
            $adendum->no_adendum  = $request->no_adendum;
            $adendum->tgl_adendum = $request->tgl_adendum;
            $adendum->jenis       = $request->jenis;
            $adendum->by_users    = $this->session['id_users'];

            if ($request->jenis === 'optimasi') {
                $adendum->nil_adendum_kontrak = remove_separator($request->nil_adendum_kontrak);

                $kontrak = Kontrak::find($request->id_kontrak);
                $kontrak->nil_kontrak = $adendum->nil_adendum_kontrak;
                $kontrak->save();
            }

            if ($request->jenis === 'perpanjangan') {
                $adendum->tgl_adendum_mulai = $request->tgl_adendum_mulai;
                $adendum->tgl_adendum_akhir = $request->tgl_adendum_akhir;
            }

            $adendum->save();

            if ($request->jenis === 'cco') {
                $id_adendum = $adendum->id_adendum;

                $id_kontrak_ruas = $request->id_kontrak_ruas;

                foreach ($id_kontrak_ruas as $key => $value) {
                    AdendumRuas::create([
                        'id_adendum'      => $id_adendum,
                        'id_kontrak_ruas' => $value,
                        'by_users'        => $this->session['id_users'],
                    ]);
                }
            }

            if ($request->jenis === 'cco') {
                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success', 'url' => route_role('admin.adendum.cco', ['id' => my_encrypt($id_adendum)])];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
            }
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        $checking = is_valid_user($this->session['id_users'], $request->password);
        if ($checking) {
            try {
                $data = Adendum::find(my_decrypt($request->id));

                $data->delete();

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
            } catch (\Exception $e) {
                $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
            }
        } else {
            $response = ['title' => 'Maaf!', 'text' => 'Password Anda Salah!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
        }
        return Response::json($response);
    }
}
