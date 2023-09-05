<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
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
                </div>
                <div class="card-body">
                    <form class="form form-horizontal mt-2">
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="nama">Nama Kegiatan</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" value="{{ $kegiatan->nama }}" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="tgl">Tanggal Kegiatan</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kegiatan->tgl) }}" readonly>
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
                            <a href="{{ route('admin.paket.add', $id) }}" class="btn btn-sm btn-relief-success">
                                <i data-feather='plus'></i>&nbsp;<span>Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="tabel-paket-kegiatan-dt" style="width: 100%;"></table>
                </div>
            </div>
        </div>
    </div>
</section>


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
                    title: 'Kordinator Teknis Lapangan',
                    data: 'to_teknislap.to_user.nama',
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
                    title: 'Lokasi Pekerjaan',
                    data: 'lokasi_pekerjaan',
                    class: 'text-center'
                },
                {
                    title: 'Schedule',
                    data: 'schedule',
                    class: 'text-center'
                },
                {
                    title: 'Nilai Total Ruas',
                    data: 'nilai_total_ruas',
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
</script>
@endsection
<!-- end:: js local -->