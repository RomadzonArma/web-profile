<!-- JavaScripts ============================================= -->
<script src="{{ asset('assets-front/js/jquery.js') }}"></script>
<script src="{{ asset('assets-front/js/plugins.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- leaftlet script -->
{{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> --}}

<!-- Footer Scripts ============================================= -->
<script src="{{ asset('assets-front/js/functions.js') }}"></script>
<script src="{{ asset('assets-front/js/custom.js') }}"></script>
<script src="{{ config('app.theme') }}assets/libs/sweetalert2/sweetalert2.min.js?q={{ Str::random(5) }}"></script>


<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
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
            delay: 7500,
            disableOnInteraction: false,
        },
        speed: 1500,
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
        // centeredSlides: true,
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
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        speed: 1000,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        speed: 1500,
        // pagination: {
        //     el: ".swiper-pagination",
        //     clickable: true,
        // },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-widget .swiper-button-next',
            prevEl: '.swiper-widget .swiper-button-prev',
        },
    });

    $('#faq').on('shown.bs.modal', function(e) {
        $("#form-store").trigger('reset');
    });

    // let ziWbk = document.getElementById('zi-wbk');
    // // console.log(ziWbk.children[1]);
    // let ziWbkChildren = ziWbk.children[1];
    // // console.log(ziWbkChildren.children);
    // let arr = Array.from(ziWbkChildren.children);
    // arr.forEach(e => {
    //     let subMenu = e.classList.contains('sub-menu');
    //     if(subMenu === true){
    //         subMenu.forEach(el => {
    //             console.log(el)
    //         })
    //     }
    // })
</script>

<script>
    $(document).ready(function () {
        $('#form-store').on('submit', function (e) {
            e.preventDefault();
    
            var data = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: data,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    Swal.fire({
                        title: "Mohon Tunggu",
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        },
                        showConfirmButton: false,
                        showCancelButton: false,
                    });
                },
                success: function (response) {
                    Swal.close();
                    if (response.status == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Pertanyaan berhasil dikirim",
                            text: "Jawaban akan dikirim melalui email",
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(() => {
                            $("#form-store").trigger('reset');
                        });
                    } else {
                        toastr.error("Periksa Inputan Anda", {
                            timeOut: 2000,
                            fadeOut: 2000,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.close();
                    toastr.error("Ada inputan yang belum terisi", "Gagal", {
                        timeOut: 2000,
                        fadeOut: 2000,
                    });
                }
            })
        })
    });
       


</script>

