@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Barang</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Edit Barang</h4>
                        </div>
                        <form action="{{ route('barang.update', ['barang' => $barang->id]) }}" method="POST"
                            onsubmit="return confirm('Pastikan semua data sudah benar?')">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Barang</label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                                placeholder="Masukkan Nama Barang"
                                                value="{{ old('nama') ? old('nama') : $barang->nama }}">
                                            <small class="text-danger">{{ $errors->first('nama') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" id="satuan" name="satuan"
                                                class="form-control {{ $errors->has('satuan') ? ' is-invalid' : '' }}"
                                                placeholder="Masukkan satuan Barang"
                                                value="{{ old('satuan') ? old('satuan') : $barang->satuan }}">
                                            <small class="text-danger">{{ $errors->first('satuan') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual</label>
                                            <input type="number" id="harga_jual" name="harga_jual"
                                                class="form-control {{ $errors->has('harga_jual') ? ' is-invalid' : '' }}"
                                                placeholder="Masukkan Harga Jual"
                                                value="{{ old('harga_jual') ? old('harga_jual') : $barang->harga_jual }}">
                                            <small class="text-danger">{{ $errors->first('harga_jual') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" id="stok" name="stok"
                                                class="form-control {{ $errors->has('stok') ? ' is-invalid' : '' }}"
                                                placeholder="Masukkan Stok"
                                                value="{{ old('stok') ? old('stok') : $barang->stok }}">
                                            <small class="text-danger">{{ $errors->first('stok') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli</label>
                                            <input type="number" id="harga_beli" name="harga_beli"
                                                class="form-control {{ $errors->has('harga_beli') ? ' is-invalid' : '' }}"
                                                placeholder="Masukkan harga_beli"
                                                value="{{ old('harga_beli') ? old('harga_beli') : $barang->harga_beli }}">
                                            <small class="text-danger">{{ $errors->first('harga_beli') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('barang.index') }}">
                                    <button class="btn btn-default" type="button">Kembali</button>
                                </a>
                                <button class="btn btn-warning" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
