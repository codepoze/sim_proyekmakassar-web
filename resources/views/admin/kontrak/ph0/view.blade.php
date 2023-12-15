<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
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
                    <div class="card-datatable">
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">Nama Pekerjaan</th>
                                    <th class="text-center" rowspan="2">Panjang</th>
                                    <th class="text-center" rowspan="2">Titik Core</th>
                                    <th class="text-center" colspan="5">Lebar</th>
                                    <th class="text-center" colspan="4">Tebal Kiri</th>
                                    <th class="text-center" colspan="4">Tebal Tengah</th>
                                    <th class="text-center" colspan="4">Tebal Kanan</th>
                                    <th class="text-center" rowspan="2">Berat Jenis</th>
                                    <th class="text-center" rowspan="2">Vol Terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">L1</th>
                                    <th class="text-center">L2</th>
                                    <th class="text-center">L3</th>
                                    <th class="text-center">L4</th>
                                    <th class="text-center">Lr</th>

                                    <th class="text-center">T1.1</th>
                                    <th class="text-center">T1.2</th>
                                    <th class="text-center">T1.3</th>
                                    <th class="text-center">Tr1</th>

                                    <th class="text-center">T2.1</th>
                                    <th class="text-center">T2.2</th>
                                    <th class="text-center">T2.3</th>
                                    <th class="text-center">Tr2</th>

                                    <th class="text-center">T2.1</th>
                                    <th class="text-center">T2.2</th>
                                    <th class="text-center">T2.3</th>
                                    <th class="text-center">Tr2</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ph0 as $key => $value)
                                @php
                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_tki_1 = ($value->tki_1 != 0 ? 1 : 0);
                                $pembagi_tki_2 = ($value->tki_2 != 0 ? 1 : 0);
                                $pembagi_tki_3 = ($value->tki_3 != 0 ? 1 : 0);
                                $total_pembagi_tki = ($pembagi_tki_1 + $pembagi_tki_2 + $pembagi_tki_3);

                                $pembagi_tte_1 = ($value->tte_1 != 0 ? 1 : 0);
                                $pembagi_tte_2 = ($value->tte_2 != 0 ? 1 : 0);
                                $pembagi_tte_3 = ($value->tte_3 != 0 ? 1 : 0);
                                $total_pembagi_tte = ($pembagi_tte_1 + $pembagi_tte_2 + $pembagi_tte_3);

                                $pembagi_tka_1 = ($value->tka_1 != 0 ? 1 : 0);
                                $pembagi_tka_2 = ($value->tka_2 != 0 ? 1 : 0);
                                $pembagi_tka_3 = ($value->tka_3 != 0 ? 1 : 0);
                                $total_pembagi_tka = ($pembagi_tka_1 + $pembagi_tka_2 + $pembagi_tka_3);

                                $lebar = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $tebal_kiri = @((($value->tki_1 + $value->tki_2 + $value->tki_3) / $total_pembagi_tki) / 100);
                                $tebal_tengah = @((($value->tte_1 + $value->tte_2 + $value->tte_3) / $total_pembagi_tte) / 100);
                                $tebal_kanan = @((($value->tka_1 + $value->tka_2 + $value->tka_3) / $total_pembagi_tka) / 100);

                                $conversi_tebal_kiri = (is_nan($tebal_kiri)) ? 1 : $tebal_kiri;
                                $conversi_tebal_tengah = (is_nan($tebal_tengah)) ? 1 : $tebal_tengah;
                                $conversi_tebal_kanan = (is_nan($tebal_kanan)) ? 1 : $tebal_kanan;

                                $average_tebal = (($conversi_tebal_kiri + $conversi_tebal_tengah + $conversi_tebal_kanan) / 3);

                                $count = ($value->panjang * $lebar * $average_tebal * $value->berat_bersih);
                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->titik_core }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $lebar }}</td>
                                    <td class="text-center">{{ $value->tki_1 }}</td>
                                    <td class="text-center">{{ $value->tki_2 }}</td>
                                    <td class="text-center">{{ $value->tki_3 }}</td>
                                    <td class="text-center">{{ (is_nan($tebal_kiri) ? 0 : $tebal_kiri) }}</td>
                                    <td class="text-center">{{ $value->tte_1 }}</td>
                                    <td class="text-center">{{ $value->tte_2 }}</td>
                                    <td class="text-center">{{ $value->tte_3 }}</td>
                                    <td class="text-center">{{ (is_nan($tebal_tengah) ? 0 : $tebal_tengah) }}</td>
                                    <td class="text-center">{{ $value->tka_1 }}</td>
                                    <td class="text-center">{{ $value->tka_2 }}</td>
                                    <td class="text-center">{{ $value->tka_3 }}</td>
                                    <td class="text-center">{{ (is_nan($tebal_kanan) ? 0 : $tebal_kanan) }}</td>
                                    <td class="text-center">{{ $value->berat_bersih }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    @endpush
    <!-- end:: js local -->
</x-admin-layout>