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
                        <div class="dt-action-buttons text-end">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{ route_role('admin.kontrak.progress', ['id' => $id_kontrak]) }}" target="_blank" class="btn btn-sm btn-relief-success">
                                    <i data-feather="bar-chart"></i>&nbsp;Progress
                                </a>
                                &nbsp;
                                <a href="{{ route_role('admin.kontrak.print', ['id' => $id_kontrak]) }}" target="_blank" class="btn btn-sm btn-relief-info">
                                    <i data-feather="printer"></i>&nbsp;Cetak
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form form-horizontal mt-2">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nama Kegiatan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toPaket->toKegiatan->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tanggal Kegiatan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->toPaket->toKegiatan->tgl) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">PPTK</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toPaket->toKegiatan->toPptk->toUser->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nama Paket</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toPaket->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <hr />
                                </form>
                            </div>
                            <div class="col-lg-8">
                                <form class="form form-horizontal mt-2">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Penyedia</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toPenyedia->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">PJ Penyedia</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->pj_penyedia }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Konsultan</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toKonsultan->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">PJ Konsultan</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->pj_konsultan }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Kord Teknis Lapangan</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toTeknislap->toUser->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nomor SPMK</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_spmk }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nomor Kontrak</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_kontrak }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Waktu Kontrak</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ count_day_excluding_weekends_holiday( $kontrak->tgl_kontrak_akhir, $kontrak->tgl_kontrak_mulai) . ' Hari'; }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tahun Anggaran</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->thn_anggaran }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nilai Pagu</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($kontrak->nil_pagu) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nilai Kontrak</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($nil_kontrak) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nilai HPS</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($nil_hps) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Sumber Dana</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toFund->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Kode Rekening</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->kd_rekening }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Jenis Kontrak</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ ucfirst($kontrak->jns_kontrak) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <div class="mt-2">
                                    <img src="{{ asset_upload('picture/'.$kontrak->foto_lokasi)  }}" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="{{ $kontrak->nma_paket }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($kontrak->toKontrakRuas as $key => $row)
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">{{ $row->nama }}</h4>
                        </div>
                    </div>
                    <div class="card-datatable">
                        <table class="table table-striped table-bordered table-ruas-item" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
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
                                $total_hps = $row->toKontrakRuasItem->sum(function ($item) {
                                return $item->volume * $item->harga_hps;
                                });

                                $total_kontrak = $row->toKontrakRuasItem->sum(function ($item) {
                                return $item->volume * $item->harga_kontrak;
                                });

                                $bobot = 0;
                                @endphp

                                @foreach ($row->toKontrakRuasItem as $key => $value)

                                @php
                                $jumlah_hps = ($value->volume * $value->harga_hps);
                                $jumlah_kontrak = ($value->volume * $value->harga_kontrak);
                                $jumlah_bobot = (($jumlah_kontrak / $total_kontrak) * 100);
                                $bobot += $jumlah_bobot;
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $value->nama }}</td>
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
            @endforeach
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