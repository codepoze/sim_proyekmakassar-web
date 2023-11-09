<title>Rencana Anggaran Biaya</title>

<!-- CSS -->
<style media="screen">
    .kop_surat {
        padding-top: 4mm;
        padding-right: 4mm;
        padding-left: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
    }

    .jenis_surat_head {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .jenis_surat {
        text-decoration: underline;
        text-transform: uppercase;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    h3 {
        font-family: times;
    }

    p {
        margin: 0;
    }

    .page_break {
        page-break-before: always;
    }

    #tabel-pengembalian td {
        vertical-align: top;
    }

    .tabel-anak tr td {
        border: none;
    }
</style>
<!-- CSS -->

<body>
    <div class="kop_surat">
        <table align="center">
            <td align="center">
                <h3>RENCANA ANGGARAN BIAYA / PERUBAHAN HARGA KONTRAK</h3>
            </td>
        </table>
        <hr style="margin: 0;">
    </div>
    <br />
    <br />
    <table>
        <tr>
            <td width="150">Pekerjaan</td>
            <td>:</td>
            <td>{{ $paket->nma_paket }}</td>
        </tr>
        <tr>
            <td>Tahun Anggaran</td>
            <td>:</td>
            <td>{{ $paket->thn_anggaran }}</td>
        </tr>
        <tr>
            <td>Kontraktor Pelaksana</td>
            <td>:</td>
            <td>{{ $paket->toPenyedia->nama }}</td>
        </tr>
        <tr>
            <td>Konsultan Pengawas</td>
            <td>:</td>
            <td>{{ $paket->toKonsultan->nama }}</td>
        </tr>
    </table>

    <ul type="1">
        @foreach ($paket->toPaketRuas as $key => $row)
        <li>
            <b>{{ $row->nama }}</b>
        </li>
        <table align="center" border="1">
            <thead>
                <tr align="center">
                    <td rowspan="2">NO</td>
                    <td rowspan="2">URAIAN RUAS PEKERJAAN</td>
                    <td colspan="7">KONTRAK</td>
                </tr>
                <tr align="center">
                    <td>SATUAN</td>
                    <td>VOLUME</td>
                    <td>HARGA HPS</td>
                    <td>HARGA KONTRAK</td>
                    <td>JUMLAH HARGA HPS</td>
                    <td>JUMLAH HARGA KONTRAK</td>
                    <td>BOBOT (%)</td>
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

                <tr align="center">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->toSatuan->nama }}</td>
                    <td>{{ $value->volume }}</td>
                    <td>{{ rupiah($value->harga_hps) }}</td>
                    <td>{{ rupiah($value->harga_kontrak) }}</td>
                    <td>{{ rupiah($jumlah_hps) }}</td>
                    <td>{{ rupiah($jumlah_kontrak) }}</td>
                    <td>{{ number_format($jumlah_bobot, 2) }}</td>
                </tr>

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Total Nilai Per Ruas</th>
                    <th>{{ rupiah($total_hps) }}</th>
                    <th>{{ rupiah($total_kontrak) }}</th>
                    <th>{{ number_format($bobot, 2) }}</th>
                </tr>
            </tfoot>
        </table>
        <br />
        @endforeach
    </ul>
</body>