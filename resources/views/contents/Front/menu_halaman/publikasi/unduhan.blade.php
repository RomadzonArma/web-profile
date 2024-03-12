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
            @foreach ($unduhan as $item)
                <div class="entry mb-5">
                    <div class="grid-inner row no-gutters p-0">
                        <div class="entry-image col-md-2 mb-md-0">
                            <a href="#">
                                <img src="{{ asset('cover-unduhan/' . $item->cover) }}" alt="thumbnail_unduhan">
                            </a>
                        </div>
                        <div class="col-md-10 pl-md-4">
                            <div class="entry-title title-xs">
                                <h3 class="mb-1"><a href="#">{{ $item->judul }}</a></h3>
                            </div>
                            <div class="entry-meta mb-2 mt-0">
                                <ul>
                                    <li><a href="#"><i class="icon-calendar3"></i>
                                            {{ $carbon::parse($item->tanggal)->format('d M
                                                                                                                                            Y') }}</a>
                                    </li>
                                    <li><a href="#"><i class="icon-line-folder"></i> Unduhan</a></li>
                                    <li><a href="#"><i class="icon-line-download"></i>
                                            {{ $item->jumlah_download }}Diunduh</a>
                                    </li>
                                </ul>
                            </div>
                            <a class="button button-mini button-aqua rounded m-0"
                                href="{{ asset('file-unduhan/' . $item->file) }}" target="_blank">Unduh Dokumen
                                <i class="icon-line-download"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-2 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/pedoman-apresiasi.jpg') }}"
                                                alt="thumbnail_unduhan">
                                        </a>
                                    </div>
                                    <div class="col-md-10 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pedoman Apresiasi Guru dan Tenaga
                                                    Kependidikan Tahun 2023</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Unduhan</a></li>
                                                <li><a href="#"><i class="icon-line-download"></i> 8 Diunduh</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="button button-mini button-aqua rounded m-0" href="#">Unduh Dokumen
                                            <i class="icon-line-download"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-2 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/pedoman-apresiasi.jpg') }}"
                                                alt="thumbnail_unduhan">
                                        </a>
                                    </div>
                                    <div class="col-md-10 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pedoman Apresiasi Guru dan Tenaga
                                                    Kependidikan Tahun 2023</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="{{ asset('file-unduhan/' . $list->file) }}" target="_blank"><i class="icon-line-folder"></i> Unduhan</a></li>
                                                <li><a href="#"><i class="icon-line-download"></i> 8 Diunduh</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="button button-mini button-aqua rounded m-0" href="#">Unduh Dokumen
                                            <i class="icon-line-download"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-2 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/pedoman-apresiasi.jpg') }}"
                                                alt="thumbnail_unduhan">
                                        </a>
                                    </div>
                                    <div class="col-md-10 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pedoman Apresiasi Guru dan Tenaga
                                                    Kependidikan Tahun 2023</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Unduhan</a></li>
                                                <li><a href="#"><i class="icon-line-download"></i> 8 Diunduh</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="button button-mini button-aqua rounded m-0" href="#">Unduh Dokumen
                                            <i class="icon-line-download"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-2 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/pedoman-apresiasi.jpg') }}"
                                                alt="thumbnail_unduhan">
                                        </a>
                                    </div>
                                    <div class="col-md-10 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pedoman Apresiasi Guru dan Tenaga
                                                    Kependidikan Tahun 2023</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Unduhan</a></li>
                                                <li><a href="#"><i class="icon-line-download"></i> 8 Diunduh</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="button button-mini button-aqua rounded m-0" href="#">Unduh Dokumen
                                            <i class="icon-line-download"></i></a>
                                    </div>
                                </div>
                            </div> --}}
            <ul class="pagination pagination-circle justify-content-center">
                @if ($unduhan->onFirstPage())
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">«</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $unduhan->previousPageUrl() }}"
                            aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                @endif

                @foreach (range(1, $unduhan->lastPage()) as $page)
                    <li class="page-item{{ $page == $unduhan->currentPage() ? ' active' : '' }}">
                        <a class="page-link" href="{{ $unduhan->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($unduhan->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $unduhan->nextPageUrl() }}" aria-label="Next"><span
                                aria-hidden="true">»</span></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">»</span></li>
                @endif
            </ul>
        </div>
    </div>
@endsection
