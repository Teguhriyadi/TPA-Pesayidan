@extends('modules.layouts.main')

@push('modules-title', 'Detail Penilaian Rapot')

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-search"></i> @stack('modules-title')
        </h1>

        <a href="{{ route('modules.report.rapot.index') }}" class="btn btn-outline-danger btn-sm">
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
                    Detail Penilaian
                </strong>

                <hr>

                <table class="table table-bordered table-striped">
                    <tbody>
                        @foreach ($detailRapot as $item)
                            <tr>
                                <td>{{ $item->kelompokRapot->nama_kelompok_rapot }}</td>
                                <td class="text-center" style="width: 5%">:</td>
                                <td class="text-center">
                                    {{ $item->nilai }}
                                </td>
                                <td>{{ $item->nilai_teks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                <strong>
                    Aspek Penilaian
                </strong>

                <hr>

                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Sikap</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td class="text-center">
                                {{ $aspekPenilaian->sikap }}
                            </td>
                        </tr>
                        <tr>
                            <td>Kerajinan</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td class="text-center">
                                {{ $aspekPenilaian->kerajinan }}
                            </td>
                        </tr>
                        <tr>
                            <td>Kebersihan</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td class="text-center">
                                {{ $aspekPenilaian->kebersihan }}
                            </td>
                        </tr>
                        <tr>
                            <td>Kerapihan</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td class="text-center">
                                {{ $aspekPenilaian->kerapihan }}
                            </td>
                        </tr>
                        <tr>
                            <td>Eskul</td>
                            <td class="text-center" style="width: 5%">:</td>
                            <td class="text-center">
                                {{ $aspekPenilaian->eskul }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endpush
