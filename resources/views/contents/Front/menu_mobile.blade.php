<!-- Primary Navigation ============================================= -->
<nav class="primary-menu">

    <ul class="menu-container">
        <li class="menu-item current"><a class="menu-link" href="{{ route('index') }}">BERANDA</a></li>
        <li class="menu-item sub-menu">
            <a class="menu-link" href="#">PROFIL</a>
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
            <a href="#" class="menu-link">INFORMASI PUBLIK</a>
            <ul class="sub-menu-container">
                <li class="menu-item"><a href="{{ route('berita') }}" class="menu-link">BERITA</a></li>
                <li class="menu-item"><a href="{{route('artikel')}}" class="menu-link">ARTIKEL</a></li>
                <li class="menu-item"><a href="{{ route('galeri') }}" class="menu-link">GALERI</a></li>
            </ul>
        </li>
        <li class="menu-item sub-menu">
            <a class="menu-link" href="#">ZI/WBK</a>
            <ul class="sub-menu-container">
                @foreach ($ziwbk as $item)
                    @if (!empty($item->link_kategori))
                        <li class="menu-item">
                            <a class="menu-link" href="{{ $item->link_kategori }}"
                                target="_blank">{{$item->list_kategori->nama_kategori }}</a>
                        </li>
                    @else
                        <li class="menu-item sub-menu">
                            <a href="#" class="menu-link">
                                <div>{{ $item->list_kategori->nama_kategori }}<i class="icon-angle-down"></i></div>
                            </a>
                            <ul class="sub-menu-container">
                                <li class="menu-item">
                                    <a href="{{ $item->link }}" class="menu-link">{{$item->sub_kategori}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endforeach
                {{-- <li class="menu-item">
                    <a class="menu-link" href="#">LKE</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">APLIKASI SIAZIK </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">TESTIMONIAL SIAZIK </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="https://elhkpn.kpk.go.id/portal/user/login">LHKPN</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">LHKASN</a>
                </li>
                <li class="menu-item sub-menu">
                    <a class="menu-link" href="#">
                        <div>
                            SAKIP
                            <i class="icon-angle-down"></i>
                        </div>
                    </a>
                    <ul class="sub-menu-container">
                        <li class="menu-item">
                            <a class="menu-link" href="visi-misi.html">AKUNTABILITAS</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="#">RENSTRA 2020-2024 </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </li>
        <li class="menu-item sub-menu">
            <a class="menu-link" href="#">MENU HALAMAN</a>
            <div class="mega-menu-content mega-menu-style-2" style="width: 95%">
                <div class="container">
                    <div class="row">
                        <ul class="sub-menu-container mega-menu-column col">
                            <li class="menu-item mega-menu-title sub-menu">
                                <a class="menu-link" href="#">PROGRAM DAN LAYANAN</a>
                                <ul class="sub-menu-container">
                                    <a class="menu-link" href="{{ route('guru-penggerak') }}">
                                        PROGRAM PENDIDIKAN GURU PENGGERAK </a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="{{ route('sekolah-penggerak') }}">PROGRAM SEKOLAH
                                    PENGGERAK</a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="https://kurikulum.kemdikbud.go.id/kurikulum-merdeka/">IMPLEMENTASI
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
                <li class="menu-item">
                    <a class="menu-link" href="#">PLATFORM MERDEKA
                        MENGAJAR</a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="sub-menu-container mega-menu-column col">
        <li class="menu-item mega-menu-title sub-menu">
            <a class="menu-link" href="#">PUBLIKASI</a>
            <ul class="sub-menu-container">
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('panduan') }}">PANDUAN</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="/pengumumans">PENGUMUMAN</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('regulasis') }}">REGULASI</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('agenda.list') }}">AGENDA</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('unduhan.list') }}">UNDUHAN</a>
                </li>
            </ul>
        </li>
    </ul>
    </div>
    </div>
    </div>
    </li>
    </ul>

</nav><!-- #primary-menu end -->
