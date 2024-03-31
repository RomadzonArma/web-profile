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
                    <li class="breadcrumb-item"><a href="#">ZIWBK</a></li>
                    <li class="breadcrumb-item"><a href="#">SAKIP</a></li>
                    <li class="breadcrumb-item active" aria="page">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="col-md-9 col-12">
        <div class="result-akuntabilitas">
            @foreach ($akuntabilitas as $item)
                <div class="entry mb-5">
                    <div class="grid-inner row no-gutters p-0">
                        <div class="entry-image col-xl-2 col-md-3 col-sm-4 col-12 mb-md-0">
                            <a href="#">
                                <img src="{{ asset('/storage/uploads/akuntabilitas/gambar-Akuntabilitas/' . $item->foto) }}" alt="thumbnail">
                            </a>
                        </div>
                        <div class="col-xl-10 col-md-9 col-sm-8 col-12 pl-sm-4">
                            <div class="entry-title title-md">
                                <h3 class="mb-1"><a href="#">{{ $item->judul }}</a></h3>
                            </div>
                            <div class="entry-meta mb-2 mt-0">
                                <ul>
                                    <li><a href="#"><i class="icon-calendar3"></i>
                                            {{ $carbon::parse($item->created_at)->format('d M
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Y') }}</a>
                                    </li>
                                    <li><a href="#"><i class="icon-line-folder"></i> akuntabilitas</a></li>
                                    {{-- <li><a href="#"><i class="icon-line-download"></i>
                                            {{ $item->jumlah_download }}Diunduh</a>
                                    </li> --}}
                                </ul>
                            </div>
                            <a class="button button-mini button-aqua rounded m-0 unduh-dokumen"
                                href="{{ asset('/storage/uploads/akuntabilitas/file-Akuntabilitas/' . $item->file) }}" target="_blank"
                                data-id="{{ $item->id }}">Unduh Dokumen <i class="icon-line-download"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <ul class="pagination pagination-circle justify-content-center">
                @if ($akuntabilitas->onFirstPage())
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">«</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $akuntabilitas->previousPageUrl() }}"
                            aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                @endif

                @foreach (range(1, $akuntabilitas->lastPage()) as $page)
                    <li class="page-item{{ $page == $akuntabilitas->currentPage() ? ' active' : '' }}">
                        <a class="page-link" href="{{ $akuntabilitas->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($akuntabilitas->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $akuntabilitas->nextPageUrl() }}" aria-label="Next"><span
                                aria-hidden="true">»</span></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">»</span></li>
                @endif
            </ul> --}}
            <ul class="pagination pagination-circle justify-content-center">
                @if ($akuntabilitas->onFirstPage())
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">«</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $akuntabilitas->previousPageUrl() }}" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                @endif

                @php
                    $limit = 5;
                    $halfLimit = floor($limit / 2);
                    $start = max(1, $akuntabilitas->currentPage() - $halfLimit);
                    $end = min($akuntabilitas->lastPage(), $akuntabilitas->currentPage() + $halfLimit);

                    if ($start > 1) {
                        $end = min($akuntabilitas->lastPage(), $end + $limit - ($end - $start + 1));
                    }
                    if ($end < $akuntabilitas->lastPage()) {
                        $start = max(1, $start - ($limit - ($end - $start + 1)));
                    }
                @endphp

                @for ($page = $start; $page <= $end; $page++)
                    <li class="page-item{{ $page == $akuntabilitas->currentPage() ? ' active' : '' }}">
                        <a class="page-link" href="{{ $akuntabilitas->url($page) }}">{{ $page }}</a>
                    </li>
                @endfor

                @if ($akuntabilitas->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $akuntabilitas->nextPageUrl() }}" aria-label="Next"><span aria-hidden="true">»</span></a></li>
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
                    var idAkuntabilitas = this.getAttribute('data-id');
                    recordDownload(idAkuntabilitas);
                });
            });

            function recordDownload(idAkuntabilitas) {
                // Kirim request AJAX ke server untuk merekam kegiatan
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/rekam-pengunjung-akuntabilitas');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log('Pengunjung akuntabilitas direkam.');
                    } else {
                        console.error('Terjadi kesalahan saat merekam pengunjung akuntabilitas.');
                    }
                };
                xhr.send(JSON.stringify({
                    id_akuntabilitas: idAkuntabilitas
                }));
            }
        });
    </script>
@endpush
