<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
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
                        <form class="form form-horizontal mt-2">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Nama Kegiatan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $paket->toKegiatan->nama }}" readonly>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Tanggal Kegiatan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ tgl_indo($paket->toKegiatan->tgl) }}" readonly>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">PPTK</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $paket->toKegiatan->toPptk->toUser->nama }}" readonly>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Nama Paket</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $paket->nama }}" readonly>
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
                            <h4 class="card-title">Kontrak Paket</h4>
                        </div>
                        <div class="dt-action-buttons text-end">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{ route_role('admin.kontrak.add', ['id' => $id]) }}" class="btn btn-sm btn-relief-success">
                                    <i data-feather='plus'></i>&nbsp;<span>Tambah</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tabel-kontrak-paket-dt" style="width: 100%;"></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

    <script>
        var table;

        let untukTabel = function() {
            table = $('#tabel-kontrak-paket-dt').DataTable({
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
                    url: "{{ route_role('admin.kontrak.get_data_dt') }}",
                    type: "GET",
                    data: {
                        id_paket: "{{ $id }}"
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
                        title: 'Nomor SPMK',
                        data: 'no_spmk',
                        class: 'text-center'
                    },
                    {
                        title: 'Nomor Kontrak',
                        data: 'no_kontrak',
                        class: 'text-center'
                    },
                    {
                        title: 'Penyedia',
                        data: 'to_penyedia.nama',
                        class: 'text-center'
                    },
                    {
                        title: 'PJ Penyedia',
                        data: 'pj_penyedia',
                        class: 'text-center'
                    },
                    {
                        title: 'Konsultan',
                        data: 'to_konsultan.nama',
                        class: 'text-center'
                    },
                    {
                        title: 'PJ Konsultan',
                        data: 'pj_konsultan',
                        class: 'text-center'
                    },
                    {
                        title: 'Kord. Teknis Lapangan',
                        data: 'to_teknislap.to_user.nama',
                        class: 'text-center'
                    },
                    {
                        title: 'Nilai Pagu',
                        data: 'nil_pagu',
                        class: 'text-center'
                    },
                    {
                        title: 'Nilai Kontrak',
                        data: 'nil_kontrak',
                        class: 'text-center'
                    },
                    {
                        title: 'Waktu Kontrak',
                        data: 'waktu_kontrak',
                        class: 'text-center'
                    },
                    {
                        title: 'Jenis Kontrak',
                        data: 'jenis_kontrak',
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
                                url: "{{ route_role('admin.kontrak.del') }}",
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
    @endpush
    <!-- end:: js local -->
</x-admin-layout>