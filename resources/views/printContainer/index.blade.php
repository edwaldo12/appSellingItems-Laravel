@extends('layout.index')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kontainer
            {{-- <small>Control panel</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Kontainer</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-12">
                Halaman Cetak Kontainer
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{ route('print.printcontainerall') }}?start_date={{ request()->query('start_date') }}&end_date={{ request()->query('end_date') }}"
                            class="btn btn-primary">Print Semua Kontainer</a>
                        <form class="row" method="GET" action="{{ url('printContainer') }}">
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
                        <table class="table" id="container_table">
                            <thead>
                                <tr>
                                    <th>ID Pengiriman</th>
                                    <th>No Seal Kontainer</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($containers as $container)
                                    <tr>
                                        <td>{{ $container->id }}</td>
                                        <td>{{ $container->no_seal_container }}</td>
                                        <td>{{ $container->tanggal }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('print.printpagecontainer', ['container_id' => $container->id]) }}"><i
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
            $("#container_table").DataTable()
        })
    </script>
@endpush
