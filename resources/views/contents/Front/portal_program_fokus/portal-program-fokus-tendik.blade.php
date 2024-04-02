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
    <link rel="stylesheet" href="{{ asset('assets-front/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets-front/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets-front/css/swiper.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets-front/css/dark.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets-front/css/font-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets-front/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets-front/css/magnific-popup.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets-front/css/custom.css') }}" type="text/css" />

    <link rel="shortcut icon" href="{{ asset('assets-front/img/logo_kemendikbud.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
                                                                <i class="{{ $item->icon }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flip-card-back bg-white no-after">
                                                    <div class="flip-card-inner">
                                                        <p class="mb-0 text-primary">{{ $item->nama_sub_program }}</p>
                                                        @if ($item->nama_sub_program == 'TAS')
                                                            <button type="button"
                                                                class="btn btn-outline-primary mt-2 btn-sm"
                                                                data-toggle="modal" data-target=".modal-tas">Lihat
                                                                Detail</button>
                                                        @endif
                                                        @if ($item->nama_sub_program == 'LABORAN')
                                                            <button type="button"
                                                                class="btn btn-outline-primary mt-2 btn-sm"
                                                                data-toggle="modal" data-target=".modal-laboran">Lihat
                                                                Detail</button>
                                                        @endif
                                                        @if ($item->nama_sub_program == 'PUSTAKAWAN')
                                                            <button type="button"
                                                                class="btn btn-outline-primary mt-2 btn-sm"
                                                                data-toggle="modal"
                                                                data-target=".modal-pustakawan">Lihat
                                                                Detail</button>
                                                        @endif
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

    <div class="modal fade modal-tas" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title">TAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="post-grid py-5 row gutter-30 justify-content-center" data-layout="fitRows">
                        @foreach ($tas as $item_tas)
                            <div class="entry col-md-3 col-sm-6 col-12">
                                <div class="grid-inner hover-custom">
                                    <div class="entry-image">
                                        <div class="fslider" data-arrows="false" data-lightbox="gallery">
                                            <div class="flexslider">
                                                <div class="slider-wrap">
                                                    @if ($item_tas->reftas->isEmpty())
                                                        <div class="slide">
                                                            <a href="{{ asset('' . $item_tas->gambar) }}"
                                                                data-lightbox="gallery-item">
                                                                <img src="{{ asset('' . $item_tas->gambar) }}"
                                                                    alt="Standard Post with Gallery">
                                                            </a>
                                                        </div>
                                                    @else
                                                        @foreach ($item_tas->reftas as $img)
                                                            <div class="slide">
                                                                <a href="{{ asset('' . $img->image) }}"
                                                                    data-lightbox="gallery-item">
                                                                    <img src="{{ asset('' . $img->image) }}"
                                                                        alt="Standard Post with Gallery">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="entry-title title-md">
                                        <h2><a href="{{ $item_tas->file_pdf ? $item_tas->file_pdf : '#' }}"
                                                target="_blank">{{ $item_tas->judul }}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li>
                                                <i
                                                    class="icon-calendar3"></i>{{ \Carbon\Carbon::parse($item_tas->created_at)->format('d F Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-laboran" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title">LABORAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="post-grid py-5 row gutter-30 justify-content-center" data-layout="fitRows">
                        @foreach ($laboran as $item_laboran)
                            <div class="entry col-md-3 col-sm-6 col-12">
                                <div class="grid-inner hover-custom">
                                    <div class="entry-image">
                                        <div class="fslider" data-arrows="false" data-lightbox="gallery">
                                            <div class="flexslider">
                                                <div class="slider-wrap">
                                                    @if ($item_laboran->reflaboran->isEmpty())
                                                        <div class="slide">
                                                            <a href="{{ asset('' . $item_laboran->gambar) }}"
                                                                data-lightbox="gallery-item">
                                                                <img src="{{ asset('' . $item_laboran->gambar) }}"
                                                                    alt="Standard Post with Gallery">
                                                            </a>
                                                        </div>
                                                    @else
                                                        @foreach ($item_laboran->reflaboran as $img)
                                                            <div class="slide">
                                                                <a href="{{ asset('' . $img->image) }}"
                                                                    data-lightbox="gallery-item">
                                                                    <img src="{{ asset('' . $img->image) }}"
                                                                        alt="Standard Post with Gallery">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="entry-title title-md">
                                        <h2><a href="{{ $item_laboran->file_pdf ? $item_laboran->file_pdf : '#' }}"
                                                target="_blank">{{ $item_laboran->judul }}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li>
                                                <i
                                                    class="icon-calendar3"></i>{{ \Carbon\Carbon::parse($item_laboran->created_at)->format('d F Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-pustakawan" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title">PUSTAKAWAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="post-grid py-5 row gutter-30 justify-content-center" data-layout="fitRows">
                        @foreach ($pustakawan as $item_pustakawan)
                            <div class="entry col-md-3 col-sm-6 col-12">
                                <div class="grid-inner hover-custom">
                                    <div class="entry-image">
                                        <div class="fslider" data-arrows="false" data-lightbox="gallery">
                                            <div class="flexslider">
                                                <div class="slider-wrap">
                                                    @if ($item_pustakawan->ref_pustakawan->isEmpty())
                                                        <div class="slide">
                                                            <a href="{{ asset('' . $item_pustakawan->gambar) }}"
                                                                data-lightbox="gallery-item">
                                                                <img src="{{ asset('' . $item_pustakawan->gambar) }}"
                                                                    alt="Standard Post with Gallery">
                                                            </a>
                                                        </div>
                                                    @else
                                                        @foreach ($item_pustakawan->ref_pustakawan as $img)
                                                            <div class="slide">
                                                                <a href="{{ asset('' . $img->image) }}"
                                                                    data-lightbox="gallery-item">
                                                                    <img src="{{ asset('' . $img->image) }}"
                                                                        alt="Standard Post with Gallery">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="entry-title title-md">
                                        <h2><a href="{{ $item_pustakawan->file_pdf ? $item_pustakawan->file_pdf : '#' }}"
                                                target="_blank">{{ $item_pustakawan->judul }}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li>
                                                <i
                                                    class="icon-calendar3"></i>{{ \Carbon\Carbon::parse($item_pustakawan->created_at)->format('d F Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
