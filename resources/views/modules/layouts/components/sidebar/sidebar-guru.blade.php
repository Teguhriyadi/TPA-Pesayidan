<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">
            TPA Pesayidan
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('modules/dashboard') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Master
    </div>

    <li class="nav-item {{ Request::is('modules/pembelajaran/hafalan') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.master.pembelajaran.hafalan.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Hafalan Quran</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('modules/siswa') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.siswa.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Siswa</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Pengaturan
    </div>

    <li class="nav-item {{ Request::is('modules/akun/profil-saya') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.akun.profil') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Saya</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
