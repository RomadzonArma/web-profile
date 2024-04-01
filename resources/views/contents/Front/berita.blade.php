{{-- BERITA --}}
@inject('carbon', 'Carbon\Carbon')
<div class="mb-3">
    <div class="heading-block border-bottom-0 d-flex justify-content-between">
        <h6 class="text-uppercase text-dark mb-0">BERITA TERKINI</h6>
        <a href="{{ route('berita') }}" class="arrow-rounded">
            <span class="d-sm-inline d-none">Selengkapnya</span>
            <div>
                <i class="icon-angle-right1"></i>
            </div>
        </a>
    </div>

    @foreach ($berita as $item)
        <div class="entry mb-lg-0 mb-md-4 mb-4">
            <div class="grid-inner row no-gutters p-0">
                <div class="entry-image col-xl-4">
                    <a href="{{ route('berita.detail', ['slug' => $item->slug]) }}">
                        <img src="{{ asset('/storage/uploads/list_berita/' . $item->gambar) }}" alt="thumbnail_berita">
                    </a>
                </div>
                <div class="col-xl-8 pl-xl-4">
                    <div class="entry-title title-xs text-clamp-2">
                        <h5 class="mb-1"><a href="{{ route('berita.detail', ['slug' => $item->slug]) }}">{{ $item->judul }}</a></h5>
                    </div>
                    <div class="entry-meta mb-2 mt-0">
                        <ul>
                            <li><a href="#"><i class="icon-calendar3"></i>
                                    {{ $carbon::parse($item->date)->format('d M Y') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
