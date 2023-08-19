<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
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
                    <form class="form form-horizontal mt-2">
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="nama">Nama Kegiatan</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" id="nama" name="nama" value="{{ $kegiatan->nama }}" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="tgl">Tanggal Kegiatan</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" id="tgl" name="tgl" value="{{ tgl_indo($kegiatan->tgl) }}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="head-label">
                        <h4 class="card-title">Paket Kegiatan</h4>
                    </div>
                    <div class="dt-action-buttons text-end">
                        <div class="dt-buttons d-inline-flex">
                            <button type="button" id="add" class="btn btn-sm btn-relief-success" data-bs-toggle="modal" data-bs-target="#modal-add-upd">
                                <i data-feather='plus'></i>&nbsp;<span>Tambah</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="tabel-paket-kegiatan-dt" style="width: 100%;">
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- begin:: modal tambah & ubah -->
<div id="modal-add-upd" class="modal fade text-start" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <!-- begin:: untuk form -->
            <form id="form-add-upd" class="form form-horizontal" action="{{ route('admin.paket.save') }}" method="POST">
                <div class="modal-body">
                    <!-- begin:: untuk loading -->
                    <div id="form-loading"></div>
                    <!-- end:: untuk loading -->
                    <div id="form-show">
                        <div class="row">
                            <!-- begin:: id -->
                            <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="{{ $kegiatan->id_kegiatan }}" />
                            <input type="hidden" name="id_paket" id="id_paket" />
                            <!-- end:: id -->
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="id_perusahaan">Perusahaan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select select2" id="id_perusahaan" name="id_perusahaan">
                                            <option value=""></option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="id_kord_pengawas">Kordinator Pengawas</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select select2" id="id_kord_pengawas" name="id_kord_pengawas">
                                            <option value=""></option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nama_paket">Nama Paket</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nama_paket" class="form-control form-control-sm" name="nama_paket" placeholder="Masukkan Nama Paket" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nama_pekerjaan">Nama Pekerjaan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nama_pekerjaan" class="form-control form-control-sm" name="nama_pekerjaan" placeholder="Masukkan Nama Pekerjaan" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="lama_pekerjaan">Lama Pekerjaan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="lama_pekerjaan" class="form-control form-control-sm" name="lama_pekerjaan" placeholder="Masukkan Lama Pekerjaan" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nilai_kontrak">Nilai Kontrak</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nilai_kontrak" class="form-control form-control-sm" name="nilai_kontrak" placeholder="Masukkan Kontrak" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nomor_kontrak">Nomor Kontrak</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nomor_kontrak" class="form-control form-control-sm" name="nomor_kontrak" placeholder="Masukkan Nomor Kontrak" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nomor_spk">Nomor SPK</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nomor_spk" class="form-control form-control-sm" name="nomor_spk" placeholder="Masukkan Nomor SPK" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nama_lokasi">Nama Lokasi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nama_lokasi" class="form-control form-control-sm" name="nama_lokasi" placeholder="Masukkan Nama Lokasi" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="ruas_jalan">Ruas Jalan</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="ruas_jalan" class="form-control form-control-sm" name="ruas_jalan" placeholder="Masukkan Ruas Jalan" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nilai_peruas">Nilai Peruas</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nilai_peruas" class="form-control form-control-sm" name="nilai_peruas" placeholder="Masukkan Nilai Peruas" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nilai_total_ruas">Nilai Total Ruas</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nilai_total_ruas" class="form-control form-control-sm" name="nilai_total_ruas" placeholder="Masukkan Nilai Total Ruas" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="titik_kordinat">Titik Kordinat</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="titik_kordinat" class="form-control form-control-sm" name="titik_kordinat" placeholder="Masukkan Kordinat" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="schedule">Schedule</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="schedule" class="form-control form-control-sm" name="schedule" placeholder="Masukkan Schedule" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="foto_lokasi">Foto Lokasi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" id="foto_lokasi" class="form-control" name="foto_lokasi" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="doc_administrasi">Doc Administrasi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" id="doc_administrasi" class="form-control" name="doc_administrasi" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="doc_kontrak">Doc Kontrak</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" id="doc_kontrak" class="form-control" name="doc_kontrak" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancel" class="btn btn-sm btn-relief-danger" data-bs-dismiss="modal">
                        <i data-feather="x"></i>&nbsp;<span>Batal</span>
                    </button>
                    <button type="submit" id="save" class="btn btn-sm btn-relief-primary">
                        <i data-feather="save"></i>&nbsp;<span>Simpan</span>
                    </button>
                </div>
            </form>
            <!-- end:: untuk form -->
        </div>
    </div>
</div>
<!-- end:: modal tambah & ubah -->
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
<script src="{{ asset_admin('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset_admin('vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ asset_admin('vendors/js/forms/select/select2.full.min.js') }}"></script>

<script>
    var table;

    let untukTabel = function() {
        table = $('#tabel-paket-kegiatan-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: {
                url: "{{ route('admin.paket.get_data_dt') }}",
                type: "GET",
                data: {
                    id_kegiatan: $('#id_kegiatan').val()
                }
            },
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            drawCallback: function() {
                feather.replace();
            },
            columns: [{
                    title: 'No.',
                    data: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    title: 'Perusahaan',
                    data: 'to_perusahaan.nama',
                    class: 'text-center'
                },
                {
                    title: 'Kordinator Pengawas',
                    data: 'to_kord_pengawas.to_user.nama',
                    class: 'text-center'
                },
                {
                    title: 'Nama Paket',
                    data: 'nama_paket',
                    class: 'text-center'
                },
                {
                    title: 'Nama Pekerjaan',
                    data: 'nama_pekerjaan',
                    class: 'text-center'
                },
                {
                    title: 'Lama Pekerjaan',
                    data: 'lama_pekerjaan',
                    class: 'text-center'
                },
                {
                    title: 'Nilai Kontrak',
                    data: 'nilai_kontrak',
                    class: 'text-center'
                },
                {
                    title: 'Nomor Kontrak',
                    data: 'nomor_kontrak',
                    class: 'text-center'
                },
                {
                    title: 'Nomor SPK',
                    data: 'nomor_spk',
                    class: 'text-center'
                },
                {
                    title: 'Nama Lokasi',
                    data: 'nama_lokasi',
                    class: 'text-center'
                },
                {
                    title: 'Ruas Jalan',
                    data: 'ruas_jalan',
                    class: 'text-center'
                },
                {
                    title: 'Nilai Peruas',
                    data: 'nilai_peruas',
                    class: 'text-center'
                },
                {
                    title: 'Nilai Total Ruas',
                    data: 'nilai_total_ruas',
                    class: 'text-center'
                },
                {
                    title: 'Titik Kordinat',
                    data: 'titik_kordinat',
                    class: 'text-center'
                },
                {
                    title: 'Schedule',
                    data: 'schedule',
                    class: 'text-center'
                },
                {
                    title: 'Aksi',
                    data: 'action',
                    className: 'text-center',
                    responsivePriority: -1,
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }();

    let untukTambahData = function() {
        $(document).on('click', '#add', function(e) {
            e.preventDefault();
            $('#judul-add-upd').text('Tambah');

            $('#id_paket').removeAttr('value');

            $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
            $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

            $('#form-add-upd').parsley().destroy();
            $('#form-add-upd').parsley().reset();
            $('#form-add-upd')[0].reset();
        });
    }();

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
                            $('#modal-add-upd').modal('hide');
                            table.ajax.reload();
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

    let untukHapusData = function() {
        $(document).on('click', '#del', function() {
            var ini = $(this);

            Swal.fire({
                title: "Apakah Anda yakin ingin menghapusnya?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Iya, Hapus!',
                customClass: {
                    confirmButton: 'btn btn-sm btn-success',
                    cancelButton: 'btn btn-sm btn-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        title: 'Masukkan password Anda!',
                        input: 'password',
                        inputLabel: 'Password Anda',
                        inputPlaceholder: 'Masukkan password Anda',
                    }).then((result) => {
                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.paket.del') }}",
                            dataType: 'json',
                            data: {
                                id: ini.data('id'),
                                password: result.value,
                            },
                            beforeSend: function() {
                                ini.attr('disabled', 'disabled');
                                ini.html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                                feather.replace();
                            },
                            success: function(response) {
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
                                    table.ajax.reload();
                                });
                            }
                        });
                    })
                }
            });
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

    let untukSelectKordPengawas = function() {
        $.get("{{ route('admin.pengawas.kordinator.get_all') }}", function(response) {
            $("#id_kord_pengawas").select2({
                placeholder: "Pilih Kordinator Pengawas",
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