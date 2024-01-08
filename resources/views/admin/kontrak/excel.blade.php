<table>
    <thead>
        <tr>
            <th align="center" valign="middle" rowspan="2"><b>NAMA PEKERJAAN</b></th>
            <th align="center" valign="middle" rowspan="2"><b>KODE RUP</b></th>
            <th align="center" valign="middle" rowspan="2"><b>NILAI PAGU (Rp.)</b></th>
            <th align="center" valign="middle" rowspan="2"><b>NAMA PENYEDIA</b></th>
            <th align="center" valign="middle" rowspan="2"><b>NAMA DIREKTUR</b></th>
            <th align="center" valign="middle" rowspan="2"><b>ALAMAT PERUSAHAAN</b></th>
            <th align="center" colspan="2"><b>BA. MC NOL</b></th>
            <th align="center" colspan="2"><b>BA. NEGO</b></th>
            <th align="center" colspan="2"><b>SPPBJ</b></th>
            <th align="center" colspan="2"><b>BA. PERSIAPAN PENANDATANGANAN</b></th>
            <th align="center" colspan="2"><b>SURAT PESANAN</b></th>
            <th align="center" colspan="3"><b>SURAT PERJANJIAN / SPK</b></th>
            <th align="center" colspan="2"><b>SPMK</b></th>
            <th align="center" colspan="3"><b>JANGKA WAKTU PELAKSANAAN</b></th>
            <th align="center" colspan="2"><b>BA. PENYERAHAN LOKASI PEKERJAAN</b></th>
            <th align="center" valign="middle" rowspan="2"><b>PPTK</b></th>
            <th align="center" valign="middle" rowspan="2"><b>PEMBUAT KONTRAK</b></th>
        </tr>
        <tr>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
            <th align="center"><b>NILAI KONTRAK (Rp.)</b></th>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
            <th align="center"><b>JANGKA WAKTU</b></th>
            <th align="center"><b>MULAI</b></th>
            <th align="center"><b>SELESAI</b></th>
            <th align="center"><b>NOMOR</b></th>
            <th align="center"><b>TANGGAL</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $kontrak->toPaket->toKegiatan->nama }} {{ $kontrak->toPaket->nama }}</td>
            <td>{{ $kontrak->kd_rekening }}</td>
            <td>{{ rupiah($kontrak->nil_pagu) }}</td>
            <td>{{ $kontrak->toPenyedia->nama }}</td>
            <td>{{ $kontrak->pj_penyedia }}</td>
            <td>{{ $kontrak->toPenyedia->alamat }}</td>
            <td>{{ $kontrak->no_ba_mc0 }}</td>
            <td>{{ tgl_indo($kontrak->tgl_ba_mc0) }}</td>
            <td>{{ $kontrak->no_ba_kntb }}</td>
            <td>{{ tgl_indo($kontrak->tgl_ba_kntb) }}</td>
            <td>{{ $kontrak->no_sppbj }}</td>
            <td>{{ tgl_indo($kontrak->tgl_sppbj) }}</td>
            <td>{{ $kontrak->no_ba_rp2k }}</td>
            <td>{{ tgl_indo($kontrak->tgl_ba_rp2k) }}</td>
            <td>{{ $kontrak->no_sp }}</td>
            <td>{{ tgl_indo($kontrak->tgl_sp) }}</td>
            <td>{{ $kontrak->no_kontrak }}</td>
            <td>{{ tgl_indo($kontrak->tgl_kontrak) }}</td>
            <td>{{ rupiah($kontrak->nil_kontrak) }}</td>
            <td>{{ $kontrak->no_spmk }}</td>
            <td>{{ tgl_indo($kontrak->tgl_spmk) }}</td>
            <td>{{ count_day_excluding_weekends_holiday( $kontrak->tgl_kontrak_akhir, $kontrak->tgl_kontrak_mulai) . ' HK'; }}</td>
            <td>{{ tgl_indo($kontrak->tgl_kontrak_mulai) }}</td>
            <td>{{ tgl_indo($kontrak->tgl_kontrak_akhir) }}</td>
            <td>{{ $kontrak->no_ba_plp }}</td>
            <td>{{ tgl_indo($kontrak->tgl_ba_plp) }}</td>
            <td>{{ $kontrak->toPaket->toKegiatan->toPptk->toUser->nama }}</td>
            <td>{{ $kontrak->pembuat_kontrak }}</td>
        </tr>
    </tbody>
</table>