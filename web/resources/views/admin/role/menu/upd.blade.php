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
                    </div>
                    <div class="card-body">
                        <form id="form-add-upd" class="form form-horizontal mt-2" action="{{ route('admin.role.menu.save') }}" method="POST">
                            <!-- begin:: id -->
                            <input type="hidden" id="param" name="param" value="upd" />
                            <input type="hidden" id="id_role" name="id_role" value="{{ $role->id_role }}" />
                            <!-- end:: id -->

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="role">Role</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="role" class="form-control form-control-sm" value="{{ $role->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    @foreach ($role_menu as $row)
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input pilih-menu-head id_menu_head" id="{{ $row->id_menu_head }}" name="id_menu_head[]" value="{{ $row->id_menu_head }}" {{ $row->role_menu === null ? '' : 'checked' }}>
                                                <label class="form-check-label" for="{{ $row->id_menu_head }}">{{ $row->nama }}</label>
                                            </div>
                                            @foreach ($role_body as $row2)
                                            @if ($row->id_menu_head == $row2->id_menu_head)
                                            <div class="row">
                                                <div class="col-lg-6 offset-sm-3">
                                                    <div class="form-check form-check-inline mb-2">
                                                        <input type="checkbox" class="form-check-input pilih-menu-body id_menu_body" id="{{ $row->id_menu_head }}{{ $row2->id_menu_body }}" name="id_menu_body[]" value="{{ $row2->id_menu_body }}" data-id_menu_head="{{ $row2->id_menu_head }}" {{ $row2->role_body === null ? '' : 'checked' }}>
                                                        <label class="form-check-label" for="{{ $row->id_menu_head }}{{ $row2->id_menu_body }}">{{ $row2->nama }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="col-lg-8">
                                            @foreach ($role_action as $row3)
                                            @if ($row3->id_menu_head == $row->id_menu_head)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input pilih-menu-action" name="id_menu_action[]" value="{{ $row3->id_menu_action }}" {{ $row3->role_action === null ? '' : 'checked' }}>
                                                <label class="form-check-label" for="{{ $row3->nama }}">{{ $row3->nama }}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="d-grid col-sm-6">
                                    <a href="{{ route('admin.role.menu') }}" class="btn btn-block btn-sm btn-relief-danger">
                                        <i data-feather="x"></i>&nbsp;<span>Batal</span>
                                    </a>
                                </div>
                                <div class="d-grid col-sm-6">
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
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    <script src="{{ asset_admin('vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script>
        let untukCheckBox = function() {
            $(document).on('change', 'input[name="id_menu_head[]"]', function(e) {
                var id_menu_head = $(this);
                $('.id_menu_body').each(function() {
                    var id_menu_body = $(this);
                    if (id_menu_head.is(':checked')) {
                        if (id_menu_head.val() == id_menu_body.data('id_menu_head')) {
                            id_menu_body.prop('checked', true);
                        }
                    } else {
                        if (id_menu_head.val() == id_menu_body.data('id_menu_head')) {
                            id_menu_body.prop('checked', false);
                        }
                    }
                });
            });

            $(document).on('change', 'input[name="id_menu_body[]"]', function(e) {
                var id_menu_body = $(this);
                var test = [];
                $('.id_menu_head').each(function() {
                    var id_menu_head = $(this);
                    if (id_menu_body.is(':checked')) {
                        if (id_menu_body.data('id_menu_head') == id_menu_head.val()) {
                            id_menu_head.prop('checked', true);
                        }
                    } else {
                        var check_length = $('.id_menu_body:checked[data-id_menu_head=' + id_menu_head.val() + ']').length;
                        if (check_length == 0) {
                            if (id_menu_body.data('id_menu_head') == id_menu_head.val()) {
                                id_menu_head.prop('checked', false);
                            }
                        }
                    }
                });
            });
        }();

        let untukSimpanData = function() {
            $(document).on('submit', '#form-add-upd', function(e) {
                e.preventDefault();

                let menu_head = $('.pilih-menu-head:checked');

                if (menu_head.length == 0) {
                    Swal.fire('Oops...', 'Pilih menu terlebih dahulu!', 'error');
                } else {
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
                                    if (value.isConfirmed) {
                                        window.location.href = "{{ route('admin.role.menu') }}";
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
                }
            });

            $(document).on('keyup', '#form-add-upd input', function(e) {
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
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>