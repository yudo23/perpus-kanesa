<div class="modal fade" id="modalFilter" aria-labelledby="modalFilter-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="modalFilter-title">Pencarian</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <form method="get" action="" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">Search</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Search (Nama,NISN)" value="{{request()->get('search')}}" name="search">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select class="form-control select2" name="status" style="width:100%;">
                                <option value="">==Semua Status==</option>
                                @foreach($status as $index => $row)
                                <option value="{{$index}}">{{$row}}</option>
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

<div class="modal fade" id="modalImportExcel" aria-labelledby="modalImportExcel-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="modalImportExcel-title">Import Data</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <form method="POST" action="{{route('dashboard.students.importExcel')}}" autocomplete="off" id="frmImportExcel">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3 row">
                        <label class="col-md-2 col-form-label">File <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" name="file" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a class="btn btn-success" href="{{URL::to('/')}}/imports/students.xlsx">Format</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>