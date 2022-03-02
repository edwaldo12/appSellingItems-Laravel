@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Penjualan
        </h1>
        <ol class="breadcrumb">
            {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Penjualan</a></li> --}}
            <li class="active">Penjualan</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data Penjualan</h4>
                        </div>
                        @if (Auth::user()->tipe_pengguna == 'Admin' || Auth::user()->tipe_pengguna == 'Super_Admin')
                            <div class="box-header">
                                <button type="button" class="btn btn-success">
                                    <a href="{{ route('penjualan.create') }}" style="color:white">Tambah</a>
                                </button>
                            </div>
                        @endif
                        <a href="{{ url('print/penjualan') }}" style="margin-left:5px;">
                            <button class="btn btn-submit">Print Laporan</button>
                        </a>
                        <div class="box-body">
                            <form action="" method="GET">
                                <p>Filter Data</p>
                                <input type="date" name="start_date" class="form-control"
                                    style="min-width:100px;max-width:200px;width:100%;display:inline-block"
                                    placeholder="Dimulai dari tanggal" required>
                                <input type="date" name="end_date" class="form-control"
                                    style="min-width:100px;max-width:200px;width:100%;display:inline-block"
                                    placeholder="Hingga Tanggal" required>
                                <button class="btn btn-primary" style="position:relative;top:-2px"><i
                                        class="fa fa-search"></i></button>
                            </form>
                            <br />
                            <table id="table_penjualan" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Pelanggan</th>
                                        <th>Nama User</th>
                                        <th>Tanggal Penjualan</th>
                                        <th>Total</th>
                                        @if (Auth::user()->tipe_pengguna == 'Operator')
                                        @else
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan as $penjualan)
                                        <tr>
                                            <td>{{ $penjualan->pelanggan->nama }}</td>
                                            <td>{{ $penjualan->user->nama }}</td>
                                            <td>{{ date('Y-m-d', strtotime($penjualan->created_at)) }}</td>
                                            <td>Rp. {{ number_format($penjualan->total) }}</td>
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
                                                                    href="{{ route('penjualan.edit', ['penjualan' => $penjualan->id]) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="{{ url('printeachoneselling', ['id' => $penjualan->id]) }}">Print</a>
                                                            </li>
                                                            {{-- <li>
                                                                <a
                                                                    href="{{ route('penjualan.show', ['penjualan' => $penjualan->id]) }}">Detail</a>
                                                            </li> --}}
                                                            <li>
                                                                <a href="#" onclick="this.nextElementSibling.submit()">
                                                                    Hapus
                                                                </a>
                                                                <form
                                                                    action="{{ route('penjualan.destroy', ['penjualan' => $penjualan->id]) }}"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Ingin menghapus Penjualan?')"
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
        $("#table_penjualan").DataTable()
    </script>

    @if (session('store_penjualan') === true)
        <script>
            alert('Penjualan telah ditambah...')
        </script>
    @endif
    @if (session('update_penjualan') === true)
        <script>
            alert('Penjualan telah diubah...')
        </script>
    @endif
    @if (session('destroy_penjualan') === true)
        <script>
            alert('Penjualan telah dihapus...')
        </script>
    @endif
@endpush
