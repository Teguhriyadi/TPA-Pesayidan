@extends('modules.layouts.main')

@push('modules-title', 'Penilaian Hafalan Ujian')

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
                    <button style="float: right" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
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
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Ujian</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($hafalanUjian as $item)
                                <tr>
                                    <td class="text-center">{{ $nomor++ }}.</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td class="text-center">{{ $item->siswa->kelas->namaKelas }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('H:i:s - d F Y') }}</td>
                                    <td class="text-center">{{ $item->kelompokPenilaian->kelompok }}</td>
                                    <td class="text-center">{{ $item->materiPelajaran->nama }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('modules.report.hafalan.ujian.show', ['id' => $item->id]) }}" class="btn btn-outline-info btn-sm">
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
