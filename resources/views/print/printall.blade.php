<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>

    {{-- <img src="{{ url('logo/logo_gas.png') }}" alt="" width="100px" height="100px"
        style="position: relative;margin-left:45%"> --}}

    <table border="1" cellpadding="5px" style="width:100%">
        <tr>
            <td colspan="13" style="font-size:18px">
                BARANG
            </td>
        </tr>
        @foreach ($goods as $good)
            <tr>
                <td width="1%">Nomor Produk</td>
                <td width="1%">Nama Produk</td>
                <td width="1%">Satuan</td>
                <td width="1%">Tanggal</td>
                <td width="1%">Jenis</td>
                <td width="1%">Batch</td>
                <td width="1%">PO</td>
                <td width="1%">BS</td>
                <td width="1%">Check Prioritas</td>
                <td width="1%">Sampling</td>
                <td width="1%">Release</td>
                <td width="1%">Rejected</td>
                <td width="1%">Keterangan</td>
            </tr>
            <tr>
                <td>{{ $good->nomor_produk }}</td>
                <td>{{ $good->nama_produk }}</td>
                <td>{{ $good->satuan }}</td>
                <td>{{ $good->tanggal }}</td>
                <td>{{ $good->jenis }}</td>
                <td>{{ $good->batch }}</td>
                <td>{{ $good->po }}</td>
                <td>{{ $good->bs }}</td>
                <td>{{ $good->priority_check }}</td>
                <td>{{ $good->sampling }}</td>
                <td>{{ $good->release }}</td>
                <td>{{ $good->rejected }}</td>
                <td>{{ $good->keterangan }}</td>
        @endforeach
    </table>
    <br>

    {{-- <table border="1" cellpadding="5px" style="width:100%">
        <tr>
            <th>Nama Barang</th>
            <th>Harga (Rp)</th>
            <th>Jumlah</th>
            <th>Subtotal (Rp)</th>
        </tr>
        @foreach ($details as $detail)
            <tr>
                <td>{{ $detail->good->name }}</td>
                <td>Rp. {{ number_format($detail->good->price, 0, ',', '.') }}</td>
                <td>{{ $detail->qty }} Pcs</td>
                <td>Rp. {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table> --}}

    <br />
    {{-- <table border="1" cellpadding="5px" style="width:100%">
        <tr>
            <td colspan="3">Syarat Pembayaran
            </td>
        </tr>
        <tr>
            <td>
                Diusulkan Oleh,
                <br />
                Manajer
            </td>
            <td>
                Disetujui oleh,
                <br />
                Wakil Manajemen
            </td>
            <td>
                Diketahui oleh,
                <br />
                Direktur
            </td>
        </tr>
        <tr>
            <td style="padding-top:100px;text-align:center">(Visia Veronica)</td>
            <td style="padding-top:100px;text-align:center">(Jason Gunawan)</td>
            <td style="padding-top:100px;text-align:center">(Gunawan Adi Suwarno)</td>
        </tr>
    </table> --}}


    <script>
        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString();
            split = number_string.split(',');
            sisa = split[0].length % 3;
            rupiah = split[0].substr(0, sisa);
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return "Rp. " + rupiah;
        }
        window.print()
    </script>
</body>

</html>
