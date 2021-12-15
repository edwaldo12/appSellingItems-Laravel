@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Barang
        </h1>
        <ol class="breadcrumb">
            {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Barang</a></li> --}}
            <li class="active">Barang</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data Barang</h4>
                        </div>
                        {{-- <div class="box-header">
                            <button type="button" class="btn btn-success">
                                <a href="{{ route('barang.create') }}" style="color:white">Tambah</a>
                            </button>
                        </div> --}}
                        <a href="{{ url('print/barang') }}" style="margin-left:5px;">
                            <button class="btn btn-submit">Print Laporan</button>
                        </a>
                        <div class="box-body">
                            <table id="table_barang" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        @if (Auth::user()->tipe_pengguna == 'Operator')
                                        @else
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $barang)
                                        <tr>
                                            <td>{{ $barang->nama }}</td>
                                            <td>{{ $barang->satuan }}</td>
                                            <td>Rp. {{ number_format($barang->harga_beli) }}</td>
                                            <td>Rp. {{ number_format($barang->harga_jual) }}</td>
                                            <td>{{ $barang->stok }}</td>
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
                                                                    href="{{ route('barang.edit', ['barang' => $barang->id]) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="this.nextElementSibling.submit()">
                                                                    Hapus
                                                                </a>
                                                                <form
                                                                    action="{{ route('barang.destroy', ['barang' => $barang->id]) }}"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Ingin menghapus barang?')"
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
        $("#table_barang").DataTable()
    </script>

    @if (session('store_barang') === true)
        <script>
            alert('Barang telah ditambah...')
        </script>
    @endif
    @if (session('update_barang') === true)
        <script>
            alert('Barang telah diubah...')
        </script>
    @endif
    @if (session('destroy_barang') === true)
        <script>
            alert('Barang telah dihapus...')
        </script>
    @endif
@endpush
