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
            <li class="active">Barang</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-12">
                Halaman Cetak Barang
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{ route('print.printpageall') }}" class="btn btn-primary">Print Semua Barang</a>
                        <form class="row" method="GET" action="{{ url('print') }}">
                            <div class="col-md-4 form-group">
                                <label for="start_date">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="start_date">Tanggal Akhir</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            <div class="col-md-4 form-group" style="margin-top:22px">
                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="box-body">
                        <table class="table" id="good_table">
                            <thead>
                                <tr>
                                    <th>No produk</th>
                                    <th>Nama Produk</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($goods as $good)
                                    <tr>
                                        <td>{{ $good->nomor_produk }}</td>
                                        <td>{{ $good->nama_produk }}</td>
                                        <td>{{ $good->tanggal }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('print.printpage', ['good_id' => $good->id]) }}"><i
                                                    class="fa fa-print"></i></a>
                                        </td>
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
            $("#good_table").DataTable()
        })
    </script>
@endpush
