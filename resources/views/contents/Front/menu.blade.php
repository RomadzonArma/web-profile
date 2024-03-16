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
            <a class="menu-link has-menu" href="#">INFORMASI PUBLIK <i class="icon-angle-down1"></i></a>
            <ul class="sub-menu-container">
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('berita') }}">BERITA</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('artikel') }}">ARTIKEL</a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('galeri') }}">GALERI</a>
                </li>
            </ul>
        </li>
        <li class="menu-item sub-menu">
            <a class="menu-link has-menu" href="#">ZI/WBK <i class="icon-angle-down1"></i></a>
            <ul class="sub-menu-container">
                @foreach ($ziwbk1 as $item)
                    <li class="menu-item">
                        <a class="menu-link" href="{{ $item->link_kategori }}" target="_blank">{{ $item->list_kategori->nama_kategori }}</a>
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
                                    <a href="{{ $item->link }}" class="menu-link">{{ $item->sub_kategori->nama_sub_kategori }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
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
                                        <a class="menu-link" href="{{ route('guru-penggerak') }}">PROGRAM PENDIDIKAN
                                            GURU
                                            PENGGERAK </a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="{{ route('sekolah-penggerak') }}">PROGRAM SEKOLAH
                                            PENGGERAK</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="https://kurikulum.kemdikbud.go.id/kurikulum-merdeka/"
                                            target="_blank">IMPLEMENTASI
                                            KURIKULUM
                                            MERDEKA</a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="https://guru.kemdikbud.go.id/"
                                            target="_blank">PLATFORM MERDEKA
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
                                            <a class="menu-link" href="{{ $tautan->link_tautan }}"
                                                target="_blank">{{ $tautan->list_kategori->nama_kategori }}</a>
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
</nav>



                    {{--  @if (!empty($item->link_kategori))
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
                    @endif  --}}


                {{-- <li class="menu-item">
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
               --}}