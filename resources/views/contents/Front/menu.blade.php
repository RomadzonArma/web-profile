<!-- Primary Navigation website ============================================= -->
<nav class="primary-menu on-click">
    <ul class="menu-container p-0 m-0">
        <li class="menu-item {{ request()->routeIs('index') ? 'current' : '' }}">
            <a class="menu-link" href="{{ route('index') }}">BERANDA</a>
        </li>
        <li class="menu-item sub-menu">
            <a class="menu-link has-menu" href="#">PROFIL <i class="icon-angle-down1"></i></a>
            <ul class="sub-menu-container">
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('visi-misi') }}">VISI & MISI</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">STRUKTUR ORGANISASI</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">TUGAS & FUNGSI</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">KONTAK KAMI</a>
                </li>
            </ul>
        </li>
        <li class="menu-item sub-menu">
            <a class="menu-link has-menu" href="#">INFORMASI PUBLIK <i class="icon-angle-down1"></i></a>
            <ul class="sub-menu-container">
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('berita') }}">BERITA</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">ARTIKEL</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('galeri') }}">GALERI</a>
                </li>
            </ul>
        </li>
        <li class="menu-item sub-menu">
            <a class="menu-link has-menu" href="#">ZI/WBK <i class="icon-angle-down1"></i></a>
            <ul class="sub-menu-container">
                <li class="menu-item">
                    <a class="menu-link" href="#">LKE</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">APLIKASI SIAZIK</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">TESTIMONIAL SIAZIK</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">LHKPN</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">LHKASN</a>
                </li>
                <li class="menu-item sub-menu">
                    <a href="#" class="menu-link">
                        <div>SAKIP<i class="icon-angle-down"></i></div>
                    </a>
                    <ul class="sub-menu-container">
                        <li class="menu-item">
                            <a href="#" class="menu-link">AKUNTABILITAS</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">RENSTRA 2020 - 2024</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="menu-item mega-menu sub-menu">
            <a class="menu-link" href="#">MENU HALAMAN
                <i class="icon-bars ml-2 mr-0"></i>
            </a>
            <div class="mega-menu-content mega-menu-style-2" style="width: 95%">
                <div class="container">
                    <div class="row">
                        <ul class="sub-menu-container mega-menu-column col">
                            <li class="menu-item mega-menu-title sub-menu">
                                <a class="menu-link" href="#">PROGRAM DAN LAYANAN</a>
                                <ul class="sub-menu-container">
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PROGRAM PENDIDIKAN
                                            GURU
                                            PENGGERAK</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PROGRAM SEKOLAH
                                            PENGGERAK</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">IMPLEMENTASI
                                            KURIKULUM
                                            MERDEKA</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PLATFORM MERDEKA
                                            MENGAJAR</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="sub-menu-container mega-menu-column col">
                            <li class="menu-item mega-menu-title sub-menu">
                                <a class="menu-link" href="#">TAUTAN</a>
                                <ul class="sub-menu-container scrolled">
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">KEMDIKBUD</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">DITJEN GTK</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PROGRAM PENDIDIKAN
                                            GURU
                                            PENGGERAK</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PROGRAM SEKOLAH
                                            PENGGERAK</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">ORGANISASI
                                            PENGGERAK</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">DIT. GURU PAUD
                                            DIKMAS</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">DIT. GURU
                                            DIKDAS</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">DIT. GURU
                                            DIKMENDIKSUS</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">DIT. PPG</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PENGADUAN</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="sub-menu-container mega-menu-column col">
                            <li class="menu-item mega-menu-title sub-menu">
                                <a class="menu-link" href="#">PUBLIKASI</a>
                                <ul class="sub-menu-container">
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PANDUAN</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">PENGUMUMAN</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="#">REGULASI</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="{{ route('agenda.list') }}">AGENDA</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="{{ route('unduhan') }}">UNDUHAN</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
