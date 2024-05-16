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
    <div class="col-md-12">
        <div class="card m-b-30 px-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="table">
                                <table class="table mb-3 table-striped table-bordred">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>No.HP</th>
                                        <th>Subjek</th>
                                        <th>Pesan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse($table as $index => $row)
                                        <tr>
                                            <td>{{$table->firstItem() + $index}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->phone}}</td>
                                            <td>{{$row->subject}}</td>
                                            <td>{{$row->message}}</td>
                                            <td class="d-flex">
                                                <a href="{{route('dashboard.contacts.show',$row->id)}}" class="btn btn-info btn-sm" style="margin-right:10px;">Detail</a>
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

@endsection("content")

@section("script")
<script>
    $(function() {})
</script>
@endsection