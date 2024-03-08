@extends('contents.Front.informasi_publik.galeri-foto')
@section('foto')
<div class="tab-content clearfix" id="foto">
    <div class="post-grid row gutter-30" data-layout="fitRows">
        @foreach ($foto as $item)
            <div class="entry col-md-4 col-sm-6 col-12">
                <div class="grid-inner hover-custom">
                    <div class="entry-image">
                        <div class="fslider" data-arrows="false" data-lightbox="gallery">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                    <div class="slide">
                                        <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                            data-lightbox="gallery-item">
                                            <img src="{{ asset('file-galeri/' . $item->image) }}"
                                                alt="Standard Post with Gallery">
                                        </a>
                                    </div>
                                    {{-- <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entry-title">
                        <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                                2023</a></h2>
                    </div>
                    <div class="entry-meta">
                        <ul>
                            <li><i class="icon-calendar3"></i> 23 November 2023</li>
                            <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- {{-- <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="entry col-md-4 col-sm-6 col-12">
        <div class="grid-inner hover-custom">
            <div class="entry-image">
                <div class="fslider" data-arrows="false" data-lightbox="gallery">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto1.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto1.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto2.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto2.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                            <div class="slide">
                                <a href="{{ asset('assets-front/img/foto3.jpeg') }}"
                                    data-lightbox="gallery-item">
                                    <img src="{{ asset('assets-front/img/foto3.jpeg') }}"
                                        alt="Standard Post with Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-title">
                <h2><a href="blog-single.html">Hari Ketiga, Apresiasi KSPSTK
                        2023</a></h2>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> 23 November 2023</li>
                    <li><i class="icon-line-eye"></i> 10 Dilihat</li>
                </ul>
            </div>
        </div>
    </div> --}} -->

    </div>
    <!-- Pagination
            ============================================= -->
    <ul class="pagination pagination-circle justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"> <span
                    aria-hidden="true">«</span></a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="ml-2" href="#">...</a></li>
        <li class="page-item"><a class="page-link" href="#">5</a></li>
        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                    aria-hidden="true">»</span></a></li>
    </ul>
</div>
@endsection

