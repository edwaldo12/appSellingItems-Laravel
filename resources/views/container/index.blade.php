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
    @if (session('Status'))
        <div class="alert alert-danger">
            {{ session('Status') }}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 15px">
            <div class="col-md-12">
                <a href="{{ route('containers.create') }}" class="btn btn-primary">Tambah Kontainer</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Pengecekan Kontainer</h3>
                    </div>
                    <div class="box-body">
                        <table class="table" id="containers_table">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>ID Pengiriman</th>
                                    <th>No Seal Kontainer</th>
                                    <th>Tipe Kontainer</th>
                                    <th>Suhu Sebelum Loading</th>
                                    <th>Suhu Sesudah Loading</th>
                                    <th>Kondisi Fisik</th>
                                    <th>Tidak Berbau Menyengat</th>
                                    <th>Tidak Kotor</th>
                                    <th>Tidak Terdapat Bocor</th>
                                    <th>Status Kontainer</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($containers as $container)
                                    <tr>
                                        <td>{{ $container->jenis }}</td>
                                        <td>{{ $container->sending_id }}</td>
                                        <td>{{ $container->no_seal_container }}</td>
                                        <td>{{ $container->type_container }}</td>
                                        <td>{{ $container->suhu_sebelum_loading }}</td>
                                        <td>{{ $container->suhu_sesudah_loading }}</td>
                                        <td>{{ $container->kondisi_fisik }}</td>
                                        <td>{{ $container->tidak_berbau_menyengat }}</td>
                                        <td>{{ $container->tidak_kotor }}</td>
                                        <td>{{ $container->tidak_terdapat_bocor }}</td>
                                        <td>{{ $container->status_container }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('containers.edit', ['container' => $container->id]) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            {{-- <form onsubmit=" return confirm('Yakin ingin menghapus?')"
                                                action="{{ route('containers.destroy', ['container' => $container->id]) }}"
                                                method="POST" style="display: inline">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-sm btn-danger" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form> --}}
                                            <button class="btn btn-sm btn-primary btn-foto"
                                                data-id="{{ $container->id }}">
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
            $("#containers_table").DataTable()

            $(".btn-foto").on('click', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('container_foto') }}/" + $(this).data('id'),
                    success: function(result) {
                        console.log(result)
                        let foto = result.foto
                        let _foto = ""
                        foto.forEach((f) => {
                            _foto +=
                                `<div class="col-sm-6"><img class="img-thumbnail" style="height:250px;width:100%" src='{{ url('foto') }}/${f.foto}' /><a href="{{ url('hapus_container_foto') }}/${f.id}">Hapus</a></div>`
                        })
                        $("#modal-foto #modal-body").html(`<div class="row">${_foto}</div>`)
                    }
                })

                $("#modal-foto").modal('show')
            })
        })
    </script>
@endpush
