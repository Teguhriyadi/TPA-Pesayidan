<form action="{{ route('modules.penilaian.harian.store') }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="siswaId" class="form-label"> Siswa </label>
            <select name="siswaId" class="form-control" id="siswaId">
                <option value="">- Pilih -</option>
                @foreach ($siswa as $item)
                    <option value="{{ $item->id }}" {{ $edit->siswaId == $item->id ? 'selected' : '' }} >
                        {{ $item->nama }} - {{ $item->kelas->namaKelas }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pilihanEdit" class="form-label"> Kategori Penilaian </label>
            <select name="pilihanEdit" class="form-control" id="pilihanEdit" onchange="kategoriPenilaianEdit()">
                <option value="">- Pilih -</option>
                <option value="Surat">Surat</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div id="suratEdit" style="display: none;">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="jilidSurat" class="form-label"> Jilid Surat </label>
                        <input type="number" class="form-control" name="jilidSurat" id="jilidSurat" placeholder="0" value="{{ $edit->jilidSurat }}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="halAyat" class="form-label"> Ayat Halaman </label>
                        <input type="number" class="form-control" name="halAyat" id="halAyat" placeholder="0" value="{{ $edit->halAyat }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group" id="lainnyaEdit" style="display: none">
            <label for="materiId" class="form-label"> Materi / Hafalan </label>
            <select name="materiId" class="form-control" id="materiId">
                <option value="">- Pilih -</option>
                @foreach ($materi as $item)
                    <option value="{{ $item->id }}" {{ $edit->materiId == $item->id ? 'selected' : '' }} >
                        {{ $item->kode }} - {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="penilaian" class="form-label"> Penilaian </label>
            <select name="penilaian" class="form-control" id="penilaian">
                <option value="">- Pilih -</option>
                <option {{ $edit->penilaian == "Lancar" ? 'selected' : '' }} value="Lancar">Lancar</option>
                <option {{ $edit->penilaian == "Tidak Lancar" ? 'selected' : '' }} value="Tidak Lancar">Tidak Lancar</option>
                <option {{ $edit->penilaian == "Kurang Lancar" ? 'selected' : '' }} value="Kurang Lancar">Kurang Lancar</option>
                <option {{ $edit->penilaian == "Setengah Lancar" ? 'selected' : '' }} value="Setengah Lancar">Setengah Lancar</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-outline-danger">
            <i class="fa fa-times"></i> Batal
        </button>
        <button type="submit" class="btn btn-outline-success">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</form>
