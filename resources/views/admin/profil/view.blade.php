<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section id="page-account-settings">
        <div class="row">
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column nav-left">
                    <li class="nav-item">
                        <a class="nav-link active" id="foto-tab" data-bs-toggle="pill" href="#foto" aria-expanded="true">
                            <i data-feather="user" class="font-medium-3 me-1"></i>
                            <span class="fw-bold">Foto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="akun-tab" data-bs-toggle="pill" href="#akun" aria-expanded="false">
                            <i data-feather="info" class="font-medium-3 me-1"></i>
                            <span class="fw-bold">Akun</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keamanan-tab" data-bs-toggle="pill" href="#keamanan" aria-expanded="false">
                            <i data-feather="lock" class="font-medium-3 me-1"></i>
                            <span class="fw-bold">Keamanan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- begin:: foto -->
                            <div role="tabpanel" class="tab-pane active" id="foto" aria-labelledby="foto-tab" aria-expanded="true">
                                <form id="form-foto" action="{{ route('admin.profil.save_picture', session()->get('roles')) }}" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6 align-self-center">
                                            <input type="file" class="form-control" name="i_foto" id="i_foto" />
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="{{ ($user->foto === null) ? '//placehold.co/150' : asset_upload('picture/'.$user->foto) }}" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="Profil" width="200" />
                                            <br>
                                            <div class="text-center">
                                                <button type="submit" id="save-foto" class="btn btn-sm btn-relief-success mt-1 me-1"><i data-feather="save"></i>&nbsp;<span>Simpan</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end:: foto -->
                            <!-- begin:: akun -->
                            <div class="tab-pane fade" id="akun" role="tabpanel" aria-labelledby="akun-tab" aria-expanded="false">
                                <form id="form-akun" action="{{ route('admin.profil.save_account', session()->get('roles')) }}" method="POST">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="field-input mb-1">
                                                <label class="form-label" for="i_nama">Nama&nbsp;*</label>
                                                <input type="text" class="form-control" name="i_nama" id="i_nama" value="{{ $user->nama }}" placeholder="Masukkan nama Anda" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="field-input mb-1">
                                                <label class="form-label" for="i_email">E-Mail&nbsp;*</label>
                                                <input type="text" class="form-control" name="i_email" id="i_email" value="{{ $user->email }}" placeholder="Masukkan e-mail Anda" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="field-input mb-1">
                                                <label class="form-label" for="i_username">Username&nbsp;*</label>
                                                <input type="text" class="form-control" name="i_username" id="i_username" value="{{ $user->username }}" placeholder="Masukkan username Anda" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" id="save-akun" class="btn btn-sm btn-relief-success mt-1 me-1"><i data-feather="save"></i>&nbsp;<span>Simpan</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end:: akun -->
                            <!-- begin:: password -->
                            <div class="tab-pane fade" id="keamanan" role="tabpanel" aria-labelledby="keamanan-tab" aria-expanded="false">
                                <form id="form-keamanan" action="{{ route('admin.profil.save_security', session()->get('roles')) }}" method="POST">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="field-input mb-1">
                                                <label class="form-label" for="i_pass_lama">Password Lama&nbsp;*</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input type="password" class="form-control" name="i_pass_lama" id="i_pass_lama" placeholder="Masukkan password lama Anda" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="field-input mb-1">
                                                <label class="form-label" for="i_pass_baru">Password Baru&nbsp;*</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input type="password" class="form-control" name="i_pass_baru" id="i_pass_baru" placeholder="Masukkan password baru Anda" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="field-input mb-1">
                                                <label class="form-label" for="i_pass_baru_lagi">Ulangi Password Baru&nbsp;*</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input type="password" class="form-control" name="i_pass_baru_lagi" id="i_pass_baru_lagi" placeholder="Masukkan kembali password Anda" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" id="save-keamanan" class="btn btn-sm btn-relief-success mt-1 me-1"><i data-feather="save"></i>&nbsp;<span>Simpan</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end:: password -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    <script>
        let untukSimpanFoto = function() {
            $(document).on('submit', '#form-foto', function(e) {
                e.preventDefault();

                $('#i_foto').attr('required', 'required');

                if ($('#form-foto').parsley().isValid() == true) {
                    $.ajax({
                        method: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: 'json',
                        beforeSend: function() {
                            $('#save-foto').attr('disabled', 'disabled');
                            $('#save-foto').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                            feather.replace();
                        },
                        success: function(response) {
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
                                location.reload();
                            });
                        }
                    });
                }
            });
        }();

        let untukSimpanAkun = function() {
            $(document).on('submit', '#form-akun', function(e) {
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
                        $('#save-akun').attr('disabled', 'disabled');
                        $('#save-akun').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
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
                                location.reload();
                            });
                        } else {
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
                            });

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

                        $('#save-akun').removeAttr('disabled');
                        $('#save-akun').html('<i data-feather="save"></i>&nbsp;<span>Simpan</span>');
                        feather.replace();
                    }
                });

                $(document).on('keyup', '#form-akun input', function(e) {
                    e.preventDefault();

                    if ($(this).val() == '') {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }
                });
            });
        }();

        let untukSimpanKeamanan = function() {
            $(document).on('submit', '#form-keamanan', function(e) {
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
                        $('#save-keamanan').attr('disabled', 'disabled');
                        $('#save-keamanan').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
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
                                location.reload();
                            });
                        } else {
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
                            });

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

                        $('#save-keamanan').removeAttr('disabled');
                        $('#save-keamanan').html('<i data-feather="save"></i>&nbsp;<span>Simpan</span>');
                        feather.replace();
                    }
                });

                $(document).on('keyup', '#form-keamanan input', function(e) {
                    e.preventDefault();

                    if ($(this).val() == '') {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }
                });
            });
        }();

        let untukChangePicture = function() {
            $("#i_foto").change(function() {
                cekLokasiFoto(this);
            });
        }();

        function cekLokasiFoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function(e) {
                    $('#lihat-gambar').attr('src', e.target.result);
                };
            }
        }
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>