@extends('modules.layouts.main')

@push('modules-title', 'Siswa Kelas ' . $detail->kelasPelajaran->kelas->namaKelas)

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-users"></i>
            @stack('modules-title') | Pelajaran : {{ $detail->kelasPelajaran->pelajaran->nama }}
        </h1>

        <a href="{{ route('modules.master.jadwal-kelas-guru.index') }}" class="btn btn-outline-danger btn-sm">
            Kembali
        </a>

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Data @stack('modules-title')
                    <button style="float: right" type="button" class="btn btn-outline-primary" data-toggle="modal"
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
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tempat Tanggal Lahir</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th>Nama Wali</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($siswa as $item)
                                <tr>
                                    <td class="text-center">{{ $nomor++ }}.</td>
                                    <td class="text-center">{{ $item->nama }}</td>
                                    <td class="text-center">{{ $item->tempatLahir }}, {{ $item->tanggalLahir }}</td>
                                    <td class="text-center">{{ $item->jenisKelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}
                                    </td>
                                    <td>{{ $item->wali->nama }}</td>
                                    <td class="text-center">
                                        <button onclick="editData({{ $item['id'] }})" type="button"
                                            class="btn btn-outline-info" data-toggle="modal" data-target="#editModal">
                                            <i class="fa fa-search"></i> Detail
                                        </button>
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
