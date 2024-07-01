@extends('modules.layouts.main')

@push('modules-title', 'Penilaian Rapot ' . $edit->siswa->nama)

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
                    Form @stack('modules-title')
                </h6>
            </div>
            <form action="{{ route('modules.penilaian.rapot.update', ['id' => $edit->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="card-body">
                    <div class="form-group">
                        <label for="siswaId" class="form-label"> Nama Siswa </label>
                        <select name="siswaId" class="form-control" id="siswaId">
                            <option value="">- Pilih -</option>
                            @foreach ($siswa as $item)
                                <option value="{{ $item['id'] }}" {{ $edit->siswa_id == $item->id ? 'selected' : '' }} >
                                    {{ $item['nama'] }} - {{ $item['kelas']['namaKelas'] }} -
                                    {{ $item['kelas']['jenjang'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($kelompokRapot as $item)
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nama_kelompok_rapot" class="form-label mt-2">
                                        <strong>
                                            ({{ $item["kategori"]["nama_kategori"] }})
                                        </strong> - {{ $item["nama_kelompok_rapot"] }}
                                    </label>
                                </div>
                            </div>

                            @php
                                $nilai = $editKelompokRapot->firstWhere("kelompok_rapot_id", $item->id);
                            @endphp

                            <div class="col-md-4">
                                <input type="number" min="1" name="nilai[]" placeholder="0" class="form-control" value="{{ $nilai->nilai }}">
                            </div>
                        </div>
                    @endforeach

                    <hr>

                    <strong>Aspek Penilaian Lainnya</strong>

                    <hr>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="sikap" class="form-label"> Aspek Sikap </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="sikap" class="form-control" id="sikap">
                                <option value="">- Pilih -</option>
                                <option {{ $editAspek->sikap == "A" ? 'selected' : '' }} value="A">A</option>
                                <option {{ $editAspek->sikap == "B" ? 'selected' : '' }} value="B">B</option>
                                <option {{ $editAspek->sikap == "C" ? 'selected' : '' }} value="C">C</option>
                                <option {{ $editAspek->sikap == "D" ? 'selected' : '' }} value="D">D</option>
                                <option {{ $editAspek->sikap == "E" ? 'selected' : '' }} value="E">E</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="kerajinan" class="form-label"> Aspek Kerajinan </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="kerajinan" class="form-control" id="kerajinan">
                                <option value="">- Pilih -</option>
                                <option {{ $editAspek->kerajinan == "A" ? 'selected' : '' }} value="A">A</option>
                                <option {{ $editAspek->kerajinan == "B" ? 'selected' : '' }} value="B">B</option>
                                <option {{ $editAspek->kerajinan == "C" ? 'selected' : '' }} value="C">C</option>
                                <option {{ $editAspek->kerajinan == "D" ? 'selected' : '' }} value="D">D</option>
                                <option {{ $editAspek->kerajinan == "E" ? 'selected' : '' }} value="E">E</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="kebersihan" class="form-label"> Aspek Kebersihan </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="kebersihan" class="form-control" id="kebersihan">
                                <option value="">- Pilih -</option>
                                <option {{ $editAspek->kebersihan == "A" ? 'selected' : '' }} value="A">A</option>
                                <option {{ $editAspek->kebersihan == "B" ? 'selected' : '' }} value="B">B</option>
                                <option {{ $editAspek->kebersihan == "C" ? 'selected' : '' }} value="C">C</option>
                                <option {{ $editAspek->kebersihan == "D" ? 'selected' : '' }} value="D">D</option>
                                <option {{ $editAspek->kebersihan == "E" ? 'selected' : '' }} value="E">E</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="kerapihan" class="form-label"> Aspek Kerapihan </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="kerapihan" class="form-control" id="kerapihan">
                                <option value="">- Pilih -</option>
                                <option {{ $editAspek->kerapihan == "A" ? 'selected' : '' }} value="A">A</option>
                                <option {{ $editAspek->kerapihan == "B" ? 'selected' : '' }} value="B">B</option>
                                <option {{ $editAspek->kerapihan == "C" ? 'selected' : '' }} value="C">C</option>
                                <option {{ $editAspek->kerapihan == "D" ? 'selected' : '' }} value="D">D</option>
                                <option {{ $editAspek->kerapihan == "E" ? 'selected' : '' }} value="E">E</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="eskul" class="form-label"> Aspek Eskul </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="eskul" class="form-control" id="eskul">
                                <option value="">- Pilih -</option>
                                <option {{ $editAspek->eskul == "A" ? 'selected' : '' }} value="A">A</option>
                                <option {{ $editAspek->eskul == "B" ? 'selected' : '' }} value="B">B</option>
                                <option {{ $editAspek->eskul == "C" ? 'selected' : '' }} value="C">C</option>
                                <option {{ $editAspek->eskul == "D" ? 'selected' : '' }} value="D">D</option>
                                <option {{ $editAspek->eskul == "E" ? 'selected' : '' }} value="E">E</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
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
                <form action="{{ route('modules.master.kelas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaKelas" class="form-label"> Nama Kelas </label>
                            <input type="text" class="form-control" name="namaKelas" id="namaKelas"
                                placeholder="Masukkan Nama Kelas">
                        </div>
                        <div class="form-group">
                            <label for="jenjang" class="form-label"> Jenjang </label>
                            <select name="jenjang" class="form-control" id="jenjang">
                                <option value="">- Pilih -</option>
                                <option value="TK">TK</option>
                                <option value="TPA">TPA</option>
                                <option value="DTA">DTA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-label"> Deskripsi </label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="5" placeholder="Masukkan Deskripsi"></textarea>
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
    {{-- <script type="text/javascript">
        function editData(id) {
            $.ajax({
                url: "{{ url('/modules/master/kelas') }}" + "/" + id + "/edit",
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
                        url: "{{ url('/modules/master/kelas') }}" + "/" + id,
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
                                window.location.href = "{{ route('modules.master.kelas') }}"
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
    </script> --}}
@endpush
