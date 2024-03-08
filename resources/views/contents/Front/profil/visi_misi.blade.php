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
    <section class="px-md-5">
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9 col-12 mb-md-0 mb-4">
                        <div class="row">
                            <div class="col-xl-3 col-lg-5 mb-4">
                                <img src="{{ asset('assets-front/img/quotes.jpeg') }}" class="img-fluid rounded">
                            </div>
                            <div class="col-xl-9 col-lg-7">
                                <p class="mb-4">
                                    Kementerian Pendidikan dan Kebudayaan mendukung Visi dan Misi Presiden untuk
                                    mewujudkan Indonesia Maju yang berdaulat, mandiri, dan berkepribadian melalui
                                    terciptanya Pelajar Pancasila yang bernalar kritis, kreatif, mandiri, beriman,
                                    bertakwa kepada Tuhan YME, dan berakhlak mulia, bergotong royong, dan
                                    berkebinekaan global.
                                </p>
                                <p class="mb-4">
                                    Untuk mendukung pencapaian Visi Presiden, Kemendikbud sesuai tugas dan
                                    kewenangannya, melaksanakan Misi Presiden yang dikenal sebagai Nawacita kedua,
                                    yaitu menjabarkan misi nomor (1) Peningkatan kualitas manusia Indonesia; nomor
                                    (5) Kemajuan budaya yang mencerminkan kepribadian bangsa; dan nomor (8)
                                    Pengelolaan pemerintahan yang bersih, efektif, dan terpercaya. Untuk itu, misi
                                    Kemendikbud dalam melaksanakan Nawacita kedua tersebut adalah sebagai berikut:
                                </p>
                            </div>
                        </div>
                        <ul class="iconlist mb-0 indent">
                            <li><i class="icon-line-chevrons-right"></i> Mewujudkan pendidikan yang relevan dan
                                berkualitas tinggi, merata dan berkelanjutan, didukung oleh infrastruktur dan
                                teknologi.</li>
                            <li><i class="icon-line-chevrons-right"></i> Mewujudkan pelestarian dan pemajuan
                                kebudayaan serta pengembangan bahasa dan sastra.</li>
                            <li><i class="icon-line-chevrons-right"></i> Mengoptimalkan peran serta seluruh pemangku
                                kepentingan untuk mendukung transformasi dan reformasi pengelolaan pendidikan dan
                                kebudayaan.</li>
                        </ul>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
@endsection
