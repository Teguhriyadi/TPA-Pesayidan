@extends('modules.layouts.main')

@push('modules-title', 'Tambah Siswa')

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-plus"></i> @stack('modules-title')
        </h1>

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Data @stack('modules-title')
                    <a style="float: right" class="btn btn-outline-danger" href="{{ route('modules.siswa.index') }}">
                        <i class="fa fa-sign-out-alt"></i> Kembali
                    </a>
                </h6>
            </div>
            <form action="{{ route('modules.siswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="nama" class="form-label"> Nama </label>
                                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama" class="form-control">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="option" class="form-label"> Apakah Sudah Pernah Mendaftarkan Anak? </label>
                                <select name="option" class="form-control" id="option" onchange="optionAnak()">
                                    <option value="">- Pilih -</option>
                                    <option value="Ya">Ya, Sudah Pernah Mendaftarkan</option>
                                    <option value="Belum">Belum, Saya Baru Mau Mendaftarkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="wali" style="display: none">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="namaWali" class="form-label"> Nama Wali </label>
                                    <input type="text" name="namaWali" id="namaWali" placeholder="Masukkan Nama Wali" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomorHpAktif" class="form-label"> Nomor HP Aktif Wali </label>
                                    <input type="text" min="1" name="nomorHpAktif" id="nomorHpAktif" placeholder="Masukkan Nomor HP Aktif Wali" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="waliId" style="display: none">
                        <label for="waliId" class="form-label"> Wali Siswa </label>
                        <select name="waliId" class="form-control" id="waliId">
                            <option value="">- Pilih Wali Siswa -</option>
                            @foreach ($wali as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }} - {{ $item->hasWali->nomorHpAktif }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="jenisKelamin" class="form-label"> Jenis Kelamin </label>
                                <select name="jenisKelamin" class="form-control" id="jenisKelamin">
                                    <option value="">- Pilih -</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tempatLahir" class="form-label"> Tempat Lahir </label>
                                <input type="text" class="form-control" name="tempatLahir" id="tempatLahir" placeholder="Masukkan Tempat Lahir">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggalLahir" class="form-label"> Tanggal Lahir </label>
                                <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" placeholder="Masukkan Tanggal Lahir">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kelasId" class="form-label"> Kelas </label>
                                <select name="kelasId" class="form-control" id="kelasId">
                                    <option value="">- Pilih -</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->namaKelas }} - {{ $item->jenjang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="form-label"> Foto </label>
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                </div>
                <div class="card-footer">
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

@endpush

@push("modules-js")
    <script type="text/javascript">
        function optionAnak() {
            let pilihan = document.getElementById("option").value
            let wali = document.getElementById("wali");
            let waliId = document.getElementById("waliId")

            if (pilihan == "Belum") {
                wali.style.display = "block"
                waliId.style.display = "none"
            } else if (pilihan === "Ya") {
                wali.style.display = "none";
                waliId.style.display = "block";
            } else {
                surat.style.display = "none";
                lainnya.style.display = "none";
            }
        }
    </script>
@endpush
