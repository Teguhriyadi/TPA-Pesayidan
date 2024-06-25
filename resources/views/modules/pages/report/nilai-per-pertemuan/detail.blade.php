@extends('modules.layouts.main')

@push('modules-title', 'Detail Nilai')

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-search"></i> @stack('modules-title')
        </h1>

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    @stack('modules-title') - {{ $detail->siswa->nama }} | Kelas :  {{ $detail->siswa->kelas->namaKelas }}
                    <a href="{{ route('modules.report.nilai-per-pertemuan.index') }}" class="btn btn-outline-danger btn-sm" style="float: right">
                        <i class="fa fa-times"></i> Kembali
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 15%">Nama</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>{{ $detail->siswa->nama }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Jenis Kelamin</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>{{ $detail->siswa->jenisKelamin == "L" ? "Laki - Laki" : "Perempuan" }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Guru</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>{{ $detail->jadwal->guru->users->nama }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Pelajaran</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>{{ $detail->jadwal->kelasPelajaran->pelajaran->kode }} | {{ $detail->jadwal->kelasPelajaran->pelajaran->nama }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Jadwal Kelas</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>{{ $detail->jadwal->hari }} | {{ $detail->jadwal->mulai }} - {{ $detail->jadwal->selesai }} </td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Nilai</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>{{ $detail->nilai }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Pertemuan</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>
                                <span class="badge bg-primary text-white fw-bold">
                                    Nilai Pertemuan Ke - {{ $detail->pertemuan }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Tahun Ajaran</td>
                            <td class="text-center" style="width: 3%;">:</td>
                            <td>
                                Tahun Ajaran {{ $detail->jadwal->kelasPelajaran->tahunAjaran->tahun_ajaran }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endpush
