<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
</head>

<body>
    <h1>
        Laporan Pembelian
    </h1>
    <table border="1" cellpadding="5px" style="width:100%" class="table table-striped">
        <tr>
            <th>Nama Supplier</th>
            <th>Penanggung Jawab</th>
            <th>Tanggal Pembelian</th>
            <th>Total</th>
        </tr>
        @foreach ($pembelian as $p)
            <tr>
                <td>{{ $p->supplier->nama }}</td>
                <td>{{ $p->user->nama }}</td>
                <td>{{ date('Y-m-d', strtotime($p->created_at)) }}</td>
                <td>Rp. {{ number_format($p->total) }}</td>
            </tr>
        @endforeach
    </table>
</body>

<script>
    window.print();
</script>

</html>
