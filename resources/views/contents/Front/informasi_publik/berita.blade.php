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
        <form class="row mb-4 mt-4">
            <div class="form-group pr-sm-2 col-lg-2 col-sm-4 mb-sm-0 mb-3">
                <select class="form-control" id="tahun">
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                </select>
                <i class="icon-caret-down1 icon-select"></i>
            </div>
            <div class="form-group px-sm-2 col-lg-2 col-sm-4 mb-sm-0 mb-3">
                <select class="form-control" id="bulan">
                    <option>Januari</option>
                    <option>Februari</option>
                    <option>Maret</option>
                    <option>April</option>
                    <option>Mei</option>
                    <option>Juni</option>
                    <option>Juli</option>
                    <option>Agustus</option>
                    <option>September</option>
                    <option>Oktober</option>
                    <option>November</option>
                    <option>Desember</option>
                </select>
                <i class="icon-caret-down1 icon-select"></i>
            </div>
            <div class="col-xl-2 pl-sm-2 col-sm-4">
                <button class="button w-100 m-0 rounded">Cari</button>
            </div>
        </form>
        <div class="result-berita">
            @foreach ($berita as $item)
                <div class="entry mb-5">
                    <div class="grid-inner row no-gutters p-0">
                        <div class="entry-image col-md-4 mb-md-0">
                            <a href="#">
                                <img src="{{ asset('list_berita/' . $item->gambar) }}" alt="thumbnail_berita">
                            </a>
                        </div>
                        <div class="col-md-8 pl-md-4">
                            <div class="entry-title title-xs">
                                <h3 class="mb-1"><a href="#">{{ $item->judul }}</a>
                                </h3>
                            </div>
                            <div class="entry-meta mb-2 mt-0">
                                <ul>
                                    <li><a href="#"><i
                                                class="icon-calendar3"></i>{{ $carbon::parse($item->tanggal)->format('D M Y') }}</a>
                                    </li>
                                    <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                    <li><a href="#"><i class="icon-line-folder"></i> Berita</a></li>
                                    <li><a href="#"><i class="icon-line-eye"></i>{{ $item->jumlah_lihat }} Dilihat</a>
                                    </li>
                                </ul>
                            </div>
                            <p class="mb-2 text-muted text-clamp-2">
                                {!! \Illuminate\Support\Str::words(strip_tags($item->isi_konten), 65, '...') !!}
                            </p>
                            <a class="more-link" href="/berita/detail/{{ $item->id }}">Baca Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-4 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Berita</a></li>
                                                <li><a href="#"><i class="icon-line-eye"></i> 8 Dilihat</a></li>
                                            </ul>
                                        </div>
                                        <p class="mb-2 text-muted text-clamp-2">
                                            KSPSTK - Direktorat Jenderal Guru dan Tenaga Kependidikan (Ditjen
                                            GTK), Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi
                                            (Kemendikbudristek) kembali menyelenggarakan program rutin SAPA GTK yang
                                            sudah memasuki Episode 18, pada Selasa (23/1).
                                        </p>
                                        <a class="more-link" href="#">Baca Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-4 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Berita</a></li>
                                                <li><a href="#"><i class="icon-line-eye"></i> 8 Dilihat</a></li>
                                            </ul>
                                        </div>
                                        <p class="mb-2 text-muted text-clamp-2">
                                            KSPSTK - Direktorat Jenderal Guru dan Tenaga Kependidikan (Ditjen
                                            GTK), Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi
                                            (Kemendikbudristek) kembali menyelenggarakan program rutin SAPA GTK yang
                                            sudah memasuki Episode 18, pada Selasa (23/1).
                                        </p>
                                        <a class="more-link" href="#">Baca Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-4 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Berita</a></li>
                                                <li><a href="#"><i class="icon-line-eye"></i> 8 Dilihat</a></li>
                                            </ul>
                                        </div>
                                        <p class="mb-2 text-muted text-clamp-2">
                                            KSPSTK - Direktorat Jenderal Guru dan Tenaga Kependidikan (Ditjen
                                            GTK), Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi
                                            (Kemendikbudristek) kembali menyelenggarakan program rutin SAPA GTK yang
                                            sudah memasuki Episode 18, pada Selasa (23/1).
                                        </p>
                                        <a class="more-link" href="#">Baca Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry mb-5">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-4 mb-md-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                                                alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-xs">
                                            <h3 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h3>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                                <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                                <li><a href="#"><i class="icon-line-folder"></i> Berita</a></li>
                                                <li><a href="#"><i class="icon-line-eye"></i> 8 Dilihat</a></li>
                                            </ul>
                                        </div>
                                        <p class="mb-2 text-muted text-clamp-2">
                                            KSPSTK - Direktorat Jenderal Guru dan Tenaga Kependidikan (Ditjen
                                            GTK), Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi
                                            (Kemendikbudristek) kembali menyelenggarakan program rutin SAPA GTK yang
                                            sudah memasuki Episode 18, pada Selasa (23/1).
                                        </p>
                                        <a class="more-link" href="#">Baca Lebih Lanjut</a>
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
