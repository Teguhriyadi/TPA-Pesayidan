<form action="{{ route('modules.master.kelompok-rapot.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="nama_kelompok_rapot" class="form-label"> Kelompok Penilaian Rapot </label>
            <input type="text" class="form-control" name="nama_kelompok_rapot" id="nama_kelompok_rapot"
                placeholder="Masukkan Bagian Kelompok Rapot" value="{{ $edit['nama_kelompok_rapot'] }}">
        </div>
        <div class="form-group">
            <label for="kelompok_rapot" class="form-label"> Kategori </label>
            <select name="kategoriId" class="form-control" id="kategoriId">
                <option value="">- Pilih -</option>
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $edit["kategoriId"] ? 'selected' : '' }} >
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach
            </select>
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
