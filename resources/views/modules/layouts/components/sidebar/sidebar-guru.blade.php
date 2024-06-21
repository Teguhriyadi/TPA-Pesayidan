<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('modules.dashboard') }}">
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

    <li class="nav-item {{ Request::is('modules/master/jadwal-kelas-saya') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.master.jadwal-kelas-guru.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Jadwal Kelas</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Penilaian</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/modules/penilaian/harian') }}">Hafalan Harian</a>
                <a class="collapse-item" href="{{ url('/modules/penilaian/ujian') }}">Hafalan Ujian</a>
            </div>
        </div>
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
