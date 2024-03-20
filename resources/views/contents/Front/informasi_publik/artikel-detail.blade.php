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
        <div class="entry-title">
            <h3 class="mb-1">{{ $artikel->judul }}</h3>
        </div>
        <div class="entry-meta my-4">
            <ul>
                <li><i class="icon-calendar3"></i> {{ $carbon::parse($artikel->date)->format('d M Y') }}</li>
                <li><i class="icon-user1"></i> KSPTK</li>
                <li><i class="icon-line-folder"></i> Artikel</li>
                <li><i class="icon-line-eye"></i> {{ $artikel->jumlah_lihat }} Dilihat</li>
            </ul>
        </div>
        <div class="entry-image">
            <img src="{{ asset('gambar-artikel/' . $artikel->gambar) }}" alt="img">
            <p class="mt-1">
                <small>
                    <center>{{ $artikel->caption_gambar }}</center>
                </small>
            </p>
        </div>
        <div class="entry-content mt-0">
            <p class="mb-4">
                {!! $artikel->konten !!}
            </p>
        </div>
        <div class="entry-title">
            <h6 class="mb-1"><a href="#"># {{ $artikel->tag }}</a></h6>
            {{-- <h6 class="mb-1"><a href="#"># {{ $artikel->link }}</a></h6> --}}
        </div>
        {{-- <div class="row">
            <div class="col-xl-10">
            </div>
        </div> --}}
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
