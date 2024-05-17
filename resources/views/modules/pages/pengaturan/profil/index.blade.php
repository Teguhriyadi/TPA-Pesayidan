@extends('modules.layouts.main')

@push('modules-title', 'Profil Madrasah')

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
                </h6>
            </div>
            @if (empty($profil))
            <form action="{{ route('modules.pengaturan.profil.store') }}" method="POST">
                @csrf
            @else
                <form action="{{ route('modules.pengaturan.profil.update') }}" method="POST">
                    @csrf
                    @method("PUT")
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_mdta"> Nama MDTA </label>
                                <input type="text" class="form-control" name="nama_mdta" id="nama_mdta"
                                    placeholder="Masukkan Nama MDTA" value="{{ empty($profil) ? '' : $profil->nama_mdta }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="no_statistik"> No. Statistik </label>
                                <input type="text" class="form-control" name="no_statistik" id="no_statistik"
                                    placeholder="Masukkan No. Statistik"
                                    value="{{ empty($profil) ? '' : $profil->no_statistik }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="provinsi"> Provinsi </label>
                                <input type="text" class="form-control" name="provinsi" id="provinsi"
                                    placeholder="Masukkan Provinsi" value="{{ empty($profil) ? '' : $profil->provinsi }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kabupaten_kota"> Kabupaten / Kota </label>
                                <input type="text" class="form-control" name="kabupaten_kota" id="kabupaten_kota"
                                    placeholder="Masukkan Kabupaten / Kota"
                                    value="{{ empty($profil) ? '' : $profil->kabupaten_kota }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kecamatan"> Kecamatan </label>
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan"
                                    placeholder="Masukkan Kecamatan" value="{{ empty($profil) ? '' : $profil->kecamatan }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ empty($profil) ? '' : $profil->alamat }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-outline-danger">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-outline-success">
                        <i class="fa fa-edit"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endpush
