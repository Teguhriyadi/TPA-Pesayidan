<form action="{{ route('modules.master.kelas.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="namaKelas" class="form-label"> Nama Kelas </label>
            <input type="text" class="form-control" name="namaKelas" id="namaKelas"
                placeholder="Masukkan Nama Kelas" value="{{ $edit['namaKelas'] }}">
        </div>
        <div class="form-group">
            <label for="jenjang" class="form-label"> Jenjang </label>
            <select name="jenjang" class="form-control" id="jenjang">
                <option value="">- Pilih -</option>
                <option value="TK" {{ $edit->jenjang == "TK" ? 'selected' : '' }} >TK</option>
                <option value="TPA" {{ $edit->jenjang == "TPA" ? 'selected' : '' }} >TPA</option>
                <option value="DTA" {{ $edit->jenjang == "DTA" ? 'selected' : '' }} >DTA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi" class="form-label"> Deskripsi </label>
            <textarea name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi" id="deskripsi" rows="5">{{ $edit->deskripsi }}</textarea>
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
