<form action="{{ route('modules.master.orang-tua.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="nama" class="form-label"> Nama </label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Wali" value="{{ $edit->nama }}">
        </div>
        <div class="form-group">
            <label for="username" class="form-label"> Username </label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" value="{{ $edit->username }}" readonly>
        </div>
        <div class="form-group">
            <label for="nomorHpAktif" class="form-label"> NomorHpAktif </label>
            <input type="number" class="form-control" name="nomorHpAktif" id="nomorHpAktif" placeholder="0" min="1" value="{{ $edit->nomorHpAktif }}">
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
