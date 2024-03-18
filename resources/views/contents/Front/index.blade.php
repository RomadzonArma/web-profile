@extends('layouts.front.app-beranda')

@section('content-header')
    <section class="bg-soft px-xl-5 d-lg-block d-none">
        <div class="content-wrap py-2">
            <div class="container-fluid">
                <div class="d-flex justify-content-lg-between justify-content-center align-items-center">
                    <a href="{{ route('index') }}" data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                        <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                    </a>
                    <form class="bg-white form-banner my-0" style="min-width: 280px;">
                        <input type="text" placeholder="Cari kata kunci...">
                        <div class="rounded-icon bg-primary">
                            <i class="icon-line-search"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="px-xl-5">
        <div class="content-wrap scrolled">
            <div class="container-fluid">

                {{-- SWIPER --}}
                @include('contents.Front.swiper')

                <div class="row">
                    <div class="col-lg-8 col-md-7 col-12 mb-lg-0 mb-4">

                        {{-- SWIPER PROGRAM --}}
                        @include('contents.Front.swiper_program')

                        {{-- PETA --}}
                        {{-- @include('contents.Front.peta') --}}

                        <div class="tabs clearfix mt-4" id="tab-3">

                            <ul class="tab-nav tab-nav2 clearfix">
                                <li><a href="#praktik-baik-pgp">Praktik Baik Guru Penggerak</a></li>
                                <li><a href="#ksps-berprestasi">KSPSTK Berprestasi</a></li>
                                <li><a href="#praktik-baik">Cerita Praktik Baik</a></li>
                            </ul>

                            <div class="tab-container">

                                <div class="tab-content clearfix" id="praktik-baik-pgp">
                                    <div class="swiper swiper-4 swiper-padding">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=ogwpNKOwGlE"
                                                    data-lightbox="iframe">
                                                    <img src="https://penggerak-simpkb.s3.ap-southeast-1.amazonaws.com/portal-gurupenggerak/THUMBNAIL-LABUANBAJO-Rev-01-1-scaled.jpg" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Kepala Sekolah, GP Angkatan 1, Kab. Manggarai Barat, NTT</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=XaGB9hU-HnQ"
                                                    data-lightbox="iframe">
                                                    <img src="https://penggerak-simpkb.s3.ap-southeast-1.amazonaws.com/portal-gurupenggerak/Screen-Shot-2022-12-19-at-12.57.07.jpg" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Kepala Sekolah, GP Angkatan 1, Kab. Manggarai Barat, NTT</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=EQIv-2kawZ8"
                                                    data-lightbox="iframe">
                                                    <img src="https://penggerak-simpkb.s3.ap-southeast-1.amazonaws.com/portal-gurupenggerak/Screen-Shot-2022-12-19-at-13.08.52.png" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Kepala Sekolah, GP Angkatan 1, Kab. Manggarai Barat, NTT</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=EBu93bAq8rQ"
                                                    data-lightbox="iframe">
                                                    <img src="https://sekolah.penggerak.kemdikbud.go.id/gurupenggerak/wp-content/uploads/2021/07/Testimoni_Taufik-Hidayat.jpg" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Pengajar Praktik PGP Angkatan 1 Kota Binjai, Sumatera Utara</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                    <p class="text-muted mt-4 mb-0">120 Jumlah Video</p>
                                </div>
                                <div class="tab-content clearfix" id="ksps-berprestasi">
                                    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                                    <p class="text-muted mt-4 mb-0">120 Jumlah Video</p>
                                </div>
                                <div class="tab-content clearfix" id="praktik-baik">
                                    <p>Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                                    <p class="text-muted mt-4 mb-0">120 Jumlah Video</p>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-4 col-md-5 col-12 mb-lg-0 mb-4">

                        {{-- BERITA --}}
                        @include('contents.Front.berita')

                        {{-- WEBINAR --}}
                        @include('contents.Front.webinar')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
