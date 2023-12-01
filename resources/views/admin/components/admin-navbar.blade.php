<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow p-0 fixed-top">
    <div class="navbar-container d-flex content">
        <!-- begin:: left -->
        <div class="bookmark-wrapper d-flex align-items-center">
        </div>
        <!-- end:: left -->
        <!-- begin:: right -->
        <ul class="nav navbar-nav align-items-center ms-auto">
            <!-- begin:: profil & settings -->
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ session()->get('nama') }}</span>
                        <span class="user-status">{{ ucfirst(session()->get('roles')) }}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ (session()->get('foto') === null) ? '//placehold.co/150' : asset_upload('picture/'.session()->get('foto')) }}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('admin.profil', session()->get('roles')) }}">
                        <i class="me-50" data-feather="user"></i>Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="page-account-settings.html">
                        <i class="me-50" data-feather="settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                        <i class="me-50" data-feather="power"></i> Logout
                    </a>
                </div>
            </li>
            <!-- begin:: profil & settings -->
        </ul>
        <!-- end:: right -->
    </div>
</nav>