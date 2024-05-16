<div class="row mt-5">
    <div class="col-12">
        <h4>Informasi Data Penerimaan Buku</h4>
        <div class="table-responsive">
            <div class="table">
                <table class="table mb-3 table-striped table-bordred">
                    <thead>
                        <th>No</th>
                        <th>Kode Item</th>
                        <th>Tanggal Diterima</th>
                    </thead>
                    <tbody>
                        @forelse($result->items as $index => $row)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$row->item_code}}</td>
                            <td>
                                @if(!empty($row->received_date))
                                {{\Carbon\Carbon::parse($row->received_date)->format("d F Y")}}
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
            </div>
        </div>
    </div>
</div>