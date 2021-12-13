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
    @if (session('Status'))
        <div class="alert alert-danger">
            {{ session('Status') }}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-12">
                <a href="{{ route('goods.create') }}" class="btn btn-primary">Tambah Barang</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Pengecekan Barang</h3>
                    </div>
                    <div class="box-body">
                        <table class="table" id="good_table">
                            <thead>
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Produk</th>
                                    <th>Nomor Produk</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Batch</th>
                                    <th>PO</th>
                                    <th>BS</th>
                                    <th>Priority Check</th>
                                    <th>Sampling</th>
                                    <th>Release</th>
                                    <th>Rejected</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($goods as $good)
                                    <tr>
                                        <td>ID-{{ sprintf('%04d', $good->id) }}</td>
                                        <td>{{ $good->nama_produk }}</td>
                                        <td>Rp.
                                            {{ $good->nomor_produk }}</td>
                                        <td>{{ $good->satuan }} </td>
                                        <td>{{ $good->tanggal }}</td>
                                        <td>{{ $good->jenis }}</td>
                                        <td>{{ $good->batch }}</td>
                                        <td>{{ $good->po }}</td>
                                        <td>{{ $good->bs }}</td>
                                        <td>{{ $good->priority_check }}</td>
                                        <td>{{ $good->sampling }}</td>
                                        <td>{{ $good->release }}</td>
                                        <td>{{ $good->rejected }}</td>
                                        <td>{{ $good->keterangan }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('goods.edit', ['good' => $good->id]) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            {{-- <form action="{{ route('goods.destroy', ['good' => $good->id]) }}"
                                                onsubmit=" return confirm('Yakin ingin menghapus?')" method="POST"
                                                style="display: inline">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-sm btn-danger" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form> --}}
                                            <button class="btn btn-sm btn-primary btn-foto" data-id="{{ $good->id }}">
                                                <i class="fa fa-image"></i>
                                            </button>
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
    <div class="modal" tabindex="-1" role="dialog" id="modal-foto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




@endsection
@push('scripts')
    <script>
        $(function() {
            $("#good_table").DataTable()

            $(".btn-foto").on('click', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('good_foto') }}/" + $(this).data('id'),
                    success: function(result) {
                        console.log(result)
                        let foto = result.foto
                        let _foto = ""
                        foto.forEach((f) => {
                            _foto +=
                                `<div class="col-sm-6"><img class="img-thumbnail" style="height:250px;width:100%" src='{{ url('foto') }}/${f.foto}' /><a href="{{ url('hapus_good_foto') }}/${f.id}">Hapus</a></div>`
                        })
                        $("#modal-foto #modal-body").html(`<div class="row">${_foto}</div>`)
                    }
                })

                $("#modal-foto").modal('show')
            })
        })
    </script>
@endpush
