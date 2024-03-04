{{-- SWIPER PROGRAM --}}
<div class="mb-3">
    <div class="heading-block border-bottom-0 line-bottom">
        <h6 class="text-uppercase text-dark">PROGRAM FOKUS KSPSTK</h6>
        <div></div>
    </div>
    <div class="swiper swiper-3 swiper-padding">
        <div class="swiper-wrapper">
            @foreach($program_fokus as $program_fokus)
            <div class="swiper-slide">
                <a href="#" class="card card-custom mb-2 bg-primary">
                    <div class="card-body text-center">
                        <p class="text-dark font-weight-normal mb-0">{{$program_fokus->title}}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>
{{-- END SWIPER PROGRAM --}}
