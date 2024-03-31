@inject('carbon', 'Carbon\Carbon')
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @include('layouts.front.css')
    <!-- Document Title ============================================= -->
    <title>KSPSTENDIK Kemdikbud | 2024</title>

</head>

<body class="stretched">
    <div id="wrapper" class="clearfix">

        @include('layouts.front.header_mobile')

        @yield('content-header')

        @include('layouts.front.header')

        @yield('content')


        @include('layouts.front.footer')

    </div>

    <a href="javascript:void(0)" id="faq">
        <div class="position-relative">
            <i class="icon-line-phone"></i>
            <h6 class="text-white mb-0">INFO KSPS</h6>
        </div>
    </a>
    <div class="faq-wrapper">
        <div class="position-relative d-flex justify-content-between">
            <h5 class="text-primary mb-2">QnA!</h5>
            <img src="{{ asset('assets-front/img/faqq.png') }}" width="140" class="faq img-fluid">
        </div>
        {{-- <img src="{{ asset('assets-front/img/ksps_faq.png') }}" alt="faq" class="img-fluid"> --}}
        {{-- <form class="mb-0 w-100" action="{{ route('faq.store') }}" method="post" name="form-store" id="form-store">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" id="nama" name="nama"  placeholder="Nama ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" name="email"  placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="pertanyaan" name="pertanyaan"  placeholder="Tulis pertanyaan anda...">
            </div>
            <button  type="submit" class="btn btn-primary btn-simpan w-100">Kirim</button>
        </form> --}}
        <form action="{{ route('faq.store') }}"  method="post" name="form-store" id="form-store"  class="w-100 mb-0">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <select class="form-control" id="id_kategori_faq" name="id_kategori_faq" data-placeholder="Pilih Kategori">
                        <option>Pilih Kategori</option>
                        <option disabled>Kategori</option>
                        @foreach ( $kategori_faq as $data )
                            <option value="{{$data->id}}">{{$data->nama_kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <select class="form-control"  id="id_keperluan_faq" name="id_keperluan_faq" data-placeholder="Pilih Keperluan">
                        <option>Pilih Keperluan</option>
                        <option disabled>Keperluan</option>
                        @foreach ( $keperluan_faq as $item )
                            <option value="{{$item->id}}">{{$item->nama_keperluan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control" id="nama" name="nama"  placeholder="Nama Lengkap">
                </div>
                <div class="form-group col-12">
                    <input type="email" class="form-control" id="email" name="email"  placeholder="Email anda">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="nip" name="nip"  placeholder="NIP/NIK">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="instansi" name="instansi"  placeholder="Instansi">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="jabatan" name="jabatan"  placeholder="Jabatan">
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp"  placeholder="Nomor HP">
                </div>
                <div class="form-group col-12">
                    <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3" style="height: 86px;" placeholder="Isi pertanyaan anda"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-simpan w-100">Kirim</button>
        </form>
    </div>

    <div class="modal fade" id="podcast" tabindex="-1" role="dialog" aria-labelledby="Podcast" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Podcast KSPSTK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body py-0 my-3">
                    @foreach ($podcast as $podcast)
                        <div class="entry mb-4">
                            <div class="grid-inner row no-gutters p-0">
                                <div class="entry-image col-3">
                                    <a href="{{$podcast->link_podcast}}">
                                        <img src="{{ asset('podcast/' . $podcast->gambar) }}" alt="thumbnail_podcast">
                                    </a>
                                </div>
                                <div class="col-9 pl-3">
                                    <div class="entry-title title-md text-clamp-2">
                                        <h6 class="mb-1"><a href="{{$podcast->link_podcast}}">{{ $podcast->judul }}</a></h6>
                                    </div>
                                    <div class="entry-meta mb-2 mt-0">
                                        <ul>
                                            <li><a href="#"><i class="icon-users"></i> {{$podcast->jumlah_lihat ?? 0}} penonton</a>
                                            <li><a href="#"><i
                                                        class="icon-calendar3"></i>{{ $podcast->date }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="text-muted text-clamp-3 mb-0">{{ $podcast->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('layouts.front.js')

</body>

</html>
