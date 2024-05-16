@extends("dashboard.templates.main")

@section("title","Profile")

@section("css")
@endsection("css")

@section("breadcumb")
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-header-title">Ubah Profil</h1>
        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Data Profil</h4>
                <p class="card-title-desc">
                    Pastikan <code> Data Profil</code> di bawah sesuai dengan informasi pribadi Anda.
                </p>
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label">Nama Lengkap</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" value="{{old('name',$result->name)}}" readonly>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label">Username</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Username" value="{{old('phone',$result->username)}}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Foto Profil</h4>
                <p class="card-title-desc">Pastikan <code> Foto Profil</code> di bawah sesuai dengan foto Anda.</p>
                <div class="text-center">
                    <img src="{{ $result->avatar ? asset($result->avatar) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}" alt="user" class="rounded-circle img-thumbnail" style="width: 80px; height: 80px;" required>
                </div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary btn-sm btn-modal-foto">
                        Update Foto
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reset Password</h4>
                <p class="card-title-desc">
                    Anda dapat mengatur ulang <code> password atau kata sandi </code> Anda dengan mengisi form di
                    bawah.
                </p>
                <form method="POST" action="{{route('dashboard.profile.updatePassword')}}" id="frmUpdatePassword">
                    @csrf
                    @method("PUT")
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">Password Saat Ini</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password_old" placeholder="Password Saat Ini" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">Password Baru</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label">Konfirmasi Password Baru</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password Konfirmasi" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary btn-sm" disabled>Ubah Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

<div class="modal fade" id="modalUpdateImage" tabindex="false" aria-labelledby="modalUpdateFotoUpdate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateFotoUpdate">Upload Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="frmUpdateAvatar" action="{{route('dashboard.profile.updateAvatar')}}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Foto <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" name="avatar" accept="image/*" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include("dashboard.templates.loader")

@endsection("content")

@section("script")
<script>
    $(function(){
        $('button[type="submit"]').attr("disabled",false);

        $(document).on("click",".btn-modal-foto",function(e){
            e.preventDefault();
            $('#modalUpdateImage').modal("show");
        })

        $(document).on('submit','#frmUpdateAvatar',function(e){
            e.preventDefault();
            if(confirm("Apakah anda yakin ingin menyimpan data ini ?")){
                $.ajax({
                    url : $("#frmUpdateAvatar").attr("action"),
                    method : "POST",
                    data : new FormData($('#frmUpdateAvatar')[0]),
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
                            responseSuccess(resp.message,"{{route('dashboard.profile.index')}}");
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

        $(document).on('submit','#frmUpdatePassword',function(e){
            e.preventDefault();
            if(confirm("Apakah anda yakin ingin menyimpan data ini ?")){
                $.ajax({
                    url : $("#frmUpdatePassword").attr("action"),
                    method : "POST",
                    data : new FormData($('#frmUpdatePassword')[0]),
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
                            responseSuccess(resp.message,"{{route('dashboard.profile.index')}}");
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