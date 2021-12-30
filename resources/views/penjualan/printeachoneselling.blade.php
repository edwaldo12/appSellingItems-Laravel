<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan penjualan Per Hari</title>
</head>

<body>
    <h1>
        Laporan penjualan Per Hari
    </h1>
    <table border="1" cellpadding="5px" style="width:100%" class="table table-striped">
        <tr>
            <th>Tanggal penjualan</th>
            <th>Barang</th>
            <th>Harga</th>
            <th>Jumlah Pesanan</th>
            <th>Sub Total</th>
        </tr>
        @foreach ($penjualan->detail_penjualan as $detail_penjualan)
            <tr>
                <td>{{ date('Y-m-d', strtotime($detail_penjualan->created_at)) }}</td>
                <td>{{ $detail_penjualan->barang->nama }}</td>
                <td>{{ $detail_penjualan->barang->harga_jual }}</td>
                <td>{{ $detail_penjualan->jumlah }}</td>
                <td>{{ $detail_penjualan->sub_total }}</td>
            </tr>
        @endforeach
    </table>
    <table style="width:100%">
        <tr>
            <td align="right">Total : {{ $penjualan->total }}</td>
        </tr>
    </table>
</body>

<script>
    window.print();
</script>

</html>
