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

    <li class="nav-item {{ Request::is('modules/master/kelas') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.master.kelas') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Kelas</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('modules/master/tahun_ajaran') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.master.tahun_ajaran') }}">
            <i class="fas fa-fw fa-sign-in-alt"></i>
            <span>Tahun Ajaran</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('modules/siswa') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.siswa.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Siswa</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('modules/walikelas') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.walikelas.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Wali Kelas</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <li class="nav-item {{ Request::is('modules/pengaturan/profil') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.pengaturan.profil') }}">
            <i class="fas fa-fw fa-edit"></i>
            <span>Pengaturan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Akun</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('modules.guru.index') }}">Guru</a>
                <a class="collapse-item" href="{{ route('modules.admin.index') }}">Administrator</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
