@extends('layouts.index')

@section('content')
<section class="content-header">
    <h1>
        Pembelian
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Pembelian</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">Edit Pembelian</h4>
                    </div>
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Supplier</label>
                                    <select name="nama_supplier" id="nama_supplier" class="form-control {{ $errors->has('nama_supplier') ? 'is-invalid' : '' }}">
                                        @foreach ($supplier as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('nama') == $supplier->nama ? 'selected' : '' }}>
                                            {{ $supplier->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('pembelian.index') }}">
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
                            <input min="1" max="100" type="number" class="form-control" placeholder="" name="jumlah_pesanan" value="{{ old('jumlah_pesanan') ?: 1 }}" id="jumlah_pesanan">
                        </div>
                        <small class="text-danger">{{ $errors->first('jumlah_pesanan') }}</small>
                    </div>
                </div>
                <div class="col-md-6 col-xs-2 col-sm-2">
                    <div class="form-group">
                        <label for=""></label>
                        <div style="margin-top:6px;">
                            <button type="button" class="btn btn-sm btn-success" onclick="addPembelianOrder()">Tambah</button>
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
                    <button type="button" class="btn btn-sm btn-success" onclick="updatePembelian()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')

<script>
    let pembelianOrder = [];
    pembelianOrder = JSON.parse('{!! $pembelian->detail_pembelian !!}')
    refreshTable();

    function refreshTable() {
        let pembelian = "";
        for (let i = 0; i < pembelianOrder.length; i++) {
            pembelian += "<tr>" +
                "<td>" + pembelianOrder[i].barang.nama + "</td>" +
                "<td>" + formatRupiah(String(pembelianOrder[i].barang.harga)) + "</td>" +
                "<td>" + pembelianOrder[i].jumlah + "</td>" +
                "<td>" + formatRupiah(String(pembelianOrder[i].jumlah * pembelianOrder[i].barang.harga)) + "</td>" +
                "<td>" +
                "<button class='btn btn-xs btn-danger' onclick='removePembelian(" + i +
                ")'><i class='fa fa-close'></button>" +
                "</td>" +
                "</tr>"
        }
        $('#detail_pembelian_body').html(pembelian)
        calculateTotal();
    }

    const addPembelianOrder = async () => {
        let id_barang = $("#barang option:selected").val();
        let jumlah_pesanan = parseInt($("#jumlah_pesanan").val());

        if (jumlah_pesanan < 0 || jumlah_pesanan == "") {
            alert("Jumlah pembelian harus di isi !")
            return;
        }
        let cari = pembelianOrder.find(function(order) {
            return order.id_barang == id_barang;
        });


        if (cari != undefined) {
            let index = pembelianOrder.indexOf(cari);
            let harga = $("#barang option:selected").data('harga');
            pembelianOrder[index].jumlah += jumlah_pesanan;
            pembelianOrder[index].subtotal += jumlah_pesanan * harga;
        } else {
            let harga = $("#barang option:selected").data('harga');
            let order = {
                id_barang: id_barang,
                barang: {
                    nama: $("#barang option:selected").text().trim(),
                    harga: harga
                },
                jumlah: jumlah_pesanan,
                subtotal: jumlah_pesanan * harga
            };
            pembelianOrder.push(order);
        }
        refreshTable();
    }

    function calculateTotal() {
        let total = pembelianOrder.reduce(function(a, b) {
            return a + (b.barang.harga * b.jumlah)
        }, 0)
        $("#total").text("Total Pembelian : " + formatRupiah(String(total)));
    }

    function removePembelian(index) {
        pembelianOrder.splice(index, 1);
        refreshTable();
    }

    function validate() {
        let isValidationError = false;
        let nama_supplier = $("nama_supplier").val();

        let isNamaSupplierEmpty = nama_supplier == "";
        $("#error_nama_supplier").html(isNamaSupplierEmpty ? "Nama supplier tidak boleh kosong." : "")
        isValidationError = isValidationError || isNamaSupplierEmpty

        if (pembelianOrder.length < 1) {
            alert("Pembelian tidak boleh kosong.")
            isValidationError = true;
        }
        return isValidationError;
    }

    function updatePembelian() {
        if (validate())
            return;

        $(function() {
            let token = $("input[name='_token']").val();
            let pembelian = {
                id_supplier: $("#nama_supplier").val()
            }
            $.ajax({
                type: "POST",
                url: "{{ route('pembelian.update', ['pembelian' => $pembelian->id]) }}",
                data: {
                    pembelian: pembelian,
                    pembelianOrder: pembelianOrder,
                    _token: token,
                    _method: "PUT"
                },
                success: function(result) {
                    if (result.success)
                        alert("Pembelian berhasil diubah.")
                    window.location.href = "{{ route('pembelian.index') }}";
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
@endpush

@endsection