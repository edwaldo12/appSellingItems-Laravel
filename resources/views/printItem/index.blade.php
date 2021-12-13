@extends('layout.index')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengiriman Barang
            {{-- <small>Control panel</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pengiriman Barang</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-12">
                Halaman Cetak Pengiriman Barang
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{ route('print.printallpageitem') }}?start_date={{ request()->query('start_date') }}&end_date={{ request()->query('end_date') }}"
                            class="btn btn-primary">Print Semua Pengiriman Barang</a>
                        <form class="row" method="GET" action="{{ url('printSendingItem') }}">
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
                        <table class="table" id="sendingItem_table">
                            <thead>
                                <tr>
                                    <th>ID Pengiriman</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>No Kontainer</th>
                                    <th>Plat Nomor</th>
                                    <th>Barang Yang Dikirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sendingItem as $sendingItem)
                                    <tr>
                                        <td>{{ $sendingItem->id }}</td>
                                        <td>{{ $sendingItem->tanggal }}</td>
                                        <td>{{ $sendingItem->jenis }}</td>
                                        <td>{{ $sendingItem->no_container }}</td>
                                        <td>{{ $sendingItem->plat_nomor }}</td>
                                        <td>{{ $sendingItem->good_items->nama_produk }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('print.printpageitem', ['sendingItem_id' => $sendingItem->id]) }}"><i
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
            $("#sendingItem_table").DataTable()
        })
    </script>
@endpush
