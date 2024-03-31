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
    <div class="col-md-9 col-12 mb-md-0 mb-4">
        <div class="row">
            <div class="col-lg-10  mb-4">
                <img src="{{ asset('/storage/uploads/program-image/' . $guru->image) }}" alt="thumbnail_program">
            </div>
            <div class=" col-lg-10">
                <div class="entry-title">
                    <h3 class="mb-1"><a href="#">{{ $guru->title }}</a>
                    </h3>
                </div>

                <p class="mb-4">
                    {!! $guru->body !!}
                </p>

                <div class="entry-title">
                    <h6 class="mb-1">
                        @php
                            $tags = explode(',', $guru->tag);
                        @endphp

                        @foreach ($tags as $tag)
                            <a href="#"># {{ trim($tag) }}</a>
                        @endforeach
                    </h6>
                </div>

            </div>
        </div>
    </div>
@endsection
