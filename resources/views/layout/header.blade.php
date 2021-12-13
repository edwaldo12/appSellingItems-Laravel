<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <span class="logo-lg">
            {{-- <img src="{{ url('logo/logo_gas.png') }}" width="50px" alt=""> --}}
            Admin
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                {{ Auth::user()->name }} - {{ Auth::user()->username }}
                                <small>Member since {{ Auth::user()->created_at }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <div class="pull-right">
                                    <button class="btn btn-default btn-flat">Logout</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
