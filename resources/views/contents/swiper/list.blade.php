@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (rbacCheck('swiper', 2))
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="text-sm-right">
                                    <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light btn-tambah"><i
                                            class="bx bx-plus-circle mr-1"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th>Status Keaktifan</th>
                                    <th>Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="modal-swiper" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-swiperLabel"
        aria-hidden="true">
        <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('swiper.store') }}"
            id="form-swiper">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary-bold">
                        <h4 class="modal-title mt-0" id="myModalLabel">Form Swiper</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul Swiper</label>
                            <textarea class="form-control" placeholder="Judul Swiper" name="judul" id="judul"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9!%.,()\/'?\-\s]/g, '').replace(/(\..*?)\..*/g, '$1');"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="form_foto">Foto Swiper<font color="red">*Ukuran 1422 x 320 px</font></label>
                            <input type="file" accept=".png,.jpg,.jpeg,.jfif" class="form-control" name="foto"
                                id="form_foto">
                            <font color="red">*Gambar (PNG, JPG, JPEG, JFIF) Max 10MB</font>
                            <div id="foto"></div>
                            <div id="file-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal -->

    <!-- sample modal content -->
    <div id="modal-swiper-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-swiper-updateLabel" aria-hidden="true">
        <form action="{{ route('swiper.update') }}" method="post" id="form-swiper-update" autocomplete="off" enctype="multipart/form-data">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-swiper-updateLabel">Form Swiper</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update-judul">Judul Swiper</label>
                            <textarea class="form-control" placeholder="Judul Swiper" name="judul" id="update-judul"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9!%.,()\/'?\-\s]/g, '').replace(/(\..*?)\..*/g, '$1');"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="udpdate-form_foto">Foto Swiper<font color="red">*Ukuran 1422 x 320 px</font></label>
                            <input type="file" accept=".png,.jpg,.jpeg,.jfif" class="form-control" name="foto"
                                id="udpdate-form_foto">
                            <font color="red">*Gambar (PNG, JPG, JPEG, JFIF) Max 10MB</font>
                            <div id="foto"></div>
                            <div id="file-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script src="{{ asset('js/page/swiper/list.js?q=' . Str::random(5)) }}"></script>
@endpush
