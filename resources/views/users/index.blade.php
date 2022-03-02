@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Pengguna
        </h1>
        <ol class="breadcrumb">
            {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Pengguna</a></li> --}}
            <li class="active">Pengguna</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data Pengguna</h4>
                        </div>
                        @if (Auth::user()->tipe_pengguna == 'Admin' || Auth::user()->tipe_pengguna == 'Super_Admin')
                            <div class="box-header">
                                <button type="button" class="btn btn-success">
                                    <a href="{{ route('users.create') }}" style="color:white">Tambah</a>
                                </button>
                            </div>
                        @endif
                        <div class="box-body">
                            <table id="table_pengguna" class="table table-bordered compact">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Tipe Pengguna</th>
                                        <th>Username</th>
                                        @if (Auth::user()->tipe_pengguna == 'Operator' || Auth::user()->tipe_pengguna == 'Admin')
                                        @else
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->telepon }}</td>
                                            <td>{{ $user->email }}</td>
                                            @if ($user->tipe_pengguna == 'Super_Admin')
                                                <td>Super Admin</td>
                                            @else
                                                <td>{{ $user->tipe_pengguna }}</td>
                                            @endif
                                            <td>{{ $user->username }}</td>
                                            @if (Auth::user()->tipe_pengguna == 'Operator' || Auth::user()->tipe_pengguna == 'Admin')
                                            @else
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            <span class="fa fa-cog"></span>
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a
                                                                    href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="this.nextElementSibling.submit()">
                                                                    Hapus
                                                                </a>
                                                                <form
                                                                    action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Ingin menghapus pengguna?')"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#table_pengguna").DataTable({
            buttons: ['copy', 'csv', 'excel']
        })
    </script>

    @if (session('store_user') === true)
        <script>
            alert('Pengguna telah ditambah...')
        </script>
    @endif
    @if (session('update_user') === true)
        <script>
            alert('Pengguna telah diubah...')
        </script>
    @endif
    @if (session('destroy_user') === true)
        <script>
            alert('Pengguna telah dihapus...')
        </script>
    @endif
@endpush
