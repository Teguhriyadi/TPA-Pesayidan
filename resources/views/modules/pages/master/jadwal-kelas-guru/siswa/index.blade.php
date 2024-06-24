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
                                <th class="text-center">Keterangan</th>
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
                                        @if ($item->jumlah_pertemuan == 0)
                                        <span class="badge bg-danger text-white">
                                            Belum Dilakukan Penilaian
                                        </span>
                                        @else
                                        <span class="badge bg-primary text-white">
                                            Sudah Nilai Ke Pertemuan - {{ $item->jumlah_pertemuan }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->jumlah_pertemuan < 5)
                                        <button onclick="tambahNilai({{ $id }}, {{ $item->id }})" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-plus"></i> Tambah Nilai
                                        </button>
                                        @endif
                                        <a href="{{ route('modules.master.jadwal-kelas-guru.detail-nilai', ['idJadwal' => $id, 'idSiswa' => $item->id]) }}" class="btn btn-outline-success btn-sm">
                                            <i class="fa fa-search"></i> Detail
                                        </a>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fa fa-plus"></i> Tambah Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-content-nilai">

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
        function tambahNilai(idJadwal, idSiswa)
        {
            $.ajax({
                url: "{{ url('/modules/master/jadwal-kelas-saya') }}" + "/" + idJadwal + "/" + idSiswa,
                method: "GET",
                success: function(response) {
                    $("#modal-content-nilai").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
    </script>
@endpush
