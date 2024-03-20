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
                                <li><a href="#praktik-baik">Praktik Baik GP</a></li>
                                <li><a href="#ksps-berprestasi">KSPSTK Berprestasi</a></li>
                                <li><a href="#karya-kspstk">Karya KSPSTK</a></li>
                            </ul>

                            <div class="tab-container">

                                <div class="tab-content" id="praktik-baik">
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
                                    <p class="text-muted mt-3 mb-0">4 jumlah konten</p>
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
                                    <p class="text-muted mt-3 mb-0">4 jumlah konten</p>
                                </div>
                                <div class="tab-content" id="karya-kspstk">
                                    <div class="swiper swiper-4">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide swiper-slide-artikel">
                                                <a href="#" data-toggle="modal" data-target=".modal-artikel">
                                                    <img src="{{ asset('assets-front/img/karya-kspstk-nusantara.jpg') }}" alt="" height="137px">
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="swiper-slide">
                                                    <a class="position-relative d-block lightbox-img"
                                                        href="https://www.youtube.com/watch?v=rQzEftiRUSs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/apresiasi-ksps-2022.jpg') }}" class="img-fluid" style="object-fit: contain" width="380" alt="Video"
                                                            draggable="false">
                                                        <div class="bg-overlay">
                                                            <div class="bg-overlay-content dark">
                                                                <h6 class="text-white mb-0" data-hover-animate="fadeIn">Apresiasi 10 Besar Kepala Sekolah dan Pengawas Sekolah Inspiratif 2022 HGN 2022</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
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
                                    <p class="text-muted mt-3 mb-0">4 jumlah konten</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
