<form action="{{ route('modules.master.hafalan.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="nama" class="form-label"> Nama </label>
            <input type="text" class="form-control" name="nama" id="nama"
                placeholder="Masukkan Nama" value="{{ $edit['nama'] }}">
        </div>
        <div class="form-group">
            <label for="kelompokPelajaranId" class="form-label"> Kelompok Penilaian </label>
            <select name="kelompokPelajaranId" class="form-control" id="kelompokPelajaranId">
                <option value="">- Pilih -</option>
                @foreach ($kelompokPenilaian as $item)
                    <option value="{{ $item->id }}" {{ $edit->kelompokPelajaranId == $item->id ? 'selected' : '' }} >
                        {{ $item->kelompok }}
                    </option>
                @endforeach
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
