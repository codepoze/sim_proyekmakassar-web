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
                        @if ($kontrak_ruas_item->tipe === 'pbj')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));

                                $count = ($value->panjang * $L);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'lpa')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal sisi kiri</th>
                                    <th class="text-center" colspan="4">tebal sisi kanan</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                    <th class="text-center">T3.1 (cm)</th>
                                    <th class="text-center">T3.2 (cm)</th>
                                    <th class="text-center">T3.3 (cm)</th>
                                    <th class="text-center">Tr3 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $pembagi_t3_1 = ($value->t3_1 != 0 ? 1 : 0);
                                $pembagi_t3_2 = ($value->t3_2 != 0 ? 1 : 0);
                                $pembagi_t3_3 = ($value->t3_3 != 0 ? 1 : 0);
                                $total_pembagi_t3 = ($pembagi_t3_1 + $pembagi_t3_2 + $pembagi_t3_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);
                                $T3 = @((($value->t3_1 + $value->t3_2 + $value->t3_3) / $total_pembagi_t3) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;
                                $conversi_T3 = (is_nan($T3)) ? 1 : $T3;

                                $average_tebal = (($conversi_T1 + $conversi_T3) / 2);

                                $count = ($value->panjang * $L * $average_tebal);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $value->t3_1 }}</td>
                                    <td class="text-center">{{ $value->t3_2 }}</td>
                                    <td class="text-center">{{ $value->t3_3 }}</td>
                                    <td class="text-center">{{ $T3 }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'lpb')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal sisi kiri</th>
                                    <th class="text-center" colspan="4">tebal sisi kanan</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                    <th class="text-center">T3.1 (cm)</th>
                                    <th class="text-center">T3.2 (cm)</th>
                                    <th class="text-center">T3.3 (cm)</th>
                                    <th class="text-center">Tr3 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $pembagi_t3_1 = ($value->t3_1 != 0 ? 1 : 0);
                                $pembagi_t3_2 = ($value->t3_2 != 0 ? 1 : 0);
                                $pembagi_t3_3 = ($value->t3_3 != 0 ? 1 : 0);
                                $total_pembagi_t3 = ($pembagi_t3_1 + $pembagi_t3_2 + $pembagi_t3_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);
                                $T3 = @((($value->t3_1 + $value->t3_2 + $value->t3_3) / $total_pembagi_t3) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;
                                $conversi_T3 = (is_nan($T3)) ? 1 : $T3;

                                $average_tebal = (($conversi_T1 + $conversi_T3) / 2);

                                $count = ($value->panjang * $L * $average_tebal);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $value->t3_1 }}</td>
                                    <td class="text-center">{{ $value->t3_2 }}</td>
                                    <td class="text-center">{{ $value->t3_3 }}</td>
                                    <td class="text-center">{{ $T3 }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'ac_bc')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" rowspan="2">titik core</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal core kiri</th>
                                    <th class="text-center" colspan="4">tebal core tengah</th>
                                    <th class="text-center" colspan="4">tebal core kanan</th>
                                    <th class="text-center" rowspan="2">berat jenis</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                    <th class="text-center">T2.1 (cm)</th>
                                    <th class="text-center">T2.2 (cm)</th>
                                    <th class="text-center">T2.3 (cm)</th>
                                    <th class="text-center">Tr2 (m)</th>
                                    <th class="text-center">T3.1 (cm)</th>
                                    <th class="text-center">T3.2 (cm)</th>
                                    <th class="text-center">T3.3 (cm)</th>
                                    <th class="text-center">Tr3 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $pembagi_t2_1 = ($value->t2_1 != 0 ? 1 : 0);
                                $pembagi_t2_2 = ($value->t2_2 != 0 ? 1 : 0);
                                $pembagi_t2_3 = ($value->t2_3 != 0 ? 1 : 0);
                                $total_pembagi_t2 = ($pembagi_t2_1 + $pembagi_t2_2 + $pembagi_t2_3);

                                $pembagi_t3_1 = ($value->t3_1 != 0 ? 1 : 0);
                                $pembagi_t3_2 = ($value->t3_2 != 0 ? 1 : 0);
                                $pembagi_t3_3 = ($value->t3_3 != 0 ? 1 : 0);
                                $total_pembagi_t3 = ($pembagi_t3_1 + $pembagi_t3_2 + $pembagi_t3_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);
                                $T2 = @((($value->t2_1 + $value->t2_2 + $value->t2_3) / $total_pembagi_t2) / 100);
                                $T3 = @((($value->t3_1 + $value->t3_2 + $value->t3_3) / $total_pembagi_t3) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;
                                $conversi_T2 = (is_nan($T2)) ? 1 : $T2;
                                $conversi_T3 = (is_nan($T3)) ? 1 : $T3;

                                $average_tebal = ($conversi_T1 + $conversi_T2 + $conversi_T3) / 3;

                                $count = ($value->panjang * $L * $average_tebal * $value->berat_jenis);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->titik_core }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $value->t2_1 }}</td>
                                    <td class="text-center">{{ $value->t2_2 }}</td>
                                    <td class="text-center">{{ $value->t2_3 }}</td>
                                    <td class="text-center">{{ $T2 }}</td>
                                    <td class="text-center">{{ $value->t3_1 }}</td>
                                    <td class="text-center">{{ $value->t3_2 }}</td>
                                    <td class="text-center">{{ $value->t3_3 }}</td>
                                    <td class="text-center">{{ $T3 }}</td>
                                    <td class="text-center">{{ $value->berat_jenis }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'ac_wc')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" rowspan="2">titik core</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal core kiri</th>
                                    <th class="text-center" colspan="4">tebal core tengah</th>
                                    <th class="text-center" colspan="4">tebal core kanan</th>
                                    <th class="text-center" rowspan="2">berat jenis</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                    <th class="text-center">T2.1 (cm)</th>
                                    <th class="text-center">T2.2 (cm)</th>
                                    <th class="text-center">T2.3 (cm)</th>
                                    <th class="text-center">Tr2 (m)</th>
                                    <th class="text-center">T3.1 (cm)</th>
                                    <th class="text-center">T3.2 (cm)</th>
                                    <th class="text-center">T3.3 (cm)</th>
                                    <th class="text-center">Tr3 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $pembagi_t2_1 = ($value->t2_1 != 0 ? 1 : 0);
                                $pembagi_t2_2 = ($value->t2_2 != 0 ? 1 : 0);
                                $pembagi_t2_3 = ($value->t2_3 != 0 ? 1 : 0);
                                $total_pembagi_t2 = ($pembagi_t2_1 + $pembagi_t2_2 + $pembagi_t2_3);

                                $pembagi_t3_1 = ($value->t3_1 != 0 ? 1 : 0);
                                $pembagi_t3_2 = ($value->t3_2 != 0 ? 1 : 0);
                                $pembagi_t3_3 = ($value->t3_3 != 0 ? 1 : 0);
                                $total_pembagi_t3 = ($pembagi_t3_1 + $pembagi_t3_2 + $pembagi_t3_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);
                                $T2 = @((($value->t2_1 + $value->t2_2 + $value->t2_3) / $total_pembagi_t2) / 100);
                                $T3 = @((($value->t3_1 + $value->t3_2 + $value->t3_3) / $total_pembagi_t3) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;
                                $conversi_T2 = (is_nan($T2)) ? 1 : $T2;
                                $conversi_T3 = (is_nan($T3)) ? 1 : $T3;

                                $average_tebal = ($conversi_T1 + $conversi_T2 + $conversi_T3) / 3;

                                $count = ($value->panjang * $L * $average_tebal * $value->berat_jenis);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->titik_core }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $value->t2_1 }}</td>
                                    <td class="text-center">{{ $value->t2_2 }}</td>
                                    <td class="text-center">{{ $value->t2_3 }}</td>
                                    <td class="text-center">{{ $T2 }}</td>
                                    <td class="text-center">{{ $value->t3_1 }}</td>
                                    <td class="text-center">{{ $value->t3_2 }}</td>
                                    <td class="text-center">{{ $value->t3_3 }}</td>
                                    <td class="text-center">{{ $T3 }}</td>
                                    <td class="text-center">{{ $value->berat_jenis }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'lc')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" rowspan="2">titik core</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal core kiri</th>
                                    <th class="text-center" colspan="4">tebal core tengah</th>
                                    <th class="text-center" colspan="4">tebal core kanan</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                    <th class="text-center">T2.1 (cm)</th>
                                    <th class="text-center">T2.2 (cm)</th>
                                    <th class="text-center">T2.3 (cm)</th>
                                    <th class="text-center">Tr2 (m)</th>
                                    <th class="text-center">T3.1 (cm)</th>
                                    <th class="text-center">T3.2 (cm)</th>
                                    <th class="text-center">T3.3 (cm)</th>
                                    <th class="text-center">Tr3 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $pembagi_t2_1 = ($value->t2_1 != 0 ? 1 : 0);
                                $pembagi_t2_2 = ($value->t2_2 != 0 ? 1 : 0);
                                $pembagi_t2_3 = ($value->t2_3 != 0 ? 1 : 0);
                                $total_pembagi_t2 = ($pembagi_t2_1 + $pembagi_t2_2 + $pembagi_t2_3);

                                $pembagi_t3_1 = ($value->t3_1 != 0 ? 1 : 0);
                                $pembagi_t3_2 = ($value->t3_2 != 0 ? 1 : 0);
                                $pembagi_t3_3 = ($value->t3_3 != 0 ? 1 : 0);
                                $total_pembagi_t3 = ($pembagi_t3_1 + $pembagi_t3_2 + $pembagi_t3_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);
                                $T2 = @((($value->t2_1 + $value->t2_2 + $value->t2_3) / $total_pembagi_t2) / 100);
                                $T3 = @((($value->t3_1 + $value->t3_2 + $value->t3_3) / $total_pembagi_t3) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;
                                $conversi_T2 = (is_nan($T2)) ? 1 : $T2;
                                $conversi_T3 = (is_nan($T3)) ? 1 : $T3;

                                $average_tebal = ($conversi_T1 + $conversi_T2 + $conversi_T3) / 3;

                                $count = ($value->panjang * $L * $average_tebal);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->titik_core }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $value->t2_1 }}</td>
                                    <td class="text-center">{{ $value->t2_2 }}</td>
                                    <td class="text-center">{{ $value->t2_3 }}</td>
                                    <td class="text-center">{{ $T2 }}</td>
                                    <td class="text-center">{{ $value->t3_1 }}</td>
                                    <td class="text-center">{{ $value->t3_2 }}</td>
                                    <td class="text-center">{{ $value->t3_3 }}</td>
                                    <td class="text-center">{{ $T3 }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'rigid')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" rowspan="2">titik core</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal core kiri</th>
                                    <th class="text-center" colspan="4">tebal core tengah</th>
                                    <th class="text-center" colspan="4">tebal core kanan</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                    <th class="text-center">T2.1 (cm)</th>
                                    <th class="text-center">T2.2 (cm)</th>
                                    <th class="text-center">T2.3 (cm)</th>
                                    <th class="text-center">Tr2 (m)</th>
                                    <th class="text-center">T3.1 (cm)</th>
                                    <th class="text-center">T3.2 (cm)</th>
                                    <th class="text-center">T3.3 (cm)</th>
                                    <th class="text-center">Tr3 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $pembagi_t2_1 = ($value->t2_1 != 0 ? 1 : 0);
                                $pembagi_t2_2 = ($value->t2_2 != 0 ? 1 : 0);
                                $pembagi_t2_3 = ($value->t2_3 != 0 ? 1 : 0);
                                $total_pembagi_t2 = ($pembagi_t2_1 + $pembagi_t2_2 + $pembagi_t2_3);

                                $pembagi_t3_1 = ($value->t3_1 != 0 ? 1 : 0);
                                $pembagi_t3_2 = ($value->t3_2 != 0 ? 1 : 0);
                                $pembagi_t3_3 = ($value->t3_3 != 0 ? 1 : 0);
                                $total_pembagi_t3 = ($pembagi_t3_1 + $pembagi_t3_2 + $pembagi_t3_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);
                                $T2 = @((($value->t2_1 + $value->t2_2 + $value->t2_3) / $total_pembagi_t2) / 100);
                                $T3 = @((($value->t3_1 + $value->t3_2 + $value->t3_3) / $total_pembagi_t3) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;
                                $conversi_T2 = (is_nan($T2)) ? 1 : $T2;
                                $conversi_T3 = (is_nan($T3)) ? 1 : $T3;

                                $average_tebal = ($conversi_T1 + $conversi_T2 + $conversi_T3) / 3;

                                $count = ($value->panjang * $L * $average_tebal);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->titik_core }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $value->t2_1 }}</td>
                                    <td class="text-center">{{ $value->t2_2 }}</td>
                                    <td class="text-center">{{ $value->t2_3 }}</td>
                                    <td class="text-center">{{ $T2 }}</td>
                                    <td class="text-center">{{ $value->t3_1 }}</td>
                                    <td class="text-center">{{ $value->t3_2 }}</td>
                                    <td class="text-center">{{ $value->t3_3 }}</td>
                                    <td class="text-center">{{ $T3 }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'timbunan')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal sisi kiri</th>
                                    <th class="text-center" colspan="4">tebal sisi kanan</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                    <th class="text-center">T3.1 (cm)</th>
                                    <th class="text-center">T3.2 (cm)</th>
                                    <th class="text-center">T3.3 (cm)</th>
                                    <th class="text-center">Tr3 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $pembagi_t3_1 = ($value->t3_1 != 0 ? 1 : 0);
                                $pembagi_t3_2 = ($value->t3_2 != 0 ? 1 : 0);
                                $pembagi_t3_3 = ($value->t3_3 != 0 ? 1 : 0);
                                $total_pembagi_t3 = ($pembagi_t3_1 + $pembagi_t3_2 + $pembagi_t3_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);
                                $T3 = @((($value->t3_1 + $value->t3_2 + $value->t3_3) / $total_pembagi_t3) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;
                                $conversi_T3 = (is_nan($T3)) ? 1 : $T3;

                                $average_tebal = (($conversi_T1 + $conversi_T3) / 2);

                                $count = ($value->panjang * $L * $average_tebal);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $value->t3_1 }}</td>
                                    <td class="text-center">{{ $value->t3_2 }}</td>
                                    <td class="text-center">{{ $value->t3_3 }}</td>
                                    <td class="text-center">{{ $T3 }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'paving')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $lebar = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));

                                $count = ($value->panjang * $lebar);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $lebar }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'k_precast')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">minggu ke-</th>
                                    <th class="text-center">nama pekerjaan</th>
                                    <th class="text-center">sta</th>
                                    <th class="text-center">sisi</th>
                                    <th class="text-center">panjang</th>
                                    <th class="text-center">pengurangan</th>
                                    <th class="text-center">keterangan pengurangan</th>
                                    <th class="text-center">penambahan</th>
                                    <th class="text-center">keterangan penambahan</th>
                                    <th class="text-center">vol terpasang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang = $value->panjang;
                                $pengurangan = $value->pengurangan;
                                $penambahan = $value->penambahan;

                                $volume = ($panjang + $pengurangan + $penambahan);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->pengurangan }}</td>
                                    <td class="text-center">(L/R)</td>
                                    <td class="text-center">{{ $value->penambahan }}</td>
                                    <td class="text-center">(L/R)</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'k_cor')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" colspan="5">lebar</th>
                                    <th class="text-center" colspan="4">tebal kastin cor</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L1 (m)</th>
                                    <th class="text-center">L2 (m)</th>
                                    <th class="text-center">L3 (m)</th>
                                    <th class="text-center">L4 (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">T1.3 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $pembagi_l_3 = ($value->l_3 != 0 ? 1 : 0);
                                $pembagi_l_4 = ($value->l_4 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2 + $pembagi_l_3 + $pembagi_l_4);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $pembagi_t1_3 = ($value->t1_3 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2 + $pembagi_t1_3);

                                $L = ((($value->l_1 + $value->l_2 + $value->l_3 + $value->l_4) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2 + $value->t1_3) / $total_pembagi_t1) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;

                                $count = ($value->panjang * $L * $conversi_T1);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $value->l_3 }}</td>
                                    <td class="text-center">{{ $value->l_4 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $value->t1_3 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif ($kontrak_ruas_item->tipe === 'pas_batu')
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">nama pekerjaan</th>
                                    <th class="text-center" colspan="2">sta</th>
                                    <th class="text-center" rowspan="2">panjang</th>
                                    <th class="text-center" colspan="3">lebar</th>
                                    <th class="text-center" colspan="3">tinggi pas. batu</th>
                                    <th class="text-center" rowspan="2">keterangan</th>
                                    <th class="text-center" rowspan="2">vol terpasang</th>
                                </tr>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">L atas (m)</th>
                                    <th class="text-center">L bawah (m)</th>
                                    <th class="text-center">Lr (m)</th>
                                    <th class="text-center">T1.1 (cm)</th>
                                    <th class="text-center">T1.2 (cm)</th>
                                    <th class="text-center">Tr1 (m)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $panjang_prev = 0;
                                $panjang_next = 0;
                                @endphp

                                @foreach ($fh0 as $key => $value)

                                @php
                                $panjang_next += $value->panjang;
                                $panjang_prev = $key == 0 ? 0 : $fh0[$key - 1]->panjang + $panjang_prev;

                                $pembagi_l_1 = ($value->l_1 != 0 ? 1 : 0);
                                $pembagi_l_2 = ($value->l_2 != 0 ? 1 : 0);
                                $total_pembagi_l = ($pembagi_l_1 + $pembagi_l_2);

                                $pembagi_t1_1 = ($value->t1_1 != 0 ? 1 : 0);
                                $pembagi_t1_2 = ($value->t1_2 != 0 ? 1 : 0);
                                $total_pembagi_t1 = ($pembagi_t1_1 + $pembagi_t1_2);

                                $L = ((($value->l_1 + $value->l_2) / $total_pembagi_l));
                                $T1 = @((($value->t1_1 + $value->t1_2) / $total_pembagi_t1) / 100);

                                $conversi_T1 = (is_nan($T1)) ? 1 : $T1;

                                $count = ($value->panjang * $L * $conversi_T1);

                                $volume = round($count, 2);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $value->nma_pekerjaan }}</td>
                                    <td class="text-center">{{ $panjang_prev }}</td>
                                    <td class="text-center">{{ $panjang_next }}</td>
                                    <td class="text-center">{{ $value->panjang }}</td>
                                    <td class="text-center">{{ $value->l_1 }}</td>
                                    <td class="text-center">{{ $value->l_2 }}</td>
                                    <td class="text-center">{{ $L }}</td>
                                    <td class="text-center">{{ $value->t1_1 }}</td>
                                    <td class="text-center">{{ $value->t1_2 }}</td>
                                    <td class="text-center">{{ $T1 }}</td>
                                    <td class="text-center">(L/R)</td>
                                    <td class="text-center">{{ $volume }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
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