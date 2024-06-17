<form action="{{ route('modules.master.kelompok-penilaian.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="kelompok" class="form-label"> Kelompok </label>
            <input type="text" class="form-control" name="kelompok" id="kelompok"
                placeholder="Masukkan Kelompok Penilaian" value="{{ $edit['kelompok'] }}">
        </div>
        <div class="form-group">
            <label for="kategori" class="form-label"> Kategori </label>
            <select name="kategori" class="form-control" id="kategori">
                <option value="">- Pilih -</option>
                <option {{ $edit->kategori == "Ujian" ? 'selected' : '' }} value="Ujian">Ujian</option>
                <option {{ $edit->kategori == "Pelajaran" ? 'selected' : '' }} value="Pelajaran">Pelajaran</option>
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
