@extends('modules.layouts.main')

@push('modules-title', 'Jadwal Kelas Saya')

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-calendar"></i> @stack('modules-title')
        </h1>

        @if ($count > 0)
            <div class="row mt-4">
                @foreach ($jadwalKelasSaya as $item)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ $item->kelasPelajaran->pelajaran->kode }} | {{ $item->kelasPelajaran->pelajaran->nama }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $item->hari }} | {{ $item->mulai }} s/d {{ $item->selesai }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-book fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('modules.master.jadwal-kelas-guru.detail', ['id' => $item->id]) }}" class="btn btn-outline-primary btn-sm btn-block">
                                    <i class="fa fa-search"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-danger mt-4">
                <strong>Tidak Ditemukan</strong>. Belum Ada Jadwal Kelas Pelajaran di Semester Ini.
            </div>
        @endif
    </div>

@endpush
