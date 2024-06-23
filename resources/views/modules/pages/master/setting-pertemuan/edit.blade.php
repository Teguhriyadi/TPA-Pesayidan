<form action="{{ route('modules.setting-pertemuan.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="jumlah" class="form-label"> Jumlah Pertemuan Semester Sekarang </label>
            <input type="number" class="form-control" name="jumlah" id="jumlah"
                placeholder="0" value="{{ $edit['jumlah'] }}" min="1">
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
