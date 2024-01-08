<table>
    <thead>
        <tr>
            <th rowspan="2">NAMA PEKERJAAN</th>
            <th rowspan="2">KODE RUP</th>
            <th rowspan="2">NILAI PAGU (Rp.)</th>
            <th rowspan="2">NAMA PENYEDIA</th>
            <th rowspan="2">NAMA DIREKTUR</th>
            <th rowspan="2">ALAMAT PERUSAHAAN</th>
            <th colspan="2">BA. MC NOL</th>
            <th colspan="2">BA. NEGO</th>
            <th colspan="2">SPPBJ</th>
            <th colspan="2">BA. PERSIAPAN PENANDATANGANAN</th>
            <th colspan="2">SURAT PESANAN</th>
            <th colspan="3">SURAT PERJANJIAN / SPK</th>
        </tr>
        <tr>
            <th>NOMOR</th>
            <th>TANGGAL</th>
            <th>NOMOR</th>
            <th>TANGGAL</th>
            <th>NOMOR</th>
            <th>TANGGAL</th>
            <th>NOMOR</th>
            <th>TANGGAL</th>
            <th>NOMOR</th>
            <th>TANGGAL</th>
            <th>NOMOR</th>
            <th>TANGGAL</th>
            <th>NILAI KONTRAK</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $kontrak->toPaket->nama }}</td>
            <td>{{ $kontrak->kd_rekening }}</td>
        </tr>
    </tbody>
</table>