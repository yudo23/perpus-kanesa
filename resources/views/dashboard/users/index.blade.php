@extends("dashboard.templates.main")

@section("title","Pengguna")

@section("css")
@endsection("css")

@section("breadcumb")
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-header-title">Pengguna</h1>
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
                    <div class="col-lg-12">
                        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary btn-sm btn-add"><i class="fa fa-plus"></i> Tambah</a>
                        <a href="#" class="btn btn-warning btn-sm btn-filter text-white"><i class="fa fa-filter"></i> Filter</a>
                        <a href="{{route('dashboard.users.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="table">
                                <table class="table mb-3 table-striped table-bordred">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse($table as $index => $row)
                                        <tr>
                                            <td>{{$table->firstItem() + $index}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->username}}</td>
                                            <td>{{$row->getRoleNames()->implode(', ') }}</td>
                                            <td>
                                                <span class="badge bg-{{$row->status()->class ?? null}}">{{$row->status()->msg ?? null}}</span>
                                            </td>
                                            <td>
                                                <a href="{{route('dashboard.users.show',$row->id)}}" class="btn btn-info btn-sm">Detail</a>
                                                <a href="{{route('dashboard.users.edit',$row->id)}}" class="btn btn-primary btn-sm">Ubah</a>
                                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="{{$row->id}}">Hapus</a>
                                                @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN]) && $row->id != Auth::user()->id)
                                                <a href="{{route('dashboard.users.impersonate',$row->id)}}" class="btn btn-success btn-sm btn-delete">Login</a>
                                                @endif
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

@include("dashboard.users.modal.index")

<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id" />
</form>
@endsection("content")

@section("script")
<script>
    $(function() {
        $(document).on("click", ".btn-filter", function(e) {
            e.preventDefault();

            $("#modalFilter").modal("show");
        });

        $(document).on("click", ".btn-delete", function() {
            let id = $(this).data("id");
            if (confirm("Apakah anda yakin ingin menghapus data ini ?")) {
                $("#frmDelete").attr("action", "{{ route('dashboard.users.destroy', '_id_') }}".replace("_id_", id));
                $("#frmDelete").find('input[name="id"]').val(id);
                $("#frmDelete").submit();
            }
        })
    })
</script>
@endsection