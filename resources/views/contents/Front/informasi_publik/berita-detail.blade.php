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
            <div class="col-lg-10  mb-4">
                <img src="{{ asset('list_berita/' . $berita->gambar) }}" alt="thumbnail_beritas">
                <p class="mt-1">
                    <small>
                        <center>{{ $berita->caption_gambar }}</center>
                    </small>
                </p>
            </div>
            <div class="col-xl-10">
                <div class="entry-title">
                    <h3 class="mb-1"><a href="#">{{ $berita->judul }}</a>
                    </h3>
                </div>

                <p class="mb-4">
                    {!! $berita->isi_konten !!}
                </p>
                <div class="entry-title">
                    <h6 class="mb-1"><a href="#"># {{ $berita->tag_dinamis }}</a></h6>
                    <h6 class="mb-1"><a href="#"># {{ $berita->url_video }}</a></h6>
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
