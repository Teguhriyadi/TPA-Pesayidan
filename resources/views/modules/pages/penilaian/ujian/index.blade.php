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
                    <a style="float: right" href="{{ route('modules.penilaian.ujian.create') }}" class="btn btn-outline-primary btn-sm">
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
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Ujian</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
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

{{-- @extends('modules.layouts.main')

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
                        </thead> --}}
{{-- <tbody>
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
                                        <a href="{{ route('modules.penilaian.ujian.show', ['id' => $item->id]) }}" class="btn btn-outline-info btn-sm">
                                            <i class="fa fa-search"></i> Detail
                                        </a>
                                        <button onclick="editData({{ $item['id'] }})" class="btn btn-outline-warning btn-sm"
                                            type="button" data-toggle="modal"
                                            data-target="#exampleModalEdit">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
{{-- </table>
                </div>
            </div>
        </div>
    </div> --}}

<!-- Tambah Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fa fa-plus"></i> Tambah @stack('modules-title')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
{{-- <form action="{{ route('modules.penilaian.ujian.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="siswaId" class="form-label"> Siswa </label>
                            <select name="siswaId" class="form-control" id="siswaId">
                                <option value="">- Pilih -</option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }} - {{ $item->kelas->namaKelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pilihan" class="form-label"> Kategori Penilaian </label>
                            <select name="pilihan" class="form-control" id="pilihan">
                                <option value="">- Pilih -</option>
                                @foreach ($kelompokPenilaian as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->kelompok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="pelajaranId" class="form-label"> Pelajaran </label>
                                    <select name="pelajaranId" class="form-control" id="pelajaranId">
                                        <option value="">- Pilih -</option>
                                        <!-- Select Option -->
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penilaian" class="form-label"> Penilaian </label>
                                    <select name="penilaian" class="form-control" id="penilaian">
                                        <option value="">- Pilih -</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Cukup">Cukup</option>
                                        <option value="Kurang">Kurang</option>
                                        <option value="Sangat Kurang">Sangat Kurang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="form-label"> Keterangan </label>
                            <textarea name="keterangan" class="form-control" id="keterangan" rows="5" placeholder="Masukkan Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-danger">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-outline-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form> --}}
{{-- </div>
        </div>
    </div> --}}
<!-- End Modal -->

<!-- Edit Modal -->
{{-- <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fa fa-edit"></i> Edit @stack('modules-title')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-content-edit"> --}}
<!-- Modal Content Edit -->
{{-- </div>
            </div>
        </div>
    </div> --}}
<!-- End Modal -->
{{-- @endpush --}}

{{-- @push('modules-js')
    <script src="{{ url('/theme') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/theme') }}/js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        function editData(id) {
            $.ajax({
                url: "{{ url('/modules/penilaian/ujian') }}" + "/" + id + "/edit",
                type: "GET",
                success: function(response) {
                    $("#modal-content-edit").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script> --}}
{{-- @endpush --}}
