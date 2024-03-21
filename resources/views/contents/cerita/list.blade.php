@extends('layouts.app')

@php
    $plugins = ['datatable', 'editor', 'swal', 'select2'];
@endphp
@push('styles')
    <style>
        .clamp-2-lines {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2;
        }
    </style>
@endpush
@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('cerita', 2))
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
                                    <th>Isi cerita</th>
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
    <div id="modal-cerita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-ceritaLabel"
        aria-hidden="true">
        <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('cerita.store') }}"
            id="form-cerita">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-bold">
                        <h4 class="modal-title mt-0" id="myModalLabel">Form Cerita Praktik Baik</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul cerita</label>
                            <textarea class="form-control" placeholder="Judul cerita" name="judul" id="judul"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9!%.,()\/'?\-\s]/g, '').replace(/(\..*?)\..*/g, '$1');"></textarea>
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 0px;">
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-primary mb-3">
                                        <input type="radio" id="jenis_link" name="jenis" class="custom-control-input"
                                            value="link">
                                        <label class="custom-control-label" for="jenis_link"> Link Video </label>
                                    </div>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-success mb-3">
                                        <input type="radio" id="jenis_video" name="jenis" class="custom-control-input"
                                            value="video">
                                        <label class="custom-control-label" for="jenis_video"> Upload Video </label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="form-group row_link" style="display: none;">
                            <label for="konten">Link Video</label>
                            <input type="text" class="form-control" name="link_video" id="link_video"
                                placeholder="Masukan Link Youtube">
                        </div>
                        <div class="form-group row_video" style="display: none;">
                            <div class="form-group">
                                <label for="video">Upload Video</label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="video" id="video"
                                        accept="video/*">
                                    <label class="custom-file-label" for="video">Pilih Video</label>
                                </div>
                                <small id="videoHelpBlock" class="form-text text-muted">
                                    Hanya file video yang diizinkan (.mp4, .avi, .mkv, dll.).
                                </small>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="form_foto">Gambar cerita</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto" id="customFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Cari Gambar</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="konten">Isi</label>
                            <textarea class="form-control" placeholder="Isi Cerita" name="konten" id="konten"></textarea>
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
    <div id="modal-cerita-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-cerita-updateLabel" aria-hidden="true">
        <form action="{{ route('cerita.update') }}" method="post" id="form-cerita-update" autocomplete="off"
            enctype="multipart/form-data">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-cerita-updateLabel">Form Cerita Praktik Baik</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update-judul">Judul cerita</label>
                            <textarea class="form-control" placeholder="Judul cerita" name="judul" id="update-judul"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9!%.,()\/'?\-\s]/g, '').replace(/(\..*?)\..*/g, '$1');"></textarea>
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 0px;">
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-primary mb-3">
                                        <input type="radio" id="jenis_link_edit" name="jenis"
                                            class="custom-control-input" value="link">
                                        <label class="custom-control-label" for="jenis_link"> Link </label>
                                    </div>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-success mb-3">
                                        <input type="radio" id="jenis_video_edit" name="jenis"
                                            class="custom-control-input" value="video">
                                        <label class="custom-control-label" for="jenis_video"> Upload Video </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group row_link"style="display: none;">
                            <label for="update-konten">Link Video</label>
                            <input type="text" class="form-control" placeholder="Link Video" name="link_video"
                                id="update-link_video"></input>
                        </div>
                        <div class="form-group row_video" style="display: none;">
                            <div class="form-group">
                                <label for="video">Upload Video</label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="video" id="video-update"
                                        accept="video/*">
                                    <label class="custom-file-label" for="video">Pilih Video</label>
                                </div>
                                <small id="videoHelpBlock" class="form-text text-muted">
                                    Hanya file video yang diizinkan (.mp4, .avi, .mkv, dll.).
                                </small>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="updateCustomFile">Gambar cerita</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto" id="updateCustomFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="updateCustomFile">Cari Gambar</label>
                            </div>
                            <div id="updateImagePreview" class="mt-3"></div>
                            <div id="foto"></div>
                        </div>
                        <div class="form-group">
                            <label for="update-konten">Isi</label>
                            <textarea class="form-control" placeholder="Isi" name="konten" id="update-konten"></textarea>
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
        $('#modal-cerita').on('hidden.bs.modal', function() {
            document.getElementById("ImagePreview");
            imagePreview.innerHTML = '';
        });
        $('#modal-cerita-update').on('hidden.bs.modal', function() {
            var imagePreview = document.getElementById("updateImagePreview");
            imagePreview.innerHTML = '';
        });
        $(document).ready(function() {
            $('#update-konten').summernote({
                height: 300,
                color: 'black',
            });
        });
        $(document).ready(function() {
            $('#konten').summernote();
        });
      z
    </script>
    <script src="{{ asset('js/page/cerita/list.js?q=' . Str::random(5)) }}"></script>
@endpush
