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

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
            aria-expanded="true" aria-controls="collapseMasterData">
            <i class="fas fa-fw fa-bars"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('modules.master.kelas') }}">Kelas</a>
                <a class="collapse-item" href="{{ route('modules.master.tahun_ajaran') }}">Tahun Ajaran</a>
                <a class="collapse-item" href="{{ route('modules.siswa.index') }}">Siswa</a>
                <a class="collapse-item" href="{{ route('modules.walikelas.index') }}">Wali Kelas</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePembelajaran"
            aria-expanded="true" aria-controls="collapsePembelajaran">
            <i class="fas fa-fw fa-book"></i>
            <span>Pembelajaran</span>
        </a>
        <div id="collapsePembelajaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('modules.master.kelompok-penilaian.index') }}">Kelompok Penilaian</a>
                <a class="collapse-item" href="{{ route('modules.master.pelajaran.index') }}">Pelajaran</a>
                <a class="collapse-item" href="{{ route('modules.master.hafalan.index') }}">Hafalan</a>
                <a class="collapse-item" href="{{ route('modules.master.kelas-pelajaran.index') }}">Kelas Pelajaran</a>
                <a class="collapse-item" href="{{ route('modules.master.jadwal-kelas.index') }}">Jadwal Kelas</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporanHafalan"
            aria-expanded="true" aria-controls="collapseLaporanHafalan">
            <i class="fas fa-fw fa-edit"></i>
            <span>Hafalan</span>
        </a>
        <div id="collapseLaporanHafalan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('modules.report.hafalan.harian.index') }}">Penilaian Harian</a>
                <a class="collapse-item" href="{{ route('modules.admin.index') }}">Penilaian Ujian</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporanPelajaran"
            aria-expanded="true" aria-controls="collapseLaporanPelajaran">
            <i class="fas fa-fw fa-book"></i>
            <span>Pelajaran</span>
        </a>
        <div id="collapseLaporanPelajaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('modules.guru.index') }}">Guru</a>
                <a class="collapse-item" href="{{ route('modules.admin.index') }}">Administrator</a>
                <a class="collapse-item" href="{{ route('modules.akun.profil') }}">Profil Saya</a>
            </div>
        </div>
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
                <a class="collapse-item" href="{{ route('modules.akun.profil') }}">Profil Saya</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
