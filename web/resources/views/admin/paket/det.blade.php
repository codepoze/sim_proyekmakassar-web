<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
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
                    <div class="dt-action-buttons text-end">
                        <div class="dt-buttons d-inline-flex">
                            <a href="{{ route('admin.paket.print', my_encrypt($paket->id_paket)) }}" target="_blank" class="btn btn-action btn-sm btn-relief-info"><i data-feather="printer"></i>&nbsp;Cetak</a>&nbsp;
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="form form-horizontal mt-2">
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Penyedia&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->toPenyedia->nama }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">PJ Penyedia&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->pj_penyedia }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Konsultan&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->toKonsultan->nama }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">PJ Konsultan&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->pj_konsultan }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Kord Teknis Lapangan&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->toTeknislap->toUser->nama }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Nama Paket&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->nma_paket }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Nomor SPMK&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->no_spmk }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Nomor Kontrak&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->no_kontrak }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Waktu Kontrak&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ count_day_excluding_weekends_holiday( $paket->tgl_kontrak_akhir, $paket->tgl_kontrak_mulai) . ' Hari'; }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Tahun Anggaran&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->thn_anggaran }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Nilai Pagu&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ rupiah($paket->nil_pagu) }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Nilai Kontrak&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ rupiah($nil_kontrak) }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Kode Rekening&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->kd_rekening }}" />
                                    </div>
                                </div>
                                <div class="field-input mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Sumber Dana&nbsp;*</label>
                                    </div>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control-plaintext" value="{{ $paket->sumber_dana }}" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="mt-2">
                                <img src="{{ asset_upload('picture/'.$paket->foto_lokasi)  }}" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="{{ $paket->nma_paket }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($paket->toPaketRuas as $key => $row)
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
                            $total_hps = $row->toPaketRuasItem->sum(function ($item) {
                            return $item->volume * $item->harga_hps;
                            });

                            $total_kontrak = $row->toPaketRuasItem->sum(function ($item) {
                            return $item->volume * $item->harga_kontrak;
                            });

                            $bobot = 0;
                            @endphp

                            @foreach ($row->toPaketRuasItem as $key => $value)

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
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
@endsection
<!-- end:: js local -->