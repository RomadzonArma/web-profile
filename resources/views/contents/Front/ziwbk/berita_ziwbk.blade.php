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
    <div class="col-md-9 col-12">
        <form class="row mb-4" method="get" action="{{ url('/berita') }}">
            <div class="form-group pr-sm-2 col-lg-3 col-sm-4 mb-sm-0 mb-3">
                <select class="form-control" id="tahun" name="tahun">
                    <option value="">Semua Tahun</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
                <i class="icon-caret-down1 icon-select"></i>
            </div>
            <div class="form-group px-sm-2 col-lg-3 col-sm-4 mb-sm-0 mb-3">
                <select class="form-control" id="bulan" name="bulan">
                    <option value="">Semua Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <i class="icon-caret-down1 icon-select"></i>
            </div>
            <div class="col-xl-2 pl-sm-2 col-sm-4">
                <button type="submit" class="button w-100 m-0 rounded">Cari</button>
            </div>
        </form>

        <div class="result-berita">
            @foreach ($berita_ziwbk as $item)
                <div class="entry mb-5">
                    <div class="grid-inner row no-gutters p-0">
                        <div class="entry-image col-md-4 mb-md-0">
                            {{-- <a href="/berita/detail/{{ $item->slug }}"> --}}
                            <a href="{{ route('berita_ziwbk.detail', ['slug' => $item->slug]) }}">
                                <img src="{{ asset('berita_ziwbk/' . $item->gambar) }}" alt="thumbnail_berita">
                            </a>
                        </div>
                        <div class="col-md-8 pl-md-4">
                            <div class="entry-title title-md">
                                <h3 class="mb-1"><a href="{{ route('berita_ziwbk.detail', ['slug' => $item->slug]) }}">{{ $item->judul }}</a>
                                </h3>
                            </div>
                            <div class="entry-meta mb-2 mt-0">
                                <ul>
                                    <li><a href="#"><i
                                                class="icon-calendar3"></i>{{ $carbon::parse($item->date)->format('d M Y') }}</a>
                                    </li>
                                    <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                    <li><a href="#"><i class="icon-line-folder"></i> Berita</a></li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-line-eye"></i>
                                            {{ $item->jumlah_lihat ?? '0' }} Dilihat
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <p class="mb-2 text-muted text-clamp-2">
                                {!! \Illuminate\Support\Str::words(strip_tags($item->isi_konten), 65, '...') !!}
                            </p>
                            <a class="more-link" href="{{ route('berita_ziwbk.detail', ['slug' => $item->slug]) }}">Baca Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <ul class="pagination pagination-circle justify-content-center">
                @if ($berita_ziwbk->onFirstPage())
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">«</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $berita_ziwbk->previousPageUrl() }}"
                            aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                @endif

                @foreach (range(1, $berita_ziwbk->lastPage()) as $page)
                    <li class="page-item{{ $page == $berita_ziwbk->currentPage() ? ' active' : '' }}">
                        <a class="page-link" href="{{ $berita_ziwbk->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($berita_ziwbk->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $berita_ziwbk->nextPageUrl() }}" aria-label="Next"><span
                                aria-hidden="true">»</span></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">»</span></li>
                @endif
            </ul>
        </div>
    </div>
@endsection
