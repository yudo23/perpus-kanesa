<div class="modal fade" id="modalFilter" aria-labelledby="modalFilter-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title filter-title" id="modalFilter-title">Pencarian</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <form method="get" action="" autocomplete="off" id="frmFilter">
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">Search</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Search (Judul Buku)" value="{{request()->get('search')}}" name="search">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">Penerbit</label>
                        <div class="col-md-9">
                            <select class="form-control select2" name="publisher_id" style="width:100%;">
                                <option value="">==Semua Penerbit==</option>
                                @foreach($publishers as $index => $row)
                                <option value="{{$row->publisher_id}}">{{$row->publisher_name}}</option>
                                @endforeach
                            </select>
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