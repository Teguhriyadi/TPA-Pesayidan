@extends('modules.layouts.main')

@push('modules-title', 'Profil Saya')

@push('modules-css')
    <link href="{{ url('/theme') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('modules-content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-user"></i> @stack('modules-title')
        </h1>

        @if (Auth::user()->akses == 'ADMIN')
            <form action="{{ route('modules.akun.profil.update', ['id' => $profilSaya->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card shadow mb-4 mt-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fa fa-image"></i> Ganti Profil
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    @if (empty($profilSaya->foto))
                                        <img src="{{ URL::asset('images/user-default.png') }}" alt="Gambar Profil"
                                            style="width: 100%;">
                                    @else
                                        <input type="hidden" name="gambarLama" value="{{ $profilSaya->foto }}">
                                        <img src="{{ url('/storage/' . $profilSaya->foto) }}" alt="Gambar Profil"
                                            style="width: 100%;">
                                    @endif
                                    <input type="file" class="form-control mt-4" name="foto" id="foto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow mb-4 mt-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fa fa-edit"></i> Update Profil Saya
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama" class="control-label"> Nama </label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Masukkan Nama" value="{{ $profilSaya->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="username" class="control-label"> Username </label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Masukkan Username" value="{{ $profilSaya->username }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="akses" class="control-label"> Akses </label>
                                    <input type="text" class="form-control" name="akses" id="akses"
                                        value="{{ $profilSaya->akses }}" disabled>
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
                        </div>
                    </div>
                </div>
            </form>
        @elseif(Auth::user()->akses == 'GURU')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <button onclick="lihatProfil(`{{ $profilSaya->id }}`)" type="button"
                        class="btn btn-outline-primary btn-block mt-4" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-search"></i> Lihat Profil Saya
                    </button>
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fa fa-search"></i> Data Profil Saya
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username" class="form-label"> Username </label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Masukkan Username" value="{{ $profilSaya->username }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="akses" class="form-label"> Akses </label>
                                <input type="text" class="form-control" name="akses" id="akses"
                                    placeholder="Masukkan Akses" value="{{ $profilSaya->akses }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-3">
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fa fa-edit"></i> Update Data Diri
                            </h6>
                        </div>
                        <form action="{{ route('modules.akun.profil.update', ['id' => $profilSaya->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="nip" class="form-label"> NIP </label>
                                            <input type="text" class="form-control" name="nip" id="nip"
                                                placeholder="Masukkan NIP" value="{{ $profilSaya->hasGuru->nip }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama" class="form-label"> Nama </label>
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                placeholder="Masukkan Nama" value="{{ $profilSaya->nama }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="jenisKelamin" class="form-label"> Jenis Kelamin </label>
                                            <select name="jenisKelamin" class="form-control" id="jenisKelamin">
                                                <option value="">- Pilih -</option>
                                                <option value="L"
                                                    {{ $profilSaya->hasGuru->jenisKelamin == 'L' ? 'selected' : '' }}>Laki
                                                    - Laki</option>
                                                <option value="P"
                                                    {{ $profilSaya->hasGuru->jenisKelamin == 'P' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="tempatLahir" class="form-label"> Tempat Lahir </label>
                                            <input type="text" class="form-control" name="tempatLahir"
                                                id="tempatLahir" placeholder="Masukkan Tempat Lahir"
                                                value="{{ $profilSaya->hasGuru->tempatLahir }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="tanggalLahir" class="form-label"> Tanggal Lahir </label>
                                            <input type="date" class="form-control" name="tanggalLahir"
                                                id="tanggalLahir" value="{{ $profilSaya->hasGuru->tanggalLahir }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="form-label"> Alamat </label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ $profilSaya->hasGuru->alamat }}</textarea>
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
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fa fa-image"></i> Profil Saya
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="modal-content-profil">
                            <!-- Detail Profil Image -->
                        </div>
                    </div>
                </div>
            </div>


        @endif
    </div>

@endpush

@push('modules-js')

    <script type="text/javascript">
        function lihatProfil(id) {
            $.ajax({
                url: "{{ url('/modules/akun/profil-saya') }}" + "/" + id + "/lihat-profil",
                type: "GET",
                success: function(response) {
                    $("#modal-content-profil").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>

@endpush
