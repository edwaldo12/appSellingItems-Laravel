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
            <td colspan="3" style="font-size:18px">
                KONTAINER
            </td>
        </tr>
        <tr>
            <td width="1%">Tanggal</td>
            <td width="1%">:</td>
            <td>{{ $container->tanggal }}</td>
        </tr>
        <tr>
            <td width="1%">Jenis Kontainer</td>
            <td width="1%">:</td>
            <td>{{ $container->jenis }}</td>
        </tr>
        <tr>
            <td width="1%">No Seal Container</td>
            <td width="1%">:</td>
            <td>{{ $container->no_seal_container }}</td>
        </tr>
        <tr>
            <td width="1%">Tipe Kontainer</td>
            <td width="1%">:</td>
            <td>{{ $container->type_container }}</td>
        </tr>
        <tr>
            <td width="1%">Suhu Sebelum Loading</td>
            <td width="1%">:</td>
            <td>{{ $container->suhu_sebelum_loading }}</td>
        </tr>
        <tr>
            <td width="1%">Suhu Sesudah Loading</td>
            <td width="1%">:</td>
            <td>{{ $container->suhu_sesudah_loading }}</td>
        </tr>
        <tr>
            <td width="1%">Kondisi Fisik</td>
            <td width="1%">:</td>
            <td>{{ $container->kondisi_fisik }}</td>
        </tr>
        <tr>
            <td width="1%">Tidak Berbau Menyengat</td>
            <td width="1%">:</td>
            <td>{{ $container->tidak_berbau_menyengat }}</td>
        </tr>
        <tr>
            <td width="1%">Tidak Kotor</td>
            <td width="1%">:</td>
            <td>{{ $container->tidak_kotor }}</td>
        </tr>
        <tr>
            <td width="1%">Tidak Terdapat Bocor</td>
            <td width="1%">:</td>
            <td>{{ $container->tidak_terdapat_bocor }}</td>
        </tr>
        <tr>
            <td width="1%">Status Kontainer</td>
            <td width="1%">:</td>
            <td>{{ $container->status_container }}</td>
        </tr>
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
