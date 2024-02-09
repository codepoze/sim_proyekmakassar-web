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
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form form-horizontal mt-2">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nomor Kontrak</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ $adendum->toKontrak->no_kontrak }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nomor Adendum</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ $adendum->no_adendum }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tanggal Adendum</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($adendum->tgl_adendum) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Jenis Adendum</label>
                                        </div>
                                        <div class="col-sm-9">
                                            @if ($adendum->jenis == 'cco')
                                            <input type="text" class="form-control-plaintext" value="ADENDUM CCO" readonly="readonly" />
                                            @elseif ($adendum->jenis == 'optimasi')
                                            <input type="text" class="form-control-plaintext" value="ADENDUM OPTIMASI/PERUBAHAN NILAI KONTRAK" readonly="readonly" />
                                            @elseif ($adendum->jenis == 'perpanjangan')
                                            <input type="text" class="form-control-plaintext" value="ADENDUM PERPANJANGAN WAKTU/PEMBERIAN KESEMPATAN" readonly="readonly" />
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($adendum->jenis == 'cco')
                @foreach ($adendum->toAdendumRuas as $key => $row)
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <div class="head-label">
                                <h4 class="card-title">{{ $row->toKontrakRuas->nama }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mt-2">
                                        <img src="{{ asset_upload('picture/'.$row->toKontrakRuas->foto)  }}" class="img-fluid mx-auto d-block" id="lihat-gambar" />
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <table class="table table-striped table-bordered table-ruas-item" style="width: 100%;">
                                        <thead>
                                            <tr>
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
                                                <th class="text-center" colspan="6">Total Nilai Per Ruas</th>
                                                <th class="text-center">{{ rupiah($total_hps) }}</th>
                                                <th class="text-center">{{ rupiah($total_kontrak) }}</th>
                                                <th class="text-center">{{ number_format($bobot, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @elseif ($adendum->jenis == 'optimasi')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form form-horizontal mt-2">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nilai Kontrak</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($adendum->nil_adendum_kontrak) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif ($adendum->jenis == 'perpanjangan')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form form-horizontal mt-2">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nilai Kontrak</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($adendum->toKontrak->nil_kontrak) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tanggal Adendum Mulai</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($adendum->tgl_adendum_mulai) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tanggal Adendum Mulai</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($adendum->tgl_adendum_akhir) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Jangka Waktu Adendum</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ count_day_excluding_weekends_holiday( $adendum->tgl_adendum_akhir, $adendum->tgl_adendum_mulai) . ' HK'; }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <hr />
                                    @php
                                    $total_denda = 0;
                                    @endphp

                                    @for($i = 1; $i <= count_day_excluding_weekends_holiday( $adendum->tgl_adendum_akhir, $adendum->tgl_adendum_mulai); $i++)
                                        @php
                                        $denda = ($adendum->toKontrak->nil_kontrak * 0.01);
                                        $total_denda += $denda;
                                        @endphp
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Denda Hari Ke {{ $i }}</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-plaintext" value="{{ rupiah($denda) }}" readonly="readonly" />
                                            </div>
                                        </div>
                                        @endfor
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label"><b>Total Denda</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-plaintext" value="{{ rupiah($total_denda) }}" readonly="readonly" />
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>