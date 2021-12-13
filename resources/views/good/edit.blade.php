@extends('layout.index')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Barang
            {{-- <small>Control panel</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href=" {{ route('goods.index') }}">Barang</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Barang</h3>
                    </div>
                    <form action="{{ route('goods.update', ['good' => $good->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('nama_produk') ? 'has-error' : '' }}">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                                            value="{{ old('nama_produk') ? old('nama_produk') : $good->nama_produk }}"
                                            placeholder="Masukkan Nama Produk" required>
                                        <small class="text-danger">{{ $errors->first('nama_produk') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('satuan') ? 'has-error' : '' }}">
                                        <label for="satuan">Satuan</label>
                                        <select class="form-control" required name="satuan" id="satuan">
                                            @if (old('satuan'))
                                                <option value="pc" {{ old('satuan') == 'pc' ? 'selected' : '' }}>Pc
                                                </option>
                                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg
                                                </option>
                                                <option value="roll" {{ old('satuan') == 'roll' ? 'selected' : '' }}>Roll
                                                </option>
                                            @else
                                                <option value="pc" {{ $good->satuan == 'pc' ? 'selected' : '' }}>Pc
                                                </option>
                                                <option value="kg" {{ $good->satuan == 'kg' ? 'selected' : '' }}>Kg
                                                </option>
                                                <option value="roll" {{ $good->satuan == 'roll' ? 'selected' : '' }}>Roll
                                                </option>
                                            @endif
                                        </select>
                                        <small class="text-danger">{{ $errors->first('satuan') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('batch') ? 'has-error' : '' }}">
                                        <label for="batch">Batch</label>
                                        <input type="text" class="form-control" name="batch" id="batch"
                                            value="{{ old('batch') ? old('batch') : $good->batch }}"
                                            placeholder="Masukkan Batch" required>
                                        <small class="text-danger">{{ $errors->first('batch') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('priority_check') ? 'has-error' : '' }}">
                                        <label for="priority_check">Priority Check</label>
                                        <select class="form-control" required name="priority_check" id="priority_check">
                                            @if (old('satuan'))
                                                <option value="1" {{ old('priority_check') == '1' ? 'selected' : '' }}>1
                                                </option>
                                                <option value="2" {{ old('priority_check') == '2' ? 'selected' : '' }}>2
                                                </option>
                                                <option value="3" {{ old('priority_check') == '3' ? 'selected' : '' }}>3
                                                </option>
                                            @else
                                                <option value="1" {{ $good->priority_check == '1' ? 'selected' : '' }}>1
                                                </option>
                                                <option value="2" {{ $good->priority_check == '2' ? 'selected' : '' }}>2
                                                </option>
                                                <option value="3" {{ $good->priority_check == '3' ? 'selected' : '' }}>3
                                                </option>
                                            @endif
                                        </select>
                                        <small class="text-danger">{{ $errors->first('priority_check') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('release') ? 'has-error' : '' }}">
                                        <label for="release">Release</label>
                                        <input type="number" class="form-control" name="release" id="release"
                                            value="{{ old('release') ? old('release') : $good->release }}"
                                            placeholder="Masukkan Release" required>
                                        <small class="text-danger">{{ $errors->first('release') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('rejected') ? 'has-error' : '' }}">
                                        <label for="rejected">Rejected</label>
                                        <input type="number" class="form-control" name="rejected" id="rejected"
                                            value="{{ old('rejected') ? old('rejected') : $good->rejected }}"
                                            placeholder="Masukkan Rejected" required>
                                        <small class="text-danger">{{ $errors->first('rejected') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                                        <label for="foto">Foto</label>
                                        <input type="file" name="foto[]" id="foto" multiple>
                                        <small class="text-danger">{{ $errors->first('foto') }}</small>
                                    </div>
                                    <h5 style="color:red">*Hanya Dapat Menambahkan Foto, Untuk Menghapus Foto Di Halaman
                                        Pengecekan Kontainer</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('nomor_produk') ? 'has-error' : '' }}">
                                        <label for="nomor_produk">Nomor Produk</label>
                                        <input type="number" class="form-control" name="nomor_produk" id="nomor_produk"
                                            value="{{ old('nomor_produk') ? old('nomor_produk') : $good->nomor_produk }}"
                                            placeholder="Masukkan Nomor Produk" required>
                                        <small class="text-danger">{{ $errors->first('nomor_produk') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}">
                                        <label for="jenis">Jenis Produk</label>
                                        <select class="form-control" required name="jenis" id="jenis">
                                            @if (old('satuan'))
                                                <option value="fcp" {{ old('nomor_produk') == 'fcp' ? 'selected' : '' }}>
                                                    fcp
                                                </option>
                                                <option value="hk" {{ old('nomor_produk') == 'hk' ? 'selected' : '' }}>hk
                                                </option>
                                                <option value="sa" {{ old('nomor_produk') == 'sa' ? 'selected' : '' }}>sa
                                                </option>
                                            @else
                                                <option value="1" {{ $good->nomor_produk == 'fcp' ? 'selected' : '' }}>
                                                    fcp
                                                </option>
                                                <option value="2" {{ $good->nomor_produk == 'hk' ? 'selected' : '' }}>hk
                                                </option>
                                                <option value="3" {{ $good->nomor_produk == 'sa' ? 'selected' : '' }}>sa
                                                </option>
                                            @endif
                                        </select>
                                        <small class="text-danger">{{ $errors->first('jenis') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('po') ? 'has-error' : '' }}">
                                        <label for="po">Nomor PO</label>
                                        <input type="number" class="form-control" name="po" id="po"
                                            value="{{ old('po') ? old('po') : $good->po }}" placeholder="Masukkan PO"
                                            required>
                                        <small class="text-danger">{{ $errors->first('po') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('bs') ? 'has-error' : '' }}">
                                        <label for="bs">Nomor BS</label>
                                        <input type="number" class="form-control" name="bs" id="bs"
                                            value="{{ old('bs') ? old('bs') : $good->bs }}" placeholder="Masukkan BS"
                                            required>
                                        <small class="text-danger">{{ $errors->first('bs') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('sampling') ? 'has-error' : '' }}">
                                        <label for="sampling">Sampling</label>
                                        <input type="number" class="form-control" name="sampling" id="sampling"
                                            value="{{ old('sampling') ? old('sampling') : $good->sampling }}"
                                            placeholder="Masukkan Sampling" required>
                                        <small class="text-danger">{{ $errors->first('sampling') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                                            value="{{ old('keterangan') ? old('keterangan') : $good->keterangan }}"
                                            placeholder="Masukkan Keterangan" required>
                                        <small class="text-danger">{{ $errors->first('keterangan') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" href="{{ route('goods.index') }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection
