<form action="{{ route('modules.master.jadwal-kelas-guru.store') }}" method="POST">
    @csrf
    <input type="hidden" name="id_jadwal" value="{{ $id_jadwal }}">
    <input type="hidden" name="id_siswa" value="{{ $id_siswa }}">
    <input type="hidden" name="pertemuan" value="{{ $pertemuan }}">
    <div class="modal-body">
        <div class="form-group">
            <label for="nilai" class="form-label"> Nilai </label>
            <input type="number" class="form-control" name="nilai" id="nilai" placeholder="Masukkan Nilai" min="1">
        </div>
        <div class="form-group">
            <label for="pertemuan" class="form-label"> Pertemuan </label>
            <input type="text" class="form-control" name="pertemuan" id="pertemuan" value="Pertemuan Ke - {{ $pertemuan }}" disabled>
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
