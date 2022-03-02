@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Detail Penjualan
        </h1>
        <ol class="breadcrumb">
            {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Detail Penjualan</a></li> --}}
            <li class="active">Detail Penjualan</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data Detail Penjualan</h4>
                        </div>
                        <div class="box-body">
                            <table id="table_detail" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Penjualan</th>
                                    </tr>
                                <tbody>
                                    @foreach ($detailPenjualan as $detail)
                                        <tr>
                                            <td>{{ $detail->barang->nama }}</td>
                                            <td>{{ $detail->jumlah }}</td>
                                            <td>{{ date('Y-m-d', strtotime($detail->created_at)) }}</td>
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
        $("#table_detail").DataTable()
    </script>
@endpush
