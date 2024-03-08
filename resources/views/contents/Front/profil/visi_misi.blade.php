@extends('layouts.front.app')

@section('content-header')
    <section id="page-title" class="bg-soft px-md-5">
        <div class="content-wrap py-0">
            <div class="container-fluid">
                <a href="index.html" class="d-none mb-4 d-lg-block"
                    data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                    <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                </a>
            </div>
            <div class="container-fluid clearfix position-relative">
                <h1 class="mb-2">{{ $title }}</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria="page">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="px-md-5">
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9 col-12 mb-md-0 mb-4">
                        @foreach ($data_visi as $profil)
                            <div class="row">
                                <div class="col-xl-9 col-lg-7">
                                    <p class="mb-4">
                                        {!! $profil->konten !!}
                                    </p>

                                </div>
                            </div>
                        @endforeach
                      
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="heading-block md mb-3">
                            <h4 class="mb-1">MEDIA SOSIAL</h4>
                        </div>
                        <div class="fslider fslider-banner testimonial-full mb-4" data-animation="slide"
                            data-arrows="false">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}" style="width: 100%;"
                                                    alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}" style="width: 100%;"
                                                    alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}" style="width: 100%;"
                                                    alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}" style="width: 100%;"
                                                    alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget clearfix">
                            <div class="heading-block md mb-3">
                                <h4 class="mb-1">BERITA TERKINI</h4>
                            </div>
                            <div class="entry mb-4">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-xl-4 mb-xl-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-xl-8 pl-xl-4">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                            <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                            <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                            <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                            <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                            <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
        </div>
    </section>
@endsection
