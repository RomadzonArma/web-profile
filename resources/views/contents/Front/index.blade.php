@extends('layouts.front.app')

@section('content-header')
    <section class="bg-soft px-xl-5 d-lg-block d-none">
        <div class="content-wrap py-2">
            <div class="container-fluid">
                <div class="d-flex justify-content-lg-between justify-content-center align-items-center">
                    <a href="index.html" data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                        <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                    </a>
                    <form class="bg-white form-banner my-0" style="min-width: 280px;">
                        <input type="text" placeholder="Cari kata kunci...">
                        <div class="rounded-icon bg-secondary">
                            <i class="icon-line-search"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="px-xl-5">
        <div class="content-wrap scrolled">
            <div class="container-fluid">
                <div class="mb-3">
                    <div class="swiper-1 swiper swiper-banner">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="wrapper-quotes">
                                    <div class="position-relative">
                                        <div class="profile-quotes">
                                            <img src="{{ asset('assets-front/img/plt_direktur.png') }}" alt="foto"
                                                class="img-fluid" width="160">
                                            <div class="bg-white text-center p-2 profile">
                                                <h6 class="text-primary mb-0">Dr. Kasiman</h6>
                                                <em class="text-muted mb-0">Direktur</em>
                                            </div>
                                        </div>
                                        <div class="banner-quotes">
                                            <p class="text-white mb-0"><em>"Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit. Unde quis tempore dicta molestias nesciunt
                                                    facere eveniet eligendi labore dolores autem."</em></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row justify-content-center">
                                    <div class="col-xl-3 col-12">
                                        <a class="position-relative d-block lightbox-img"
                                            href="https://www.youtube.com/watch?embeds_referring_euri=https%3A%2F%2Fkspstendik.kemdikbud.go.id%2F&amp;source_ve_path=MTY0NTA2LDE2NDUwMw&amp;feature=emb_share&amp;v=coZijINyLDs"
                                            data-lightbox="iframe">
                                            <img src="{{ asset('assets-front/img/video_thumb.jpg') }}" class="img-fluid"
                                                width="380" alt="Video" draggable="false">
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content dark">
                                                    <span
                                                        class="overlay-trigger-icon size-lg op-ts bg-light text-dark animated op-07"
                                                        data-hover-animate="op-1" data-hover-animate-out="op-07"
                                                        data-hover-parent=".row" style="animation-duration: 600ms;"><i
                                                            class="icon-line-play"></i></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-12 mb-lg-0 mb-4">
                        <div class="mb-3">
                            <div class="heading-block border-bottom-0 line-bottom">
                                <h6 class="text-uppercase text-dark">PROGRAM FOKUS KSPSTK</h6>
                                <div></div>
                            </div>
                            <div class="swiper swiper-3 swiper-padding">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="#" class="card card-custom mb-2">
                                            <div class="card-body text-center">
                                                <p class="text-dark font-weight-normal mb-0">Pendidikan Guru Penggerak</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#" class="card card-custom mb-2">
                                            <div class="card-body text-center">
                                                <p class="text-dark font-weight-normal mb-0">Publikasi, Kemitraan dan
                                                    Harlindung</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#" class="card card-custom mb-2">
                                            <div class="card-body text-center">
                                                <p class="text-dark font-weight-normal mb-0">Pengembangan Kompetensi
                                                    Berkelanjutan</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#" class="card card-custom mb-2">
                                            <div class="card-body text-center">
                                                <p class="text-dark font-weight-normal mb-0">Regulasi, Tata Kelola, dan
                                                    Tenaga Kerja</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#" class="card card-custom mb-2">
                                            <div class="card-body text-center">
                                                <p class="text-dark font-weight-normal mb-0">Pembelajaran</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="heading-block line-bottom border-bottom-0">
                                <h6 class="text-uppercase text-dark">PETA PERSEBARAN</h6>
                                <div></div>
                            </div>
                            <div class="row tab-custom">
                                <div class="col-lg-9 col-12 order-2 order-lg-1">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="kepala-sekolah" role="tabpanel"
                                            aria-labelledby="list-kepala-sekolah">
                                            <div id="peta-persebaran">
                                                <script src="{{ asset('assets-front/js/geo-indonesia.json') }}"></script>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pengawas-sekolah" role="tabpanel"
                                            aria-labelledby="list-pengawas-sekolah">
                                            <p>Nobis laudantium est repellendus ad cumque ex quasi alias, quas
                                                veritatis nam optio deleniti itaque, expedita, quo quidem
                                                temporibus? Voluptate ratione numquam ex quae, culpa eos eum dolor a
                                                dolore vitae praesentium animi? Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit. Voluptatum earum beatae quibusdam
                                                aspernatur impedit fuga excepturi sapiente pariatur blanditiis
                                                provident repudiandae inventore veritatis tenetur eum nisi magni
                                                explicabo dolorem atque recusandae praesentium non, mollitia
                                                dignissimos fugit! Reiciendis consectetur eligendi corporis!</p>
                                        </div>
                                        <div class="tab-pane fade" id="tas" role="tabpanel"
                                            aria-labelledby="list-tas">
                                            <p>Quam aspernatur incidunt iure soluta consequatur veniam
                                                exercitationem deleniti ullam, molestiae similique odio facilis
                                                iusto numquam. Quasi voluptatem laborum deleniti neque,
                                                necessitatibus repellat, ipsam repudiandae dignissimos. Deleniti
                                                soluta facere fugiat repudiandae delectus, perspiciatis quibusdam
                                                animi odit, eius iste vitae modi nesciunt maiores quasi repellendus
                                                eaque ratione tempora eos minus eum excepturi qui praesentium,
                                                ipsam. Maiores nulla eum dolorum saepe ullam officia consequatur
                                                blanditiis harum aperiam sequi. Dolorem odio aliquid amet error
                                                eveniet excepturi quis, suscipit, cumque itaque ab dicta magnam
                                                dolorum voluptatum cupiditate placeat atque delectus eius facilis
                                                mollitia possimus!</p>
                                        </div>
                                        <div class="tab-pane fade" id="laboran" role="tabpanel"
                                            aria-labelledby="list-laboran">
                                            <p>Placeat doloribus earum voluptate delectus porro reprehenderit unde
                                                vero neque obcaecati, aperiam, dicta, tenetur labore consequuntur
                                                enim error quidem facere eum eveniet repellendus et fugit debitis!
                                                Laudantium, dolore quasi quae rem repellendus sit hic. Nobis vel ab
                                                ratione quisquam nesciunt blanditiis et itaque iste eos atque
                                                placeat expedita quis aliquam rerum dolore fuga, dicta. Veritatis
                                                inventore adipisci cupiditate ducimus laborum eaque atque deleniti
                                                repellendus pariatur veniam repellat id laudantium, asperiores
                                                provident tempora eveniet, nihil esse facere iusto aliquam maiores,
                                                iste. Quaerat, sapiente repudiandae aspernatur animi maiores,
                                                nesciunt veritatis quam, suscipit asperiores vitae itaque! Autem,
                                                architecto, repellendus. Laudantium labore, doloremque
                                                necessitatibus quod sint iure ab officiis delectus molestias sunt
                                                illum velit harum ullam! Blanditiis corporis reiciendis pariatur,
                                                amet magni animi. Laboriosam animi ducimus a.</p>
                                        </div>
                                        <div class="tab-pane fade" id="perpustakaan" role="tabpanel"
                                            aria-labelledby="list-perpustakaan">
                                            <p>Placeat doloribus earum voluptate delectus porro reprehenderit unde
                                                vero neque obcaecati, aperiam, dicta, tenetur labore consequuntur
                                                enim error quidem facere eum eveniet repellendus et fugit debitis!
                                                Laudantium, dolore quasi quae rem repellendus sit hic. Nobis vel ab
                                                ratione quisquam nesciunt blanditiis et itaque iste eos atque
                                                placeat expedita quis aliquam rerum dolore fuga, dicta. Veritatis
                                                inventore adipisci cupiditate ducimus laborum eaque atque deleniti
                                                repellendus pariatur veniam repellat id laudantium, asperiores
                                                provident tempora eveniet, nihil esse facere iusto aliquam maiores,
                                                iste. Quaerat, sapiente repudiandae aspernatur animi maiores,
                                                nesciunt veritatis quam, suscipit asperiores vitae itaque! Autem,
                                                architecto, repellendus. Laudantium labore, doloremque
                                                necessitatibus quod sint iure ab officiis delectus molestias sunt
                                                illum velit harum ullam! Blanditiis corporis reiciendis pariatur,
                                                amet magni animi. Laboriosam animi ducimus a.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12 order-1 order-lg-2 mb-lg-0 mb-4">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-kepala-sekolah"
                                            data-toggle="list" href="#kepala-sekolah" role="tab"
                                            aria-controls="kepala-sekolah">Kepala Sekolah</a>
                                        <a class="list-group-item list-group-item-action" id="list-pengawas-sekolah"
                                            data-toggle="list" href="#pengawas-sekolah" role="tab"
                                            aria-controls="pengawas-sekolah">Pengawas Sekolah</a>
                                        <a class="list-group-item list-group-item-action" id="list-tas"
                                            data-toggle="list" href="#tas" role="tab" aria-controls="tas">Tas</a>
                                        <a class="list-group-item list-group-item-action" id="list-laboran"
                                            data-toggle="list" href="#laboran" role="tab"
                                            aria-controls="laboran">Laboran</a>
                                        <a class="list-group-item list-group-item-action" id="list-perpustakaan"
                                            data-toggle="list" href="#perpustakaan" role="tab"
                                            aria-controls="perpustakaan">Perpustakaan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 mb-lg-0 mb-4">
                        <div class="mb-3">
                            <div class="heading-block border-bottom-0 d-flex justify-content-between flex-wrap">
                                <h6 class="text-uppercase text-dark mb-0">BERITA TERKINI</h6>
                                <a href="berita.html" class="arrow-rounded">
                                    Selengkapnya
                                    <div>
                                        <i class="icon-angle-right1"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="entry mb-4">
                                <div class="grid-inner row no-gutters p-0">
                                    <div class="entry-image col-md-4 mb-xl-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h6 class="mb-1"><a href="detail.html">Pengelolaan Kinerja di PMM
                                                    Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h6>
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
                                    <div class="entry-image col-md-4 mb-xl-0">
                                        <a href="#">
                                            <img src="{{ asset('assets-front/img/BERITA1.jpg') }}" alt="thumbnail_berita">
                                        </a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-xs text-clamp-2">
                                            <h6 class="mb-1"><a href="#">Pengelolaan Kinerja di PMM
                                                    Memberikan
                                                    Banyak Kemudahan untuk Guru dan Kepala Sekolah</a></h6>
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
                        </div>
                        <div>
                            <div class="heading-block border-bottom-0 d-flex justify-content-between flex-wrap">
                                <h6 class="text-uppercase text-dark mb-0">WEBINAR KSPSTK</h6>
                                <a href="#" class="arrow-rounded">
                                    Selengkapnya
                                    <div>
                                        <i class="icon-angle-right1"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper swiper-widget px-0">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/webinar1.png') }}" alt="webinar"
                                            width="130" class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/webinar2.png') }}" alt="webinar"
                                            width="130" class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/webinar3.png') }}" alt="webinar"
                                            width="130" class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/webinar1.png') }}" alt="webinar"
                                            width="130" class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/webinar2.png') }}" alt="webinar"
                                            width="130" class="img-fluid">
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
