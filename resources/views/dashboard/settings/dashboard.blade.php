@extends("dashboard.templates.main")

@section("title","Pengaturan Dashboard")

@section("css")
@endsection("css")

@section("breadcumb")
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-header-title">Pengaturan Dashboard</h1>
        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('dashboard.settings.dashboard.update')}}" id="frmUpdate" autocomplete="off">
                    @csrf
                    @method("PUT")
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Nama Aplikasi <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" placeholder="Nama Aplikasi" value="{{old('name',$result->name)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo Large (Dark)</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_large_dark))
                                    <div class="mb-2" style="width: 150px;">
                                        <img src="{{asset($result->logo_large_dark)}}" style="width: 100%">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_large_dark" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 1018px x 200px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo Large (Light)</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_large_light))
                                    <div class="mb-2" style="width: 150px;">
                                        <img src="{{asset($result->logo_large_light)}}" style="width: 100%">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_large_light" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 198px x 198px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo Mini (Dark)</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_mini_dark))
                                    <div class="mb-2" style="width: 150px;">
                                        <img src="{{asset($result->logo_mini_dark)}}" style="width: 100%">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_mini_dark" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 198px x 198px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo Mini (Light)</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_mini_light))
                                    <div class="mb-2" style="width: 150px;">
                                        <img src="{{asset($result->logo_mini_light)}}" style="width: 100%">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_mini_light" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 198px x 198px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Favicon</label>
                                <div class="col-md-10">
                                    @if(!empty($result->favicon))
                                    <div class="mb-2" style="width: 150px;">
                                        <img src="{{asset($result->favicon)}}" style="width: 100%">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="favicon" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 64px x 64px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Footer <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="footer" placeholder="Footer" value="{{old('footer',$result->footer)}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('dashboard.index')}}" class="btn btn-warning btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm" disabled>Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                            responseSuccess(resp.message,"{{route('dashboard.settings.dashboard.index')}}");
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
@endsection