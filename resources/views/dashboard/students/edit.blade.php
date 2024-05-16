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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Mengubah Data Siswa</h4>
                <p class="card-title-desc">Isi form di bawah untuk mengubah <code> Data Siswa</code>.</p>
                <form method="POST" action="{{route('dashboard.students.update',$result->id)}}" id="frmUpdate">
                    @csrf
                    @method("PUT")
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{old('name',$result->name)}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">NISN <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="username" placeholder="NISN" value="{{old('username',$result->username)}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Jurusan <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="study_program" placeholder="Jurusan" value="{{old('study_program',$result->study_program)}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Offering <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="offering" placeholder="Offering" value="{{old('offering',$result->offering)}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Password <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password Konfirmasi">
                            <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Status<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select-role" name="status" style="width: 100%;" required>
                                <option value="">==Pilih Status==</option>
                                @foreach ($status as $index => $row)
                                <option value="{{$index}}" @if($index == $result->status) selected @endif>{{$row}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('dashboard.students.index')}}" class="btn btn-warning btn-sm text-white">Kembali</a>
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

        $(document).on('submit','#frmUpdate',function(e){
            e.preventDefault();
            if(confirm("Apakah anda yakin ingin menyimpan data ini ?")){
                $.ajax({
                    url : $("#frmUpdate").attr("action"),
                    method : "POST",
                    data : new FormData($('#frmUpdate')[0]),
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
                            responseSuccess(resp.message,"{{route('dashboard.students.index')}}");
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