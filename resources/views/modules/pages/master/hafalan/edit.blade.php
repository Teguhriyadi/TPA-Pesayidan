<form action="{{ route('modules.master.pelajaran.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="nama" class="form-label"> Nama Pelajaran </label>
            <input type="text" class="form-control" name="nama" id="nama"
                placeholder="Masukkan Nama" value="{{ $edit['nama'] }}">
        </div>
        <div class="form-group">
            <label for="kelompokPenilaianId" class="form-label"> Kelompok Penilaian </label>
            <select name="kelompokPenilaianId" class="form-control" id="kelompokPenilaianId">
                <option value="">- Pilih -</option>
                @foreach ($kelompokPenilaian as $item)
                    <option value="{{ $item->id }}" {{ $edit->kelompokPenilaianId == $item->id ? 'selected' : '' }}>
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
