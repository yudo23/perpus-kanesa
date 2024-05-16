<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Buku</title>

    <style>
        .container-box {
            max-width: 800px;
            height: 950px;
            margin: auto;
            padding: 10px;
            padding-top: 0px;
            padding-bottom: 50px;
            border: 1px solid black;
            border-bottom: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: black;
        }

        .table-bordered-header {
            background-color: #ececec;
        }

        table.table-bordered-header td {
            border: 1px solid black;
        }

        table.table-bordered-header td {
            padding: 5px;
            font-size: 14px;
            vertical-align: top;
        }

        .table-item-head {
            background-color: #ececec;
        }

        .table-item-head td,
        .table-item-content td,
        .table-item-content-end td {
            border: 1px solid black;
            padding: 5px;
            font-size: 14px;
            vertical-align: top;
        }

        .table-footer td {
            border: 1px solid black;
            padding: 5px;
            font-size: 14px;
            vertical-align: top;
        }

        @page {
            margin: 50px;
        }
    </style>
</head>

<body>
    <div class="container-box">
        <h2 style="text-align:center;">Buku</h2>
        <table cellpadding="0" cellspacing="0" style="width: 100%;">

            <tr class="table-item-head">
                <th><b>No</b></th>
                <th><b>Judul Buku</b></th>
                <th><b>Penerbit</b></th>
                <th><b>Tahun Terbit</b></th>
                <th><b>Total Buku</b></th>
                <th><b>Sinopsis</b></th>
            </tr>

            @foreach($table as $index => $row)
            <tr class="table-item-content">
                <td>{{$index+1}}</td>
                <td>{{$row->title}}</td>
                <td>{{$row->publisher->publisher_name ?? null}}</td>
                <td>{{$row->publish_year}}</td>
                <td>{{count($row->items)}}</td>
                <td>{{$row->synopsis_url}}</td>
            </tr>
            @endforeach

        </table>
    </div>
</body>

</html>