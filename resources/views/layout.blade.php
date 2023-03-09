<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>

<body>
    <div id="header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40px">
        </div>
        <div class="menu">
            @yield('menu-head')
        </div>
    </div>
    <div id="contents">
        @yield('contents')
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/store.min.js') }}"></script>
    <script src="{{ asset('js/fire.js') }}"></script>
    @yield('script')
</body>

</html>
