@extends('layouts.front.app')
@inject('carbon', 'Carbon\Carbon')
@section('content-header')
    {{-- <section id="page-title" class="bg-soft px-md-5">
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
    </section> --}}
    <section id="page-title" class="bg-soft px-md-5">
        <div class="content-wrap py-0">
            <div class="container-fluid">
                <a href="{{ route('index') }}" class="d-none mb-4 d-lg-block"
                    data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                    <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                </a>
            </div>
            <div class="container-fluid clearfix position-relative">
                {{-- <h1 class="mb-2">{{ $title }}</h1> --}}
                <h1 class="mb-2">BERITA ZI/WBK</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">ZI/WBK</a></li>
                    {{-- <li class="breadcrumb-item active" aria="page">{{ $title }}</li> --}}
                    <li class="breadcrumb-item active" aria="page">Berita ZI/WBK</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="col-md-9 col-12 mb-md-0 mb-4">
        <div class="entry-title">
            <h3 class="mb-1">KEGIATAN PENCANGANAN ZI-WBK DI LINGKUNGAN DIREKTORAT KEPALA SEKOLAH, PENGAWAS SEKOLAH, DAN TENAGA KEPENDIDIKAN</h3>
        </div>
        <div class="entry-meta my-4">
            <ul>
                {{-- <li><i class="icon-calendar3"></i> {{ $carbon::parse($berita->date)->format('d M Y') }}</li> --}}
                <li><i class="icon-calendar3"></i> 22 Maret 2024</li>
                <li><i class="icon-user1"></i> KSPTK</li>
                <li><i class="icon-line-folder"></i> Berita ZI-WBK</li>
                {{-- <li><i class="icon-line-eye"></i> {{ $berita->jumlah_lihat }} Dilihat</li> --}}
            </ul>
        </div>
        <div class="entry-image">
            {{-- <img src="{{ asset('list_berita/' . $berita->gambar) }}" alt="thumbnail_berita"> --}}
            <img src="{{ asset('assets-front/img/pencanangan_wbk2.jpg') }}" alt="thumbnail_berita">
            {{-- <p class="mt-1">
                <small>
                    <center></center>
                </small>
            </p> --}}
        </div>
        <div class="entry-content mt-0">
            <p class="mb-4">
                <strong>KSPSTK - </strong>
                Direktorat Kepala Sekolah, Pengawas Sekolah, dan Tenaga Kependidikan telah menyelenggarakan Kegiatan Penguatan Zona Integritas Wilayah Bebas Korupsi.
                <br>
                <br>
                Kegiatan ini dilaksanakan di Jakarta dan diikuti oleh seluruh jajaran Pimpinan dan Staf Direktorat Kepala Sekolah, Pengawas Sekolah, dan Tenaga Kependidikan. Salahsatu agenda dalam kegiatan ini adalah melaksanakan pembacaan maklumat pelayanan, penandatangananan Pakta Integritas bagi ASN, serta menyiapkan seluruh dokumen ZI-WBK. 
            </p>
        </div>
        {{-- <div class="entry-content mt-0">
            <p class="mb-4">
                {!! $berita->isi_konten !!}
            </p>
        </div> --}}
        <div class="entry-title">
            <h6 class="mb-1"><a href="#">#ziwbk</a></h6>
            <h6 class="mb-1"><a href="#">#wbbm</a></h6>
            <h6 class="mb-1"><a href="#">#kepalasekolah</a></h6>
            <h6 class="mb-1"><a href="#">#pengawassekolah</a></h6>
            <h6 class="mb-1"><a href="#">#tenagakependidikan</a></h6>
            <h6 class="mb-1"><a href="#">#pelayananterdepandanberkelanjutan</a></h6>
            {{-- <h6 class="mb-1"><a href="#"># {{ $berita->url_video }}</a></h6> --}}
        </div>
        {{-- <div class="entry-title">
            <h6 class="mb-1"><a href="#"># {{ $berita->tag_dinamis }}</a></h6>
            <h6 class="mb-1"><a href="#"># {{ $berita->url_video }}</a></h6>
        </div> --}}
    </div>
@endsection
