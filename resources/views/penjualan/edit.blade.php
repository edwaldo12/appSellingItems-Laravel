@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Penjualan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Penjualan</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Edit Penjualan</h4>
                        </div>
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Pelanggan</label>
                                        <select name="nama_pelanggan" id="nama_pelanggan"
                                            class="form-control {{ $errors->has('nama_pelanggan') ? 'is-invalid' : '' }}">
                                            @foreach ($pelanggan as $pelanggan)
                                                <option value="{{ $pelanggan->id }}"
                                                    {{ old('nama') == $pelanggan->nama ? 'selected' : '' }}>
                                                    {{ $pelanggan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('nama') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('penjualan.index') }}">
                                <button class="btn btn-default" type="button">Kembali</button>
                            </a>
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
                                        <option data-harga="{{ $barang['harga'] }}" value="{{ $barang['id'] }}">
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
                                <input min="1" max="100" type="number" class="form-control" placeholder=""
                                    name="jumlah_pesanan" value="{{ old('jumlah_pesanan') ?: 1 }}" id="jumlah_pesanan">
                            </div>
                            <small class="text-danger">{{ $errors->first('jumlah_pesanan') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-2 col-sm-2">
                        <div class="form-group">
                            <label for=""></label>
                            <div style="margin-top:6px;">
                                <button type="button" class="btn btn-sm btn-success"
                                    onclick="addPenjualanOrder()">Tambah</button>
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

    @push('scripts')
        <script>
            let penjualanOrder = [];
            penjualanOrder = JSON.parse('{!! $penjualan->detail_penjualan !!}')
            refreshTable();

            function refreshTable() {
                $(function() {
                    let penjualan = "";
                    for (let i = 0; i < penjualanOrder.length; i++) {
                        penjualan += "<tr>" +
                            "<td>" + penjualanOrder[i].barang.nama + "</td>" +
                            "<td>" + formatRupiah(String(penjualanOrder[i].barang.harga_jual)) + "</td>" +
                            "<td>" + penjualanOrder[i].jumlah + "</td>" +
                            "<td>" + formatRupiah(String(penjualanOrder[i].jumlah * penjualanOrder[i].barang
                                .harga_jual)) +
                            "</td>" +
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
                let barang_id = $("#barang option:selected").val();

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
                    return order.barang_id == barang_id;
                });



                if (cari != undefined) {
                    let index = penjualanOrder.indexOf(cari);
                    let harga = $("#barang option:selected").data('harga');
                    penjualanOrder[index].jumlah += jumlahBarang;
                    penjualanOrder[index].subtotal += jumlahBarang * harga;
                } else {
                    let jumlah_pesanan = parseInt($("#jumlah_pesanan").val());
                    let harga = $("#barang option:selected").data('harga');
                    let order = {
                        barang_id: barang_id,
                        barang: {
                            nama: $("#barang option:selected").text().trim(),
                            harga: harga
                        },
                        jumlah: jumlah_pesanan,
                        subtotal: jumlah_pesanan * harga
                    };
                    penjualanOrder.push(order);
                }
                refreshTable();
            }

            function calculateTotal() {
                let total = penjualanOrder.reduce(function(a, b) {
                    return a + (b.barang.harga * b.jumlah)
                }, 0)
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
                $("#error_nama_pelanggan").html(isNamaPelangganEmpty ? "Nama Pelanggan tidak boleh kosong." : "")
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
                        url: "{{ route('penjualan.update', ['penjualan' => $penjualan->id]) }}",
                        data: {
                            penjualan: penjualan,
                            penjualanOrder: penjualanOrder,
                            _token: token,
                            _method: "PUT"
                        },
                        success: function(result) {
                            if (result.success)
                                alert("Penjualan berhasil diubah.")
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
                let jumlahPenjualan = parseInt($("#jumlah_penjualan").val());

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
    @endpush

@endsection
