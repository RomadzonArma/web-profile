{{-- WEBINAR --}}
<div>
    <div class="heading-block border-bottom-0 d-flex justify-content-between">
        <h6 class="text-uppercase text-dark mb-0">WEBINAR KSPSTK</h6>
        <a href="https://app.kspstendik.kemdikbud.go.id/webinar/" class="arrow-rounded">
            <span class="d-sm-inline d-none">Selengkapnya</span>
            <div>
                <i class="icon-angle-right1"></i>
            </div>
        </a>
    </div>
    <div class="swiper swiper-widget px-0">
        <div class="swiper-wrapper">
            @foreach ($webinar as $item)
            <div class="swiper-slide">
                <a href="{{$item->link_webinar}}" target="_blank">
                    <img src="{{ asset('webinar/'. $item->gambar) }}" alt="webinar">
                </a>

            </div>
            @endforeach

            {{-- <div class="swiper-slide">
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
            </div> --}}
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
{{-- END WEBINAR --}}
