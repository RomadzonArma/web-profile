@extends('layouts.front.app')

@section('content-header')
    <section class="bg-soft px-xl-5 d-lg-block d-none">
        <div class="content-wrap py-2">
            <div class="container-fluid">
                <div class="d-flex justify-content-lg-between justify-content-center align-items-center">
                    <a href="{{ route('index') }}" data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                        <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                    </a>
                    <form class="bg-white form-banner my-0" style="min-width: 280px;">
                        <input type="text" placeholder="Cari kata kunci...">
                        <div class="rounded-icon bg-primary">
                            <i class="icon-line-search"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content-index')
    <section class="px-xl-5">
        <div class="content-wrap scrolled">
            <div class="container-fluid">

                {{-- SWIPER --}}
                @include('contents.Front.swiper')

                <div class="row">
                    <div class="col-lg-8 col-md-7 col-12 mb-lg-0 mb-4">

                        {{-- SWIPER PROGRAM --}}
                        @include('contents.Front.swiper_program')

                        {{-- PETA --}}
                        {{-- @include('contents.Front.peta') --}}

                    </div>
                    <div class="col-lg-4 col-md-5 col-12 mb-lg-0 mb-4">

                        {{-- BERITA --}}
                        @include('contents.Front.berita')

                        {{-- WEBINAR --}}
                        @include('contents.Front.webinar')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
