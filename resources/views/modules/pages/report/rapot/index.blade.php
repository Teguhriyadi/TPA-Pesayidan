@extends('modules.layouts.main')

@push('modules-title', 'Penilaian Rapot')

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
                                <th>Siswa</th>
                                <th>Guru</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Jenjang</th>
                                <th>Wali</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 1;
                            @endphp
                            @foreach ($rapot as $item)
                                <tr>
                                    <td class="text-center">{{ $nomer++ }}.</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td>{{ $item->guru->hasWakel->guru->users->nama }}</td>
                                    <td class="text-center">{{ $item->kelas->namaKelas }}</td>
                                    <td class="text-center">{{ $item->kelas->jenjang }}</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('modules.report.rapot.show', ['id' => $item->id]) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-search"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td class="text-center">{{ $nomer++ }}.</td>
                                    <td>{{ $item->namaKelas }}</td>
                                    <td class="text-center">{{ $item->jenjang }}</td>
                                    <td>{{ $item->deskripsi == null ? "-" : $item->deskripsi }}</td>
                                    <td class="text-center">
                                        <button onclick="editData({{ $item['id'] }})" type="button"
                                            class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button onclick="hapusData({{ $item['id'] }})" class="btn btn-outline-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr> --}}
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
