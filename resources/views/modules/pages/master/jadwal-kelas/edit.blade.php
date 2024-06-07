<form action="{{ route('modules.master.jadwal-kelas.update', ['id' => $edit->id]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="kelasPelajaranId" class="form-label"> Kelas Pelajaran </label>
            <select name="kelasPelajaranId" class="form-control" id="kelasPelajaranId">
                <option value="">- Pilih -</option>
                @foreach ($kelasPelajaran as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $edit->kelasPelajaranId ? 'selected' : '' }} >
                        {{ $item->kelas->namaKelas }} - {{ $item->kelas->jenjang }} | {{ $item->pelajaran->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="hari" class="form-label"> Hari </label>
            <select name="hari" class="form-control" id="hari">
                <option value="">- Pilih -</option>
                <option value="Senin" {{ $edit->hari == "Senin" ? 'selected' : '' }} >Senin</option>
                <option value="Selasa" {{ $edit->hari == "Selasa" ? 'selected' : '' }} >Selasa</option>
                <option value="Rabu" {{ $edit->hari == "Rabu" ? 'selected' : '' }} >Rabu</option>
                <option value="Kamis" {{ $edit->hari == "Kamis" ? 'selected' : '' }} >Kamis</option>
                <option value="Jumat" {{ $edit->hari == "Jumat" ? 'selected' : '' }} >Jumat</option>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="mulai" class="form-label"> Mulai </label>
                    <input type="time" class="form-control" name="mulai" id="mulai" value="{{ $edit->mulai }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="selesai" class="form-label"> Selesai </label>
                    <input type="time" class="form-control" name="selesai" id="selesai" value="{{ $edit->selesai }}" >
                </div>
            </div>
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
