@extends('modules.layouts.main')

@push('modules-title', 'Detail Nilai Siswa ' . $siswa->nama)

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-users"></i>
            @stack('modules-title')
        </h1>

        <a href="{{ route('modules.master.jadwal-kelas-guru.detail', ['id' => $jadwalId]) }}" class="btn btn-outline-danger btn-sm">
            Kembali
        </a>

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
                                <th>Pelajaran</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-center">Pertemuan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 0;
                            @endphp
                            @foreach ($nilai as $item)
                                <tr>
                                    <td class="text-center">{{ ++$nomor }}.</td>
                                    <td>{{ $item->jadwal->kelasPelajaran->pelajaran->nama }}</td>
                                    <td class="text-center">{{ $item->nilai }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary text-white">
                                            Pertemuan Ke - {{ $item->pertemuan }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button onclick="editData({{ $jadwalId }}, {{ $siswaId }}, {{ $item->id }} )" type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal"
                                            data-target="#editModal">
                                            <i class="fa fa-edit"></i> Edit
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

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fa fa-edit"></i> Edit Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-content-edit">

                </div>
            </div>
        </div>
    </div>
    <!-- End -->

@endpush

@push('modules-js')
    <script src="{{ url('/theme') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/theme') }}/js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        function editData(jadwalId, siswaId, nilaiId)
        {
            $.ajax({
                url: "{{ url('/modules/master/jadwal-kelas-saya') }}" + "/" + jadwalId + "/" + siswaId + "/" + nilaiId + "/edit",
                method: "GET",
                success: function(response) {
                    $("#modal-content-edit").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
    </script>
@endpush
