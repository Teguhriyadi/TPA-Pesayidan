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

    <li class="nav-item {{ Request::segment(3) == "kelas" || Request::segment(3) == "tahun_ajaran" || Request::segment(2) == "siswa" || Request::segment(2) == "wali-kelas" ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
            aria-expanded="true" aria-controls="collapseMasterData">
            <i class="fas fa-fw fa-bars"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse {{ Request::segment(3) == "kelas" || Request::segment(3) == "tahun_ajaran" || Request::segment(2) == "siswa" || Request::segment(2) == "wali-kelas"  ? 'show' : '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(3) == "kelas" ? 'active' : '' }} " href="{{ route('modules.master.kelas') }}">Kelas</a>
                <a class="collapse-item {{ Request::segment(3) == "tahun_ajaran" ? 'active' : '' }} " href="{{ route('modules.master.tahun_ajaran') }}">Tahun Ajaran</a>
                <a class="collapse-item {{ Request::segment(2) == "siswa" ? 'active' : '' }} " href="{{ route('modules.siswa.index') }}">Siswa</a>
                <a class="collapse-item {{ Request::segment(2) == "wali-kelas" ? 'active' : '' }} " href="{{ route('modules.walikelas.index') }}">Wali Kelas</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::segment(3) == "kategori" || Request::segment(3) == "kelompok-rapot" || Request::segment(3) == "kelompok-penilaian" || Request::segment(3) == "pelajaran" ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePembelajaran"
            aria-expanded="true" aria-controls="collapsePembelajaran">
            <i class="fas fa-fw fa-book"></i>
            <span>Pembelajaran</span>
        </a>
        <div id="collapsePembelajaran" class="collapse {{ Request::segment(3) == "kategori" || Request::segment(3) == "kelompok-rapot" || Request::segment(3) == "kelompok-penilaian" || Request::segment(3) == "pelajaran" ? 'show' : '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(3) == 'kategori' ? 'active' : '' }}" href="{{ route('modules.master.kategori.index') }}">Kategori</a>
                <a class="collapse-item {{ Request::segment(3) == 'kelompok-rapot' ? 'active' : '' }} " href="{{ route('modules.master.kelompok-rapot.index') }}">Kelompok Rapot</a>
                <a class="collapse-item {{ Request::segment(3) == 'kelompok-penilaian' ? 'active' : '' }} " href="{{ route('modules.master.kelompok-penilaian.index') }}">Kelompok Penilaian</a>
                <a class="collapse-item {{ Request::segment(3) == 'pelajaran' ? 'active' : '' }} " href="{{ route('modules.master.pelajaran.index') }}">Pelajaran</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item {{ Request::segment(4) == "harian" || Request::segment(4) == "ujian" ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporanHafalan"
            aria-expanded="true" aria-controls="collapseLaporanHafalan">
            <i class="fas fa-fw fa-edit"></i>
            <span>Hafalan</span>
        </a>
        <div id="collapseLaporanHafalan" class="collapse {{ Request::segment(4) == "harian" || Request::segment(4) == "ujian" ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(4) == "harian" ? 'active' : '' }}" href="{{ url('/modules/laporan/hafalan/harian') }}">Penilaian Harian</a>
                <a class="collapse-item {{ Request::segment(4) == "ujian" ? 'active' : '' }} " href="{{ url('/modules/laporan/hafalan/ujian') }}">Penilaian Ujian</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::segment(3) == 'rapot' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('modules.report.rapot.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Rapot</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan"
            aria-expanded="true" aria-controls="collapsePengaturan">
            <i class="fas fa-fw fa-edit"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapsePengaturan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('modules.pengaturan.profil') }}">Profil Madrasah</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::segment(2) == 'akun-guru' || Request::segment(2) == 'akun-admin' || Request::segment(3) == 'profil-saya' ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Akun</span>
        </a>
        <div id="collapseTwo" class="collapse {{ Request::segment(2) == 'akun-guru' || Request::segment(2) == 'akun-admin' || Request::segment(3) == 'profil-saya' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::segment(2) == 'akun-guru' ? 'active' : '' }}" href="{{ route('modules.guru.index') }}">Guru</a>
                <a class="collapse-item {{ Request::segment(2) == 'akun-admin' ? 'active' : '' }}" href="{{ route('modules.admin.index') }}">Administrator</a>
                <a class="collapse-item {{ Request::segment(3) == 'profil-saya' ? 'active' : '' }} " href="{{ route('modules.akun.profil') }}">Profil Saya</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
