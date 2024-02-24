{{-- SWIPER --}}
<div class="mb-3">
    <div class="swiper-1 swiper swiper-banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="wrapper-quotes">
                    <div class="position-relative">
                        <div class="profile-quotes">
                            <img src="{{ asset('assets-front/img/plt_direktur.png') }}" alt="foto" class="img-fluid"
                                width="160">
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
                            <img src="{{ asset('assets-front/img/video_thumb.jpg') }}" class="img-fluid" width="380"
                                alt="Video" draggable="false">
                            <div class="bg-overlay">
                                <div class="bg-overlay-content dark">
                                    <span class="overlay-trigger-icon size-lg op-ts bg-light text-dark animated op-07"
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
{{-- END SWIPER --}}
