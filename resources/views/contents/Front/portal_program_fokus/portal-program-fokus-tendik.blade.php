<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Program Fokus KSPSTK</title>
    <!-- Stylesheets
 ============================================= -->
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets_program_fokus/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="assets_program_fokus/css/style.css" type="text/css" />
    <link rel="stylesheet" href="assets_program_fokus/css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="assets_program_fokus/css/dark.css" type="text/css" />
    <link rel="stylesheet" href="assets_program_fokus/css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="assets_program_fokus/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="assets_program_fokus/css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="assets_program_fokus/css/custom.css" type="text/css" />

    <link rel="shortcut icon" href="assets_program_fokus/img/logo_kemendikbud.png" type="image/x-icon">
</head>

<body class="stretched">

    <!-- Document Wrapper
 ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
  ============================================= -->
        <section id="content">
            <div class="content-wrap py-0">

                <div class="section p-0 m-0 h-100 position-absolute"
                    style="background: url('images/parallax/home/1.jpg') center center no-repeat; background-size: cover;">
                </div>

                <div class="section bg-transparent vertical-middle min-vh-100 p-0 m-0">
                    <div class="container py-5 mx-auto">
                        <div class="center">
                            <h3 class="text-primary mb-2">TENDIK</h3>
                            <p class="text-muted">Program Fokus KSPSTK yang memiliki peranan dalam publikasi</p>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-8 col-12">
                                <div class="row justify-content-center">
                                  @foreach ($tendik as $item)
                                  <div class="col-md-3 col-6 mb-md-0 mb-4">
                                      <div class="flip-card text-center shadow-card primary">
                                          <div class="flip-card-front dark bg-primary no-after">
                                              <div class="flip-card-inner p-1">
                                                  <div class="card bg-transparent border-0 text-center">
                                                      <div class="card-body">
                                                          <i class="{{$item->icon}}"></i>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="flip-card-back bg-white no-after">
                                              <div class="flip-card-inner">
                                                  <p class="mb-0 text-primary">{{$item->nama_sub_program}}</p>
                                                  <button type="button"
                                                      class="btn btn-outline-primary mt-2 btn-sm">Lihat
                                                      Detail</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section><!-- #content end -->

    </div><!-- #wrapper end -->

    <!-- Go To Top
 ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- JavaScripts
 ============================================= -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.min.js"></script>

    <!-- Footer Scripts
 ============================================= -->
    <script src="js/functions.js"></script>

</body>

</html>
