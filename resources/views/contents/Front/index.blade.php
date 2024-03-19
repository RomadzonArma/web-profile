@extends('layouts.front.app-beranda')

@section('content-header')
    <section class="bg-soft px-xl-4 d-lg-block d-none">
        <div class="content-wrap py-2">
            <div class="container-fluid">
                <div class="d-flex justify-content-lg-between justify-content-center align-items-center">
                    <a href="{{ route('index') }}" data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                        <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                    </a>
                    <form class="bg-white form-banner my-0" style="min-width: 280px;">
                        <input type="text" placeholder="Cari kata kunci...">
                        <button class="rounded-icon btn btn-primary">
                            <i class="icon-line-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="px-xl-4">
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

                        <div class="tabs mt-4 mb-md-0" id="tab-3">

                            <ul class="tab-nav tab-nav2">
                                <li><a href="#video-praktik-baik">Video Praktik Baik</a></li>
                                <li><a href="#ksps-berprestasi">KSPSTK Berprestasi</a></li>
                                <li><a href="#praktik-baik">Cerita Praktik Baik</a></li>
                            </ul>

                            <div class="tab-container">

                                <div class="tab-content" id="video-praktik-baik">
                                    <div class="swiper swiper-4">
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
                                    <p class="text-muted mt-3 mb-0">120 Jumlah Video</p>
                                </div>
                                <div class="tab-content" id="ksps-berprestasi">
                                    <div class="swiper swiper-4">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=rQzEftiRUSs"
                                                    data-lightbox="iframe">
                                                    <img src="{{ asset('assets-front/img/apresiasi-ksps-2022.jpg') }}" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Apresiasi 10 Besar Kepala Sekolah dan Pengawas Sekolah Inspiratif 2022 HGN 2022</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=i0FreFwBKnw"
                                                    data-lightbox="iframe">
                                                    <img src="{{ asset('assets-front/img/podcast-apresiasi-ksps.jpg') }}" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Podcast Sukses Apresiasi KSPSTK 2023 bersama APSI.</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=aGN3VBaaT0k"
                                                    data-lightbox="iframe">
                                                    <img src="{{ asset('assets-front/img/podcast-apresiasi-ksps-2.jpg') }}" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Podcast Bisa Pintar dengan tema ”Jurus Pamungkas Tembus Apresiasi KS, PS dan Tendik 2023”</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a class="position-relative d-block lightbox-img"
                                                    href="https://www.youtube.com/watch?v=D5x9A9UQhL0"
                                                    data-lightbox="iframe">
                                                    <img src="{{ asset('assets-front/img/podcast-apresiasi-ksps.jpg') }}" class="img-fluid" width="380" alt="Video"
                                                        draggable="false">
                                                    <div class="bg-overlay">
                                                        <div class="bg-overlay-content dark">
                                                            <h6 class="text-white mb-0" data-hover-animate="fadeIn">Podcast Bisa Pintar tema ”Apresiasi Tenaga Kependidikan 2023 bersama Tenaga Perpustakaan Sekolah”</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                    <p class="text-muted mt-3 mb-0">120 Jumlah Artikel</p>
                                </div>
                                <div class="tab-content" id="praktik-baik">
                                    <p>Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                                    <p class="text-muted mt-3 mb-0">120 Jumlah Video</p>
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
