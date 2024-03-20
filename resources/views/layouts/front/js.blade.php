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
    var map1 = L.map('peta-persebaran').setView([-3.1073741, 117.4016219], 3.8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<a href="http://www.openstreetmap.org/copyright"></a>'
    }).addTo(map1);
    // map
    var map2 = L.map('peta-pengawas').setView([-3.1073741, 117.4016219], 3.8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<a href="http://www.openstreetmap.org/copyright"></a>'
    }).addTo(map2);
    // map
    var map3 = L.map('peta-tas').setView([-3.1073741, 117.4016219], 3.8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<a href="http://www.openstreetmap.org/copyright"></a>'
    }).addTo(map3);
    // map
    var map4 = L.map('peta-laboran').setView([-3.1073741, 117.4016219], 3.8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<a href="http://www.openstreetmap.org/copyright"></a>'
    }).addTo(map4);
    // map
    var map5 = L.map('peta-perpustakaan').setView([-3.1073741, 117.4016219], 3.8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<a href="http://www.openstreetmap.org/copyright"></a>'
    }).addTo(map5);
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
        spaceBetween: 24,
        speed: 1000,
        breakpoints: {
            768: {
                slidesPerView: 1,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
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
    const swiper4 = new Swiper('.swiper-4', {
        // Optional parameters
        // loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        centeredSlides: true,
        speed: 1000,
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-4 .swiper-button-next',
            prevEl: '.swiper-4 .swiper-button-prev',
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
            1024: {
                slidesPerView: 2,
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

    $('#faq').on('shown.bs.modal', function(e) {
        $("#form-store").trigger('reset');
    });

    $("#form-store").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        let url = $(this).attr("action");
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {

            },
            success: function(response) {

                if (response.status == true) {
                    // Tutup modal
                    $('#faq').modal('hide');
                    // Reset formulir
                    $("#form-store").trigger('reset');
                    // Redirect ke halaman utama
                    window.location.href = BASE_URL + '/';
                } else {
                    toastr.error("Periksa Inputan Anda", {
                        timeOut: 2000,
                        fadeOut: 2000,
                    });
                }
            },
            error: function(xhr, status, error) {

                toastr.error("Ada inputan yang belum terisi", "Gagal", {
                    timeOut: 2000,
                    fadeOut: 2000,
                });
            }
        });
    });
</script>
