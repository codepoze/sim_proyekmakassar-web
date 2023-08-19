<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
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
                    <div class="dt-action-buttons text-end">
                        <div class="dt-buttons d-inline-flex">
                            <button type="button" id="add" class="btn btn-sm btn-relief-success" data-bs-toggle="modal" data-bs-target="#modal-add-upd">
                                <i data-feather='plus'></i>&nbsp;<span>Tambah</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-datatable">
                    <table class="table table-striped table-bordered" id="tabel-users-dt" style="width: 100%;">
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
            <form id="form-add-upd" class="form form-horizontal" action="{{ route('admin.users.save') }}" method="POST">
                <div class="modal-body">
                    <!-- begin:: untuk loading -->
                    <div id="form-loading"></div>
                    <!-- end:: untuk loading -->
                    <div id="form-show">
                        <div class="row">
                            <!-- begin:: id -->
                            <input type="hidden" name="id_users" id="id_users" />
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
                                        <label class="col-form-label" for="id_role">Role</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select select2" id="id_role" name="id_role">
                                            <option value=""></option>
                                        </select>
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
<script src="{{ asset_admin('vendors/js/forms/select/select2.full.min.js') }}"></script>

<script>
    var table;

    let untukTabel = function() {
        table = $('#tabel-users-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: "{{ route('admin.users.get_data_dt') }}",
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
                    title: 'Role',
                    data: 'to_role.nama',
                    class: 'text-center'
                },
                {
                    title: 'NIK',
                    data: 'username',
                    class: 'text-center'
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    class: 'text-center'
                },
                {
                    title: 'Email',
                    data: 'email',
                    class: 'text-center'
                },
                {
                    title: 'Active',
                    data: 'active',
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

    let untukSelectRole = function() {
        $.get("{{ route('admin.role.role.get_all') }}", {
            filter: 'web'
        }, function(response) {
            $("#id_role").select2({
                placeholder: "Pilih Role",
                width: '100%',
                allowClear: true,
                containerCssClass: 'select-sm',
                data: response,
            });
        }, 'json');
    }();

    let untukStatus = function() {
        $(document).on('click', '#sts', function() {
            var ini = $(this);

            Swal.fire({
                title: "Apakah Anda yakin ingin mengubah status User?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Iya, Ubah!',
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
                            url: "{{ route('admin.users.active') }}",
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

    let untukResetPassword = function() {
        $(document).on('click', '#res-pass', function() {
            var ini = $(this);

            Swal.fire({
                title: "Apakah Anda yakin ingin mengubah mengembalika password User?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Iya, Kembalikan!',
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
                            url: "{{ route('admin.users.reset_password') }}",
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