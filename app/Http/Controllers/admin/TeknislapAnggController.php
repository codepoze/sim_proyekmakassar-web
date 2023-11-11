<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\TeknislapAngg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TeknislapAnggController extends Controller
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
        return Template::load('admin', 'Anggota Teknis Lapangan', 'teknislap/anggota', 'view');
    }

    public function get_data_dt(Request $request)
    {
        $query = TeknislapAngg::query();
        if ($request->id_teknislap) {
            $query->whereIdTeknislap($request->id_teknislap);
        }

        $data = $query->with(['toTeknislap.toUser', 'toUser'])->orderBy('id_teknislap_angg', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_teknislap_angg) . '" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_teknislap_angg) . '" class="btn btn-sm btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = TeknislapAngg::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        if ($request->id_teknislap_angg === null) {
            $rule = [
                'nik'     => 'required|numeric|digits:16|unique:teknislap_angg,nik',
                'nama'    => 'required',
                'telepon' => 'required|numeric|digits_between:10,13',
                'alamat'  => 'required',
            ];

            $message = [
                'nik.required'     => 'NIK tidak boleh kosong!',
                'nik.numeric'      => 'NIK harus berupa angka!',
                'nik.digits'       => 'NIK harus 16 digit!',
                'nik.unique'       => 'NIK sudah terdaftar!',
                'nama.required'    => 'Nama tidak boleh kosong!',
                'telepon.required' => 'Telepon tidak boleh kosong!',
                'telepon.numeric'  => 'Telepon harus berupa angka!',
                'telepon.digits'   => 'Telepon harus 10-13 digit!',
                'alamat.required'  => 'Alamat tidak boleh kosong!',
            ];
        } else {
            $rule = [
                'nik'     => 'required|numeric|digits:16',
                'nama'    => 'required',
                'telepon' => 'required|numeric|digits_between:10,13',
                'alamat'  => 'required',
            ];

            $message = [
                'nik.required'     => 'NIK tidak boleh kosong!',
                'nik.numeric'      => 'NIK harus berupa angka!',
                'nik.digits'       => 'NIK harus 16 digit!',
                'nama.required'    => 'Nama tidak boleh kosong!',
                'telepon.required' => 'Telepon tidak boleh kosong!',
                'telepon.numeric'  => 'Telepon harus berupa angka!',
                'telepon.digits'   => 'Telepon harus 10-13 digit!',
                'alamat.required'  => 'Alamat tidak boleh kosong!',
            ];
        }

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            $response = ['title' => 'Gagal!', 'text'  => 'Data gagal ditambahkan!', 'type'  => 'error', 'button' => 'Ok!', 'class' => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            TeknislapAngg::updateOrCreate(
                [
                    'id_teknislap_angg' => $request->id_teknislap_angg
                ],
                [
                    'id_teknislap' => $request->id_teknislap,
                    'nik'          => $request->nik,
                    'nama'         => $request->nama,
                    'telepon'      => $request->telepon,
                    'alamat'       => $request->alamat,
                ]
            );

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
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
                $data = TeknislapAngg::find(my_decrypt($request->id));

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
