@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            Pembelian
        </h1>
        <ol class="breadcrumb">
            {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Pembelian</a></li> --}}
            <li class="active">Pembelian</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data Pembelian</h4>
                        </div>
                        @if (Auth::user()->tipe_pengguna == 'Admin' || Auth::user()->tipe_pengguna == 'Super_Admin')
                            <div class="box-header">
                                <button type="button" class="btn btn-success">
                                    <a href="{{ route('pembelian.create') }}" style="color:white">Tambah</a>
                                </button>
                            </div>
                        @endif
                        <a href="{{ url('print/pembelian') }}" style="margin-left:5px;">
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
                            <table id="table_pembelian" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Total</th>
                                        @if (Auth::user()->tipe_pengguna == 'Operator')
                                        @else
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                <tbody>
                                    @foreach ($pembelian as $p)
                                        <tr>
                                            <td>{{ $p->supplier->nama }}</td>
                                            <td>{{ $p->user->nama }}</td>
                                            <td>{{ date('Y-m-d', strtotime($p->created_at)) }}</td>
                                            <td>Rp. {{ number_format($p->total) }}</td>
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
                                                                    href="{{ route('pembelian.edit', ['pembelian' => $p->id]) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="{{ url('printeachone', ['id' => $p->id]) }}">Print</a>
                                                            </li>
                                                            {{-- <li>
                                                            <a
                                                                href="{{ route('pembelian.show', ['pembelian' => $p->id]) }}">Detail</a>
                                                        </li> --}}
                                                            <li>
                                                                <a href="#" onclick="this.nextElementSibling.submit()">
                                                                    Hapus
                                                                </a>
                                                                <form
                                                                    action="{{ route('pembelian.destroy', ['pembelian' => $p->id]) }}"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Ingin menghapus Pembelian?')"
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
        $("#table_pembelian").DataTable()
    </script>

    @if (session('store_pembelian') === true)
        <script>
            alert('Pembelian telah ditambah...')
        </script>
    @endif
    @if (session('update_pembelian') === true)
        <script>
            alert('Pembelian telah diubah...')
        </script>
    @endif
    @if (session('destroy_pembelian') === true)
        <script>
            alert('Pembelian telah dihapus...')
        </script>
    @endif
@endpush
