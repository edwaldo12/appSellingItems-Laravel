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
    @if (session('Status'))
        <div class="alert alert-danger">
            {{ session('Status') }}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-12">
                <a href="{{ route('sendingItems.create') }}" class="btn btn-primary">Tambah Barang Pengiriman</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Pengecekan Pengiriman</h3>
                    </div>
                    <div class="box-body">
                        <table class="table" id="sendingItems_table">
                            <thead>
                                <tr>
                                    <th>ID Pengiriman</th>
                                    <th>Jenis</th>
                                    <th>No Kontainer</th>
                                    <th>Plat Nomor</th>
                                    <th>PO</th>
                                    <th>Nama Produk</th>
                                    <th>Batch</th>
                                    <th>Release</th>
                                    <th>Reject</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sendingItems as $sendingItem)
                                    <tr>
                                        <td>{{ $sendingItem->id }}</td>
                                        <td>{{ $sendingItem->jenis }}</td>
                                        <td>{{ $sendingItem->no_container }}</td>
                                        <td>{{ $sendingItem->plat_nomor }}</td>
                                        <td>{{ $sendingItem->po }}</td>
                                        <td>{{ $sendingItem->good_items->nama_produk }}</td>
                                        <td>{{ $sendingItem->good_items->batch }}</td>
                                        <td>{{ $sendingItem->good_items->release }}</td>
                                        <td>{{ $sendingItem->good_items->rejected }}</td>
                                        <td>{{ $sendingItem->keterangan }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('sendingItems.edit', ['sendingItem' => $sendingItem->id]) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            {{-- <form onsubmit=" return confirm('Yakin ingin menghapus?')"
                                                action="{{ route('sendingItems.destroy', ['sendingItem' => $sendingItem->id]) }}"
                                                method="POST" style="display: inline">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-sm btn-danger" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form> --}}
                                            <button class="btn btn-sm btn-primary btn-foto"
                                                data-id="{{ $sendingItem->id }}">
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
            $("#sendingItems_table").DataTable()

            $(".btn-foto").on('click', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('pengiriman_foto') }}/" + $(this).data('id'),
                    success: function(result) {
                        let foto = result.foto
                        console.log(foto)
                        let _foto = ""
                        foto.forEach((f) => {
                            _foto +=
                                `<div class="col-sm-6"><img class="img-thumbnail" style="height:250px;width:100%" src='{{ url('foto') }}/${f.photo}' /><a href="{{ url('hapus_pengiriman_foto') }}/${f.id}">Hapus</a></div>`
                        })
                        $("#modal-foto #modal-body").html(`<div class="row">${_foto}</div>`)
                    }
                })

                $("#modal-foto").modal('show')
            })
        })
    </script>
@endpush
