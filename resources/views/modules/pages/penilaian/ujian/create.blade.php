@extends('modules.layouts.main')

@push('modules-title', 'Form Penilaian Ujian')

@push('modules-content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fa fa-edit"></i> @stack('modules-title')
        </h1>

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Tambah @stack('modules-title')
                </h6>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="wizardTab" role="tablist">
                    @foreach ($kelompokPenilaian as $index => $kelompok)
                        <li class="nav-item">
                            <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="step{{ $index + 1 }}-tab"
                                data-toggle="tab" href="#step{{ $index + 1 }}" role="tab"
                                aria-controls="step{{ $index + 1 }}"
                                aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                {{ $kelompok->kelompok }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mt-3" id="wizardTabContent">
                    @foreach ($kelompokPenilaian as $index => $kelompok)
                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="step{{ $index + 1 }}"
                            role="tabpanel" aria-labelledby="step{{ $index + 1 }}-tab">
                            <form method="POST" action="{{ route('modules.penilaian.ujian.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="siswaId" class="form-label"> Nama Siswa </label>
                                            <select name="siswaId" class="form-control" id="siswaId">
                                                <option value="">- Pilih -</option>
                                                @foreach ($siswa as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nama }} | {{ $item->jenisKelamin == "L" ? "Laki - Laki" : "Perempuan" }} | {{ $item->kelas->namaKelas }} - {{ $item->kelas->jenjang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php for ($i = 1; $i <= 3; $i++) : ?>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="pelajaranId" class="form-label"> Pelajaran </label>
                                            <select name="pelajaranId[]" class="form-control" id="pelajaranId">
                                                <option value="">- Pilih -</option>
                                                @foreach ($kelompok->pelajaran as $pelajaran)
                                                <option value="{{ $pelajaran->id }}">
                                                    {{ $pelajaran->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="nilai" class="form-label"> Nilai </label>
                                            <input type="number" class="form-control" name="nilai[]" min="10" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <?php endfor ?>
                                <hr>
                                <button type="reset" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endpush
