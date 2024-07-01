<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Apakah Anda Yakin Ingin Keluar?
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Klik <strong>Logout</strong> Untuk Keluar dari Website.
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger btn-sm" type="button" data-dismiss="modal">
                    <i class="fa fa-times"></i> Kembali
                </button>
                <a class="btn btn-outline-primary btn-sm" href="{{ route('authorization.logout') }}">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>
