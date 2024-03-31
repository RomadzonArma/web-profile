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
                    <a class="menu-link" href="{{ route('struktur-organisasi') }}">STRUKTUR ORGANISASI</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('tugas-fungsi') }}">TUGAS & FUNGSI</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('kontak-kami') }}">KONTAK KAMI</a>
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
                @foreach ($ziwbk1 as $item)
                    <li class="menu-item">
                        <a class="menu-link" href="{{ $item->link_kategori }}"
                            target="_blank">{{ $item->list_kategori->nama_kategori }}</a>
                    </li>
                @endforeach

                <!-- Tampilkan nama kategori di luar perulangan submenu -->
                @if ($ziwbk2->isNotEmpty())
                    {{-- Iterate through unique categories --}}
                    @foreach ($ziwbk2->unique('id_kategori') as $data)
                        <li class="menu-item sub-menu">
                            <a href="#" class="menu-link">
                                <div>{{ $data->list_kategori->nama_kategori }}<i class="icon-angle-down"></i></div>
                            </a>
                            <ul class="sub-menu-container">
                                {{-- Iterate through subcategories related to the current category --}}
                                @foreach ($ziwbk2->where('id_kategori', $data->id_kategori) as $item)
                                    <li class="menu-item">
                                        <a href="{{ $item->link }}"
                                            class="menu-link">{{ $item->sub_kategori->sub_kategori }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endif
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
                                <a class="menu-link" href="https://guru.kemdikbud.go.id/">PLATFORM MERDEKA
                                    MENGAJAR</a>
                            </li>
                        </ul>
        </li>
    </ul>
    <ul class="sub-menu-container mega-menu-column col">
        <li class="menu-item mega-menu-title sub-menu">
            <a class="menu-link" href="#">TAUTAN</a>
            <ul class="sub-menu-container scrolled">
                @foreach ($tautan as $tautan)
                    <li class="menu-item">
                        @if ($tautan->list_kategori)
                            <a class="menu-link" href="{{ $tautan->link_tautan }}"
                                target="_blank">{{ $tautan->list_kategori->nama_kategori }}</a>
                        @else
                            {{-- <span class="menu-link">Kategori tidak tersedia</span> --}}
                        @endif
                    </li>
                @endforeach
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
                    <a class="menu-link" href="{{ route('pengumumans') }}">PENGUMUMAN</a>
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
    <li class="menu-item sub-menu">
        {{-- <a style="background-color: #007042; border-radius: 50%; color: #fff" class="menu-link has-menu rounded-pill border-0" href="#">PENGADUAN <i class="icon-angle-down1"></i></a> --}}
        <a class="menu-link" href="#">PENGADUAN</a>
        <ul class="sub-menu-container">
            {{-- <li class="menu-item">
                <a class="menu-link" href="#">LAYANAN INFORMASI DAN PENGADUAN</a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#">SIPPN</a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#">WHISTLEBLOWING SYSTEM</a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#">SP4N LAPOR</a>
            </li> --}}
             @foreach ($pengaduan as $data)
                <li class="menu-item">
                    @if ($data->list_kategori)
                        <a class="menu-link" href="{{ $data->link_pengaduan }}"
                            target="_blank">{{ $data->list_kategori->nama_kategori }}</a>
                    @endif
                </li>
            @endforeach 
        </ul>
    </li>
    </ul>

</nav><!-- #primary-menu end -->
