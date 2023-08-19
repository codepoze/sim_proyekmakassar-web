<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <!-- begin:: brand -->
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <span class="brand-logo">
                        <img src="{{ asset_admin('images/logo/logo.png') }}" alt="">
                    </span>
                    <h2 class="brand-text">MANPRO</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            <!-- end:: brand -->
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header">
                <span>Dashboard</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i><span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>
            @if (session()->get('roles') === 'admin')
            <li class="navigation-header">
                <span>Manajemen User</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ (Request::segment(2) === 'menu') ? 'open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="list"></i><span class="menu-title text-truncate">Menu</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center {{ (Request::segment(3) === 'head') ? 'active' : '' }}" href="{{ route('admin.menu.head') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate">Menu</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center {{ (Request::segment(3) === 'body') ? 'active' : '' }}" href="{{ route('admin.menu.body') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate">Sub Menu</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center {{ (Request::segment(3) === 'action') ? 'active' : '' }}" href="{{ route('admin.menu.action') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate">Menu Action</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ (Request::segment(2) === 'role') ? 'open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="list"></i><span class="menu-title text-truncate">Role</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center {{ (Request::segment(2) === 'role' && Request::segment(3) === null ) ? 'active' : '' }}" href="{{ route('admin.role.role') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate">Role</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center {{ (Request::segment(3) === 'menu') ? 'active' : '' }}" href="{{ route('admin.role.menu') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate">Role Menu</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ (Request::segment(2) === 'users') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.users') }}">
                    <i data-feather="list"></i><span class="menu-title text-truncate">Users</span>
                </a>
            </li>
            @endif
            <li class="navigation-header">
                <span>Akses</span><i data-feather="more-horizontal"></i>
            </li>
            <!-- begin:: menu dinamis -->
            @include('_partials.menu')
            <!-- begin:: menu dinamis -->
        </ul>
    </div>
</div>