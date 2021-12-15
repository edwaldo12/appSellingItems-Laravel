<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigasi Utama</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Pengguna</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->tipe_pengguna == 'Operator' || Auth::user()->tipe_pengguna == 'Admin')
                        <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Lihat</a></li>
                    @else
                        <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Lihat</a></li>
                        <li><a href="{{ route('users.create') }}"><i class="fa fa-circle-o"></i>Tambah</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Barang</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->tipe_pengguna == 'Operator')
                        <li><a href="{{ route('barang.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                    @else
                        <li><a href="{{ route('barang.index') }}"><i class="fa fa-circle-o"></i>Lihat</a></li>
                        <li><a href="{{ route('barang.create') }}"><i class="fa fa-circle-o"></i>Tambah</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Supplier</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->tipe_pengguna == 'Operator')
                        <li><a href="{{ route('supplier.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                    @else
                        <li><a href="{{ route('supplier.index') }}"><i class="fa fa-circle-o"></i>Lihat</a></li>
                        <li><a href="{{ route('supplier.create') }}"><i class="fa fa-circle-o"></i>Tambah</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Pelanggan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->tipe_pengguna == 'Operator')
                        <li><a href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                    @else
                        <li><a href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                        <li><a href="{{ route('customer.create') }}"><i class="fa fa-circle-o"></i> Tambah</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Pembelian</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->tipe_pengguna == 'Operator')
                        <li><a href="{{ route('pembelian.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                    @else
                        <li><a href="{{ route('pembelian.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                        <li><a href="{{ route('pembelian.create') }}"><i class="fa fa-circle-o"></i> Tambah</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Penjualan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->tipe_pengguna == 'Operator')
                        <li><a href="{{ route('penjualan.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                    @else
                        <li><a href="{{ route('penjualan.index') }}"><i class="fa fa-circle-o"></i> Lihat</a></li>
                        <li><a href="{{ route('penjualan.create') }}"><i class="fa fa-circle-o"></i> Tambah</a></li>
                    @endif
                </ul>
            </li>
        </ul>
    </section>
</aside>
