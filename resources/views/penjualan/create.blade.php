@extends('layouts.index')

@section('content')
<section class="content-header">
    <h1>
        Penjualan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Penjualan</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">Tambah Penjualan</h4>
                    </div>
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Pelanggan</label>
                                    <select name="nama" id="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}">
                                        @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id }}" {{ old('nama') == $p->nama ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header">
            Pesanan Detail
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 col-xs-5 col-sm-5">
                    <div class="form-group">
                        <label for="">Barang : </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-plus-square"></i>
                            </span>
                            <select name="id_barang" id="barang" class="form-control">
                                @foreach ($barang as $barang)
                                <option data-harga="{{ $barang['harga_jual'] }}" value="{{ $barang['id'] }}">
                                    {{ $barang['nama'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <small class="text-danger">{{ $errors->first('id_barang') }}</small>
                    </div>
                </div>
                <div class="col-md-3 col-xs-5 col-sm-5">
                    <div class="form-group">
                        <label>Jumlah : </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-home"></i>
                            </span>
                            <input min="1" max="100" type="number" class="form-control" placeholder="" name="jumlah_pesanan" value="{{ old('jumlah_pesanan') ?: 1 }}" id="jumlah_pesanan">
                        </div>
                        <small class="text-danger">{{ $errors->first('jumlah_pesanan') }}</small>
                    </div>
                </div>
                <div class="col-md-6 col-xs-2 col-sm-2">
                    <div class="form-group">
                        <label for=""></label>
                        <div style="margin-top:6px;">
                            <button type="button" class="btn btn-sm btn-success" onclick="addPenjualanOrder()">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Jumlah Pesanan</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="detail_pembelian_body"></tbody>
                    </table>
                    <p id="total" style="padding-left:8px"></p>
                    <button type="button" class="btn btn-sm btn-success" onclick="storePenjualan()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let penjualanOrder = [];

    function refreshTable() {
        $(function() {
            let penjualan = "";
            for (let i = 0; i < penjualanOrder.length; i++) {
                penjualan += "<tr>" +
                    "<td>" + penjualanOrder[i].nama_barang + "</td>" +
                    "<td>" + formatRupiah(String(penjualanOrder[i].harga_barang)) + "</td>" +
                    "<td>" + penjualanOrder[i].jumlah_pesanan + "</td>" +
                    "<td>" + formatRupiah(String(penjualanOrder[i].subtotal)) + "</td>" +
                    "<td>" +
                    "<button class='btn btn-xs btn-danger' onclick='removePenjualan(" + i +
                    ")'><i class='fa fa-close'></button>" +
                    "</td>" +
                    "</tr>"
            }
            $('#detail_pembelian_body').html(penjualan)
        });
        calculateTotal();
    }

    const addPenjualanOrder = async () => {
        let stok = await getStok();
        let id_barang = $("#barang option:selected").val();
        let jumlahBarang = parseInt($("#jumlah_pesanan").val());

        if (stok < jumlahBarang) {
            alert('Stok Kurang')
            return;
        }
        if ($("#jumlah_pesanan").val() < 0 || $("#jumlah_pesanan") == "") {
            alert("Jumlah penjualan harus di isi !")
            return;
        }
        let cari = penjualanOrder.find(function(order) {
            return order.id_barang == id_barang;
        });

        if (cari != undefined) {
            let index = penjualanOrder.indexOf(cari);
            let harga = $("#barang option:selected").data('harga');
            let jumlah_pesanan = $("#jumlah_pesanan").val();
            penjualanOrder[index].jumlah_pesanan += parseInt($("#jumlah_pesanan").val());
            penjualanOrder[index].subtotal += jumlah_pesanan * harga;
        } else {
            let jumlah_pesanan = parseInt($("#jumlah_pesanan").val());
            let harga = $("#barang option:selected").data('harga');
            let order = {
                id_barang: id_barang,
                nama_barang: $("#barang option:selected").text().trim(),
                harga_barang: harga,
                jumlah_pesanan: jumlah_pesanan,
                subtotal: jumlah_pesanan * harga
            };
            penjualanOrder.push(order);
        }
        refreshTable();
    }

    function calculateTotal() {
        let total = 0;
        for (let i = 0; i < penjualanOrder.length; i++) {
            total += penjualanOrder[i].subtotal;
        }
        $("#total").text("Total Pembelian : " + formatRupiah(String(total)));
    }

    function removePenjualan(index) {
        penjualanOrder.splice(index, 1);
        refreshTable();
    }

    function validate() {
        let isValidationError = false;
        let nama_pelanggan = $("nama").val();

        let isNamaPelangganEmpty = nama_pelanggan == "";
        $("#error_nama").html(isNamaPelangganEmpty ? "Nama Pelanggan tidak boleh kosong." : "")
        isValidationError = isValidationError || isNamaPelangganEmpty

        if (penjualanOrder.length < 1) {
            alert("Penjualan tidak boleh kosong.")
            isValidationError = true;
        }
        return isValidationError;
    }

    function storePenjualan() {
        if (validate())
            return;

        $(function() {
            let token = $("input[name='_token']").val();
            let penjualan = {
                pelanggan_id: $("#nama").val()
            }
            $.ajax({
                type: "POST",
                url: "{{ route('penjualan.store') }}",
                data: {
                    penjualan: penjualan,
                    penjualanOrder: penjualanOrder,
                    _token: token
                },
                success: function(result) {
                    if (result.success)
                        alert("Penjualan berhasil dilakukan.")
                    window.location.href = "{{ route('penjualan.index') }}";
                }
            })
        })
    }

    function hasNumbers(t) {
        var regex = /^[0-9]+$/;
        return regex.test(t);
    }

    async function getStok() {
        let stok = 0;
        let id = $("#barang").val();
        let jumlahPembelian = parseInt($("#jumlah_pembelian").val());

        await $.ajax({
            type: "GET",
            url: "{{ url('checkStok') }}/" + id,
            success: function(barang) {
                stok = barang.stok
            }
        });
        return stok;
    }
</script>
@endsection