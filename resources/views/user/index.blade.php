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
            <li class="active">Admin</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-12">
                @if (Auth::user()->status == 'Admin')
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Admin</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Admin</h3>
                    </div>
                    <div class="box-body">
                        <table class="table" id="users_table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>NIK</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>{{ $user->nik }}</td>
                                        @if (Auth::user()->status == 'Admin')
                                            <td>
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('users.edit', ['user' => $user->id]) }}"><i
                                                        class="fa fa-pencil"></i></a>
                                                <form onsubmit=" return confirm('Yakin ingin menghapus?')"
                                                    action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                    method="POST" style="display: inline">
                                                    @csrf
                                                    @method("delete")
                                                    <button class="btn btn-sm btn-danger" type="submit"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        @else
                                            <td>Staff Tidak Dapat Edit</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection
@push('scripts')
    <script>
        $(function() {
            $("#users_table").DataTable()
        })
    </script>
@endpush
