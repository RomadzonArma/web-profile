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
                                                      class="btn btn-outline-primary mt-2 btn-sm" data-toggle="modal" data-target=".modal-artikel">Lihat
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

    {{-- <div class="modal fade modal-artikel" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title">Pengembangan Bukti Baik Karya KSPSTK Nusantara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('assets-front/img/karya-kspstk-nusantara.jpg') }}" alt="">
                        </div>
                        <div class="col-md-9">
                            <div class="artikel-content">
                                <div class="entry-meta mb-2 mt-0">
                                    <ul>
                                        <li><a href="#"><i class="icon-calendar3"></i>19 Maret 2024</a>
                                        </li>
                                        <li><a href="#"><i class="icon-user1"></i> Admin KSPTK</a></li>
                                        <li><a href="#"><i class="icon-line-folder"></i> Karya KSPSTK</a></li>
                                        <li><a href="#"><i class="icon-line-eye"></i>10 Dilihat</a></li>
                                    </ul>
                                </div>
                                <p class="mb-0">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque quidem, velit ullam dignissimos quia unde sunt? Sapiente, quaerat illum exercitationem commodi ducimus asperiores. Veritatis, possimus ad sint natus deserunt doloremque ab repellendus corporis, culpa delectus quia quidem laboriosam laborum rem repudiandae ullam eaque itaque perferendis animi. Laboriosam beatae vel eos.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="modal fade modal-artikel" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title">PUSTAKAWAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="post-grid py-5 row gutter-30" data-layout="fitRows">
                        <div class="entry col-md-3 col-sm-6 col-12">
                            <div class="grid-inner hover-custom">
                                <div class="entry-image">
                                    <div class="fslider" data-arrows="false" data-lightbox="gallery">
                                        <div class="flexslider">
                                            <div class="slider-wrap">
                                                <div class="slide">
                                                    <a href="assets_program_fokus/img/tas/tas1.jpg" data-lightbox="gallery-item">
                                                        <img src="assets_program_fokus/img/tas/tas1.jpg" alt="Standard Post with Gallery">
                                                    </a>
                                                </div>
                                                <div class="slide">
                                                    <a href="assets_program_fokus/img/tas/tas2.jpg" data-lightbox="gallery-item">
                                                        <img src="assets_program_fokus/img/tas/tas2.jpg" alt="Standard Post with Gallery">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="entry-title title-md">
                                    <h2><a href="#">Kerja sama dg APMAPI & ASMAPI</a></h2>
                                    
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li>
                                            <i class="icon-calendar3"></i>22 Nov 2023
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="entry col-md-3 col-sm-6 col-12">
                            <div class="grid-inner hover-custom">
                                <div class="entry-image">
                                    <div class="fslider" data-arrows="false" data-lightbox="gallery">
                                        <div class="flexslider">
                                            <div class="slider-wrap">
                                                <div class="slide">
                                                    <a href="assets_program_fokus/img/tas/tas5.jpg" data-lightbox="gallery-item">
                                                        <img src="assets_program_fokus/img/tas/tas5.jpg" alt="Standard Post with Gallery">
                                                    </a>
                                                </div>
                                                <div class="slide">
                                                    <a href="assets_program_fokus/img/tas/tas6.jpg" data-lightbox="gallery-item">
                                                        <img src="assets_program_fokus/img/tas/tas6.jpg" alt="Standard Post with Gallery">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="entry-title title-md">
                                    <h2><a href="#">Kegiatan Workshop Peningkatan Kompetensi   Tenaga Administrasi Sekolah</a></h2>
                                    
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li>
                                            <i class="icon-calendar3"></i>22 Nov 2023
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="entry col-md-3 col-sm-6 col-12">
                            <div class="grid-inner hover-custom">
                                <div class="entry-image">
                                    <iframe src="assets_program_fokus/img/tas/Majalah_Bulan_April_2024.pdf" frameborder="0"></iframe>
                                </div>
                                <div class="entry-title title-md">
                                    <h2><a href="assets_program_fokus/img/tas/Majalah_Bulan_April_2024.pdf" target="_blank">Kerja sama dg APMAPI & ASMAPI</a></h2>
                                    
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li>
                                            <i class="icon-calendar3"></i>22 Nov 2023
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScripts
 ============================================= -->
    <script src="{{ asset('assets-front/js/jquery.js') }}"></script>
    <script src="{{ asset('assets-front/js/plugins.min.js') }}"></script>

    <!-- Footer Scripts
 ============================================= -->
    <script src="{{ asset('assets-front/js/functions.js') }}"></script>

</body>

</html>
