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
    @foreach ($data_tugas as $data_tugas)
        <div class="col-md-9 col-12 mb-md-0 mb-4">
            <div class="mt-4">
                {!! $data_tugas->konten !!}
            </div>
            {{-- <p class="mb-4">
            </p> --}}
            {{-- <div class="row">
                <div class="col-xl-9 col-lg-7">

                </div>
            </div> --}}
            
        </div>
    @endforeach
@endsection
