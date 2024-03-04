@extends('layouts.front.app')

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
                <h3 class="mb-2">HADAPI ERA DIGITAL, KEMENDIKBUDRISTEK OPTIMALKAN PERAN ORANG TUA DAN GURU DALAM
                    MEMBIMBING ANAK</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Informasi Publik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
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
                    <div class="col-md-9 col-12">
                        <div class="entry-title">
                            <h2>HADAPI ERA DIGITAL, KEMENDIKBUDRISTEK OPTIMALKAN PERAN ORANG TUA DAN GURU DALAM MEMBIMBING
                                ANAK</h2>
                        </div>
                        <div class="entry-meta my-4">
                            <ul>
                                <li><a href="#"><i class="icon-calendar3"></i> 10 Februari 2024</a></li>
                                <li><a href="#"><i class="icon-user1"></i> KSPTK</a></li>
                                <li><a href="#"><i class="icon-line-folder"></i> Berita</a></li>
                                <li><a href="#"><i class="icon-line-eye"></i> 8 Dilihat</a></li>
                            </ul>
                        </div>
                        <div class="entry-image">
                            <img src="{{ asset('assets-front/img/berita2.jpg') }}" alt="banner-berita">
                        </div>
                        <div class="entry-content mt-0">
                            <p><b>KSPS - </b>Dewasa ini, gawai dan peranti digital semakin masif digunakan anak dan remaja
                                Indonesia untuk berpartisipasi dalam kegiatan pembelajaran jarak jauh, baik untuk jenjang
                                pendidikan anak usia dini hingga pendidikan tinggi. Namun di saat yang sama, muncul pula
                                berbagai permasalahan akibat meningkatnya intensitas penggunaan gawai tersebut.</p>
                            <p>Oleh karena itu, Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi (Kemendikbudristek)
                                melalui Direktorat Jenderal Guru dan Tenaga Kependidikan (Ditjen GTK) bekerja sama dengan
                                Dharma Wanita Persatuan (DWP) menyelenggarakan webinar bertajuk “Menjadi Orang Tua Bijak di
                                Era Digital.” Webinar disiarkan secara langsung melalui Youtube Ditjen GTK Kemdikbud RI,
                                Rabu (7/2).</p>
                        </div>
                        <div class="fslider" data-arrows="false" data-speed="650" data-pause="2500" data-animation="fade">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                    <div class="slide"><a href="#"><img
                                                src="{{ asset('assets-front/img/berita2.jpg') }}" alt="banner"></a></div>
                                    <div class="slide"><a href="#"><img
                                                src="{{ asset('assets-front/img/berita3.jpg') }}" alt="banner"></a></div>
                                    <div class="slide"><a href="#"><img
                                                src="{{ asset('assets-front/img/berita4.jpg') }}" alt="banner"></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="entry-content">
                            <p>Dalam sambutannya, Ketua DWP Kemendikbudristek, Franka Makarim, menuturkan bahwa isu yang
                                diangkat dalam webinar ini sangat relevan dengan kondisi yang dihadapi orang tua maupun
                                pendidik terkait penggunaan teknologi digital di dalam dunia pendidikan. </p>
                            <p>Teknologi digital merupakan salah satu sarana untuk memudahkan pertukaran informasi namun
                                menciptakan ekosistem pendidikan digital yang sehat bagi tumbuh-kembang anak-anak Indonesia
                                masih menjadi tugas besar berbagai pihak terkait. Tak dapat dipungkiri, kemajuan teknologi
                                dapat mengoptimalkan pertukaran informasi yang berguna untuk menstimulasi keterampilan
                                berpikir dan nalar kritis anak. </p>
                            <p>Di sisi lain, maraknya bahaya siber yang mengancam ketika berselancar di internet, membuat
                                peran orang tua sebagai figur teladan pengguna teknologi digital yang cermat, kritis, dan
                                produktif menjadi sangat penting. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="heading-block md mb-3">
                            <h4 class="mb-1">MEDIA SOSIAL</h4>
                        </div>
                        <div class="fslider fslider-banner testimonial-full mb-4" data-animation="slide"
                            data-arrows="false">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}" style="width: 100%;"
                                                    alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}" style="width: 100%;"
                                                    alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}" style="width: 100%;"
                                                    alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide" style="max-height: 100%;">
                                        <div class="overlaying-img">
                                            <a href="#"><img class="img-fluid"
                                                    src="{{ asset('assets-front/img/podcast.jpeg') }}"
                                                    style="width: 100%;" alt="Image 1"></a>
                                            <div class="bg-overlay">
                                                <div class="overlaying-desc">
                                                    <h4 class="text-white mb-0 text-center">Podcast</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry-social">
                            <h4>Bagikan ke Media Sosial</h4>
                            <div class="d-flex flex-wrap">
                                <a href="#" class="social-icon si-colored si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#" class="social-icon si-colored si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>
                                <a href="#" class="social-icon si-colored si-instagram">
                                    <i class="icon-instagram"></i>
                                    <i class="icon-instagram"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget clearfix">
                            <div class="heading-block md mb-3">
                                <h4 class="mb-1">BERITA TERKINI</h4>
                            </div>
                            <div class="entry mb-4">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-xl-4 mb-xl-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}"
                                                alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-xl-8 pl-xl-3">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h6 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h6>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                    <div class="col-xl-8 pl-xl-3">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h6 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h6>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                    <div class="col-xl-8 pl-xl-3">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h6 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h6>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                    <div class="col-xl-8 pl-xl-3">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h6 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h6>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
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
                                    <div class="col-xl-8 pl-xl-3">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h6 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h6>
                                        </div>
                                        <div class="entry-meta mb-2 mt-0">
                                            <ul>
                                                <li><a href="#"><i class="icon-calendar3"></i> 2 Februari 2024</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
