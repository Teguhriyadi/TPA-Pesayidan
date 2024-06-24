<form action="{{ route('modules.master.jadwal-kelas-guru.update', ['idJadwal' => $jadwalId, 'idSiswa' => $siswaId, 'nilaiId' => $edit->id]) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="nilai" class="form-label"> Nilai </label>
            <input type="number" class="form-control" name="nilai" id="nilai" placeholder="0" min="1" value="{{ $edit->nilai }}">
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
