@extends('modules.layouts.main')

@push('modules-title', 'Penilaian Ujian')

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
                    <a style="float: right" href="{{ route('modules.penilaian.ambil-nilai.create') }}"
                        class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
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
                                <th class="text-center">Jenjang</th>
                                <th>Wali</th>
                                <th class="text-center">Kelompok Penilaian</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 0;
                            @endphp
                            @foreach ($ambilNilai as $item)
                                <tr>
                                    <td class="text-center">{{ ++$nomer }}.</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td class="text-center">{{ $item->siswa->kelas->namaKelas }}</td>
                                    <td class="text-center">{{ $item->siswa->kelas->jenjang }}</td>
                                    <td>{{ $item->siswa->wali->nama }}</td>
                                    <td class="text-center">{{ $item->kelompokPenilaian->kelompok }}</td>
                                    <td class="text-center">
                                        <button onclick="detail({{ $item->siswa_id }}, {{ $item->kelompok_penilaian_id }})" type="button"
                                            class="btn btn-outline-info btn-sm" data-toggle="modal"
                                            data-target="#exampleModal">
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

    <!-- Detail -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-content-detail"></div>
            </div>
        </div>
    </div>

    <!-- END -->
@endpush

@push('modules-js')
    <script src="{{ url('/theme') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/theme') }}/js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        function detail(id, kelompokPenilaianId)
        {
            $.ajax({
                url: "{{ url('/modules/penilaian/data/ambil-nilai') }}" + "/" + id + "/" + kelompokPenilaianId + "/show",
                method: "GET",
                success: function(response) {
                    $("#modal-content-detail").html(response)
                },
                error: function(error) {
                    console.log(error);
                    alert(error)
                }
            })
        }
    </script>
@endpush
