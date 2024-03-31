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
                    <li class="breadcrumb-item"><a href="#">ZI/WBK</a></li>
                    <li class="breadcrumb-item active" aria="page">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="col-md-9 col-12 mb-md-0 mb-4">
        <div class="entry-title">
            <h3 class="mb-1">{{ $data->judul }}</h3>
        </div>
        <div class="entry-meta my-4">
            <ul>
                <li><i class="icon-calendar3"></i> {{ $carbon::parse($data->created_at)->format('d M Y') }}</li>
                <li><i class="icon-user1"></i> KSPTK</li>
                <li><i class="icon-line-folder"></i> SPT PPH 21</li>
            </ul>
        </div>
        {{-- <div class="entry-image">
            <img src="{{ asset($data->gambar) }}" alt="img">
        </div> --}}
        <div class="entry-content mt-0">
            @foreach ($data->dokumen as $item)
                <div class="col-lg-12 pb-3 d-flex flex-column align-items-center justify-content-center">
                    @if ($item->extension == 'pdf')
                        <iframe src="{{ asset($item->file) }}" frameborder="0"
                            style="height: 500px; width: 100%;"></iframe>
                    @elseif(in_array($item->extension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset($item->file) }}" style="height: 500px; width: 100%;" alt="gambar">
                    @endif
                    <div style="border: dashed #365984 2px; width: 100%;"></div>
                </div>
            @endforeach
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
