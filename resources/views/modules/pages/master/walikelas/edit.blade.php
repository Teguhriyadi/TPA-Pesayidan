<form action="{{ route('modules.walikelas.update', ['id' => $edit->id]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="guru_id" class="form-label"> Nama Guru </label>
            <select name="guru_id" class="form-control" id="guru_id">
                <option value="">- Pilih -</option>
                @foreach ($guru as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $edit->guru_id ? 'selected' : '' }} >
                        NIP : {{ $item->nip }} - {{ $item->users->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kelas_id" class="form-label"> Kelas </label>
            <select name="kelas_id" class="form-control" id="kelas_id">
                <option value="">- Pilih -</option>
                @foreach ($kelas as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $edit->kelas_id ? 'selected' : '' }} >
                        {{ $item->namaKelas }}
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
