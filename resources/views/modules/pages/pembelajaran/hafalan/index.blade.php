@extends('modules.layouts.main')

@push('modules-title', 'Hafalan Quran')

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
                                <th>Siswa</th>
                                <th>Pelajaran</th>
                                <th class="text-center">Kriteria</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 1;
                            @endphp
                            @foreach ($penilaianHafalan as $item)
                            <tr>
                                <td class="text-center">{{ $nomer++ }}.</td>
                                <td>{{ $item->siswa->nama }}</td>
                                <td>{{ $item->pelajaran->kode }} - {{ $item->pelajaran->nama }} </td>
                                <td class="text-center">
                                    @if ($item->rating == "1")
                                        Sangat Baik
                                    @elseif($item->rating == "2")
                                        Baik
                                    @elseif($item->rating == "3")
                                        Cukup
                                    @elseif($item->rating == "4")
                                        Kurang
                                    @elseif($item->rating == "5")
                                        Sangat Kurang
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->keterangan ? $item->keterangan : "" }}</td>
                                <td class="text-center">
                                    <button onclick="editData({{ $item['id'] }})" type="button"
                                        class="btn btn-outline-warning" data-toggle="modal" data-target="#editModal">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button onclick="hapusData({{ $item['id'] }})" class="btn btn-outline-danger">
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
                <form action="{{ route('modules.master.pembelajaran.hafalan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pelajaranId" class="form-label"> Pelajaran </label>
                            <select name="pelajaranId" class="form-control" id="pelajaranId">
                                <option value="">- Pilih -</option>
                                @foreach ($pelajaran as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->kode }} - {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="siswaId" class="form-label"> Nama Siswa </label>
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
                            <label for="rating" class="form-label"> Nilai </label>
                            <select name="rating" class="form-control" id="rating">
                                <option value="">- Pilih -</option>
                                <option value="1">Sangat Baik</option>
                                <option value="2">Baik</option>
                                <option value="3">Cukup</option>
                                <option value="4">Kurang</option>
                                <option value="5">Sangat Kurang</option>
                            </select>
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
                url: "{{ url('/modules/pembelajaran/hafalan') }}" + "/" + id + "/edit",
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
                        url: "{{ url('/modules/pembelajaran/hafalan') }}" + "/" + id,
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
                                window.location.href = "{{ route('modules.master.pembelajaran.hafalan.index') }}"
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