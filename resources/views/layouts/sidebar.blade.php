<!-- main-sidebar opened -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="main-sidebar app-sidebar sidebar-scroll">
    <div class="main-sidebar-header">
        <a class="desktop-logo logo-light active" href="index.html" class="text-center mx-auto"><img
                src="{{ asset('') }}assets/img/brand/logo.png" class="main-logo"></a>
        <a class="desktop-logo icon-logo active"href="index.html"><img
                src="{{ asset('') }}assets/img/brand/favicon.png" class="logo-icon"></a>
        <a class="desktop-logo logo-dark active" href="index.html"><img
                src="{{ asset('') }}assets/img/brand/logo-white.png" class="main-logo dark-theme"
                alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="index.html"><img
                src="{{ asset('') }}assets/img/brand/favicon-white.png" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    <!-- /logo -->
    <div class="main-sidebar-loggedin">
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    <img src="{{ asset('') }}assets/img/faces/6.jpg" alt="user-img"
                        class="rounded-circle mCS_img_loaded">
                </div>
                <div class="user-info">
                    <h6 class=" mb-0 text-dark">{{ auth()->user()->username }}</h6>
                    <span class="text-muted app-sidebar__user-name text-sm">{{ auth()->user()->role->role }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- /user -->
    <div class="main-sidebar-body">
        <ul class="side-menu ">
            <li class="slide">
                <a class="side-menu__item {{ request()->is('dashboard') ? 'active' : '' }}" href="dashboard">
                    <i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
            </li>
            @if (strtolower(auth()->user()->role->role) == strtolower('admin'))
                <li class="slide">
                    <a class="side-menu__item {{ request()->is('kelolauser') ? 'active' : '' }}" href="kelolauser">
                        <i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Kelola User</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->is('stokbibit') ? 'active' : '' }}" href="stokbibit">
                        <i class="side-menu__icon fe fe-database"></i><span class="side-menu__label">Stok
                            jamur</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->is('dataproduksi') ? 'active' : '' }}" href="dataproduksi">
                        <i class="side-menu__icon fe fe-database"></i><span class="side-menu__label">Data
                            Produksi</span></a>
                </li>
            @endif

            <li class="slide">
                <a class="side-menu__item {{ request()->is('kelolapemesanan') ? 'active' : '' }}"
                    href="kelolapemesanan"><i class="side-menu__icon fe fe-shopping-bag"></i><span
                        class="side-menu__label">Kelola Pemesanan
                    </span></a>
            </li>

            @if (strtolower(auth()->user()->role->role) == strtolower('admin') ||
                    strtolower(auth()->user()->role->role) == strtolower('pemilik'))
                <li class="slide">
                    <a class="side-menu__item {{ request()->is('laporan') ? 'active' : '' }}" href="laporan"><i
                            class="side-menu__icon fe fe-shopping-cart"></i><span
                            class="side-menu__label">Laporan</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->is('kelolapemasaran') ? 'active' : '' }}"
                        href="kelolapemasaran"><i class="side-menu__icon fe fe-shopping-cart"></i><span
                            class="side-menu__label">Kelola Pemasaran
                        </span></a>
                </li>
            @endif

        </ul>
    </div>
</aside>
<!-- /main-sidebar -->
