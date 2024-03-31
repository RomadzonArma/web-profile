@extends('layouts.front.app')
@inject('carbon', 'Carbon\Carbon')

@section('content-header')
    {{-- @include('layouts.front.header_mobile') --}}
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
            <div class="col-xl-10">
                <div class="entry-title">
                    <h3 class="mb-1">{{ $agenda->judul }}</h3>
                </div>
                <div class="entry-meta my-4">
                    <ul>
                        <li><i class="icon-calendar3"></i> {{ $carbon::parse($agenda->date)->format('d M Y') }}</li>
                        <li><i class="icon-user1"></i> KSPTK</li>
                        <li><i class="icon-line-folder"></i> Agenda</li>
                        <li><i class="icon-line-eye"></i> {{ $agenda->jumlah_lihat }} Dilihat</li>
                    </ul>
                </div>
                <div class="entry-image">
                    <img src="{{ asset('/storage/uploads/agenda/' . $agenda->gambar) }}" alt="img">
                </div>
                <div class="entry-content mt-0">
                    <p class="mb-4">
                        {!! $agenda->konten !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
