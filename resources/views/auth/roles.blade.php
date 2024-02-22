<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | KSPS Tendik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
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
                                <form class="form-horizontal" action="{{ route('choose-role') }}" method="post"
                                    id="form-choose-role">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Crypt::encrypt($user->id) }}">
                                    <div class="user-thumb text-center mb-4">
                                        <img src="{{ asset('img/user_icon.png') }}"
                                            class="rounded-circle img-thumbnail avatar-md" alt="thumbnail">
                                        <h5 class="font-size-15 mt-3">
                                            <?= $user->name ?>
                                        </h5>
                                    </div>
                                    @if (!empty($user->roles))
                                        <div class="form-group">
                                            <label for="role_id">Peran</label>
                                            <select name="role_id" id="role_id" class="form-control">
                                                <option value="" selected disabled>Pilih Peran</option>
                                                @foreach ($user->roles as $role)
                                                    <option value="{{ Crypt::encrypt($role->id) }}">
                                                        {{ Str::ucfirst($role->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            Anda belum memiliki hak akses untuk masuk kedalam sistem. Hubungi admin
                                            untuk
                                            informasi lebih lanjut!
                                        </div>
                                    @endif
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <div>
                            <p>Bukan Anda? <a href="{{ route('logout') }}" class="font-weight-medium text-primary"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    Kembali ke halaman login </a> </p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

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
    <script src="{{ asset('js/page/auth/chooseRole.js') }}"></script>
</body>

</html>
