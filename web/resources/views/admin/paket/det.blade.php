<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/pickers/pickadate/pickadate.css') }}">
@endsection
<!-- end:: css local -->

<!-- begin:: content -->
@section('content')
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="head-label">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-add-upd" class="form form-horizontal mt-2" action="" method="POST">
                        <!-- begin:: id -->
                        <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="" />
                        <input type="hidden" name="id_paket" id="id_paket" />
                        <!-- end:: id -->

                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="id_penyedia">Penyedia&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <select class="form-select select2" id="id_penyedia" name="id_penyedia">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="pj_penyedia">PJ Penyedia&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="pj_penyedia" name="pj_penyedia" placeholder="Masukkan nama penanggung jawab penyedia" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="id_konsultan">Konsultan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <select class="form-select select2" id="id_konsultan" name="id_konsultan">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="pj_konsultan">PJ Konsultan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="pj_konsultan" name="pj_konsultan" placeholder="Masukkan nama penanggung jawab konsultan" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="id_teknislap">Kord Teknis Lapangan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <select class="form-select select2" id="id_teknislap" name="id_teknislap">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="nma_paket">Nama Paket&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="nma_paket" name="nma_paket" placeholder="Masukkan nama paket" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="no_spmk">Nomor SPMK&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="no_spmk" name="no_spmk" placeholder="Masukkan nomor spmk" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="no_kontrak">Nomor Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="no_kontrak" name="no_kontrak" placeholder="Masukkan nomor kontrak" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="waktu_kontrak">Schedule&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-sm" id="tgl_kontrak_mulai" name="tgl_kontrak_mulai" placeholder="Masukkan tanggal mulai kontrak" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-sm" id="tgl_kontrak_akhir" name="tgl_kontrak_akhir" placeholder="Masukkan tanggal akhir kontrak" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="thn_anggaran">Tahun Anggaran&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="thn_anggaran" name="thn_anggaran" placeholder="Masukkan tahun anggaran" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="nil_pagu">Nilai Pagu&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="nil_pagu" name="nil_pagu" placeholder="Masukkan nilai pagu" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="kd_rekening">Kode Rekening&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="kd_rekening" name="kd_rekening" placeholder="Masukkan kode rekening" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="sumber_dana">Sumber Dana&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="sumber_dana" name="sumber_dana" placeholder="Masukkan sumber dana" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="foto_lokasi">Foto Lokasi&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" class="form-control form-control-sm" id="foto_lokasi" name="foto_lokasi" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="doc_kontrak">Doc Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" class="form-control form-control-sm" id="doc_kontrak" name="doc_kontrak" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="laporan">Laporan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" class="form-control form-control-sm" id="laporan" name="laporan" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- begin:: untuk ruas -->
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Ruas&nbsp;*</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="row my-1 ruas">
                                    <div class="field-input col-9">
                                        <input type="text" id="nama_ruas_0" name="nama_ruas[]" class="form-control form-control-sm" placeholder="Masukkan nama ruas" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <button type="button" id="add" class="btn btn-sm btn-relief-success">
                                            <span>Tambah</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:: untuk ruas -->
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="" class="btn btn-sm btn-relief-danger">
                                    <i data-feather="x"></i>&nbsp;<span>Batal</span>
                                </a>&nbsp;
                                <button type="submit" id="save" class="btn btn-sm btn-relief-primary">
                                    <i data-feather="save"></i>&nbsp;<span>Simpan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
@endsection
<!-- end:: js local -->