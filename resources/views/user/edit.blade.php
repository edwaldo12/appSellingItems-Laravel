@extends('layout.index')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin
            {{-- <small>Control panel</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href=" {{ route('users.index') }}">Admin</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Admin</h3>
                    </div>
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') ? old('name') : $user->name }}"
                                            placeholder="Masukkan Nama" required>
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            value="{{ old('username') ? old('username') : $user->username }}"
                                            placeholder="Masukkan Username" required>
                                        <small class="text-danger">{{ $errors->first('username') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                        <label for="status">Status</label>
                                        <select class="form-control" required name="status" id="status">
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('status') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control" name="nik" id="nik"
                                            value="{{ old('nik') ? old('nik') : $user->nik }}" placeholder="Masukkan NIK"
                                            required>
                                        <small class="text-danger">{{ $errors->first('nik') }}</small>
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value=""
                                            placeholder="Masukkan Password" required>
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" href="{{ route('users.index') }}">Kembali</a>
                            <button class="btn btn-warning" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection
