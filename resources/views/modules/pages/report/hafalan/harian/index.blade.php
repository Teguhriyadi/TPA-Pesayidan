@extends('modules.layouts.main')

@push('modules-title', 'Hafalan Harian')

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-edit"></i> @stack('modules-title')
        </h1>

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Data @stack('modules-title')
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Siswa</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Tanggal</th>
                                <th>Guru</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 1;
                            @endphp
                            @foreach ($hafalanHarian as $item)
                                <tr>
                                    <td class="text-center">{{ $nomer++ }}.</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td class="text-center">{{ $item->siswa->kelas->namaKelas }} - {{ $item->siswa->kelas->jenjang }} </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('H:i:s - d F Y') }}</td>
                                    <td>{{ $item->guru->users->nama }}</td>
                                    <td class="text-center">
                                        @if ($item->penilaian == 'Tidak Lancar')
                                            <span class="badge bg-danger text-white fw-bold">
                                                Tidak Lancar
                                            </span>
                                        @elseif($item->penilaian == 'Kurang Lancar')
                                            <span class="badge bg-warning text-white fw-bold">
                                                Kurang Lancar
                                            </span>
                                        @elseif($item->penilaian == 'Lancar')
                                            <span class="badge bg-success text-white fw-bold">
                                                Lancar
                                            </span>
                                        @elseif($item->penilaian == 'Sangat Lancar')
                                            <span class="badge bg-primary text-white fw-bold">
                                                Sangat Lancar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('modules-js')
    <script src="{{ url('/theme') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/theme') }}/js/demo/datatables-demo.js"></script>
@endpush
