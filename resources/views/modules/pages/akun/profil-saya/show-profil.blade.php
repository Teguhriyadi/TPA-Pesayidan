<form action="{{ route('modules.akun.profil.update-image', ['id' => $detail->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group d-flex justify-content-center">
            @if (empty($detail->foto))
                <img src="{{ URL::asset('images/user-default.png') }}" alt="Default User Image" style="width: 300px; height: auto">
            @else
                <input type="hidden" name="gambarLama" value="{{ $detail->foto }}">
                <img src="{{ url('/storage/' . $detail->foto) }}" alt="User Image" style="width: 300px; height: auto">
            @endif
        </div>
        <div class="form-group">
            <label for="gantiGambar" class="form-label"> Ganti Gambar </label>
            <input type="file" class="form-control" name="gambarNew" id="gambarNew">
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
