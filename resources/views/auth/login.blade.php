<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | KSPS Tendik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="KSPS" name="description" />
    <meta content="alief" name="author" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="assets-dashboard/images/favicon.ico"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets-dashboard/image/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets-dashboard/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets-dashboard/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets-dashboard/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets-dashboard/css/custom.css">

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container" style="margin-top: 120px;">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card rounded overflow-hidden">
                        <div class="text-white" style="background-color: #365984;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-white p-4">
                                        <h5 class="text-white">Selamat Datang di KSPS</h5>
                                        <p>Masuk untuk melanjutkan</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets-dashboard/image/logo-kemendikbud.png" alt=""
                                        class="rounded-circle" height="96"
                                        style="margin-left: 36px; margin-bottom: 8px;">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <!-- <div>
                                <a href="index.html">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="assets-dashboard/images/logo.svg" alt="" class="rounded-circle" height="36">
                                        </span>
                                    </div>
                                </a>
                            </div> -->
                            <div class="p-2 mt-4">
                                @if (Session::has('error-msg'))
                                    <div class="alert alert-danger" role="alert">
                                        @php
                                            Session::get('error-msg', 'default');
                                        @endphp
                                    </div>
                                @endif

                                @if (session('message'))
                                    <div class="alert alert-danger">{{ session('message') }}</div>
                                @endif
                                <form class="form-horizontal" action="{{ route('login') }}" autocomplete="off"
                                    method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text"
                                            class="form-control  @error('username') is-invalid @enderror" id="username"
                                            name="username" value="{{ old('username') }}"
                                            placeholder="Masukan username"autofocus>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" value="{{ old('password') }}"
                                                placeholder="Masukkan Kata Sandi">
                                            <div class="input-group-append">
                                                <button type="button" class="btn text-white" id="show"
                                                    style="background-color: #365984;"><i
                                                        class="bx bx-show"></i></button>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember
                                            me</label>
                                    </div> -->


                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light"
                                            type="submit">Masuk</button>
                                    </div>




                                    <!-- <div class="mt-4 text-center">
                                        <h5 class="font-size-14 mb-3">Sign in with</h5>

                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript::void()"
                                                    class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript::void()"
                                                    class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript::void()"
                                                    class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> -->

                                    <!-- <div class="mt-4 text-center">
                                        <a href="auth-recoverpw.html" class="text-muted"><i
                                                class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                                    </div> -->
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

                        <div>
                            <p>©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> KSPS
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets-dashboard/libs/jquery/jquery.min.js"></script>
    <script src="assets-dashboard/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets-dashboard/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets-dashboard/libs/simplebar/simplebar.min.js"></script>
    <script src="assets-dashboard/libs/node-waves/waves.min.js"></script>
    <script>
        let show = false;
        $('#show').on('click', function() {
            if (show == false) {
                $('#password').attr('type', 'text');
                show = true;
            } else {
                $('#password').attr('type', 'password');
                show = false;
            }
        })
    </script>

    <!-- App js -->
    <script src="assets-dashboard/js/app.js"></script>
</body>

</html>
