<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Phronesis</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i>
    </button>

    <!-- App Search-->
    <form class="app-search d-none d-lg-block ms-3">
        <div class="position-relative">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="ri-search-line"></span>
        </div>
    </form>
    <!-- Navbar Notification-->



    <!-- Navbar-->
    <div class="ms-auto">
        <div class="dropdown d-inline-block user-dropdown">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown">

                <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/avatar-1.jpg') }}">

                <span class="d-none d-xl-inline-block ms-1">
                    {{ auth()->user()->name ?? 'User' }}
                </span>

                <i class="fas fa-chevron-down"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-end pr-3">

                <!-- item-->
                <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                <a class="dropdown-item d-block" href="#"><span
                        class="badge bg-success float-end mt-1">11</span><i
                        class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock
                    screen</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="dropdown-item text-danger border-0 bg-transparent">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
