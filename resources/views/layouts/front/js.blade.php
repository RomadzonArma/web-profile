<!-- JavaScripts ============================================= -->
<script src="{{ asset('assets-front/js/jquery.js') }}"></script>
<script src="{{ asset('assets-front/js/plugins.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- leaftlet script -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<!-- Footer Scripts ============================================= -->
<script src="{{ asset('assets-front/js/functions.js') }}"></script>
<script src="{{ asset('assets-front/js/custom.js') }}"></script>

<script>
    // map
    var map = L.map('peta-persebaran').setView([-3.1073741, 117.4016219], 3.8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<a href="http://www.openstreetmap.org/copyright"></a>'
    }).addTo(map);
</script>

<script>
    const swiper1 = new Swiper('.swiper-1', {
        // Optional parameters
        // loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        // autoHeight: true,
        centeredSlides: true,
        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
        },
        speed: 1000,
        // Pagination
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-1 .swiper-button-next',
            prevEl: '.swiper-1 .swiper-button-prev',
        },
    });
    // Swiper 3
    const swiper3 = new Swiper('.swiper-3', {
        // Optional parameters
        // loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        speed: 1000,
        breakpoints: {
            768: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-3 .swiper-button-next',
            prevEl: '.swiper-3 .swiper-button-prev',
        },
    });
    const swiperWidget = new Swiper('.swiper-widget', {
        // Optional parameters
        // loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        speed: 1000,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-widget .swiper-button-next',
            prevEl: '.swiper-widget .swiper-button-prev',
        },
    });
</script>
