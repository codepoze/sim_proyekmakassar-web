<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    <style>
        .table tfoot th,
        .table thead th,
        .table tbody td {
            text-align: center;
            font-size: 10px !important;
        }
    </style>
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row">
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
                                    <th rowspan="2">Nama</th>
                                    <th colspan="7">KONTRAK</th>
                                    <th colspan="4">CCO</th>
                                    <th colspan="2">SELISIH</th>
                                </tr>
                                <tr>
                                    <th>Satuan</th>
                                    <th>Volume</th>
                                    <th>Harga HPS</th>
                                    <th>Harga Kontrak</th>
                                    <th>Jumlah Harga HPS</th>
                                    <th>Jumlah Harga Kontrak</th>
                                    <th>Bobot (%)</th>

                                    <th>Volume</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah Harga</th>
                                    <th>Bobot (%)</th>

                                    <th>Berkurang</th>
                                    <th>Bertambah</th>
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

                                $total_jumlah_harga = 0;
                                $total_bertambah = 0;
                                $total_berkurang = 0;
                                $bobot_kontrak = 0;
                                $bobot_cco = 0;
                                @endphp

                                @foreach ($row->toKontrakRuasItem as $key => $value)
                                @php
                                $volume = 0;
                                @endphp

                                @foreach ($value->toProgress as $key => $item)
                                @php
                                $lebar = (($item->l_1 + $item->l_2 + $item->l_3 + $item->l_4) / 3) / 100;

                                $tebal_kiri = (($item->tki_1 + $item->tki_2 + $item->tki_3) / 3) / 100;
                                $tebal_tengah = (($item->tte_1 + $item->tte_2 + $item->tte_3) / 3) / 100;
                                $tebal_kanan = (($item->tka_1 + $item->tka_2 + $item->tka_3) / 3) / 100;
                                $sum_tebal = (($tebal_kiri + $tebal_tengah + $tebal_kanan) / 3);

                                $count = ($item->panjang * $lebar * $sum_tebal * $item->berat_bersih);
                                $volume += round($count, 2);
                                @endphp
                                @endforeach

                                @php
                                $jumlah_hps = ($value->volume * $value->harga_hps);
                                $jumlah_kontrak = ($value->volume * $value->harga_kontrak);
                                $jumlah_bobot_kontrak = (($jumlah_kontrak / $total_kontrak) * 100);
                                $bobot_kontrak += $jumlah_bobot_kontrak;

                                $jumlah_harga = ($volume * $value->harga_kontrak);
                                $jumlah_bobot_cco = (($jumlah_harga / $total_kontrak) * 100);
                                $total_jumlah_harga += $jumlah_harga;
                                $bobot_cco += $jumlah_bobot_cco;

                                $selisih = abs($jumlah_kontrak - $jumlah_harga);

                                $bertambah = ($jumlah_kontrak > $jumlah_harga ? $selisih : 0);
                                $berkurang = ($jumlah_kontrak < $jumlah_harga ? $selisih : 0);

                                $total_bertambah += $bertambah;
                                $total_berkurang += $berkurang;
                                @endphp

                                <tr>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->toSatuan->nama }}</td>
                                    <td>{{ $value->volume }}</td>
                                    <td>{{ create_separator($value->harga_hps) }}</td>
                                    <td>{{ create_separator($value->harga_kontrak) }}</td>
                                    <td>{{ create_separator($jumlah_hps) }}</td>
                                    <td>{{ create_separator($jumlah_kontrak) }}</td>
                                    <td>{{ number_format($jumlah_bobot_kontrak, 2) }}</td>

                                    <td>{{ $volume }}</td>
                                    <td>{{ create_separator($value->harga_kontrak) }}</td>
                                    <td>{{ create_separator($jumlah_harga) }}</td>
                                    <td>{{ number_format($jumlah_bobot_cco, 2) }}</td>

                                    <td>{{ create_separator($bertambah)  }}</td>
                                    <td>{{ create_separator($berkurang)  }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total Nilai Per Ruas</th>
                                    <th>{{ create_separator($total_hps) }}</th>
                                    <th>{{ create_separator($total_kontrak) }}</th>
                                    <th>{{ number_format($bobot_kontrak, 2) }}</th>
                                    <th colspan="2">Total Nilai Per CCO Ruas</th>
                                    <th>{{ create_separator($total_jumlah_harga) }}</th>
                                    <th>{{ number_format($bobot_cco, 2) }}</th>
                                    <th>{{ create_separator($total_bertambah) }}</th>
                                    <th>{{ create_separator($total_berkurang) }}</th>
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
    @endpush
    <!-- end:: js local -->
</x-admin-layout>