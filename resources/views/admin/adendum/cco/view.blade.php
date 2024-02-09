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
            @foreach ($adendum_ruas as $key => $row)
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">{{ $row->toKontrakRuas->nama }}</h4>
                        </div>
                        <div class="dt-action-buttons text-end">
                            <div class="dt-buttons d-inline-flex">
                                <button type="button" id="add" data-id_adendum_ruas="{{ $row->id_adendum_ruas }}" class="btn btn-sm btn-relief-success" data-bs-toggle="modal" data-bs-target="#modal-add-upd">
                                    <i data-feather='plus'></i>&nbsp;<span>Tambah</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable">
                        <table class="table table-striped table-bordered table-ruas-item" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-center">Satuan</th>
                                    <th class="text-center">Volume</th>
                                    <th class="text-center">Harga HPS</th>
                                    <th class="text-center">Harga Kontrak</th>
                                    <th class="text-center">Jumlah Harga HPS</th>
                                    <th class="text-center">Jumlah Harga Kontrak</th>
                                    <th class="text-center">Bobot (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total_hps = $row->toAdendumRuasItem->sum(function ($item) {
                                return $item->volume * $item->harga_hps;
                                });

                                $total_kontrak = $row->toAdendumRuasItem->sum(function ($item) {
                                return $item->volume * $item->harga_kontrak;
                                });

                                $bobot = 0;
                                @endphp

                                @foreach ($row->toAdendumRuasItem as $key => $value)

                                @php
                                $jumlah_hps = ($value->volume * $value->harga_hps);
                                $jumlah_kontrak = ($value->volume * $value->harga_kontrak);
                                $jumlah_bobot = (($jumlah_kontrak / $total_kontrak) * 100);
                                $bobot += $jumlah_bobot;
                                @endphp

                                <tr>
                                    <td class="text-center">
                                        <button type="button" id="upd" data-id="{{ my_encrypt($value->id_adendum_ruas_item) }}" data-id_adendum_ruas="{{ $value->id_adendum_ruas }}" class="btn btn-sm btn-action btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                                        <button type="button" id="del" data-id="{{ my_encrypt($value->id_adendum_ruas_item) }}" data-id_adendum_ruas="{{ $value->id_adendum_ruas }}" class="btn btn-sm btn-action btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                                    </td>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $value->toRuasItem->nama }}</td>
                                    <td class="text-center">{{ strtoupper(str_replace('_', ' ', $value->toRuasItem->tipe)) }}</td>
                                    <td class="text-center">{{ $value->toSatuan->nama }}</td>
                                    <td class="text-center">{{ $value->volume }}</td>
                                    <td class="text-center">{{ rupiah($value->harga_hps) }}</td>
                                    <td class="text-center">{{ rupiah($value->harga_kontrak) }}</td>
                                    <td class="text-center">{{ rupiah($jumlah_hps) }}</td>
                                    <td class="text-center">{{ rupiah($jumlah_kontrak) }}</td>
                                    <td class="text-center">{{ number_format($jumlah_bobot, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center" colspan="8">Total Nilai Per Ruas</th>
                                    <th class="text-center">{{ rupiah($total_hps) }}</th>
                                    <th class="text-center">{{ rupiah($total_kontrak) }}</th>
                                    <th class="text-center">{{ number_format($bobot, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="d-grid gap-2">
                <button type="button" id="finish" data-id="{{ my_encrypt($id_adendum) }}" class="btn btn-lg btn-relief-info">
                    <i data-feather='check'></i>&nbsp;<span>Selesai</span>
                </button>
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
                <form id="form-add-upd" class="form form-horizontal" action="{{ route_role('admin.adendum.item.save') }}" method="POST">
                    <div class="modal-body">
                        <!-- begin:: untuk loading -->
                        <div id="form-loading"></div>
                        <!-- end:: untuk loading -->
                        <div id="form-show">
                            <div class="row">
                                <!-- begin:: id -->
                                <input type="hidden" name="id_adendum_ruas_item" id="id_adendum_ruas_item" />
                                <input type="hidden" name="id_adendum_ruas" id="id_adendum_ruas" />
                                <!-- end:: id -->
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="id_ruas_item">Nama Item&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <select class="form-select select2" id="id_ruas_item" name="id_ruas_item">
                                                <option value=""></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="id_satuan">Satuan&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <select class="form-select select2" id="id_satuan" name="id_satuan">
                                                <option value=""></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="volume">Volume&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="volume" name="volume" placeholder="Masukkan volume" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="harga_hps">Harga HPS&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="harga_hps" name="harga_hps" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan harga hps" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="harga_kontrak">Harga Kontrak&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="harga_kontrak" name="harga_kontrak" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan kontrak" />
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
        $('.table-ruas-item').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        });

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
                                location.reload();
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
                var ini = $(this);

                $('#judul-add-upd').text('Tambah');
                $('#id_adendum_ruas').val(ini.data('id_adendum_ruas'));

                $('#id_adendum_ruas_item').removeAttr('value');

                $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
                $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

                $('#form-add-upd').parsley().destroy();
                $('#form-add-upd').parsley().reset();
                $('#form-add-upd')[0].reset();

                get_ruas_item();
                get_satuan();
            });
        }();

        let untukUbahData = function() {
            $(document).on('click', '#upd', function(e) {
                var ini = $(this);

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route_role('admin.adendum.item.show') }}",
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

                        get_ruas_item(response.id_ruas_item);
                        get_satuan(response.id_satuan);

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
                                url: "{{ route_role('admin.adendum.item.del') }}",
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
                                        location.reload();
                                    });
                                }
                            });
                        })
                    }
                });
            });
        }();

        let untukFinish = function() {
            $(document).on('click', '#finish', function() {
                var ini = $(this);

                $.ajax({
                    type: "post",
                    url: "{{ route_role('admin.adendum.item.finish') }}",
                    dataType: 'json',
                    data: {
                        id: ini.data('id'),
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
                            location.href = response.url;
                        });
                    }
                });
            });
        }();

        function get_satuan(id = null) {
            $.get("{{ route_role('admin.satuan.get_all') }}", {
                id: id
            }, function(response) {
                $("#id_satuan").select2({
                    placeholder: "Pilih satuan",
                    width: '100%',
                    allowClear: true,
                    containerCssClass: 'select-sm',
                    data: response,
                });
            }, 'json');
        }

        function get_ruas_item(id = null) {
            $.get("{{ route_role('admin.ruas_item.get_all') }}", {
                id: id
            }, function(response) {
                $("#id_ruas_item").select2({
                    placeholder: "Pilih ruas item",
                    width: '100%',
                    allowClear: true,
                    containerCssClass: 'select-sm',
                    data: response,
                });
            }, 'json');
        }
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>