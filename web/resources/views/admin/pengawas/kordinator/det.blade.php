<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
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
                                <label class="col-form-label" for="username">NIK</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" value="{{ $kord_pengawas->toUser->username }}" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="nama">Nama</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" value="{{ $kord_pengawas->toUser->nama }}" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="email">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" value="{{ $kord_pengawas->toUser->email }}" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="telepon">Telepon</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" value="{{ $kord_pengawas->telepon }}" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="alamat">Alamat</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" value="{{ $kord_pengawas->alamat }}" readonly>
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
                        <h4 class="card-title">Anggota Kordinator</h4>
                    </div>
                    <div class="dt-action-buttons text-end">
                        <div class="dt-buttons d-inline-flex">
                            <button type="button" id="add" class="btn btn-sm btn-relief-success" data-bs-toggle="modal" data-bs-target="#modal-add-upd">
                                <i data-feather='plus'></i>&nbsp;<span>Tambah</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-datatable">
                    <table class="table table-striped table-bordered" id="tabel-anggota-pengawaas-dt" style="width: 100%;">
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- begin:: modal tambah & ubah -->
<div id="modal-add-upd" class="modal fade text-start" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <!-- begin:: untuk form -->
            <form id="form-add-upd" class="form form-horizontal" action="{{ route('admin.pengawas.anggota.save') }}" method="POST">
                <div class="modal-body">
                    <!-- begin:: untuk loading -->
                    <div id="form-loading"></div>
                    <!-- end:: untuk loading -->
                    <div id="form-show">
                        <div class="row">
                            <!-- begin:: id -->
                            <input type="hidden" name="id_kord_pengawas" id="id_kord_pengawas" value="{{ $kord_pengawas->id_kord_pengawas }}" />
                            <input type="hidden" name="id_angg_pengawas" id="id_angg_pengawas" />
                            <!-- end:: id -->
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nik">NIK</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nik" class="form-control form-control-sm" name="nik" placeholder="Masukkan NIK" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nama">Nama</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="nama" class="form-control form-control-sm" name="nama" placeholder="Masukkan Nama" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="email">Email</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="email" class="form-control form-control-sm" name="email" placeholder="Masukkan Email" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="telepon">Telepon</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="telepon" class="form-control form-control-sm" name="telepon" placeholder="Masukkan Telepon" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="alamat">Alamat</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="alamat" class="form-control form-control-sm" name="alamat" placeholder="Masukkan Alamat"></textarea>
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

<script>
    var table;

    let untukTabel = function() {
        table = $('#tabel-anggota-pengawaas-dt').DataTable({
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
                url: "{{ route('admin.pengawas.anggota.get_data_dt') }}",
                type: "GET",
                data: {
                    id_kord_pengawas: $('#id_kord_pengawas').val()
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
                    title: 'NIK',
                    data: 'to_user.username',
                    class: 'text-center'
                },
                {
                    title: 'Nama',
                    data: 'to_user.nama',
                    class: 'text-center'
                },
                {
                    title: 'Email',
                    data: 'to_user.email',
                    class: 'text-center'
                },
                {
                    title: 'Telepon',
                    data: 'telepon',
                    class: 'text-center'
                },
                {
                    title: 'Alamat',
                    data: 'alamat',
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
    }();

    let untukTambahData = function() {
        $(document).on('click', '#add', function(e) {
            e.preventDefault();
            $('#judul-add-upd').text('Tambah');

            $('#id_angg_pengawas').removeAttr('value');

            $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
            $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

            $('#form-add-upd').parsley().destroy();
            $('#form-add-upd').parsley().reset();
            $('#form-add-upd')[0].reset();
        });
    }();

    let untukUbahData = function() {
        $(document).on('click', '#upd', function(e) {
            var ini = $(this);

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "{{ route('admin.pengawas.anggota.show') }}",
                data: {
                    id: ini.data('id')
                },
                beforeSend: function() {
                    $('#judul-add-upd').html('Ubah');
                    $('#form-loading').html(`<div class="center"><div class="loader"></div></div>`);
                    $('#form-show').attr('style', 'display: none');

                    $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
                    $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

                    ini.attr('disabled', 'disabled');
                    ini.html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                    feather.replace();
                },
                success: function(response) {
                    $('#form-loading').empty();
                    $('#form-show').removeAttr('style');

                    $.each(response, function(key, value) {
                        if (key) {
                            if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                $('#' + key).val(value);
                            } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                $('#' + key).val(value);
                            }
                        }
                    });

                    ini.removeAttr('disabled');
                    ini.html('<i data-feather="edit"></i>&nbsp;<span>Ubah</span>');
                    feather.replace();
                }
            });
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
                            url: "{{ route('admin.pengawas.anggota.del') }}",
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
</script>
@endsection
<!-- end:: js local -->