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
                    @if (rbacCheck('praktik_baik', 2))
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
                                    <th>Link Video</th>
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
    {{-- <div id="modal-praktik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-praktikLabel"
        aria-hidden="true">
        <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('praktik_baik.store') }}"
            id="form-praktik">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-bold">
                        <h4 class="modal-title mt-0" id="myModalLabel">Form Tambah Praktik Baik</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="judul">Judul praktik</label>
                            <input type="text" class="form-control" name="judul" id="judul"
                                placeholder="Masukan Judul" Required>
                        </div>

                        <div class="form-group">
                            <label for="jenis_inputan">Jenis Inputan</label>
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
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-success mb-3">
                                        <input type="radio" id="jenis_foto" name="jenis" class="custom-control-input"
                                            value="foto">
                                        <label class="custom-control-label" for="jenis_foto"> Upload Foto </label>
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
                        <div class="form-group row_foto" style="display: none;">
                            <label for="foto_praktik">Foto Praktik</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto_praktik" id="foto_praktik"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Cari Gambar</label>
                            </div>
                            <div id="foto_praktik-preview" class="mt-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">Upload Artikel PDF</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="file_pdf" id="file_pdf"
                                            accept=".pdf*">
                                        <label class="custom-file-label" for="video">Pilih PDF</label>
                                    </div>
                                    <small id="videoHelpBlock" class="form-text text-muted">
                                        Hanya file video yang diizinkan PDF
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customFile">Thumbnail Praktik</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="foto" id="customFile"
                                            accept=".jpg,.jpeg,.png" multiple>
                                        <label class="custom-file-label" for="customFile">Cari Gambar</label>
                                    </div>
                                    <div id="imagePreview" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Konten</label>
                            <textarea class="form-control" id="konten" name="konten" required></textarea>
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
    </div> --}}
    <!-- /.modal -->
    <!-- sample modal content -->
    <div id="modal-praktik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-praktikLabel"
        aria-hidden="true">
        <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('praktik_baik.store') }}"
            id="form-praktik">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-bold">
                        <h4 class="modal-title mt-0" id="myModalLabel">Form Edit Praktik Baik</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Judul praktik</label>
                                    <input type="text" class="form-control" name="judul" id="judul"
                                        placeholder="Masukan Judul" Required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="jenis_inputan">Jenis Inputan</label>
                                    <select id="jenis_inputan" name="jenis" class="form-control">
                                        <option value="#">Pilih Jenis Inputan</option>
                                        <option value="link">Link Video</option>
                                        <option value="video">Upload Video</option>
                                        <option value="foto">Upload Foto</option>
                                        <option value="pdf">Upload PDF</option>
                                    </select>
                                </div>

                            </div>
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
                                    Hanya file video yang diizinkan (.mp4, .avi, .mkv, dll.)  <b class="text-danger">Max 10.mb</b>
                                </small>
                            </div>

                        </div>
                        <div class="form-group row_foto" style="display: none;">
                            <label for="foto_praktik">Foto Praktik</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto_praktik" id="foto_praktik"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            <div id="foto_praktik-preview" class="mt-3"></div>
                        </div>

                        <div class="form-group row_pdf" style="display: none;">
                            <label for="video">Upload Artikel PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="file_pdf" id="file_pdf"
                                    accept=".pdf*">
                                <label class="custom-file-label" for="video">Pilih PDF</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file yang diizinkan .PDF <b class="text-danger">Max 5.mb</b>
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="form_foto">Thumbnail Praktik</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto" id="customFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="judul">Konten</label>
                            <textarea class="form-control" id="konten" name="konten" required></textarea>
                        </div> --}}
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
    <div id="modal-praktik-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-praktik-updateLabel" aria-hidden="true">
        <form action="{{ route('praktik_baik.update') }}" method="post" id="form-praktik-update" autocomplete="off"
            enctype="multipart/form-data">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-praktik-updateLabel">Form Praktik Baik</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Judul praktik</label>
                                    <input type="text" class="form-control" name="judul" id="update-judul"
                                        placeholder="Masukan Judul" Required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label for="jenis_inputan">Jenis Inputan</label>
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
                                        <li class="d-inline-block mr-2">
                                            <div class="custom-control custom-radio custom-radio-success mb-3">
                                                <input type="radio" id="jenis_foto" name="jenis" class="custom-control-input"
                                                    value="foto">
                                                <label class="custom-control-label" for="jenis_foto"> Upload Foto </label>
                                            </div>
                                        </li>

                                    </ul>
                                </div> --}}
                                <div class="form-group">
                                    <label for="jenis_inputan">Jenis Inputan</label>
                                    <select id="jenis_inputan-edit" name="jenis" class="form-control">
                                        <option value="#">Pilih Jenis Inputan</option>
                                        <option value="link">Link Video</option>
                                        <option value="video">Upload Video</option>
                                        <option value="foto">Upload Foto</option>
                                        <option value="pdf">Upload PDF</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- <div class="form-group">
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
                        </div> --}}
                        <div class="form-group row_link"style="display: none;">
                            <label for="update-konten">Link Video</label>
                            <input type="text" class="form-control" placeholder="Link Video" name="link_video"
                                id="update-link_video"></input>
                        </div>
                        <div class="form-group row_video" style="display: none;">
                            <div class="form-group">
                                <label for="video">Upload Video</label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="video" id="update-video"
                                        accept="video/*">
                                    <label class="custom-file-label" for="video">Pilih Video</label>
                                </div>
                                <small id="videoHelpBlock" class="form-text text-muted">
                                    Hanya file video yang diizinkan (.mp4, .avi, .mkv, dll.)  <b class="text-danger">Max 10.mb</b>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row_pdf" style="display: none;">
                            <label for="video">Upload PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="file_pdf" id="update-file_pdf"
                                    accept=".pdf">
                                <label class="custom-file-label" for="video">Pilih PDF</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file yang diizinkan .PDF <b class="text-danger">Max 5.mb</b>
                            </small>
                            <div class="form-group">
                                <label for="pdf_preview">File PDF Preview</label>
                                <iframe id="pdf_preview" width="100%" height="300px"
                                    style="border: 1px solid #ddd;"></iframe>
                            </div>
                        </div>
                        <div class="form-group row_foto" style="display: none;">
                            <label for="foto_praktik-update">Foto Praktik</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto_praktik"
                                    id="update-foto_praktik" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="updateCustomFile">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            <div id="updatepraktikPreview" class="mt-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="form_foto">Thumbnail Praktik</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto" id="update-CustomFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="updateCustomFile">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            <div id="updateImagePreview" class="mt-3"></div>
                            <div id="foto"></div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="judul">Konten</label>
                            <textarea class="form-control" id="update-konten" name="konten"></textarea>
                        </div> --}}
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
        document.getElementById("foto_praktik").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="foto_praktik"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("foto_praktik-preview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });
        document.getElementById("updateCustomFile").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="UpdatecustomFile"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("updateImagePreview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });

        $('#modal-praktik').on('hidden.bs.modal', function() {
            document.getElementById("ImagePreview");
            imagePreview.innerHTML = '';
        });
        $('#modal-praktik-update').on('hidden.bs.modal', function() {
            var imagePreview = document.getElementById("updateImagePreview");
            imagePreview.innerHTML = '';
        });
        $(document).ready(function() {
            $('#konten').summernote();
        });

        $(document).ready(function() {
            $('#id_kategori').select2();
        });

        $(document).ready(function() {
            $('#update-id_kategori').select2();
        });

        $(document).ready(function() {
            $('#update-konten').summernote({
                height: 300,
                color: 'black',
            });
        });
    </script>
    <script src="{{ asset('js/page/praktik/list.js?q=' . Str::random(5)) }}"></script>
@endpush
