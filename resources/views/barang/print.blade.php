<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang</title>
</head>

<body>
    <h1>
        Laporan Barang
    </h1>
    <table border="1" cellpadding="5px" style="width:100%" class="table table-striped">
        <tr>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
        </tr>
        @foreach ($barang as $b)
            <tr>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->satuan }}</td>
                <td>Rp.{{ number_format($b->harga_beli, 0) }}</td>
                <td>Rp.{{ number_format($b->harga_jual, 0) }}</td>
                <td>{{ $b->stok }}</td>
            </tr>
        @endforeach
    </table>
</body>

<script>
    window.print();
</script>

</html>
