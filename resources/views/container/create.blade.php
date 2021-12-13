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
            <li class=""><a href=" {{ route('containers.index') }}">Kontainer</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Tambah Kontainer</h3>
                    </div>
                    <form action="{{ route('containers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}">
                                        <label for="jenis">Jenis Kontainer</label>
                                        <select name="jenis" id="jenis" class="form-control" required>
                                            <option value="fcp">fcp</option>
                                            <option value="hk">hk</option>
                                            <option value="sa">sa</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('jenis') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('sending_id') ? 'has-error' : '' }}">
                                        <label for="sending_id">ID Pengiriman</label>
                                        <select name="sending_id" id="sending_id" class="form-control" required>
                                            @foreach ($sendingItems as $sendingItem)
                                                <option value="{{ $sendingItem->id }}">{{ $sendingItem->id }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('sending_id') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('suhu_sesudah_loading') ? 'has-error' : '' }}">
                                        <label for="suhu_sesudah_loading">Suhu Sesudah Loading</label>
                                        <input type="number" class="form-control" name="suhu_sesudah_loading"
                                            id="suhu_sesudah_loading" value="{{ old('suhu_sesudah_loading') }}"
                                            placeholder="Masukkan Suhu Sesudah Loading" required>
                                        <small
                                            class="text-danger">{{ $errors->first('suhu_sesudah_loading') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('tidak_kotor') ? 'has-error' : '' }}">
                                        <label for="tidak_kotor">Tidak Kotor</label>
                                        <select name="tidak_kotor" id="tidak_kotor" class="form-control" required>
                                            <option value="ya">ya</option>
                                            <option value="tidak">tidak</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('tidak_kotor') }}</small>
                                    </div>
                                    <div
                                        class="form-group {{ $errors->has('tidak_terdapat_bocor') ? 'has-error' : '' }}">
                                        <label for="tidak_terdapat_bocor">Tidak Terdapat Bocor</label>
                                        <select name="tidak_terdapat_bocor" id="tidak_terdapat_bocor" class="form-control"
                                            required>
                                            <option value="ya">ya</option>
                                            <option value="tidak">tidak</option>
                                        </select>
                                        <small
                                            class="text-danger">{{ $errors->first('tidak_terdapat_bocor') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('status_container') ? 'has-error' : '' }}">
                                        <label for="status_container">Status Kontainer</label>
                                        <select name="status_container" id="status_container" class="form-control"
                                            required>
                                            <option value="release">release</option>
                                            <option value="rejected">rejected</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('status_container') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('no_seal_container') ? 'has-error' : '' }}">
                                        <label for="no_seal_container">No Seal Container</label>
                                        <input type="number" class="form-control" name="no_seal_container"
                                            id="no_seal_container" value="{{ old('no_seal_container') }}"
                                            placeholder="Masukkan No Seal Container" required>
                                        <small class="text-danger">{{ $errors->first('no_seal_container') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('type_container') ? 'has-error' : '' }}">
                                        <label for="type_container">Tipe Kontainer</label>
                                        <select name="type_container" id="type_container" class="form-control" required>
                                            <option value="dry">dry</option>
                                            <option value="freeze">freeze</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('type_container') }}</small>
                                    </div>
                                    <div
                                        class="form-group {{ $errors->has('suhu_sebelum_loading;l') ? 'has-error' : '' }}">
                                        <label for="suhu_sebelum_loading">Suhu Sebelum Loading</label>
                                        <input type="number" class="form-control" name="suhu_sebelum_loading"
                                            id="suhu_sebelum_loading" value="{{ old('suhu_sebelum_loading') }}"
                                            placeholder="Masukkan Suhu Sebelum Loading" required>
                                        <small
                                            class="text-danger">{{ $errors->first('suhu_sebelum_loading') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('kondisi_fisik') ? 'has-error' : '' }}">
                                        <label for="kondisi_fisik">Kondisi Fisik</label>
                                        <select name="kondisi_fisik" id="kondisi_fisik" class="form-control" required>
                                            <option value="baik">baik</option>
                                            <option value="tidak">tidak</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('kondisi_fisik') }}</small>
                                    </div>
                                    <div
                                        class="form-group {{ $errors->has('tidak_berbau_menyengat') ? 'has-error' : '' }}">
                                        <label for="tidak_berbau_menyengat">Tidak Berbau Menyengat</label>
                                        <select name="tidak_berbau_menyengat" id="tidak_berbau_menyengat"
                                            class="form-control" required>
                                            <option value="ya">ya</option>
                                            <option value="tidak">tidak</option>
                                        </select>
                                        <small
                                            class="text-danger">{{ $errors->first('tidak_berbau_menyengat') }}</small>
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
                            <a class="btn btn-default" href="{{ route('containers.index') }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
