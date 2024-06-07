<form action="{{ route('modules.master.kelompok-penilaian.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="kelompok" class="form-label"> Kelompok </label>
            <input type="text" class="form-control" name="kelompok" id="kelompok"
                placeholder="Masukkan Kelompok Penilaian" value="{{ $edit['kelompok'] }}">
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
