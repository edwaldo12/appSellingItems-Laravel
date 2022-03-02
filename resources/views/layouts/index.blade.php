<!DOCTYPE html>
<html>

<head>
    @include('layouts.head')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('layouts.footer')

    </div>

    @include('layouts.scripts')
    @stack('scripts')
</body>

</html>