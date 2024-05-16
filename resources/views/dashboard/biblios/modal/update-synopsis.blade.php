<div class="modal fade" id="modalUpdateSynopsis" aria-labelledby="modalUpdateSynopsis-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="modalUpdateSynopsis-title">Ubah URL Sinopsis</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <form method="post" autocomplete="off" id="frmUpdateSynopsis">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">URL Sinopsis <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="URL Sinopsis" name="synopsis_url">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>