<form action="{{ route('modules.penilaian.ujian.store') }}" method="POST">
    @csrf
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
            <label for="pilihan" class="form-label"> Kategori Penilaian </label>
            <select name="pilihan" class="form-control" id="pilihan">
                <option value="">- Pilih -</option>
                @foreach ($kelompokPenilaian as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->kelompok }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="pelajaranId" class="form-label"> Pelajaran </label>
                    <select name="pelajaranId" class="form-control" id="pelajaranId">
                        <option value="">- Pilih -</option>
                        <!-- Select Option -->
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="penilaian" class="form-label"> Penilaian </label>
                    <select name="penilaian" class="form-control" id="penilaian">
                        <option value="">- Pilih -</option>
                        <option {{ $edit->penilaian == "Sangat Baik" ? 'selected' : '' }} value="Sangat Baik">Sangat Baik</option>
                        <option {{ $edit->penilaian == "Baik" ? 'selected' : '' }} value="Baik">Baik</option>
                        <option {{ $edit->penilaian == "Cukup" ? 'selected' : '' }} value="Cukup">Cukup</option>
                        <option {{ $edit->penilaian == "Kurang" ? 'selected' : '' }} value="Kurang">Kurang</option>
                        <option {{ $edit->penilaian == "Sangat Kurang" ? 'selected' : '' }} value="Sangat Kurang">Sangat Kurang</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="keterangan" class="form-label"> Keterangan </label>
            <textarea name="keterangan" class="form-control" id="keterangan" rows="5" placeholder="Masukkan Keterangan">{{ $edit->keterangan }}</textarea>
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
