{{-- PETA PERSEBARAN --}}
<div class="mb-3">
    <div class="heading-block line-bottom border-bottom-0">
        <h6 class="text-uppercase text-dark">PETA PERSEBARAN</h6>
        <div></div>
    </div>
    <div class="row tab-custom">
        <div class="col-lg-9 col-12 order-2 order-lg-1">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="kepala-sekolah" role="tabpanel"
                    aria-labelledby="list-kepala-sekolah">
                    <div id="peta-persebaran">
                        <script src="{{ asset('assets-front/js/geo-indonesia.json') }}"></script>
                    </div>
                </div>
                <div class="tab-pane fade" id="pengawas-sekolah" role="tabpanel"
                    aria-labelledby="list-pengawas-sekolah">
                    <div id="peta-pengawas">
                        <script src="{{ asset('assets-front/js/geo-indonesia.json') }}"></script>
                    </div>
                </div>
                <div class="tab-pane fade" id="tas" role="tabpanel"
                    aria-labelledby="list-tas">
                    <div id="peta-tas">
                        <script src="{{ asset('assets-front/js/geo-indonesia.json') }}"></script>
                    </div>
                </div>
                <div class="tab-pane fade" id="laboran" role="tabpanel"
                    aria-labelledby="list-laboran">
                    <div id="peta-laboran">
                        <script src="{{ asset('assets-front/js/geo-indonesia.json') }}"></script>
                    </div>
                </div>
                <div class="tab-pane fade" id="perpustakaan" role="tabpanel"
                    aria-labelledby="list-perpustakaan">
                    <div id="peta-perpustakaan">
                        <script src="{{ asset('assets-front/js/geo-indonesia.json') }}"></script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 order-1 order-lg-2 mb-lg-0 mb-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-kepala-sekolah"
                    data-toggle="list" href="#kepala-sekolah" role="tab"
                    aria-controls="kepala-sekolah">Kepala Sekolah</a>
                <a class="list-group-item list-group-item-action" id="list-pengawas-sekolah"
                    data-toggle="list" href="#pengawas-sekolah" role="tab"
                    aria-controls="pengawas-sekolah">Pengawas Sekolah</a>
                <a class="list-group-item list-group-item-action" id="list-tas"
                    data-toggle="list" href="#tas" role="tab" aria-controls="tas">Tas</a>
                <a class="list-group-item list-group-item-action" id="list-laboran"
                    data-toggle="list" href="#laboran" role="tab"
                    aria-controls="laboran">Laboran</a>
                <a class="list-group-item list-group-item-action" id="list-perpustakaan"
                    data-toggle="list" href="#perpustakaan" role="tab"
                    aria-controls="perpustakaan">Perpustakaan</a>
            </div>
        </div>
    </div>
</div>
{{-- END PETA PERSEBARAN --}}
