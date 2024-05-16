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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Data Buku</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Judul
                            </div>
                            <div class="col-md-8">
                                : {{$result->title}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                ISBN
                            </div>
                            <div class="col-md-8">
                                : {{$result->isbn_issn}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Penerbit
                            </div>
                            <div class="col-md-8">
                                : {{$result->publisher->publisher_name ?? null}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Tahun Terbit
                            </div>
                            <div class="col-md-8">
                                : {{$result->publish_year}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Total Buku
                            </div>
                            <div class="col-md-8">
                                : {{count($result->items)}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                URL Sinopsis
                            </div>
                            <div class="col-md-8">
                                : @if(!empty($result->synopsis_url))
                                <a href="{{route('dashboard.biblios.qrcode',$result->biblio_id)}}">{!! QrCode::size(50)->generate($result->synopsis_url) !!}</a>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Tanggal Dibuat
                            </div>
                            <div class="col-md-8">
                                : @if(!empty($result->input_date))
                                {{\Carbon\Carbon::parse($result->input_date)->format("d F Y")}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @include("dashboard.biblios.stock")
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