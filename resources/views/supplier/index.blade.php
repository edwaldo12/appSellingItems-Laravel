@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Supplier
        </h1>
        <ol class="breadcrumb">
            {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Supplier</a></li> --}}
            <li class="active">Supplier</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data Supplier</h4>
                        </div>
                        {{-- <div class="box-header">
                            <button type="button" class="btn btn-success">
                                <a href="{{ route('supplier.create') }}" style="color:white">Tambah</a>
                            </button>
                        </div> --}}
                        <div class="box-body">
                            <table id="table_supplier" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Supplier</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        @if (Auth::user()->tipe_pengguna == 'Operator')
                                        @else
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supplier as $supplier)
                                        <tr>
                                            <td>{{ $supplier->nama }}</td>
                                            <td>{{ $supplier->telepon }}</td>
                                            <td>{{ $supplier->alamat }}</td>
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
                                                                    href="{{ route('supplier.edit', ['supplier' => $supplier->id]) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="this.nextElementSibling.submit()">
                                                                    Hapus
                                                                </a>
                                                                <form
                                                                    action="{{ route('supplier.destroy', ['supplier' => $supplier->id]) }}"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Ingin menghapus Supplier?')"
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
        $("#table_supplier").DataTable()
    </script>

    @if (session('store_supplier') === true)
        <script>
            alert('Supplier telah ditambah...')
        </script>
    @endif
    @if (session('update_supplier') === true)
        <script>
            alert('Supplier telah diubah...')
        </script>
    @endif
    @if (session('destroy_supplier') === true)
        <script>
            alert('Supplier telah dihapus...')
        </script>
    @endif
@endpush
