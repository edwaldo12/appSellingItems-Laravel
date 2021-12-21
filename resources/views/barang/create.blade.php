@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Barang</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Tambah Barang</h4>
                        </div>
                        <form action="{{ route('barang.store') }}" method="POST"
                            onsubmit="return confirm('Pastikan semua data sudah benar?')">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Barang</label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Nama Barang" value="{{ old('nama') }}">
                                            <small class="text-danger">{{ $errors->first('nama') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" id="satuan" name="satuan"
                                                class="form-control {{ $errors->has('satuan') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Satuan" value="{{ old('satuan') }}">
                                            <small class="text-danger">{{ $errors->first('satuan') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual</label>
                                            <input type="number" id="harga_jual" name="harga_jual"
                                                class="form-control {{ $errors->has('harga_jual') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Harga Jual" value="{{ old('harga_jual') }}" min="1">
                                            <small class="text-danger">{{ $errors->first('harga_jual') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" id="stok" name="stok"
                                                class="form-control {{ $errors->has('stok') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Stok" value="{{ old('stok') }}">
                                            <small class="text-danger">{{ $errors->first('stok') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli</label>
                                            <input type="number" id="harga_beli" name="harga_beli"
                                                class="form-control {{ $errors->has('harga_beli') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Harga Beli" value="{{ old('harga_beli') }}"
                                                min="1">
                                            <small class="text-danger">{{ $errors->first('harga_beli') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
