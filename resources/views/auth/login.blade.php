<!DOCTYPE html>
<html lang="en">

<head>

    <style type="text/css">
        @media (max-width: 1920px) {

            /* CSS that should be displayed if width is equal to or less than 800px goes here */
            .tes {
                margin-top: 100px;
            }

            .card-body {
                margin-top: 110px;
                margin-bottom: 130px;
            }

            .img-fluid {
                margin-top: 150px;
            }

            @media (max-width: 1366px) {
                .tes {
                    margin-top: 40px;
                }

                .text-header {
                    margin-top: 0px;
                }

                .card-body {
                    margin-top: 60px;
                    margin-bottom: 60px;
                }

                .img-fluid {
                    margin-top: 100px;
                }
            }
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-fixed bg-light">

    @include('sweetalert::alert')

    <!-- /.login-logo -->
    <div class="tes container">
        <div class="row mt-4">
            <div class="col-md-12 mt-4">
                <div class="card shadow  mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-fluid" src="{{ asset('img/Logo_FBI.png') }}" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="card-header text-center text-header">

                                <a href="{{ asset('template/') }}/index2.html" class="h1"><b
                                        class=""></b>FIBERBOAT INDONESIA</a>
                            </div>
                            <div class="card-body">
                                <p class="login-box-msg">Sign in to start your session</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('login_data') }}" method="post">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" value="{{ old('name') }}" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password-field" placeholder="Password" required
                                                    value="{{ old('password') }}">

                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span toggle="#password-field"
                                                            class="fa fa-fw fa-eye field-icon toggle-password-icon"></span>
                                                    </div>
                                                </div>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-block">Sign
                                                        In</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
    <!-- /.card -->

    <!-- jQuery -->
    <script src="{{ asset('template/') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/') }}/dist/js/adminlte.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            @if (session('error'))
                Swal.fire({
                    title: `Username atau Password salah`,
                    text: "Login Error !",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
            @endif
        });
    </script>

    <script>
        $(".toggle-password-icon").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>
