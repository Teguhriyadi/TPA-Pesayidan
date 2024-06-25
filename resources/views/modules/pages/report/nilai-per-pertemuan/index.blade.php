@extends('modules.layouts.main')

@push('modules-title', 'Nilai Per Pertemuan')

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-book"></i> @stack('modules-title')
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
                                <th>Nama Siswa</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-center">Pertemuan</th>
                                <th>Guru</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 0;
                            @endphp
                            @foreach ($nilai as $item)
                            <tr>
                                <td class="text-center">{{ ++$nomer }}.</td>
                                <td>{{ $item->siswa->nama }}</td>
                                <td class="text-center">{{ $item->siswa->jenisKelamin == "L" ? "Laki - Laki" : "Perempuan" }}</td>
                                <td class="text-center">{{ $item->nilai }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary text-white fw-bold">
                                        Nilai Pertemuan Ke - {{ $item->pertemuan }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $item->jadwal->guru->users->nama }}</td>
                                <td class="text-center">
                                    <a href="{{ route('modules.report.nilai-per-pertemuan.show', ['id' => $item->id]) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fa fa-search"></i> Detail
                                    </a>
                                </td>
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
