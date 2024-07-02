@extends('modules.layouts.main')

@push('modules-title', 'Edit Siswa')

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-edit"></i> @stack('modules-title')
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
            <form action="{{ route('modules.siswa.update', ['id' => $edit->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if (!empty($edit->foto))
                    <input type="hidden" name="gambarLama" value="{{ $edit->foto }}">
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="nama" class="form-label"> Nama </label>
                                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama"
                                    class="form-control" value="{{ $edit->nama }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="jenisKelamin" class="form-label"> Jenis Kelamin </label>
                                <select name="jenisKelamin" class="form-control" id="jenisKelamin">
                                    <option value="">- Pilih -</option>
                                    <option value="L" {{ $edit->jenisKelamin == 'L' ? 'selected' : '' }}>Laki - Laki
                                    </option>
                                    <option value="P" {{ $edit->jenisKelamin == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tempatLahir" class="form-label"> Tempat Lahir </label>
                                <input type="text" class="form-control" name="tempatLahir" id="tempatLahir"
                                    placeholder="Masukkan Tempat Lahir" value="{{ $edit->tempatLahir }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggalLahir" class="form-label"> Tanggal Lahir </label>
                                <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir"
                                    placeholder="Masukkan Tanggal Lahir" value="{{ $edit->tanggalLahir }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kelasId" class="form-label"> Kelas </label>
                                <select name="kelasId" class="form-control" id="kelasId">
                                    <option value="">- Pilih -</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $edit->kelasId ? 'selected' : '' }}>
                                            {{ $item->namaKelas }} - {{ $item->jenjang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ $edit->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="form-label"> Foto </label>
                        @if (!empty($edit->foto))
                        <br>
                            <img src="{{ url('/storage/' . $edit->foto) }}" alt="Image Siswa" class="img-responsive mb-4" style="width: 150px; height: 150px">
                        @endif
                        <input type="file" class="form-control" name="foto" id="foto">
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
