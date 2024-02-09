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
                                <a href="{{ route_role('admin.kontrak.rincian', ['id' => $id_kontrak]) }}" target="_blank" class="btn btn-sm btn-relief-success">
                                    <i data-feather="bar-chart"></i>&nbsp;Rincian
                                </a>
                                &nbsp;
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-relief-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-feather="printer"></i>&nbsp;Cetak
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route_role('admin.kontrak.pdf', ['id' => $id_kontrak]) }}" target="_blank" class="dropdown-item" href="#">PDF</a></li>
                                        <li><a href="{{ route_role('admin.kontrak.excel', ['id' => $id_kontrak]) }}" target="_blank" class="dropdown-item" href="#">Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form form-horizontal mt-2">
                                    <h3>Judul</h3>
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
                                    <h3>Rencana</h3>
                                    @foreach ($kontrak->toKontrakRencana as $key => $value)
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Minggu ke-{{ $key + 1 }}</label>
                                        </div>
                                        <div class="col-sm-9 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $value->bobot }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    @endforeach
                                    <hr />
                                </form>
                            </div>
                            <div class="col-lg-8">
                                <form class="form form-horizontal mt-2">
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Penyedia</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toPenyedia->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">PJ Penyedia</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->pj_penyedia }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Konsultan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toKonsultan->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">PJ Konsultan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->pj_konsultan }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Kord Teknis Lapangan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toTeknislap->toUser->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor BA. MC NOL</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_ba_mc0 }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal BA. MC NOL</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_ba_mc0) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor BA. NEGO</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_ba_kntb }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal BA. NEGO</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_ba_kntb) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor SPPBJ</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_sppbj }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal SPPBJ</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_sppbj) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor BA. Persiapan Penandatanganan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_ba_rp2k }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal BA. Persiapan Penandatanganan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_ba_rp2k) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor Surat Pesanan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_sp }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal Surat Pesanan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_sp) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor Kontrak / SPK</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_kontrak }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal Kontrak / SPK</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_kontrak) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Jangka Waktu Kontrak</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ count_day_excluding_weekends_holiday( $kontrak->tgl_kontrak_akhir, $kontrak->tgl_kontrak_mulai) . ' HK'; }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor SPMK</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_spmk }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal SPMK</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_spmk) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nomor BA. Penyerahan Lokasi Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->no_ba_plp }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tanggal BA. Penyerahan Lokasi Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ tgl_indo($kontrak->tgl_ba_plp) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nilai Kontak</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($kontrak->nil_kontrak) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nilai Pagu</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($kontrak->nil_pagu) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Tahun Anggaran</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->thn_anggaran }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Pembuat Kontrak</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->pembuat_kontrak }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Sumber Dana</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->toFund->nama }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Kode Rekening</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ $kontrak->kd_rekening }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nilai Kontrak Per Item</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($nil_kontrak) }}" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-8">
                                            <label class="col-form-label">Nilai HPS Per Item</label>
                                        </div>
                                        <div class="col-sm-4 my-auto">
                                            <input type="text" class="form-control-plaintext" value="{{ rupiah($nil_hps) }}" readonly="readonly" />
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mt-2">
                                    <img src="{{ asset_upload('picture/'.$row->foto)  }}" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="{{ $kontrak->nma_paket }}" />
                                </div>
                            </div>
                            <div class="col-lg-8">
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
                                            <td class="text-center">
                                                <div class="btn-group btn-action">
                                                    <button class="btn btn-relief-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span>Progress</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.progress.backupdata', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Backup Data</a>
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.progress.dokumentasi', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Dokumentasi</a>
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.progress.opname', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Opname</a>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="btn-group btn-action">
                                                    <button class="btn btn-relief-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span>PHO</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.ph0.backupdata', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Backup Data</a>
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.ph0.dokumentasi', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Dokumentasi</a>
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.ph0.opname', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Opname</a>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="btn-group btn-action">
                                                    <button class="btn btn-relief-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span>FHO</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.fh0.backupdata', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Backup Data</a>
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.fh0.dokumentasi', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Dokumentasi</a>
                                                        <a class="dropdown-item" href="{{ route_role('admin.kontrak.fh0.opname', ['id' => my_encrypt($value->id_kontrak_ruas_item)]) }}">Opname</a>
                                                    </div>
                                                </div>
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