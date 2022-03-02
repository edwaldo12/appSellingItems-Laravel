@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            supplier
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> supplier</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Edit supplier</h4>
                        </div>
                        <form action="{{ route('supplier.update', ['supplier' => $supplier->id]) }}" method="POST"
                            onsubmit="return confirm('Pastikan semua data sudah benar?')">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Supplier</label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Nama Supplier"
                                                value="{{ old('nama') ? old('nama') : $supplier->nama }}">
                                            <small class="text-danger">{{ $errors->first('nama') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="text" id="telepon" name="telepon"
                                                class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Telepon"
                                                value="{{ old('telepon') ? old('telepon') : $supplier->telepon }}">
                                            <small class="text-danger">{{ $errors->first('telepon') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" id="alamat" name="alamat"
                                                class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Alamat"
                                                value="{{ old('alamat') ? old('alamat') : $supplier->alamat }}">
                                            <small class="text-danger">{{ $errors->first('alamat') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('supplier.index') }}">
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
