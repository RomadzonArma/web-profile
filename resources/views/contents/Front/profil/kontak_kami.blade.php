@extends('layouts.front.app')

@section('content-header')
    <section id="page-title" class="bg-soft px-md-5">
        <div class="content-wrap py-0">
            <div class="container-fluid">
                <a href="index.html" class="d-none mb-4 d-lg-block"
                    data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                    <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                </a>
            </div>
            <div class="container-fluid clearfix position-relative">
                <h1 class="mb-2">{{ $title }}</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria="page">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="col-md-9 col-12 mb-md-0 mb-4">
        @foreach ($data_kontak as $data_kontak)
            <div class="row">
                <div class="col-12">
                    <p class="mb-4">
                        {!! $data_kontak->konten !!}
                    </p>

                </div>
                <div class="col-12">
                    <h6 class="text-dark">Media Sosial :</h6>
                    <div class="d-flex align-items-center">
                        <a href="{{ $ref_sosmed->facebook }}" class="social-icon social-icon-2xl si-facebook si-secondary mr-2" target="_blank">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>
                        <a href="{{ $ref_sosmed->twitter }}" class="social-icon social-icon-2xl si-twitter si-secondary mr-2" target="_blank">
                            <i class="icon-twitter"></i>
                            <i class="icon-twitter"></i>
                        </a>
                        <a href="{{ $ref_sosmed->instagram }}" class="social-icon social-icon-2xl si-instagram si-secondary mr-2" target="_blank">
                            <i class="icon-instagram"></i>
                            <i class="icon-instagram"></i>
                        </a>
                        <a href="{{ $ref_sosmed->youtube }}" class="social-icon social-icon-2xl si-youtube si-secondary mr-2" target="_blank">
                            <i class="icon-youtube"></i>
                            <i class="icon-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
