@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('swiper', 2))
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-rounded waves-effect waves-light btn-tambah text-white"
                                style="background-color: #E59537;"><i class="bx bx-plus-circle mr-1"></i> Tambah
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th>Link Youtube</th>
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
                            <label for="link">Link Youtube</label>
                            <textarea class="form-control" placeholder="Link Youtube" name="link" id="link"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="form_foto">Gambar Swiper</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto" id="customFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Cari Gambar</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
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
        <form action="{{ route('swiper.update') }}" method="post" id="form-swiper-update" autocomplete="off"
            enctype="multipart/form-data">
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
                            <label for="update-link">Link Youtube</label>
                            <textarea class="form-control" placeholder="Link Youtube" name="link" id="update-link"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="updateCustomFile">Gambar Swiper</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto" id="updateCustomFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="updateCustomFile">Cari Gambar</label>
                            </div>
                            <div id="updateImagePreview" class="mt-3"></div>
                            <div id="foto"></div>
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
    <script>
        document.getElementById("customFile").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="customFile"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("imagePreview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });
    </script>
    <script>
        document.getElementById("updateCustomFile").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="customFile"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("updateImagePreview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });
        $('#modal-swiper-update').on('hidden.bs.modal', function() {
            var imagePreview = document.getElementById("updateImagePreview");
            imagePreview.innerHTML = '';
        });
    </script>
    <script src="{{ asset('js/page/swiper/list.js?q=' . Str::random(5)) }}"></script>
@endpush
