<form action="{{ route('modules.master.kelas-pelajaran.update', ['id' => $edit['id']]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="pelajaran_id" class="form-label"> Nama Pelajaran </label>
            <select name="pelajaran_id" class="form-control" id="pelajaran_id">
                <option value="">- Pilih -</option>
                @foreach ($pelajaran as $item)
                    <option value="{{ $item->id }}" {{ $edit->pelajaran_id == $item->id ? 'selected' : '' }} >
                        {{ $item->kode }} - {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kelas_id" class="form-label"> Kelas </label>
            <select name="kelas_id" class="form-control" id="kelas_id">
                <option value="">- Pilih -</option>
                @foreach ($kelas as $item)
                    <option value="{{ $item->id }}" {{ $edit->kelas_id == $item->id ? 'selected' : '' }}>
                        {{ $item->namaKelas }} - {{ $item->jenjang }}
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
