<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian Per Hari</title>
</head>

<body>
    <h1>
        Laporan Pembelian Per Hari
    </h1>
    <table border="1" cellpadding="5px" style="width:100%" class="table table-striped">
        <tr>
            <th>Tanggal Pembelian</th>
            <th>Barang</th>
            <th>Harga</th>
            <th>Jumlah Pesanan</th>
            <th>Sub Total</th>
        </tr>
        @foreach ($pembelian->detail_pembelian as $detail_pembelian)
            <tr>
                <td>{{ date('Y-m-d', strtotime($detail_pembelian->created_at)) }}</td>
                <td>{{ $detail_pembelian->barang->nama }}</td>
                <td>{{ $detail_pembelian->barang->harga_beli }}</td>
                <td>{{ $detail_pembelian->jumlah }}</td>
                <td>{{ $detail_pembelian->sub_total }}</td>
            </tr>
        @endforeach
    </table>
    <table style="width:100%">
        <tr>
            <td align="right">Total : {{ $pembelian->total }}</td>
        </tr>
    </table>
</body>

<script>
    window.print();
</script>

</html>
