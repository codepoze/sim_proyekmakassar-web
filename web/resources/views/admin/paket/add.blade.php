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
                    <form id="form-add-upd" class="form form-horizontal mt-2" action="{{ route('admin.paket.save') }}" method="POST">
                        <!-- begin:: id -->
                        <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="{{ $id_kegiatan }}" />
                        <input type="hidden" name="id_paket" id="id_paket" />
                        <!-- end:: id -->

                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="id_perusahaan">Perusahaan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <select class="form-select select2" id="id_perusahaan" name="id_perusahaan">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="id_teknislap">Kordinator Teknis Lapangan&nbsp;*</label>
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
                                <label class="col-form-label" for="no_spmk">Nomor SPMK&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" id="no_spmk" class="form-control form-control-sm" name="no_spmk" placeholder="Masukkan Nomor SPMK" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="no_kontrak">Nomor Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" id="no_kontrak" class="form-control form-control-sm" name="no_kontrak" placeholder="Masukkan Nomor Kontrak" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="nil_kontrak">Nilai Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" id="nil_kontrak" class="form-control form-control-sm" name="nil_kontrak" placeholder="Masukkan Nilai Kontrak" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="waktu_kontrak">Waktu Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" id="waktu_kontrak" class="form-control form-control-sm" name="waktu_kontrak" placeholder="Masukkan Waktu Kontrak" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="doc_kontrak">Doc Kontrak&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" id="doc_kontrak" class="form-control form-control-sm" name="doc_kontrak" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="lokasi_pekerjaan">Lokasi Pekerjaan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="text" id="lokasi_pekerjaan" class="form-control form-control-sm" name="lokasi_pekerjaan" placeholder="Masukkan Lokasi Pekerjaan" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="schedule">Schedule&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="date" id="schedule" class="form-control form-control-sm" name="schedule" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="foto_lokasi">Foto Lokasi&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" id="foto_lokasi" class="form-control form-control-sm" name="foto_lokasi" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="field-input mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="laporan">Laporan&nbsp;*</label>
                            </div>
                            <div class="col-sm-9 my-auto">
                                <input type="file" id="laporan" class="form-control form-control-sm" name="laporan" />
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
                                    <div class="field-input col-3">
                                        <input type="text" id="nilai_ruas_0" name="nilai_ruas[]" class="form-control form-control-sm" placeholder="Masukkan Nilai Ruas" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="field-input col-3">
                                        <input type="text" id="lat_0" name="lat[]" class="form-control form-control-sm" placeholder="Masukkan Latitude" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="field-input col-3">
                                        <input type="text" id="long_0" name="long[]" class="form-control form-control-sm" placeholder="Masukkan Longitude" />
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
                                <a href="{{ route('admin.paket.paket') }}" class="btn btn-sm btn-relief-danger">
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
<script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset_admin('vendors/js/pickers/pickadate/legacy.js') }}"></script>
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
                            location.href = "{{ route('admin.paket.paket') }}";
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

    let untukRuas = function() {
        var i = 0;

        $(document).on("click", "#add", function() {
            i++;

            var html = `
                <div class="row my-1 ruas-ini">
                    <div class="field-input col-3">
                        <input type="text" id="nilai_ruas_` + i + `" name="nilai_ruas[]" class="form-control form-control-sm"
                            placeholder="Masukkan Nilai Ruas" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="field-input col-3">
                        <input type="text" id="lat_` + i + `" name="lat[]" class="form-control form-control-sm"
                            placeholder="Masukkan Latitude" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="field-input col-3">
                        <input type="text" id="long_` + i + `" name="long[]" class="form-control form-control-sm"
                            placeholder="Masukkan Longitude" />
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
            ini.parents(".ruas-ini").remove();
        });
    }();

    let untukSelectPerusahaan = function() {
        $.get("{{ route('admin.perusahaan.get_all') }}", function(response) {
            $("#id_perusahaan").select2({
                placeholder: "Pilih Perusahaan",
                width: '100%',
                allowClear: true,
                containerCssClass: 'select-sm',
                data: response,
            });
        }, 'json');
    }();

    let untukSelectTeknisLapangan = function() {
        $.get("{{ route('admin.teknislap.kordinator.get_all') }}", function(response) {
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