@extends('modules.layouts.main')

@push('modules-title', 'Penilaian Rapot')

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-book"></i> @stack('modules-title')
        </h1>

        <a href="{{ route('modules.penilaian.rapot.index') }}" class="btn btn-outline-danger btn-sm">
            Kembali
        </a>

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Data @stack('modules-title')
                </h6>
            </div>
            <div class="card-body">
                <strong>
                    Data Siswa
                </strong>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>
                                {{ $edit->siswa->nama }}
                            </td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>
                                {{ $edit->siswa->kelas->namaKelas }} - {{ $edit->siswa->kelas->jenjang }}
                            </td>
                        </tr>
                        <tr>
                            <td>Wali</td>
                            <td>:</td>
                            <td>
                                {{ $edit->siswa->wali->nama }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <strong>
                    Detail Rapot
                </strong>
                <hr>
                <table class="table table-bordered table-striped">
                    <tbody>
                        @foreach ($rapotDetail as $item)
                            <tr>
                                <td>{{ $item->kelompokRapot->nama_kelompok_rapot }}</td>
                                <td class="text-center" style="width: 10px">:</td>
                                <td class="text-center">{{ $item->nilai }}</td>
                                <td>{{ $item->nilai_teks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <strong>
                    Detail Aspek Penilaian Lainnya
                </strong>
                <hr>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td style="width: 15%">Sikap</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td>
                                {{ $editAspek->sikap }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Kerajinan</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td>
                                {{ $editAspek->kerajinan }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Kebersihan</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td>
                                {{ $editAspek->kebersihan }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Kerapihan</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td>
                                {{ $editAspek->kerapihan }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Eskul</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td>
                                {{ $editAspek->eskul }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endpush
