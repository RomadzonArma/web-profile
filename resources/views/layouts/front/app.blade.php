@inject('carbon', 'Carbon\Carbon')
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.front.css')
    <!-- Document Title ============================================= -->
    <title>KSPSTENDIK Kemdikbud | 2024</title>

</head>

<body class="stretched">
    <div id="wrapper" class="clearfix">

        @include('layouts.front.header_mobile')

        @yield('content-header')

        @include('layouts.front.header')

        {{-- @yield('content-index') --}}


        {{-- @dd($podcast) --}}
        <section class="px-md-5">
            <div class="content-wrap">
                <div class="container-fluid">
                    <div class="row">

                        @yield('content')

                        <div class="col-md-3 col-12 mt-4">
                            <div class="heading-block md mb-3">
                                <h4 class="mb-1">MEDIA SOSIAL</h4>
                            </div>
                            <div class="fslider fslider-banner testimonial-full mb-4" data-animation="slide"
                                data-arrows="false">
                                <div class="flexslider">
                                    <div class="slider-wrap">
                                        @foreach ($podcast as $item)
                                            <div class="slide" style="max-height: 100%;">
                                                <div class="overlaying-img">
                                                    <a href="{{ $item->link_podcast }}"><img class="img-fluid"
                                                            src="{{ asset('podcast/' . $item->gambar) }}"
                                                            style="width: 100%;" alt="Image 1"></a>

                                                    <a href="{{ $item->link_podcast }}" target="_blank">
                                                        <div class="bg-overlay">
                                                            <div class="overlaying-desc">
                                                                <a href="{{ $item->link_podcast }}" target="_blank">
                                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="widget clearfix">
                                <div class="heading-block md mb-3">
                                    <h4 class="mb-1">BERITA TERKINI</h4>
                                </div>
                                @foreach ($berita as $item)
                                    <div class="entry mb-4">
                                        <div class="grid-inner row no-gutters p-0">
                                            <div class="entry-image col-xl-4 mb-xl-0">
                                                <a href="/berita/detail/{{ $item->slug }}">
                                                    <img src="{{ asset('list_berita/' . $item->gambar) }}"
                                                        alt="thumbnail_berita">
                                                </a>
                                            </div>
                                            <div class="col-xl-8 pl-xl-4">
                                                <div class="entry-title title-xs text-clamp-2">
                                                    <h5 class="mb-1"><a href="/berita/detail/{{ $item->slug }}">{{ $item->judul }}</a></h5>
                                                </div>
                                                <div class="entry-meta mb-2 mt-0">
                                                    <ul>
                                                        <li><a href="#"><i class="icon-calendar3"></i>
                                                                {{ $carbon::parse($item->date)->format('d M Y') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                </div>
            {{--  </div>  --}}
            </div>
        </section>

        @include('layouts.front.footer')

    </div>

    <a href="javascript:void(0)" id="faq">
        <div class="position-relative">
            <i class="icon-line-phone"></i>
            <h6 class="text-white mb-0">INFO KSPS</h6>
        </div>
    </a>
    <div class="faq-wrapper">
        <h5 class="text-primary mb-0">FAQ!</h5>
        <img src="{{ asset('assets-front/img/ksps_faq.png') }}" alt="faq" class="img-fluid">
        <form class="bg-white form-banner my-0" style="min-width: 100px;">
            <input type="text" placeholder="Cari kata kunci...">
            <div class="rounded-icon bg-primary">
                <i class="icon-line-send" style="transform: rotate(45deg); font-size: 12px; margin-left: -4px;"></i>
            </div>
        </form>
    </div>

    <div class="modal fade" id="podcast" tabindex="-1" role="dialog" aria-labelledby="Podcast" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Podcast KSPSTK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body py-0 my-3">
                    @foreach ($podcast as $podcast)
                        <div class="entry mb-5">
                            <div class="grid-inner row no-gutters p-0">
                                <div class="entry-image col-3 mb-0">
                                    <a href="{{$podcast->link_podcast}}">
                                        <img src="{{ asset('podcast/' . $podcast->gambar) }}" alt="thumbnail_podcast">
                                    </a>
                                </div>
                                <div class="col-9 pl-3">
                                    <div class="entry-title title-xs text-clamp-2">
                                        <h6 class="mb-1"><a href="{{$podcast->link_podcast}}">{{ $podcast->judul }}</a></h6>
                                    </div>
                                    <div class="entry-meta mb-2 mt-0">
                                        <ul>
                                            <li><a href="#"><i class="icon-users"></i> {{$podcast->jumlah_lihat ?? 0}} penonton</a>
                                            <li><a href="#"><i
                                                        class="icon-calendar3"></i>{{ $podcast->date }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="text-muted fs-6 text-clamp-1 mb-0">{{ $podcast->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('layouts.front.js')

</body>

</html>
{{-- <div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}
