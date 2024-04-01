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
                    <li class="breadcrumb-item"><a href="#">Publikasi</a></li>
                    <li class="breadcrumb-item active" aria="page">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="col-md-9 col-12">
        <div class="result-unduhan">
            @foreach ($pos_layanan as $item)
                <div class="entry mb-5">
                    <div class="grid-inner row no-gutters p-0">
                        {{--  <div class="entry-image col-xl-2 col-md-3 col-sm-4 col-12 mb-md-0">
                            <a href="#">
                                <img src="{{ asset('cover-unduhan/' . $item->cover) }}" alt="thumbnail_unduhan">
                            </a>
                        </div>  --}}
                        <div class="col-xl-10 col-md-9 col-sm-8 col-12 pl-sm-4">
                            <div class="entry-title title-md">
                                <h3 class="mb-1"><a href="#">{{ $item->nama_pos }}</a></h3>
                            </div>
                            <div class="entry-meta mb-2 mt-0">
                                <ul>
                                    <li><a href="#"><i class="icon-line2-users"></i>
                                            {{ "Tim Kerja " . $item->tim_kerja}}</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                    </li>
                                </ul>
                            </div>
                            <a class="button button-mini button-aqua rounded m-0 unduh-dokumen"
                                href="{{ $item->tautan_dok}}" target="_blank"
                                data-id="{{ $item->id }}">Tautan Dokumen <i class="icon-external-link"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            <ul class="pagination pagination-circle justify-content-center">
                @if ($pos_layanan->onFirstPage())
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">«</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $pos_layanan->previousPageUrl() }}"
                            aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                @endif

                @foreach (range(1, $pos_layanan->lastPage()) as $page)
                    <li class="page-item{{ $page == $pos_layanan->currentPage() ? ' active' : '' }}">
                        <a class="page-link" href="{{ $pos_layanan->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($pos_layanan->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $pos_layanan->nextPageUrl() }}" aria-label="Next"><span
                                aria-hidden="true">»</span></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">»</span></li>
                @endif
            </ul>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var downloadButtons = document.querySelectorAll('.unduh-dokumen');
            downloadButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var idUnduhan = this.getAttribute('data-id');
                    recordDownload(idUnduhan);
                });
            });

            function recordDownload(idUnduhan) {
                // Kirim request AJAX ke server untuk merekam kegiatan
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/rekam-pengunjung-unduhan');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log('Pengunjung unduhan direkam.');
                    } else {
                        console.error('Terjadi kesalahan saat merekam pengunjung unduhan.');
                    }
                };
                xhr.send(JSON.stringify({
                    id_unduhan: idUnduhan
                }));
            }
        });
    </script>
@endpush
