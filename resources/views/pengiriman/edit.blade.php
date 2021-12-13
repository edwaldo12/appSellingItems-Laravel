@extends('layout.index')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kontainer
            {{-- <small>Control panel</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href=" {{ route('containers.index') }}">Pengiriman</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Kontainer</h3>
                    </div>
                    <form action="{{ route('sendingItems.update', ['sendingItem' => $sendingItem->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
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
                                            @if (old('jenis'))
                                                <option value="fcp" {{ old('jenis') == 'fcp' ? 'selected' : '' }}>fcp
                                                </option>
                                                <option value="hk" {{ old('jenis') == 'hk' ? 'selected' : '' }}>hk
                                                </option>
                                                <option value="sa" {{ old('jenis') == 'sa' ? 'selected' : '' }}>sa
                                                </option>
                                            @else
                                                <option value="fcp" {{ $sendingItem->jenis == 'fcp' ? 'selected' : '' }}>
                                                    fcp
                                                </option>
                                                <option value="hk" {{ $sendingItem->jenis == 'hk' ? 'selected' : '' }}>hk
                                                </option>
                                                <option value="sa" {{ $sendingItem->jenis == 'sa' ? 'selected' : '' }}>sa
                                                </option>
                                            @endif
                                        </select>
                                        <small class="text-danger">{{ $errors->first('jenis') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                                            value="{{ old('keterangan') ? old('keterangan') : $sendingItem->keterangan }}"
                                            placeholder="Masukkan Keterangan" required>
                                        <small class="text-danger">{{ $errors->first('keterangan') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('plat_nomor') ? 'has-error' : '' }}">
                                        <label for="plat_nomor">Plat Nomor</label>
                                        <input type="number" class="form-control" name="plat_nomor" id="plat_nomor"
                                            value="{{ old('plat_nomor') ? old('plat_nomor') : $sendingItem->plat_nomor }}"
                                            placeholder="Masukkan Plat Nomor" required>
                                        <small class="text-danger">{{ $errors->first('plat_nomor') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('no_container') ? 'has-error' : '' }}">
                                        <label for="no_container">Nomor Kontainer</label>
                                        <input type="number" class="form-control" name="no_container" id="no_container"
                                            value="{{ old('no_container') ? old('no_container') : $sendingItem->no_container }}"
                                            placeholder="Masukkan Nomor Kontainer" required>
                                        <small class="text-danger">{{ $errors->first('no_container') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('po') ? 'has-error' : '' }}">
                                        <label for="po">PO</label>
                                        <input type="number" class="form-control" name="po" id="po"
                                            value="{{ old('po') ? old('po') : $sendingItem->po }}"
                                            placeholder="Masukkan PO" required>
                                        <small class="text-danger">{{ $errors->first('po') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                                        <label for="foto">Foto</label>
                                        <input type="file" name="foto[]" id="foto" multiple>
                                        <small class="text-danger">{{ $errors->first('foto') }}</small>
                                    </div>
                                    <h5 style="color:red">*Hanya Dapat Menambahkan Foto, Untuk Menghapus Foto Di Halaman
                                        Pengecekan Kontainer</h5>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" href="{{ route('sendingItems.index') }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection
