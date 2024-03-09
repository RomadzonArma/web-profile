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
    <div class="col-md-9 col-12 mb-md-0 mb-4">
        <div class="row">
            {{-- <div class="col-lg-5 mb-4">
                                <img src="{{ asset('pengumuman/' . $pengumuman->gambar) }}" class="img-fluid rounded">
                            </div> --}}
            <div class="col-xl-9 col-lg-7">
                <div class="entry-title">
                    <h3 class="mb-1"><a href="#">{{ $pengumuman->judul }}</a>
                    </h3>
                </div>

                <p class="mb-4">
                    {!! $pengumuman->konten !!}
                </p>
                <div class="mb-4">
                    <iframe id="pdf_preview" width="100%" height="500px"style="border: 1px solid #ddd;"
                        src="{{ asset('file-pengumuman/' . $pengumuman->file) }}"></iframe>
                </div>
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
                            <a href="#"><img class="img-fluid" src="{{ asset('assets-front/img/podcast.jpeg') }}"
                                    style="width: 100%;" alt="Image 1"></a>
                            <div class="bg-overlay">
                                <div class="overlaying-desc">
                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide" style="max-height: 100%;">
                        <div class="overlaying-img">
                            <a href="#"><img class="img-fluid" src="{{ asset('assets-front/img/podcast.jpeg') }}"
                                    style="width: 100%;" alt="Image 1"></a>
                            <div class="bg-overlay">
                                <div class="overlaying-desc">
                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide" style="max-height: 100%;">
                        <div class="overlaying-img">
                            <a href="#"><img class="img-fluid" src="{{ asset('assets-front/img/podcast.jpeg') }}"
                                    style="width: 100%;" alt="Image 1"></a>
                            <div class="bg-overlay">
                                <div class="overlaying-desc">
                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide" style="max-height: 100%;">
                        <div class="overlaying-img">
                            <a href="#"><img class="img-fluid" src="{{ asset('assets-front/img/podcast.jpeg') }}"
                                    style="width: 100%;" alt="Image 1"></a>
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
    @endsection
    @push('scripts')
        <script>
            function previewPdf(input) {
                var pdfPreview = document.getElementById('pdf_preview');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Set the src attribute of the iframe to the URL of the selected PDF file
                        pdfPreview.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.getElementById('file_pdf').addEventListener('change', function() {
                previewPdf(this);
            });
        </script>
    @endpush
