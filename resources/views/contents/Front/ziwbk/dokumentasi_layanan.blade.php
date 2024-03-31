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
    <div class="col-md-9 col-12 mt-4">
        <div class="tabs clearfix" id="tab-3">
            <div class="tab-container clearfix">
                <div class="post-grid row gutter-30" data-layout="fitRows">
                    @foreach ($foto as $item)
                        {{-- @dd($foto) --}}
                        <div class="entry col-md-4 col-sm-6 col-12">
                            <div class="grid-inner hover-custom">
                                <div class="entry-image">
                                    <div class="fslider" data-arrows="false" data-lightbox="gallery">
                                        <div class="flexslider">
                                            <div class="slider-wrap">
                                                @foreach ($item->refDokumentasiLayanan as $img)
                                                    <div class="slide">
                                                        <a href="{{ asset('/storage/uploads/file-dokumentasi-layanan/gambar/' . $img->image) }}"
                                                            data-lightbox="gallery-item">
                                                            <img src="{{ asset('/storage/uploads/file-dokumentasi-layanan/gambar/' . $img->image) }}"
                                                                alt="img">
                                                        </a>
                                                        {{-- <a href="{{ asset('file-galeri/gambar/' . $item->refGaleri[0]->image) }}"
                                                                    data-lightbox="gallery-item">
                                                                    <img src="{{ asset('file-galeri/gambar/' . $item->refGaleri[0]->image) }}"
                                                                        alt="Standard Post with Gallery">
                                                                </a> --}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="entry-title title-md">
                                    <h2><a href="#">{{ $item->judul }}</a></h2>
                                    {{-- <h2><a href="#">tes</a></h2> --}}
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li><i
                                                class="icon-calendar3"></i>{{ $carbon::parse($item->tanggal)->format('d M Y') }}
                                        </li>
                                        {{-- <li><i class="icon-line-eye"></i>{{ $item->jumlah_lihat }}</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show the 'Foto' tab by default
            showTab('foto');

            // Add click event listeners to the tab navigation links
            var tabLinks = document.querySelectorAll('.tab-nav2 a');
            tabLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var tabId = this.getAttribute('href').substring(1);
                    showTab(tabId);
                });
            });

            // Function to show/hide the tab content
            function showTab(tabId) {
                var tabs = document.querySelectorAll('.tab-container > div');
                tabs.forEach(function(tab) {
                    tab.style.display = 'none';
                });

                var activeTab = document.getElementById(tabId);
                if (activeTab) {
                    activeTab.style.display = 'block';
                }
            }
        });
    </script> --}}
@endpush
