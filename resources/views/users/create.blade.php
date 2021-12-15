@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Pengguna
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> Pengguna</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Tambah Pengguna</h4>
                        </div>
                        <form action="{{ route('users.store') }}" method="POST"
                            onsubmit="return confirm('Pastikan semua data sudah benar?')">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Nama" value="{{ old('nama') }}">
                                            <small class="text-danger">{{ $errors->first('nama') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" id="username" name="username"
                                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Username" value="{{ old('username') }}">
                                            <small class="text-danger">{{ $errors->first('username') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Password" value="{{ old('password') }}">
                                            <small class="text-danger">{{ $errors->first('password') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="number" id="telepon" name="telepon"
                                                class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan Telepon" value="{{ old('telepon') }}">
                                            <small class="text-danger">{{ $errors->first('telepon') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe_pengguna">Tipe Pengguna</label>
                                            <select name="tipe_pengguna" id="tipe_pengguna"
                                                class="form-control {{ $errors->has('tipe_pengguna') ? 'is-invalid' : '' }}">
                                                <option value="Super_Admin"
                                                    {{ old('tipe_pengguna') == 'Super_Admin' ? 'selected' : '' }}>
                                                    Super Admin</option>
                                                <option value="Admin"
                                                    {{ old('tipe_pengguna') == 'Admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="Operator"
                                                    {{ old('tipe_pengguna') == 'Operator' ? 'selected' : '' }}>
                                                    Operator</option>
                                            </select>
                                            <small class="text-danger">{{ $errors->first('tipe_pengguna') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="email"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                placeholder="Masukkan email" value="{{ old('email') }}">
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
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
