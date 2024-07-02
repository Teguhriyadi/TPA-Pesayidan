@extends('modules.layouts.main')

@push('modules-title', 'Penilaian ' . $kategori)

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
                                <th class="text-center">Hafalan</th>
                                <th class="text-center">Penilaian</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($hafalanHarian as $item)
                                <tr>
                                    <td class="text-center">{{ $nomor++ }}.</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td class="text-center">{{ $item->siswa->kelas->namaKelas }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('H:i:s - d F Y') }}</td>
                                    <td class="text-center">
                                        @if (empty($item->jilidSurat))
                                            {{ $item->materiId == null ? $item->jilidSurat . ' - ' . $item->halAyat : $item->materi->kode . ' - ' . $item->materi->nama }}
                                            @if (!empty($item->dari) && !empty($item->sampai))
                                                <br>
                                                Ayat {{ $item->dari }} - {{ $item->sampai }}
                                            @endif
                                        @else
                                            Jilid {{ $item->jilidSurat }}
                                            <br>
                                            Dari {{ $item->dari }} s/d {{ $item->sampai }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->penilaian }}</td>
                                    <td>{{ $item->keterangan ? $item->keterangan : '-' }}</td>
                                    <td class="text-center">
                                        <button onclick="editData(`{{ $kategori }}`, {{ $item['id'] }})"
                                            type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal"
                                            data-target="#exampleModalEdit">
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
                <form action="{{ route('modules.penilaian.harian.store', ['kategori' => $kategori]) }}" method="POST">
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
                            <select name="pilihan" class="form-control" id="pilihan" onchange="kategoriPenilaian()">
                                <option value="">- Pilih -</option>
                                @foreach ($kelompokPenilaian as $item)
                                    <option value="{{ $item->slug }}">
                                        {{ $item->kelompok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="surat" style="display: none;">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label for="jilidSurat" class="form-label"> Jilid Surat </label>
                                        <input type="number" class="form-control" name="jilidSurat" id="jilidSurat"
                                            placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="lainnya" style="display: none">
                            <label for="materiId" class="form-label"> Materi / Hafalan </label>
                            <select name="materiId" class="form-control" id="materiId">

                            </select>
                        </div>

                        <div id="sampai-berapa" style="display: none">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="dari" class="form-label"> Dari </label>
                                        <input type="number" class="form-control" name="dari" id="dari"
                                            placeholder="0" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="sampai" class="form-label"> Sampai </label>
                                        <input type="number" class="form-control" name="sampai" id="sampai"
                                            placeholder="0" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="penilaian" class="form-label"> Penilaian </label>
                            <select name="penilaian" class="form-control" id="penilaian">
                                <option value="">- Pilih -</option>
                                @if ($kategori == 'harian')
                                    <option value="Lancar">Lancar</option>
                                    <option value="Tidak Lancar">Tidak Lancar</option>
                                    <option value="Kurang Lancar">Kurang Lancar</option>
                                    <option value="Setengah Lancar">Setengah Lancar</option>
                                @elseif($kategori == 'ujian')
                                    <option value="Sangat Baik">Sangat Baik</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Cukup">Cukup</option>
                                    <option value="Kurang">Kurang</option>
                                    <option value="Sangat Kurang">Sangat Kurang</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="keterangan" class="form-label"> Keterangan </label>
                            <textarea name="keterangan" class="form-control" id="keterangan" rows="5" placeholder="Masukkan Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
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
    </div>
    <!-- End Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
        function kategoriPenilaian() {
            let pilihan = document.getElementById("pilihan").value
            let surat = document.getElementById("surat");
            let lainnya = document.getElementById("lainnya");
            let sampaiBerapa = document.getElementById("sampai-berapa");

            if (pilihan == "iqro-jilid") {
                surat.style.display = "block"
                sampaiBerapa.style.display = "block";
                lainnya.style.display = "none"
            } else if (pilihan === "praktek-ibadah" || pilihan == "tahfidz-doa-harian") {
                surat.style.display = "none";
                sampaiBerapa.style.display = "none"
                lainnya.style.display = "block";
                loadMateri(pilihan)
            } else if (pilihan == "tahfidz-juz-amma" || pilihan == "surat-pilihan") {
                sampaiBerapa.style.display = "block";
                lainnya.style.display = "block";
                surat.style.display = "none"
            } else {
                sampaiBerapa.style.display = "none"
                surat.style.display = "none";
                lainnya.style.display = "none";
            }
        }

        function loadMateri(pilihan) {
            $.ajax({
                url: "{{ url('/modules/penilaian/search/materi') }}",
                type: "GET",
                data: {
                    pilihan: pilihan
                },
                success: function(response) {

                    let hafalanSelect = $("select[name='materiId']");
                    hafalanSelect.empty();

                    if (response.data.length > 0) {
                        $.each(response.data, function(index, materi) {
                            hafalanSelect.append('<option value="' + materi.id + '">' +
                                materi.kode + " - " + materi.nama + '</option>');
                        });
                    } else {
                        hafalanSelect.append(
                            '<option value="">Tidak ada Hafalan yang tersedia</option>');
                    }

                },
                error: function() {
                    alert("Terjadi Kesalahan")
                }
            })
        }

        $("select[name='pilihan']").change(function() {
            let pilihan = $(this).val();
            kategoriPenilaian();
        });

        function kategoriPenilaianEdit() {
            let pilihanEdit = document.getElementById("pilihanEdit").value;
            let suratEdit = document.getElementById("suratEdit");
            let lainnyaEdit = document.getElementById("lainnyaEdit");

            if (pilihanEdit == "jilid") {
                suratEdit.style.display = "block";
                lainnyaEdit.style.display = "none";
            } else if (pilihanEdit == "praktek-ibadah" || pilihanEdit == "tahfidz-doa-harian" || pilihanEdit ==
                "tahfidz-juz-amma" ||
                pilihanEdit == "surat-pilihan") {
                suratEdit.style.display = "none";
                lainnyaEdit.style.display = "block";
            } else {
                suratEdit.style.display = "none";
                lainnyaEdit.style.display = "none";
            }
        }

        function editData(kategori, id) {
            $.ajax({
                url: "{{ route('modules.penilaian.harian.edit', ['kategori' => ':kategori', 'id' => ':id']) }}"
                    .replace(':kategori', kategori)
                    .replace(':id', id),
                type: "GET",
                success: function(response) {
                    if (response.status == false) {
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message,
                            icon: "error"
                        }).then((result) => {
                            window.location.href = "{{ url('/modules/penilaian/harian') }}"
                        })
                    } else {
                        $("#modal-content-edit").html(response)
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endpush
