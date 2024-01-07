<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/pickers/pickadate/pickadate.css') }}">

    <style>
        .picker {
            z-index: 9999 !important;
            position: relative !important;
        }
    </style>
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
                        <form id="form-add-upd" class="form form-horizontal mt-2" action="{{ route_role('admin.kontrak.save') }}" method="POST">
                            <!-- begin:: id -->
                            <input type="hidden" name="id_paket" id="id_paket" value="{{ $id_paket }}" />
                            <input type="hidden" name="id_kontrak" id="id_kontrak" />
                            <!-- end:: id -->

                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="id_penyedia">Penyedia&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <select class="form-select select2" id="id_penyedia" name="id_penyedia">
                                        <option value=""></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="pj_penyedia">PJ Penyedia&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="pj_penyedia" name="pj_penyedia" placeholder="Masukkan nama penanggung jawab penyedia" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="id_konsultan">Konsultan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <select class="form-select select2" id="id_konsultan" name="id_konsultan">
                                        <option value=""></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="pj_konsultan">PJ Konsultan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="pj_konsultan" name="pj_konsultan" placeholder="Masukkan nama penanggung jawab konsultan" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="id_teknislap">Kord Teknis Lapangan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <select class="form-select select2" id="id_teknislap" name="id_teknislap">
                                        <option value=""></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_ba_mc0">Nomor BA. MC NOL&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_ba_mc0" name="no_ba_mc0" placeholder="Masukkan ba mc0" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_ba_mc0">Tanggal BA. MC NOL&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_ba_mc0" name="tgl_ba_mc0" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_ba_kntb">Nomor BA. NEGO&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_ba_kntb" name="no_ba_kntb" placeholder="Masukkan ba kntb" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_ba_kntb">Tanggal BA. NEGO&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_ba_kntb" name="tgl_ba_kntb" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_sppbj">Nomor SPPBJ&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_sppbj" name="no_sppbj" placeholder="Masukkan sppbj" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_sppbj">Tanggal SPPBJ&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_sppbj" name="tgl_sppbj" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_ba_rp2k">Nomor BA. Persiapan Penandatanganan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_ba_rp2k" name="no_ba_rp2k" placeholder="Masukkan ba rp2k" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_ba_rp2k">Tanggal BA. Persiapan Penandatanganan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_ba_rp2k" name="tgl_ba_rp2k" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_sp">Nomor Surat Pesanan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_sp" name="no_sp" placeholder="Masukkan surat pesanan" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_sp">Tanggal Surat Pesanan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_sp" name="tgl_sp" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_kontrak">Nomor Kontrak / SPK&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_kontrak" name="no_kontrak" placeholder="Masukkan nomor kontrak" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_kontrak">Tanggal Kontrak / SPK&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_kontrak" name="tgl_kontrak" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="waktu_kontrak">Schedule&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control form-control-sm pickadate" id="tgl_kontrak_mulai" name="tgl_kontrak_mulai" placeholder="18 June, 2020" />
                                            <div id="tgl_kontrak_mulai-container"></div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control form-control-sm pickadate" id="tgl_kontrak_akhir" name="tgl_kontrak_akhir" placeholder="18 June, 2020" />
                                            <div id="tgl_kontrak_akhir-container"></div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" id="add-rencana" class="btn btn-sm btn-relief-success">
                                                <span>Rencana</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_spmk">Nomor SPMK&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_spmk" name="no_spmk" placeholder="Masukkan nomor spmk" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_spmk">Tanggal SPMK&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_spmk" name="tgl_spmk" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_ba_plp">Nomor BA. Penyerahan Lokasi Pekerjaan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="no_ba_plp" name="no_ba_plp" placeholder="Masukkan no plp" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl_ba_plp">Tanggal BA. Penyerahan Lokasi Pekerjaan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="tgl_ba_plp" name="tgl_ba_plp" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="nil_kontrak">Nilai Kontrak&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="nil_kontrak" name="nil_kontrak" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan nilai kontrak" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="nil_pagu">Nilai Pagu&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="nil_pagu" name="nil_pagu" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan nilai pagu" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="thn_anggaran">Tahun Anggaran&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="thn_anggaran" name="thn_anggaran" placeholder="Masukkan tahun anggaran" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="pembuat_kontrak">Pembuat Kontrak&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="pembuat_kontrak" name="pembuat_kontrak" placeholder="Masukkan pembuat kontrak" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="id_fund">Sumber Dana&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <select class="form-select select2" id="id_fund" name="id_fund">
                                        <option value=""></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="kd_rekening">Kode Rekening&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="text" class="form-control form-control-sm" id="kd_rekening" name="kd_rekening" placeholder="Masukkan kode rekening" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="foto_lokasi">Foto Lokasi&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="file" class="form-control form-control-sm" id="foto_lokasi" name="foto_lokasi" />
                                    <p><small class="text-muted">File dengan tipe (*.png,*.jpg,*.jpeg).</small></p>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="doc_kontrak">Doc Kontrak&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="file" class="form-control form-control-sm" id="doc_kontrak" name="doc_kontrak" />
                                    <p><small class="text-muted">File dengan tipe (*.pdf).</small></p>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="laporan">Laporan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="file" class="form-control form-control-sm" id="laporan" name="laporan" />
                                    <p><small class="text-muted">File dengan tipe (*.pdf).</small></p>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <!-- begin:: untuk ruas -->
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Ruas&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row my-1 ruas">
                                        <div class="field-input col-5">
                                            <input type="file" id="foto_0" name="foto[]" class="form-control form-control-sm" />
                                            <p><small class="text-muted">File dengan tipe (*.png,*.jpg,*.jpeg).</small></p>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="field-input col-5">
                                            <input type="text" id="nama_ruas_0" name="nama_ruas[]" class="form-control form-control-sm" placeholder="Masukkan nama ruas" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-2 justify-content-center">
                                            <button type="button" id="add" class="btn btn-sm btn-relief-success">
                                                <span>Tambah</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: untuk ruas -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ route_role('admin.paket.det', ['id' => my_encrypt($id_paket)]) }}" class="btn btn-sm btn-relief-danger">
                                        <i data-feather="x"></i>&nbsp;<span>Batal</span>
                                    </a>&nbsp;
                                    <button type="submit" id="save" class="btn btn-sm btn-relief-primary">
                                        <i data-feather="save"></i>&nbsp;<span>Simpan</span>
                                    </button>
                                </div>
                            </div>

                            <!-- begin:: modal rencana -->
                            <div id="modal-kontrak-rencana" class="modal fade text-start" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Rencana Mingguan</h4>
                                        </div>
                                        <div class="modal-body">
                                            <!-- begin:: untuk loading -->
                                            <div id="form-loading"></div>
                                            <!-- end:: untuk loading -->
                                            <div id="form-show" class="html-kontrak-rencana"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-relief-success" data-bs-dismiss="modal">
                                                <i data-feather="save"></i>&nbsp;<span>Simpan</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: modal rencana -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    <script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script>
        $('#tgl_kontrak_mulai').pickadate({
            container: '#tgl_kontrak_mulai-container',
            format: 'dd mmmm, yyyy',
            formatSubmit: 'yyyy-mm-dd',
            monthsFull: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            weekdaysShort: ["Mn", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
            hiddenName: true,
            clear: 'Hapus',
            close: 'Tutup',
            today: 'Hari Ini',
            selectYears: true,
            selectMonths: true,
            max: 365,
            closeOnSelect: true,
            closeOnClear: true,
            onSet: function(context) {
                if (context.select) {
                    this.close();
                }
            },
        });

        $('#tgl_kontrak_akhir').pickadate({
            container: '#tgl_kontrak_akhir-container',
            format: 'dd mmmm, yyyy',
            formatSubmit: 'yyyy-mm-dd',
            monthsFull: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            weekdaysShort: ["Mn", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
            hiddenName: true,
            clear: 'Hapus',
            close: 'Tutup',
            today: 'Hari Ini',
            selectYears: true,
            selectMonths: true,
            max: 365,
            closeOnSelect: true,
            closeOnClear: true,
            onSet: function(context) {
                if (context.select) {
                    this.close();
                }
            },
        });

        let untukSimpanData = function() {
            $(document).on('submit', '#form-add-upd', function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#form-add-upd').find('input, textarea, select').removeClass('is-valid');
                        $('#form-add-upd').find('input, textarea, select').removeClass('is-invalid');

                        $('#save').attr('disabled', 'disabled');
                        $('#save').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                        feather.replace();
                    },
                    success: function(response) {
                        if (response.type === 'success') {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            }).then((value) => {
                                location.href = response.url;
                            });
                        } else {
                            let checkBobotRencana = [];

                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    }
                                }

                                if ($("input[name='bobot_rencana[]']").length > 0) {
                                    for (let i = 0; i < $("input[name='bobot_rencana[]']").length; i++) {
                                        if (key === 'bobot_rencana_' + i) {
                                            checkBobotRencana.push(key);
                                        }
                                    }
                                }
                            });

                            if ($("input[name='bobot_rencana[]']").length > 0 && checkBobotRencana.length > 0) {
                                $('#modal-kontrak-rencana').modal('show');
                            }

                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            });
                        }

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i data-feather="save"></i>&nbsp;<span>Simpan</span>');
                        feather.replace();
                    }
                });
            });

            $(document).on('keyup', '#form-add-upd input', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('keyup', '#form-add-upd textarea', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('change', '#form-add-upd select', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('change', '#form-add-upd input[type=file]', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukKontrakRencana = function() {
            $(document).on("click", "#add-rencana", function() {
                let tglKontraMulai = $('#tgl_kontrak_mulai').val();
                let tglKontrakAkhir = $('#tgl_kontrak_akhir').val();

                if (tglKontraMulai == '' || tglKontrakAkhir == '') {
                    alert('Silahkan isi schedule!');
                } else {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route_role('admin.kontrak.rencana') }}",
                        dataType: 'html',
                        data: {
                            tgl_kontrak_mulai: tglKontraMulai,
                            tgl_kontrak_akhir: tglKontrakAkhir
                        },
                        beforeSend: function() {
                            $('#form-loading').html(`<div class="center"><div class="loader"></div></div>`);
                            $('#form-show').attr('style', 'display: none');
                        },
                        success: function(response) {
                            $('#modal-kontrak-rencana .html-kontrak-rencana').html(response);

                            $('#form-loading').empty();
                            $('#form-show').removeAttr('style');
                        }
                    });

                    $('#modal-kontrak-rencana').modal('show');
                }
            });
        }();

        let untukPaketRuas = function() {
            var i = 0;

            $(document).on("click", "#add", function() {
                i++;

                var html = `
                <div class="row my-1 ruas-ini">
                    <div class="field-input col-5">
                        <input type="file" id="foto_` + i + `" name="foto[]" class="form-control form-control-sm" />
                        <p><small class="text-muted">File dengan tipe (*.png,*.jpg,*.jpeg).</small></p>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="field-input col-5">
                        <input type="text" id="nama_ruas_` + i + `" name="nama_ruas[]" class="form-control form-control-sm" placeholder="Masukkan nama ruas" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-2 justify-content-center">
                        <button type="button" id="del" class="btn btn-sm btn-relief-danger">
                            <span>Hapus</span>
                        </button>
                    </div>
                </div>
            `;

                $(".ruas").after(html);
            });

            $(document).on("click", "#del", function() {
                i--;

                var ini = $(this);
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data Sukses di Hapus!',
                    icon: 'success',
                    confirmButtonText: 'Ok!',
                    customClass: {
                        confirmButton: `btn btn-sm btn-success`,
                    },
                    buttonsStyling: false,
                }).then((value) => {
                    ini.parents(".ruas-ini").remove();
                });
            });
        }();

        let untukSelectPenyedia = function() {
            $.get("{{ route_role('admin.penyedia.get_all') }}", function(response) {
                $("#id_penyedia").select2({
                    placeholder: "Pilih penyedia",
                    width: '100%',
                    allowClear: true,
                    containerCssClass: 'select-sm',
                    data: response,
                });
            }, 'json');
        }();

        let untukSelectKonsultan = function() {
            $.get("{{ route_role('admin.konsultan.get_all') }}", function(response) {
                $("#id_konsultan").select2({
                    placeholder: "Pilih konsultan",
                    width: '100%',
                    allowClear: true,
                    containerCssClass: 'select-sm',
                    data: response,
                });
            }, 'json');
        }();

        let untukSelectTeknisLapangan = function() {
            $.get("{{ route_role('admin.teknislap.kordinator.get_all') }}", function(response) {
                $("#id_teknislap").select2({
                    placeholder: "Pilih Kordinator Teknis Lapangan",
                    width: '100%',
                    allowClear: true,
                    containerCssClass: 'select-sm',
                    data: response,
                });
            }, 'json');
        }();

        let untukSelectSumberDana = function() {
            $.get("{{ route_role('admin.fund.get_all') }}", function(response) {
                $("#id_fund").select2({
                    placeholder: "Pilih sumber dana",
                    width: '100%',
                    allowClear: true,
                    containerCssClass: 'select-sm',
                    data: response,
                });
            }, 'json');
        }();
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>