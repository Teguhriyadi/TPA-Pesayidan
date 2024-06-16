@extends('modules.layouts.main')

@push('modules-title', 'Detail Hafalan Ujian ' . $detail->siswa->nama . " - " . $detail->siswa->kelas->namaKelas )

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-search"></i> @stack('modules-title')
        </h1>

        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Profil
                            <strong>
                                {{ $detail->siswa->nama }} - {{ $detail->siswa->kelas->namaKelas }}
                            </strong>
                        </h6>
                    </div>
                    <div class="card-body">
                        <center>
                            @if (empty($detail->siswa->foto))
                            <img src="{{ URL::asset('images/user-default.png') }}" alt="Image Default" class="img-responsive" style="width: 100%; height: 300px;">
                        @else
                            <img src="{{ url('/storage/' . $detail->siswa->foto) }}" alt="Image Siswa" class="img-responsive" style="width: 100%; height: 300px;">
                        @endif
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Detail Data
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">Nama</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->siswa->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Jenis Kelamin</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->siswa->jenisKelamin == "L" ? "Laki - Laki" : "Perempuan" }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Tempat, Tanggal Lahir</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->siswa->tempatLahir }}, {{ \Carbon\Carbon::parse($detail->siswa->tanggalLahir)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Alamat</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->siswa->alamat }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Kelas</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->siswa->kelas->jenjang }} - {{ $detail->siswa->kelas->namaKelas }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Tanggal Ujian</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($detail->tanggal)->translatedFormat('H:i:s - d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Pelajaran</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->materiPelajaran->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Penilaian</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->penilaian }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Keterangan</td>
                                    <td class="text-center" style="width: 5%">:</td>
                                    <td>
                                        {{ $detail->keterangan }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('modules.penilaian.ujian.index') }}" class="btn btn-outline-danger btn-sm btn-block mb-4">
            Kembali
        </a>
    </div>
@endpush
