@extends("dashboard.templates.main")

@section("title","Pesan Masuk")

@section("css")
@endsection("css")

@section("breadcumb")
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-header-title">Pesan Masuk</h1>
        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Data Pesan Masuk</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Nama Lengkap
                            </div>
                            <div class="col-md-8">
                                : {{$result->name}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                No.HP
                            </div>
                            <div class="col-md-8">
                                : {{$result->phone}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Email
                            </div>
                            <div class="col-md-8">
                                : {{$result->email}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Subjek
                            </div>
                            <div class="col-md-8">
                                : {{$result->subject}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Pesan
                            </div>
                            <div class="col-md-8">
                                : {{$result->message}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Tanggal Dibuat
                            </div>
                            <div class="col-md-8">
                                : {{\Carbon\Carbon::parse($result->created_at)->format("d F Y")}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{route('dashboard.biblios.index')}}" class="btn btn-warning btn-sm text-white" style="margin-right: 10px;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection("content")

@section("script")
@endsection("script")