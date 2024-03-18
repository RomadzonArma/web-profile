{{-- SWIPER --}}
<div class="mb-3">
    <div class="swiper-1 swiper swiper-banner">
        <div class="swiper-wrapper">
            @foreach ($swiper as $data)
                <div class="swiper-slide">
                    <div class="row justify-content-center">
                        <div class="position-relative">
                            @if (!empty($data->link))
                                @php
                                    // Extract video ID from YouTube link
                                    preg_match(
                                        '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/live\/)([^"&?\/\s]{11})/',
                                        $data->link,
                                        $matches,
                                    );
                                    $videoId = $matches[1] ?? null;
                                    $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                                @endphp
                                @if ($videoId)
                                    <a class="position-relative d-block lightbox-img"
                                        href="https://www.youtube.com/watch?v={{ $videoId }}"
                                        data-lightbox="iframe">
                                        <img src="{{ $thumbnailUrl }}" class="img-fluid" width="380" alt="Video"
                                            draggable="false">
                                        <div class="bg-overlay">
                                            <div class="bg-overlay-content dark">
                                                <span
                                                    class="overlay-trigger-icon size-lg op-ts bg-light text-dark animated op-07"
                                                    data-hover-animate="op-1" data-hover-animate-out="op-07"
                                                    data-hover-parent=".row" style="animation-duration: 600ms;">
                                                    <i class="icon-line-play"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                    {{-- @else
                                    <div>
                                        <img src="{{ asset('assets-front/img/video_thumb.jpg') }}" class="img-fluid"
                                            width="380" alt="Video" draggable="false">
                                    </div> --}}
                                @endif
                            @else
                                <div style="height: 400px; overflow: hidden;" class="d-flex align-items-center justify-content-center">
                                    <img src="{{ asset($data->foto) }}" alt="foto"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
{{-- END SWIPER --}}
