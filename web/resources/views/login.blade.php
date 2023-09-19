<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Dinas Pekerjaan Umum Makassar">
    <meta name="keywords" content="Dinas Pekerjaan Umum Makassar">
    <meta name="author" content="Dinas Pekerjaan Umum Makassar">
    <title>MANPRO | Dinas Pekerjaan Umum Makassar</title>

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="{{ asset_admin('images/ico/apple-icon-120.png') }}" sizes="180x180" />
    <link rel="shortcut icon" href="{{ asset_admin('images/ico/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.png') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.png') }}" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <!-- end:: icon -->

    <!-- begin:: css global -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/pages/page-auth.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/style.css') }}">
    <!-- end:: css global -->

</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- begin:: content -->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- begin:: left text -->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5" style="background-color: #FFD507;">
                            <div class="w-50 d-lg-flex align-items-center justify-content-center px-1">
                                <img class="img-fluid" src="{{ asset_admin('images/logo/pu.png') }}" alt="Login" />
                            </div>
                            <h1 class="fw-bolder" style="color: black;">
                                DINAS PEKERJAAN UMUM <br /> KOTA MAKASSAR
                            </h1>
                        </div>
                        <!-- end:: left text -->

                        <!-- begin:: login -->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Selamat Datang di MANPRO</h2>

                                @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="alert-body d-flex align-items-center">
                                        <i data-feather="info" class="me-50"></i>
                                        {!! Session::get('error') !!}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                @endif

                                <form class="auth-login-form mt-2" action="{{ route('auth.check') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="mb-1">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="Username" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember-me" type="checkbox" />
                                            <label class="form-check-label" for="remember-me"> Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn w-100" style="background-color: #FFD507;">Sign in</button>
                                </form>
                            </div>
                        </div>
                        <!-- end:: login -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: content -->

    <!-- begin:: js global -->
    <script src="{{ asset_admin('vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset_admin('js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset_admin('js/core/app.min.js') }}"></script>
    <script src="{{ asset_admin('js/scripts/pages/page-auth-login.js') }}"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <!-- end:: js global -->
</body>

</html>