<form action="{{ route('modules.master.tahun_ajaran.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="tahun_ajaran" class="form-label"> Tahun Ajaran </label>
            <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran"
                placeholder="Masukkan Tahun Ajaran" value="{{ $edit['tahun_ajaran'] }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-outline-danger btn-sm">
            <i class="fa fa-times"></i> Batal
        </button>
        <button type="submit" class="btn btn-outline-success btn-sm">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</form>
