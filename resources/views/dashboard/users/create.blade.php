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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Menambah Data Pengguna</h4>
                <p class="card-title-desc">Isi form di bawah untuk menambah <code> Data Pengguna</code>.</p>
                <form method="POST" action="{{route('dashboard.users.store')}}" id="frmStore">
                    @csrf
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{old('name')}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Username <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Password <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password Konfirmasi" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Roles<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select-role" name="roles" style="width: 100%;" required>
                                <option value="">==Pilih Role Pengguna==</option>
                                @foreach ($roles as $index => $row)
                                <option value="{{$row}}">{{$row}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Status<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select-role" name="status" style="width: 100%;" required>
                                <option value="">==Pilih Status==</option>
                                @foreach ($status as $index => $row)
                                <option value="{{$index}}">{{$row}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('dashboard.users.index')}}" class="btn btn-warning btn-sm text-white">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm" disabled>Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@include("dashboard.templates.loader")
@endsection("content")

@section("script")
<script>
    $(function(){
        $('button[type="submit"]').attr("disabled",false);

        $(document).on('submit','#frmStore',function(e){
            e.preventDefault();
            if(confirm("Apakah anda yakin ingin menyimpan data ini ?")){
                $.ajax({
                    url : $("#frmStore").attr("action"),
                    method : "POST",
                    data : new FormData($('#frmStore')[0]),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType : "JSON",
                    beforeSend : function(){
                        return openLoader();
                    },
                    success : function(resp){
                        if(resp.success == false){
                            responseFailed(resp.message);
                        }
                        else{
                            responseSuccess(resp.message,"{{route('dashboard.users.index')}}");
                        }
                    },
                    error: function (request, status, error) {
                        if(request.status == 422){
                            responseFailed(request.responseJSON.message);
                        }
                        else{
                            responseInternalServerError();
                        }
                    },
                    complete :function(){
                        return closeLoader();
                    }
                })
            }
        })
    })
</script>
@endsection("script")