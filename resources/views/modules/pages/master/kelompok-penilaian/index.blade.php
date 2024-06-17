@extends('modules.layouts.main')

@push('modules-title', 'Kelompok Penilaian')

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
                                <th>Kelompok Penilaian</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 1;
                            @endphp
                            @foreach ($kelompokPenilaian as $item)
                                <tr>
                                    <td class="text-center">{{ $nomer++ }}.</td>
                                    <td>{{ $item->kelompok }}</td>
                                    <td class="text-center">{{ $item->slug }}</td>
                                    <td class="text-center">
                                        @if ($item->kategori == "Ujian")
                                        <span class="badge bg-success text-white">
                                            Ujian
                                        </span>
                                        @elseif($item->kategori == "Pelajaran")
                                        <span class="badge bg-danger text-white">
                                            Pelajaran
                                        </span>
                                        @endif
                                    </td>
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
                <form action="{{ route('modules.master.kelompok-penilaian.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kelompok" class="form-label"> Kelompok </label>
                            <input type="text" class="form-control" name="kelompok" id="kelompok"
                                placeholder="Masukkan Kelompok Penilaian">
                        </div>
                        <div class="form-group">
                            <label for="kategori" class="form-label"> Kategori </label>
                            <select name="kategori" class="form-control" id="kategori">
                                <option value="">- Pilih -</option>
                                <option value="Ujian">Ujian</option>
                                <option value="Pelajaran">Pelajaran</option>
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
                url: "{{ url('/modules/master/kelompok-penilaian') }}" + "/" + id + "/edit",
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
                        url: "{{ url('/modules/master/kelompok-penilaian') }}" + "/" + id,
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
                                window.location.href = "{{ route('modules.master.kelompok-penilaian.index') }}"
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
