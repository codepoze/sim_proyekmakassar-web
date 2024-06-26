<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
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
                        <table class="table table-striped table-bordered" id="tabel-adendum-dt" style="width: 100%;">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- begin:: modal tambah & ubah -->
    <div id="modal-add-upd" class="modal fade text-start" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
                </div>
                <!-- begin:: untuk form -->
                <form id="form-add-upd" class="form form-horizontal" action="{{ route_role('admin.adendum.save') }}" method="POST">
                    <div class="modal-body">
                        <!-- begin:: untuk loading -->
                        <div id="form-loading"></div>
                        <!-- end:: untuk loading -->
                        <div id="form-show">
                            <div class="row">
                                <!-- begin:: id -->
                                <input type="hidden" name="id_adendum" id="id_adendum" />
                                <!-- end:: id -->
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="id_kontrak">Kontrak&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <select class="form-select select2" id="id_kontrak" name="id_kontrak">
                                                <option value=""></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="no_adendum">Nomor Adendum&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="no_adendum" name="no_adendum" placeholder="Masukkan nomor adendum" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="tgl_adendum">Tanggal Adendum&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" id="tgl_adendum" name="tgl_adendum" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="jenis">Jenis Adendum&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm" id="jenis" name="jenis">
                                                <option value="" selected>-- Pilih --</option>
                                                <option value="cco">ADENDUM CCO</option>
                                                <option value="optimasi">ADENDUM OPTIMASI/PERUBAHAN NILAI KONTRAK</option>
                                                <option value="perpanjangan">ADENDUM PERPANJANGAN WAKTU/PEMBERIAN KESEMPATAN</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="jenis-input"></div>
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
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
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
            table = $('#tabel-adendum-dt').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                    processing: "Data sedang diproses...",
                },
                ajax: "{{ route_role('admin.adendum.get_data_dt') }}",
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
                        title: 'Kontrak',
                        data: 'to_kontrak.no_kontrak',
                        class: 'text-center'
                    },
                    {
                        title: 'No. Adendum',
                        data: 'no_adendum',
                        class: 'text-center'
                    },
                    {
                        title: 'Tanggal Adendum',
                        data: 'tgl_adendum',
                        class: 'text-center'
                    },
                    {
                        title: 'Jenis Adendum',
                        data: 'jenis',
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
                                $('#modal-add-upd').modal('hide');
                                table.ajax.reload();

                                if ($('#jenis').val() === 'cco') {
                                    location.href = response.url;
                                }
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
                get_kontrak();

                $('#jenis-input').html(``);

                $('#judul-add-upd').text('Tambah');

                $('#id_adendum').removeAttr('value');

                $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
                $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

                $('#form-add-upd').parsley().destroy();
                $('#form-add-upd').parsley().reset();
                $('#form-add-upd')[0].reset();
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
                                url: "{{ route_role('admin.adendum.del') }}",
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

        let untukSelectJenis = function() {
            $(document).on('change', '#jenis', function() {
                let ini = $(this);
                let id_kontrak = $('#id_kontrak').val();

                if (ini.val() === 'cco') {
                    if (id_kontrak === '') {
                        Swal.fire('Oops...', 'Pilih kontrak terlebih dahulu!', 'error').then((value) => {
                            if (value.isConfirmed) {
                                ini.val('');
                            }
                        });;
                    } else {
                        get_kontrak_ruas(id_kontrak);
                    }
                } else if (ini.val() === 'optimasi') {
                    $('#jenis-input').html(`
                        <div class="col-12">
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="nil_adendum_kontrak">Nilai Kontrak&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="nil_adendum_kontrak" name="nil_adendum_kontrak" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Nilai Kontrak" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    `);
                } else if (ini.val() === 'perpanjangan') {
                    $('#jenis-input').html(`
                        <div class="col-12">
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_adendum_mulai">Tanggal Adendum Mulai&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control form-control-sm" id="tgl_adendum_mulai" name="tgl_adendum_mulai" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_adendum_akhir">Tanggal Adendum Selesai&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control form-control-sm" id="tgl_adendum_akhir" name="tgl_adendum_akhir" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        }();

        function get_kontrak(id = null) {
            $.get("{{ route_role('admin.kontrak.get_all') }}", {
                id: id
            }, function(response) {
                $("#id_kontrak").select2({
                    placeholder: "Pilih kontrak",
                    width: '100%',
                    allowClear: true,
                    containerCssClass: 'select-sm',
                    data: response,
                });
            }, 'json');
        }

        function get_kontrak_ruas(id = null) {
            $.post("{{ route_role('admin.kontrak.ruas.get_all') }}", {
                id: id
            }, function(response) {
                var html = ``;

                $.each(response, function(key, value) {
                    html += `
                    <div class="field-input mb-1 row">
                        <div class="col-12">
                            <div class="form-check form-check-inline mb-2">
                                <input type="checkbox" class="form-check-input" id="id_kontrak_ruas" name="id_kontrak_ruas[]" value="` + value.id_kontrak_ruas + `">
                                <label class="form-check-label" for="">` + value.nama + `</label>
                            </div>
                        </div>
                    </div>
                    `;
                });

                $('#jenis-input').html(html);
            }, 'json');
        }
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>