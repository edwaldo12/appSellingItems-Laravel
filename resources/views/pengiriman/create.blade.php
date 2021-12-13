@extends('layout.index')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengiriman Barang
            {{-- <small>Control panel</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href=" {{ route('sendingItems.index') }}">Pengiriman Barang</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Tambah Pengiriman Barang</h3>
                    </div>
                    <form action="{{ route('sendingItems.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('good_id') ? 'has-error' : '' }}">
                                        <label for="good_id">Barang</label>
                                        <select class="form-control" required="good_id" id="good_id" name="good_id">
                                            @foreach ($goods as $good)
                                                <option value="{{ $good->id }}">{{ $good->nama_produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('good_id') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}">
                                        <label for="jenis">Jenis</label>
                                        <select class="form-control" required="jenis" id="jenis" name="jenis">
                                            <option value="fcp" {{ old('jenis') == 'fcp' ? 'selected' : '' }}>fcp</option>
                                            <option value="hk" {{ old('jenis') == 'hk' ? 'selected' : '' }}>hk</option>
                                            <option value="sa" {{ old('jenis') == 'sa' ? 'selected' : '' }}>sa</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('jenis') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                                            value="{{ old('keterangan') }}" placeholder="Masukkan Keterangan" required>
                                        <small class="text-danger">{{ $errors->first('keterangan') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('plat_nomor') ? 'has-error' : '' }}">
                                        <label for="plat_nomor">Plat Nomor</label>
                                        <input type="number" class="form-control" name="plat_nomor" id="plat_nomor"
                                            value="{{ old('plat_nomor') }}" placeholder="Masukkan Plat Nomor" required>
                                        <small class="text-danger">{{ $errors->first('plat_nomor') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('no_container') ? 'has-error' : '' }}">
                                        <label for="no_container">Nomor Kontainer</label>
                                        <input type="number" class="form-control" name="no_container" id="no_container"
                                            value="{{ old('no_container') }}" placeholder="Masukkan Penerima Barang"
                                            required>
                                        <small class="text-danger">{{ $errors->first('no_container') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('po') ? 'has-error' : '' }}">
                                        <label for="po">PO</label>
                                        <input type="number" class="form-control" name="po" id="po"
                                            value="{{ old('po') }}" placeholder="Masukkan PO" required>
                                        <small class="text-danger">{{ $errors->first('po') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                                        <label for="foto">Foto</label>
                                        <input type="file" name="foto[]" id="foto" multiple>
                                        <small class="text-danger">{{ $errors->first('foto') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" href="{{ route('sendingItems.index') }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
