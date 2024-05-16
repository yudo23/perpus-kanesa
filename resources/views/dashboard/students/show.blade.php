@extends("dashboard.templates.main")

@section("title","Siswa")

@section("css")
@endsection("css")

@section("breadcumb")
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-header-title">Siswa</h1>
        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row pb-5">
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-body">
                <div class="text-center d-flex flex-column h-100">
                    <div>
                        <img src="{{ $result->avatar ? asset($result->avatar) : 'https://avatars.dicebear.com/api/initials/'. $result->name .'.png?background=blue&width=100&height=100' }}"
                                alt=""
                                class="avatar-lg mx-auto img-thumbnail rounded-circle">
                    </div>

                    <div class="mt-3 d-flex justify-content-between flex-column flex-1">
                        <div class="mx-auto">
                            <h6>{{ $result->name }}</h6>
                            <p class="text-body mt-1 mb-1">
                                <b>{{$result->getRoleNames()->implode(', ') }}</b>
                            </p>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{route('dashboard.users.edit',$result->id)}}" class="btn btn-primary btn-sm" style="margin-right: 10px;">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="{{$result->id}}">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Informasi Personal</h5>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Nama Lengkap</p>
                    <h6 class="">{{ $result->name }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">NISN</p>
                    <h6 class="">{{ $result->username }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Program Studi</p>
                    <h6 class="">{{ $result->study_program }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Offering</p>
                    <h6 class="">{{ $result->offering }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Status</p>
                    <h6 class="">
                        <span class="badge bg-{{$result->status()->class ?? null}}">{{$result->status()->msg ?? null}}</span>
                    </h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Tanggal Dibuat</p>
                    <h6 class="">{{ date('d-m-Y H:i:s',strtotime($result->created_at)) }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Tanggal Diperbarui</p>
                    <h6 class="">{{ date('d-m-Y H:i:s',strtotime($result->updated_at)) }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id"/>
</form>
@endsection("content")

@section("script")
<script>
    $(function(){
        $(document).on("click", ".btn-delete", function() {
            let id = $(this).data("id");
            if (confirm("Apakah anda yakin ingin menghapus data ini ?")) {
                $("#frmDelete").attr("action", "{{ route('dashboard.students.destroy', '_id_') }}".replace("_id_", id));
                $("#frmDelete").find('input[name="id"]').val(id);
                $("#frmDelete").submit();
            }
        })
    })
</script>
@endsection