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
                <div class="card-datatable">
                    <table class="table table-striped table-bordered" id="tabel-paket-dt" style="width: 100%;">
                    </table>
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
        table = $('#tabel-paket-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: "{{ route('admin.paket.get_data_dt') }}",
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
                    title: 'Kegiatan',
                    data: 'to_kegiatan.nama',
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
            ],
        });
    }();
</script>
@endsection
<!-- end:: js local -->