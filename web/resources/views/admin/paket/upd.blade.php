<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/forms/select/select2.min.css') }}">
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
                    <form id="form-add-upd" class="form form-horizontal mt-2" action="{{ route('admin.paket.save') }}" method="POST">
                        <!-- begin:: id -->
                        <input type="hidden" name="id_paket" id="id_paket" value="{{ $id_paket }}" />
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
                                <input type="text" class="form-control form-control-sm" id="pj_penyedia" name="pj_penyedia" placeholder="Masukkan nama penanggung jawab penyedia" value="{{ $paket->pj_penyedia }}" />
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
                                <input type="text" class="form-control form-control-sm" id="pj_konsultan" name="pj_konsultan" placeholder="Masukkan nama penanggung jawab konsultan" value="{{ $paket->pj_konsultan }}" />
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
                                <input type="text" class="form-control form-control-sm" id="nma_paket" name="nma_paket" placeholder="Masukkan nama paket" value="{{ $paket->nma_paket }}" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="no_spmk">Nomor SPMK&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="no_spmk" name="no_spmk" placeholder="Masukkan nomor spmk" value="{{ $paket->no_spmk }}" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="no_kontrak">Nomor Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="no_kontrak" name="no_kontrak" placeholder="Masukkan nomor kontrak" value="{{ $paket->no_kontrak }}" />
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
                                        <input type="date" class="form-control form-control-sm" id="tgl_kontrak_mulai" name="tgl_kontrak_mulai" placeholder="Masukkan tanggal mulai kontrak" value="{{ $paket->tgl_kontrak_mulai }}" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-sm" id="tgl_kontrak_akhir" name="tgl_kontrak_akhir" placeholder="Masukkan tanggal akhir kontrak" value="{{ $paket->tgl_kontrak_akhir }}" />
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
                                <input type="text" class="form-control form-control-sm" id="thn_anggaran" name="thn_anggaran" placeholder="Masukkan tahun anggaran" value="{{ $paket->thn_anggaran }}" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="nil_pagu">Nilai Pagu&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="nil_pagu" name="nil_pagu" placeholder="Masukkan nilai pagu" value="{{ $paket->nil_pagu }}" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="kd_rekening">Kode Rekening&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="kd_rekening" name="kd_rekening" placeholder="Masukkan kode rekening" value="{{ $paket->kd_rekening }}" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="sumber_dana">Sumber Dana&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" class="form-control form-control-sm" id="sumber_dana" name="sumber_dana" placeholder="Masukkan sumber dana" value="{{ $paket->sumber_dana }}" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="foto_lokasi">Foto Lokasi&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" name="foto_lokasi" class="form-control form-control-sm" disabled="disabled" />
                                <div style="padding-top: 10px">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="change_picture_lokasi" id="change_picture_lokasi" onclick="change('change_picture_lokasi', 'foto_lokasi')"><label class="form-check-label">Ubah Gambar!</label>
                                    </div>
                                </div>
                                <p><small class="text-muted">File dengan tipe (*.png,*.jpg,*.jpeg).</small></p>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="doc_kontrak">Doc Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" name="doc_kontrak" class="form-control form-control-sm" disabled="disabled" />
                                <div style="padding-top: 10px">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="change_kontrak" id="change_kontrak" onclick="change('change_kontrak', 'doc_kontrak')"><label class="form-check-label">Ubah Gambar!</label>
                                    </div>
                                </div>
                                <p><small class="text-muted">File dengan tipe (*.pdf).</small></p>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="laporan">Laporan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" name="laporan" class="form-control form-control-sm" disabled="disabled" />
                                <div style="padding-top: 10px">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="change_report" id="change_report" onclick="change('change_report', 'laporan')"><label class="form-check-label">Ubah Gambar!</label>
                                    </div>
                                </div>
                                <p><small class="text-muted">File dengan tipe (*.pdf).</small></p>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- begin:: untuk ruas -->
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Ruas&nbsp;*</label>
                            </div>
                            <div class="col-sm-9">
                                @foreach ($paket->toPaketRuas as $key => $row)
                                <input type="hidden" name="id_paket_ruas[]" value="{{ $row->id_paket_ruas }}" />
                                @if ($key === 0)
                                <div class="row my-1 ruas">
                                    <div class="field-input col-9">
                                        <input type="text" id="nama_ruas_0" name="nama_ruas[]" class="form-control form-control-sm" placeholder="Masukkan nama ruas" value="{{ $row->nama }}" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <button type="button" id="add" class="btn btn-sm btn-relief-success">
                                            <span>Tambah</span>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <div class="row my-1 ruas-ini">
                                    <div class="field-input col-9">
                                        <input type="text" id="nama_ruas_{{ $key }}" name="nama_ruas[]" class="form-control form-control-sm" placeholder="Masukkan nama ruas" value="{{ $row->nama }}" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <button type="button" id="del" data-id="{{ my_encrypt($row->id_paket_ruas) }}" class="btn btn-sm btn-relief-danger">
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- end:: untuk ruas -->
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{ route('admin.kegiatan.det', my_encrypt($paket->id_kegiatan)) }}" class="btn btn-sm btn-relief-danger">
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
<script src="{{ asset_admin('vendors/js/forms/select/select2.full.min.js') }}"></script>

<script>
    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
                    $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

                    $('#save').attr('disabled', 'disabled');
                    $('#save').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                    feather.replace();
                },
                success: function(response) {
                    if (response.type === 'success') {
                        Swal.fire({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            confirmButtonText: response.button,
                            customClass: {
                                confirmButton: `btn btn-sm btn-${response.class}`,
                            },
                            buttonsStyling: false,
                        }).then((value) => {
                            location.href = response.url;
                        });
                    } else {
                        $.each(response.errors, function(key, value) {
                            if (key) {
                                if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                }
                            }
                        });

                        Swal.fire({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            confirmButtonText: response.button,
                            customClass: {
                                confirmButton: `btn btn-sm btn-${response.class}`,
                            },
                            buttonsStyling: false,
                        });
                    }

                    $('#save').removeAttr('disabled');
                    $('#save').html('<i data-feather="save"></i>&nbsp;<span>Simpan</span>');
                    feather.replace();
                }
            });
        });

        $(document).on('keyup', '#form-add-upd input', function(e) {
            e.preventDefault();

            if ($(this).val() == '') {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        $(document).on('keyup', '#form-add-upd textarea', function(e) {
            e.preventDefault();

            if ($(this).val() == '') {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        $(document).on('change', '#form-add-upd select', function(e) {
            e.preventDefault();

            if ($(this).val() == '') {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        $(document).on('change', '#form-add-upd input[type=file]', function(e) {
            e.preventDefault();

            if ($(this).val() == '') {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });
    }();

    let untukPaketRuas = function() {
        var i = $('.ruas-ini').length;

        $(document).on("click", "#add", function() {
            i++;

            var html = `
                <input type="hidden" name="id_paket_ruas[]" value="0" />
                <div class="row my-1 ruas-ini">
                    <div class="field-input col-9">
                        <input type="text" id="nama_ruas_` + i + `" name="nama_ruas[]" class="form-control form-control-sm"
                            placeholder="Masukkan nama ruas" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-3 d-flex justify-content-center">
                        <button type="button" id="del" class="btn btn-sm btn-relief-danger">
                            <span>Hapus</span>
                        </button>
                    </div>
                </div>
            `;

            $(".ruas").after(html);
        });

        $(document).on("click", "#del", function() {
            i--;

            var ini = $(this);
            var id = ini.data("id");

            if (id !== undefined) {
                $.post("{{ route('admin.paket.ruas.del') }}", {
                    id: id
                }, function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            confirmButtonText: response.button,
                            customClass: {
                                confirmButton: `btn btn-sm btn-${response.class}`,
                            },
                            buttonsStyling: false,
                        }).then((value) => {
                            ini.parents(".ruas-ini").remove();
                        });
                    } else {
                        Swal.fire({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            confirmButtonText: response.button,
                            customClass: {
                                confirmButton: `btn btn-sm btn-${response.class}`,
                            },
                            buttonsStyling: false,
                        });
                    }
                }, 'json');
            } else {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data Sukses di Hapus!',
                    icon: 'success',
                    confirmButtonText: 'Ok!',
                    customClass: {
                        confirmButton: `btn btn-sm btn-success`,
                    },
                    buttonsStyling: false,
                }).then((value) => {
                    ini.parents(".ruas-ini").remove();
                });
            }
        });
    }();

    let untukSelectPenyedia = function() {
        $.get("{{ route('admin.penyedia.get_all') }}", {
            id: '{{ $paket->id_penyedia }}'
        }, function(response) {
            $("#id_penyedia").select2({
                placeholder: "Pilih penyedia",
                width: '100%',
                allowClear: true,
                containerCssClass: 'select-sm',
                data: response,
            });
        }, 'json');
    }();

    let untukSelectKonsultan = function() {
        $.get("{{ route('admin.konsultan.get_all') }}", {
            id: '{{ $paket->id_konsultan }}'
        }, function(response) {
            $("#id_konsultan").select2({
                placeholder: "Pilih konsultan",
                width: '100%',
                allowClear: true,
                containerCssClass: 'select-sm',
                data: response,
            });
        }, 'json');
    }();

    let untukSelectTeknisLapangan = function() {
        $.get("{{ route('admin.teknislap.kordinator.get_all') }}", {
            id: '{{ $paket->id_teknislap }}'
        }, function(response) {
            $("#id_teknislap").select2({
                placeholder: "Pilih Kordinator Teknis Lapangan",
                width: '100%',
                allowClear: true,
                containerCssClass: 'select-sm',
                data: response,
            });
        }, 'json');
    }();
</script>
@endsection
<!-- end:: js local -->