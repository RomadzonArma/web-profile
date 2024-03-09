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
        <form class="row mb-4 align-items-center">
            <div class="col-lg-2 mb-lg-0">
                <label>Pilih Tanggal</label>
            </div>
            <div class="col-lg-10">
                <input type="text" class="form-control daterange1 reportrange" value="01/01/2021 - 01/31/2021" />
            </div>
        </form>
        <div class="result-berita">
            @foreach ($agenda as $item)
                <div class="entry mb-5">
                    <div class="grid-inner row no-gutters p-0">
                        <div class="entry-image col-md-4 mb-md-0">
                            <a href="/agenda/detail/{{ $item->id }}">
                                <img src="{{ asset('agenda/' . $item->gambar) }}" alt="thumbnail_agenda">
                            </a>
                        </div>
                        <div class="col-md-8 pl-md-4">
                            <div class="entry-title title-xs">
                                <h3 class="mb-1"><a href="/agenda/detail/{{ $item->id }}">{{ $item->judul }}</a></h3>
                            </div>
                            <div class="entry-meta mb-2 mt-0">
                                <ul>
                                    <li><a href="#"><i
                                                class="icon-calendar3"></i>{{ $carbon::parse($item->created_at)->format('d M Y') }}</a>
                                    </li>
                                    <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                    <li><a href="#"><i class="icon-line-folder"></i> Agenda</a></li>
                                    <li><a href="#"><i class="icon-line-eye"></i> {{ $item->jumlah_lihat ?? 0 }}
                                            Dilihat</a></li>
                                </ul>
                            </div>
                            <p class="mb-2 text-muted">
                                {!! \Illuminate\Support\Str::words($item->konten, 75, '...') !!}
                            </p>

                            <a class="more-link" href="/agenda/detail/{{ $item->id }}">Link untuk melihat <i
                                    class="icon-external-link mr-0 ml-2"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-4 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/agenda1.jpg') }}"
                                                alt="thumbnail_agenda">
                                        </a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Peluncuran Merdeka Belajar Episode 15:
                                                    Kurikulum Merdeka dan Platform Merdeka Mengajar</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Agenda</a></li>
                                                <li><a href="#"><i class="icon-line-eye"></i> 8 Dilihat</a></li>
                                            </ul>
                                        </div>
                                        <p class="mb-2 text-muted">
                                            Saksikan peluncuran Kurikulum Merdeka dan Platform Merdeka Mengajar pada
                                            Merdeka Belajar episode Kelima Belas Jumat, 11 Februari 2022 pukul 10.00
                                            WIB melalui siaran langsung di YouTube <b class="text-dark">KEMENDIKBUD
                                                RI</b>
                                        </p>
                                        <a class="more-link" href="#">Link untuk melihat <i
                                                class="icon-external-link mr-0 ml-2"></i></a>
                                    </div>
                                </div>
                            </div> --}}
            <ul class="pagination pagination-circle justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span></a></li>
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
    </div>
@endsection
