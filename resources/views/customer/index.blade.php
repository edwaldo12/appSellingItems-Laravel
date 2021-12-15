@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Pelanggan
        </h1>
        <ol class="breadcrumb">
            {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Pelanggan</a></li> --}}
            <li class="active">Pelanggan</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data Pelanggan</h4>
                        </div>
                        {{-- <div class="box-header">
                            <button type="button" class="btn btn-success">
                                <a href="{{ route('customer.create') }}" style="color:white">Tambah</a>
                            </button>
                        </div> --}}
                        <div class="box-body">
                            <table id="table_Pelanggan" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Pelanggan</th>
                                        <th>Telpon</th>
                                        <th>Alamat</th>
                                        @if (Auth::user()->tipe_pengguna == 'Operator')
                                        @else
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer as $customer)
                                        <tr>
                                            <td>{{ $customer->nama }}</td>
                                            <td>{{ $customer->telepon }}</td>
                                            <td>{{ $customer->alamat }}</td>
                                            @if (Auth::user()->tipe_pengguna == 'Operator')
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
                                                                    href="{{ route('customer.edit', ['customer' => $customer->id]) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="this.nextElementSibling.submit()">
                                                                    Hapus
                                                                </a>
                                                                <form
                                                                    action="{{ route('customer.destroy', ['customer' => $customer->id]) }}"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Ingin menghapus customer?')"
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
            </div> <!-- end row -->
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#table_Pelanggan").DataTable()
    </script>

    @if (session('store_customer') === true)
        <script>
            alert('Customer telah ditambah...')
        </script>
    @endif
    @if (session('update_customer') === true)
        <script>
            alert('Customer telah diubah...')
        </script>
    @endif
    @if (session('destroy_customer') === true)
        <script>
            alert('Customer telah dihapus...')
        </script>
    @endif
@endpush
