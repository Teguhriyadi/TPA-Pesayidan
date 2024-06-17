@extends('modules.layouts.main')

@push('modules-title', 'Pelajaran')

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
                                <th class="text-center">Kode Pelajaran</th>
                                <th>Nama Pelajaran</th>
                                <th>Kelompok Pelajaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 1;
                            @endphp
                            @foreach ($pelajaran as $item)
                                <tr>
                                    <td class="text-center">{{ $nomer++ }}.</td>
                                    <td class="text-center">{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelompokPelajaran->kelompok }}</td>
                                    <td class="text-center">
                                        <button onclick="editData({{ $item['id'] }})" type="button"
                                            class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button onclick="hapusData({{ $item['id'] }})" class="btn btn-outline-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
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

    <!-- Tambah Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fa fa-plus"></i> Tambah @stack('modules-title')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('modules.master.pelajaran.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="form-label"> Nama </label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Masukkan Nama">
                        </div>
                        <div class="form-group">
                            <label for="kelompokPelajaranId" class="form-label"> Kelompok Penilaian </label>
                            <select name="kelompokPelajaranId" class="form-control" id="kelompokPelajaranId">
                                <option value="">- Pilih -</option>
                                @foreach ($kelompokPenilaian as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->kelompok }}
                                    </option>
                                @endforeach
                            </select>
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
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div id="modal-content-edit">
                    <!-- Modal Content Edit -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

@endpush

@push('modules-js')
    <script src="{{ url('/theme') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/theme') }}/js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        function editData(id) {
            $.ajax({
                url: "{{ url('/modules/master/pelajaran') }}" + "/" + id + "/edit",
                type: "GET",
                success: function(response) {
                    $("#modal-content-edit").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function hapusData(id) {

            let csrf_token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Ingin Menghapus Data Ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Saya Yakin",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/modules/master/pelajaran') }}" + "/" + id,
                        method: "DELETE",
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.message,
                                icon: "success"
                            }).then((result) => {
                                window.location.href = "{{ route('modules.master.pelajaran.index') }}"
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                title: "Gagal!",
                                text: error,
                                icon: "error"
                            });
                        }
                    })
                }
            });
        }
    </script>
@endpush
