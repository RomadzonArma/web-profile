@extends('layouts.front.app')
@inject('carbon', 'Carbon\Carbon')
@section('content-header')
    <section id="page-title" class="bg-soft px-md-5">
        <div class="content-wrap py-0">
            <div class="container-fluid">
                <a href="{{ route('index') }}" class="d-none mb-4 d-lg-block"
                    data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                    <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                </a>
            </div>
            <div class="container-fluid clearfix position-relative">
                <h1 class="mb-2">{{ $title }}</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Informasi Publik</a></li>
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
                    <div class="col-md-9 col-12">
                        <div class="tabs clearfix" id="tab-3">

                            <ul class="tab-nav tab-nav2 clearfix pills">
                                <li><a href="{{route('galeri')}}">Video</a></li>
                                <li><a href="{{ route('galeri.foto')}}">Foto</a></li>
                            </ul>
                            <div class="tab-container clearfix" id="video">
                                @php
                                    $counter = 0;
                                @endphp

                                @foreach ($video as $item)
                                    @if ($counter % 3 == 0)
                                        <div class="row">
                                    @endif

                                    <div class="entry col-md-4 col-sm-6 col-12">
                                        <div class="grid-inner hover-custom">
                                            <div class="entry-image">
                                                <a href="{{ $item->link }}" target="_blank" data-lightbox="iframe">
                                                    <iframe src="https://www.youtube.com/embed/{{ $item->video_id }}" data-provider="youtube" frameborder="0"></iframe>
                                                </a>
                                            </div>
                                            <div class="entry-title">
                                                <h2><a href="{{ $item->link }}">{{ $item->judul }}</a>
                                                </h2>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i
                                                            class="icon-calendar3"></i>{{ $carbon::parse($item->tanggal)->format('d M Y') }}
                                                    </li>
                                                    <li><i class="icon-line-eye"></i>{{ $item->jumlah_lihat }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $counter++;
                                    @endphp

                                    @if ($counter % 3 == 0 || $loop->last)

                            </div>
                            @endif
                            @endforeach
                            {{-- <div class="tab-content clearfix" id="video">
                                    <div class="post-grid row gutter-30" data-layout="fitRows">

                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry col-md-4 col-sm-6 col-12">
                                            <div class="grid-inner hover-custom">
                                                <div class="entry-image">
                                                    <a href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&source_ve_path=MTY0NTA2LDE2NDUwMw&feature=emb_share&v=coZijINyLDs"
                                                        data-lightbox="iframe">
                                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}"
                                                            style="width: 100%; height: auto; border-radius: 12px; object-fit: cover;"
                                                            alt="Video">
                                                    </a>
                                                </div>
                                                <div class="entry-title">
                                                    <h2><a href="blog-single.html">Webinar Rantai KSPSTK Eps 1</a>
                                                    </h2>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-calendar3"></i> 4 Februari 2024</li>
                                                        <li><i class="icon-line-eye"></i> 10 Penonton</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- #posts end -->

                                    <!-- Pagination
                                        ============================================= -->
                                    <ul class="pagination pagination-circle justify-content-center">
                                        <li class="page-item disabled"><a class="page-link" href="#"
                                                aria-label="Previous"> <span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="ml-2" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#"
                                                aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </div> --}}
                           @yield('foto')
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="heading-block md mb-3">
                        <h4 class="mb-1">MEDIA SOSIAL</h4>
                    </div>
                    <div class="fslider fslider-banner testimonial-full mb-4" data-animation="slide" data-arrows="false">
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
                            <h4 class="mb-1">INFORMASI TERBARU</h4>
                        </div>
                        <div class="entry mb-4">
                            <div class="grid-inner row no-gutters p-0">
                                <div class="entry-image col-xl-4 mb-xl-0">
                                    <a href="#">
                                        <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                    </a>
                                </div>
                                <div class="col-xl-8 pl-xl-3">
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
                                        <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                    </a>
                                </div>
                                <div class="col-xl-8 pl-xl-3">
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
                                        <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                    </a>
                                </div>
                                <div class="col-xl-8 pl-xl-3">
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
                                        <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                    </a>
                                </div>
                                <div class="col-xl-8 pl-xl-3">
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
                                        <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                    </a>
                                </div>
                                <div class="col-xl-8 pl-xl-3">
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
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide", // atau pilih animasi sesuai kebutuhan
            slideshow: true,
            slideshowSpeed: 5000, // interval per slide dalam milidetik
            animationSpeed: 600 // kecepatan animasi dalam milidetik
        });
    });
</script>
@endpush
