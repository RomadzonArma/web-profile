@inject('carbon', 'Carbon\Carbon')
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.front.css')
    <!-- Document Title ============================================= -->
    <title>KSPSTENDIK Kemdikbud | 2024</title>

</head>

<body class="stretched">
    <div id="wrapper" class="clearfix">

        @include('layouts.front.header_mobile')

        @yield('content-header')

        @include('layouts.front.header')

        {{-- @yield('content-index') --}}


        {{-- @dd($podcast) --}}
        <section class="px-xl-4">
            <div class="content-wrap">
                <div class="container-fluid">
                    <div class="row">

                        @yield('content')

                        <div class="col-md-3 col-12 mt-4">
                            <div class="heading-block md mb-3">
                                <h4 class="mb-1">MEDIA SOSIAL</h4>
                            </div>
                            <div class="fslider fslider-banner testimonial-full mb-4" data-animation="slide"
                                data-arrows="false">
                                <div class="flexslider">
                                    <div class="slider-wrap">
                                        @foreach ($podcast as $item)
                                            <div class="slide" style="max-height: 100%;">
                                                <div class="overlaying-img">
                                                    <a href="{{ $item->link_podcast }}"><img class="img-fluid"
                                                            src="{{ asset('podcast/' . $item->gambar) }}"
                                                            style="width: 100%;" alt="Image 1"></a>

                                                    <a href="{{ $item->link_podcast }}" target="_blank">
                                                        <div class="bg-overlay">
                                                            <div class="overlaying-desc">
                                                                <a href="{{ $item->link_podcast }}" target="_blank">
                                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="widget clearfix">
                                <div class="heading-block md mb-3">
                                    <h4 class="mb-1">BERITA TERKINI</h4>
                                </div>
                                @foreach ($berita as $item)
                                    <div class="entry mb-4">
                                        <div class="grid-inner row no-gutters p-0">
                                            <div class="entry-image col-xl-4 mb-xl-0">
                                                <a href="{{ route('berita.detail', ['slug' => $item->slug]) }}">
                                                    <img src="{{ asset('list_berita/' . $item->gambar) }}"
                                                        alt="thumbnail_berita">
                                                </a>
                                            </div>
                                            <div class="col-xl-8 pl-xl-4">
                                                <div class="entry-title title-xs text-clamp-2">
                                                    <h5 class="mb-1"><a
                                                            href="{{ route('berita.detail', ['slug' => $item->slug]) }}">{{ $item->judul }}</a>
                                                    </h5>
                                                </div>
                                                <div class="entry-meta mb-2 mt-0">
                                                    <ul>
                                                        <li><a href="#"><i class="icon-calendar3"></i>
                                                                {{ $carbon::parse($item->date)->format('d M Y') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                    {{--  </div>  --}}
                </div>
        </section>

        @include('layouts.front.footer')

    </div>

    <a href="javascript:void(0)" id="faq">
        <div class="position-relative">
            <i class="icon-line-phone"></i>
            <h6 class="text-white mb-0">INFO KSPS</h6>
        </div>
    </a>
    <div class="faq-wrapper">
        <div class="position-relative d-flex justify-content-between">
            <h5 class="text-primary mb-2">QnA!</h5>
            <img src="{{ asset('assets-front/img/faqq.png') }}" width="140" class="faq img-fluid">
        </div>
        {{-- <img src="{{ asset('assets-front/img/ksps_faq.png') }}" alt="faq" class="img-fluid"> --}}
        {{-- <form class="mb-0 w-100" action="{{ route('faq.store') }}" method="post" name="form-store" id="form-store">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" id="nama" name="nama"  placeholder="Nama ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" name="email"  placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="pertanyaan" name="pertanyaan"  placeholder="Tulis pertanyaan anda...">
            </div>
            <button  type="submit" class="btn btn-primary btn-simpan">Kirim</button>
        </form> --}}
        <form action="{{ route('faq.store') }}"  method="post" name="form-store" id="form-store"  class="w-100 mb-0" >
            <div class="row">
                <div class="form-group col-6">
                    <select class="form-control select2" data-placeholder="Pilih Kategori">
                        <option></option>
                        <option disabled>Kategori</option>
                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                        <option value="Dinas Pendidikan">Dinas Pendidikan</option>
                        <option value="LPTK">LPTK</option>
                        <option value="Guru">Guru</option>
                        <option value="Yayasan">Yayasan</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Pengawas">Pengawas</option>
                        <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                        <option value="Umum">Umum</option>
                        <option value="Siswa/Mahasiswa/Magang">Siswa/Mahasiswa/Magang</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <select class="form-control select2" data-placeholder="Pilih Keperluan">
                        <option></option>
                        <option disabled>Keperluan</option>
                        <option value="Program Sekolah Penggerak">Program Sekolah Penggerak</option>
                        <option value="Komunitas Belajar">Komunitas Belajar
                        </option>
                        <option value="Implementasi Kurikulum Merdeka">Implementasi Kurikulum Merdeka
                        </option>
                        <option value="Platform Merdeka Mengajar">Platform Merdeka Mengajar
                        </option>
                        <option value="Rekrutmen">Rekrutmen</option>
                        <option value="Implementasi">Implementasi</option>
                        <option value="Pelatihan">Pelatihan</option>
                        <option value="Peningkatan Kompetensi Kepala Sekolah">Peningkatan Kompetensi Kepala Sekolah
                        </option>
                        <option value="Pengembangan Kompetensi Pengawas Sekolah">Pengembangan Kompetensi Pengawas
                            Sekolah
                        </option>
                        <option value="PJOK bagi Guru Penggerak"> PJOK bagi Guru Penggerak
                        </option>
                        <option value="Data Kepala Sekolah, Pengawas Sekolah, dan Tenaga"> Data Kepala Sekolah, Pengawas
                            Sekolah, dan Tenaga
                        </option>
                        <option value="Regulasi dan peraturan"> Regulasi dan peraturan
                        </option>
                        <option value="Tata Kelola Asesor">Tata Kelola Asesor
                        </option>
                        <option value="Tenaga Kependidikan"> Tenaga Kependidikan
                        </option>
                        <option value="UKKJ Pengawas">UKKJ Pengawas
                        </option>
                        <option value="Ujikom Pengawas"> Ujikom Pengawas
                        </option>
                        <option value="SIM Tendik Pengawas"> SIM Tendik Pengawas
                        </option>
                        <option value="Publikasi"> Publikasi
                        </option>
                        <option value="Kemitraan KSPSTK"> Kemitraan KSPSTK
                        </option>
                        <option value="Penghargaan"> Penghargaan
                        </option>
                        <option value="Perlindungan KSPSTK"> Perlindungan KSPSTK
                        </option>
                        <option value="Praktik Kerja Lapangan/KKN/Magang"> Praktik Kerja Lapangan/KKN/Magang
                        </option>
                        <option value="Layanan Tata Usaha"> Layanan Tata Usaha
                        </option>
                        <option value="Layanan Lain-lain"> Layanan Lain-lain
                        </option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control" id="nama" name="nama"
                        placeholder="Nama Lengkap">
                </div>
                <div class="form-group col-12">
                    <input type="email" class="form-control" id="email" name="email"  placeholder="Email anda">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP/NIK">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="instansi" name="instansi"
                        placeholder="Instansi">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp"
                        placeholder="Nomor HP">
                </div>
                <div class="form-group col-12">
                    <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3" style="height: 86px;"
                        placeholder="Isi pertanyaan anda"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-simpan w-100">Kirim</button>
        </form>
    </div>

    <div class="modal fade" id="podcast" tabindex="-1" role="dialog" aria-labelledby="Podcast"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Podcast KSPSTK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body py-0 my-3">
                    @foreach ($podcast as $podcast)
                        <div class="entry mb-4">
                            <div class="grid-inner row no-gutters p-0">
                                <div class="entry-image col-3 mb-0">
                                    <a href="{{ $podcast->link_podcast }}" target="_blank">
                                        <img src="{{ asset('podcast/' . $podcast->gambar) }}"
                                            alt="thumbnail_podcast">
                                    </a>
                                </div>
                                <div class="col-9 pl-3">
                                    <div class="entry-title title-md text-clamp-2">
                                        <h6 class="mb-1"><a
                                                href="{{ $podcast->link_podcast }}" target="_blank">{{ $podcast->judul }}</a></h6>
                                    </div>
                                    <div class="entry-meta mb-2 mt-0">
                                        <ul>
                                            {{-- <li><a href="#"><i class="icon-users"></i> {{$podcast->jumlah_lihat ?? 0}} penonton</a> --}}
                                            <li>
                                                <a href="#"><i
                                                        class="icon-calendar3"></i>{{ $podcast->date }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="text-muted fs-6 text-clamp-3 mb-0">{{ $podcast->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('layouts.front.js')

</body>

</html>
{{-- <div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="entry mb-4">
    <div class="grid-inner row no-gutters p-0">
        <div class="entry-image col-xl-4 mb-xl-0">
            <a href="#">
                <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                    alt="thumbnail_berita">
            </a>
        </div>
        <div class="col-xl-8 pl-xl-4">
            <div class="entry-title title-xs text-clamp-2">
                <h5 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                        Memberikan
                        Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h5>
            </div>
            <div class="entry-meta mb-2 mt-0">
                <ul>
                    <li><a href="#"><i class="icon-calendar3"></i> 2 Februari
                            2024</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}
