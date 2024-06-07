<form action="{{ route('modules.master.pembelajaran.hafalan.update', ['id' => $edit->id]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="pelajaranId" class="form-label"> Pelajaran </label>
            <select name="pelajaranId" class="form-control" id="pelajaranId">
                <option value="">- Pilih -</option>
                @foreach ($pelajaran as $item)
                    <option value="{{ $item->id }}" {{ $edit->pelajaranId == $item->id ? 'selected' : '' }}>
                        {{ $item->kode }} - {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="siswaId" class="form-label"> Nama Siswa </label>
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
            <label for="rating" class="form-label"> Nilai </label>
            <select name="rating" class="form-control" id="rating">
                <option value="">- Pilih -</option>
                <option value="1" {{ $edit->rating == "1" ? 'selected' : '' }} >Sangat Baik</option>
                <option value="2" {{ $edit->rating == "2" ? 'selected' : '' }} >Baik</option>
                <option value="3" {{ $edit->rating == "3" ? 'selected' : '' }} >Cukup</option>
                <option value="4" {{ $edit->rating == "4" ? 'selected' : '' }} >Kurang</option>
                <option value="5" {{ $edit->rating == "5" ? 'selected' : '' }} >Sangat Kurang</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan" class="form-label"> Keterangan </label>
            <textarea name="keterangan" class="form-control" id="keterangan" rows="5" placeholder="Masukkan Keterangan">{{ $edit->keterangan ? $edit->keterangan : '' }}</textarea>
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
