<!-- Header Tampilan Mobile ============================================= -->
<header class="full-header not-top d-lg-none d-block">
    <div id="header-wrap" class="py-2">
        <div class="container-fluid px-xl-5">
            <div class="header-row justify-content-between">
                <a href="index.html" class="d-block"
                    data-dark-logo="{{ asset('assets-front/img/logo-P3GTK.png') }}">
                    <img src="{{ asset('assets-front/img/logo-P3GTK.png') }}" class="img-fluid" width="150">
                </a>
                <div class="d-flex align-items-center ml-auto">
                    <a href="#podcast" class="mr-2" data-toggle="modal" data-target="#podcast">
                        <img src="{{ asset('assets-front/img/podcast.jpeg') }}" alt="podcast" class="img-fluid"
                            width="36">
                    </a>
                    <a href="#" class="social-icon si-secondary mr-2">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                    </a>
                    <a href="#" class="social-icon si-secondary mr-2">
                        <i class="icon-twitter"></i>
                        <i class="icon-twitter"></i>
                    </a>
                    <a href="#" class="social-icon si-secondary mr-2">
                        <i class="icon-instagram"></i>
                        <i class="icon-instagram"></i>
                    </a>
                    <a href="#" class="social-icon si-secondary mr-2">
                        <i class="icon-youtube"></i>
                        <i class="icon-youtube"></i>
                    </a>
                </div>
                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100">
                        <path
                            d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
                        </path>
                        <path d="m 30,50 h 40"></path>
                        <path
                            d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
                        </path>
                    </svg>
                </div>
                @include('contents.Front.menu_mobile')


            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header><!-- #header end -->
