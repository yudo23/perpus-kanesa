@extends("dashboard.templates.main")

@section("title","Buku")

@section("css")
@endsection("css")

@section("breadcumb")
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-header-title">Buku</h1>
        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30 px-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-12 d-flex">
                        <a href="#" class="btn btn-warning btn-sm btn-filter text-white" style="margin-right: 10px;"><i class="fa fa-filter"></i> Filter</a>
                        <div class="dropdown" style="margin-right: 10px;">
                            <a class="btn btn-info btn-sm dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-file"></i> Export
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item btn-export-pdf" href="#">PDF</a></li>
                            </ul>
                        </div>
                        <a href="{{route('dashboard.biblios.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="table">
                                <table class="table mb-3 table-striped table-bordred">
                                    <thead>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Total Buku</th>
                                        <th>Sinopsis</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse($table as $index => $row)
                                        <tr>
                                            <td>{{$table->firstItem() + $index}}</td>
                                            <td>{{$row->title}}</td>
                                            <td>{{$row->publisher->publisher_name ?? null}}</td>
                                            <td>{{$row->publish_year}}</td>
                                            <td>{{count($row->items)}}</td>
                                            <td>
                                                @if(!empty($row->synopsis_url))
                                                <a href="{{route('dashboard.biblios.qrcode',$row->biblio_id)}}">{!! QrCode::size(50)->generate($row->synopsis_url) !!}</a>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{route('dashboard.biblios.show',$row->biblio_id)}}" class="btn btn-info btn-sm" style="margin-right:10px;">Detail</a>
                                                <a href="#" class="btn btn-primary btn-sm btn-update-synopsis" data-id="{{$row->biblio_id}}" data-url="{{$row->synopsis_url}}">Ubah URL Sinopsis</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">No data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $table->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("dashboard.biblios.modal.index")
@include("dashboard.biblios.modal.update-synopsis")

@endsection("content")

@section("script")
<script>
    $(function() {
        $(document).on("click", ".btn-filter", function(e) {
            e.preventDefault();

            $('#modalFilter').find('.filter-title').html("Pencarian");
            $("#frmFilter").attr("action", "{{ route('dashboard.biblios.index') }}");
            $("#modalFilter").modal("show");
        });

        $(document).on("click", ".btn-export-pdf", function(e) {
            e.preventDefault();

            $('#modalFilter').find('.filter-title').html("Export PDF");
            $("#frmFilter").attr("action", "{{ route('dashboard.biblios.exportPDF') }}");
            $("#modalFilter").modal("show");
        });

        $(document).on("click", ".btn-update-synopsis", function(e) {
            e.preventDefault();
            let id = $(this).data("id");
            let url = $(this).data("url");

            $("#frmUpdateSynopsis").attr("action", "{{ route('dashboard.biblios.updateSynopsis', '_id_') }}".replace("_id_", id));
            $("#frmUpdateSynopsis").find('input[name="synopsis_url"]').val(url);
            $("#modalUpdateSynopsis").modal("show");
        });

        $(document).on('submit', '#frmUpdateSynopsis', function(e) {
            e.preventDefault();
            if (confirm("Apakah anda yakin ingin menyimpan data ini ?")) {
                $.ajax({
                    url: $("#frmUpdateSynopsis").attr("action"),
                    method: "POST",
                    data: new FormData($('#frmUpdateSynopsis')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "JSON",
                    beforeSend: function() {
                        return openLoader();
                    },
                    success: function(resp) {
                        if (resp.success == false) {
                            responseFailed(resp.message);
                        } else {
                            responseSuccess(resp.message, "{{route('dashboard.biblios.index')}}");
                        }
                    },
                    error: function(request, status, error) {
                        if (request.status == 422) {
                            responseFailed(request.responseJSON.message);
                        } else {
                            responseInternalServerError();
                        }
                    },
                    complete: function() {
                        return closeLoader();
                    }
                })
            }
        })
    })
</script>
@endsection