<form action="{{ route('modules.master.kategori.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="nama_kategori" class="form-label"> Nama Kategori </label>
            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori"
                placeholder="Masukkan Nama Kategori" value="{{ $edit['nama_kategori'] }}">
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
