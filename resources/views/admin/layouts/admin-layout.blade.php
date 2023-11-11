<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Dinas Pekerjaan Umum Makassar">
    <meta name="keywords" content="Dinas Pekerjaan Umum Makassar">
    <meta name="author" content="Dinas Pekerjaan Umum Makassar">
    <title>{{ config('app.name') }} | {{ $title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="{{ asset_admin('images/icon/apple-touch-icon.png') }}" sizes="180x180" />
    <link rel="shortcut icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.png') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.png') }}" type="image/x-icon" sizes="16x16" />
    <!-- end:: icon -->

    <!-- begin:: css local -->
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/extensions/sweetalert2.min.css') }}">
    @stack('css')
    <!-- end:: css local -->

    <!-- begin:: css global -->
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/plugins/forms/form-validation.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/plugins/forms/pickers/form-pickadate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/my_css.css') }}">
    <!-- end:: css global -->

    <script src="{{ asset_admin('vendors/js/vendors.min.js') }}"></script>
</head>

<body class="vertical-layout vertical-menu-modern navbar-sticky footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- begin:: navbar -->
    <x-admin-navbar />
    <!-- end:: navbar -->

    <!-- begin:: sidebar -->
    <x-admin-sidebar />
    <!-- end:: sidebar -->

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <!-- begin:: content header -->
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{ $title }}</h2>
                            <div class="breadcrumb-wrapper">
                                {!! $breadcrumb !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end:: content header -->
            <!-- begin:: content body -->
            <div class="content-body">
                {{ $slot }}
            </div>
            <!-- end:: content body -->
        </div>
    </div>

    <!-- begin:: footer -->
    <x-admin-footer />
    <!-- end:: footer -->

    <!-- begin:: js local -->
    @stack('js')
    <!-- end:: js local -->

    <!-- begin:: js global -->
    <script type="text/javascript" src="{{ asset_admin('js/core/app-menu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('js/core/app.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/my_fun.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

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