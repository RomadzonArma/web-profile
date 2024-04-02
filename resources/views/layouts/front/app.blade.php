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
                                                            src="{{ asset('storage/uploads/podcast/' . $item->gambar) }}"
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
                                                    <img src="{{ asset('storage/uploads/list_berita/' . $item->gambar) }}"
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
        <form action="{{ route('faq.store') }}" method="post" name="form-store" id="form-store" class="w-100 mb-0">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <select class="form-control" id="id_kategori_faq" name="id_kategori_faq"
                        data-placeholder="Pilih Kategori" required>
                        <option>Pilih Kategori</option>
                        <option disabled>Kategori</option>
                        @foreach ($kategori_faq as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <select class="form-control" id="id_keperluan_faq" name="id_keperluan_faq"
                        data-placeholder="Pilih Keperluan" required>
                        <option>Pilih Keperluan</option>
                        <option disabled>Keperluan</option>
                        @foreach ($keperluan_faq as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_keperluan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..?)\../g, '$1');" required>
                </div>
                <div class="form-group col-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email anda"  required>
                </div>
                <div class="form-group col-6">
                    <input type="number" class="form-control" id="nip" name="nip" placeholder="NIP/NIK"
                        pattern="[0-9]*" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Instansi" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..?)\../g, '$1');" required>
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..?)\../g, '$1');" required>
                </div>
                <div class="form-group col-6">
                    <input type="number" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Nomor HP"
                        pattern="[0-9]*" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12">
                </div>
                <div class="form-group col-12">
                    <textarea class="form-control" id="pertanyaan" name="pertanyaan" oninput="this.value = this.value.replace(/[^a-zA-Z ?., ]/g, '').replace(/(\..?)\../g, '$1');" rows="3" style="height: 86px;"
                        placeholder="Isi pertanyaan anda" required></textarea>
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
                                        <img src="{{ asset('storage/uploads/podcast/' . $podcast->gambar) }}"
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
