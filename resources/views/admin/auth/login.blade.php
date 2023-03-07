<!doctype html>
<html lang="en" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin | Login</title>
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('images/logo.ico') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/logo.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo.ico') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" href="{{ asset('__/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('__/css/codebase.min.css') }}">
    <!-- END Stylesheets -->
</head>
<body>
<div id="page-container" class="main-content-boxed">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{ asset('__/media/photos/photo34@2x.jpg') }}');">
            <div class="row mx-0 bg-black-op">
                <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                    <div class="p-30 invisible" data-toggle="appear">
                        <p class="font-size-h3 font-w600 text-white">
                            Get Inspired and Create.
                        </p>
                        <p class="font-italic text-white-op">
                            Copyright &copy; <span class="js-year-copy"></span>
                        </p>
                    </div>
                </div>
                <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                    <div class="content content-full">
                        <!-- Header -->
                        <div class="px-30 py-10">
                            <a class="link-effect font-w700" href="index.html">
                                <i class="si si-fire"></i>
                                <span class="font-size-xl text-primary-dark">ad</span><span class="font-size-xl">rand</span>
                            </a>
                            <h1 class="h3 font-w700 mt-30 mb-10">Welcome to Your Dashboard</h1>
                            <h2 class="h5 font-w400 text-muted mb-0">Please sign in</h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="px-30 form-authen" action="{{ route('admin.login.post') }}" method="post">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="login-username" name="login-username">
                                        <label for="login-username">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="login-password" name="login-password">
                                        <label for="login-password">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="login-remember-me" name="remember-me">
                                        <label class="custom-control-label" for="login-remember-me">Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                    <i class="si si-login mr-10"></i> Sign In
                                </button>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

<script src="{{ asset('__/js/codebase.core.min.js')  }}"></script>
<script src="{{ asset('__/js/codebase.app.min.js')  }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('__/js/plugins/jquery-validation/jquery.validate.min.js')  }}"></script>
<script src="{{ asset('__/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('__/js/pages/op_auth_signin.min.js')  }}"></script>
<script src="{{ asset('__/js/auth.js')  }}"></script>
<script>
    window.toast = Swal.mixin({
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-alt-success m-5',
            cancelButton: 'btn btn-alt-danger m-5',
            input: 'form-control'
        }
    });
</script>
</body>
</html>
