{{-- SWIPER PROGRAM --}}
<div class="mb-3">
    <div class="heading-block border-bottom-0 line-bottom">
        <h6 class="text-uppercase text-dark">PROGRAM FOKUS KSPSTK</h6>
    </div>
    <div class="swiper swiper-3 d-lg-block d-none">
        @php
            use Illuminate\Support\Str;
        @endphp
        <div class="swiper-wrapper">
            @foreach ($program_fokus as $prokus)
                <div class="swiper-slide">
                    @if ($prokus->link)
                        <a href="{{ Str::startsWith($prokus->link, 'http') ? $prokus->link : 'https://' . $prokus->link }}"
                            target="_blank" class="card card-custom mb-2 bg-primary" style="min-height: 150px">
                            <div class="card-body text-center">
                                <p class="text-white font-weight-semibold mb-0">{{ $prokus->title }}</p>
                            </div>
                        </a>
                    @else
                        <a href="#" class="card card-custom mb-2 bg-primary" style="min-height: 150px">
                            <div class="card-body text-center">
                                <p class="text-white font-weight-semibold mb-0">{{ $prokus->title }}</p>
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="d-lg-none d-flex row">
        @foreach ($program_fokus as $prokus)
            <div class="col-6 mb-lg-0 mb-4">
                @if ($prokus->link)
                    <a href="{{ Str::startsWith($prokus->link, 'http') ? $prokus->link : 'https://' . $prokus->link }}"
                        target="_blank" class="card card-custom bg-primary" style="min-height: 150px">
                        <div class="card-body text-center">
                            <p class="text-white font-weight-semibold mb-0">{{ $prokus->title }}</p>
                        </div>
                    </a>
                @else
                    <a href="#" class="card card-custom bg-primary" style="min-height: 150px">
                        <div class="card-body text-center">
                            <p class="text-white font-weight-semibold mb-0">{{ $prokus->title }}</p>
                        </div>
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
{{-- END SWIPER PROGRAM --}}
