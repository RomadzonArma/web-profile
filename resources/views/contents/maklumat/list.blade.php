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
                    @if (rbacCheck('maklumat', 2))
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
                                    <th>File</th>
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

    <div id="modal-maklumat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-maklumatLabel"
        aria-hidden="true">
        <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('maklumat.store') }}"  autocomplete="off"
            id="form-maklumat">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-bold">
                        <h4 class="modal-title mt-0" id="myModalLabel">Form Tambah maklumat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_sub_program">Judul maklumat</label>
                                    <input type="text" class="form-control" name="judul_maklumat" id="judul_maklumat"
                                        placeholder="Masukan Judul" Required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="jenis_inputan">Jenis Inputan</label>
                                    <select id="jenis_inputan" name="jenis" class="form-control">
                                        <option value="#">Pilih Jenis Inputan</option>
                                        <option value="foto">Upload Foto</option>
                                        <option value="pdf">Upload PDF</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- <div class="form-group row_link" style="display: none;">
                            <label for="konten">Link Web</label>
                            <input type="text" class="form-control" name="link" id="link"
                                placeholder="Masukan Link Youtube">
                        </div> --}}
                        <div class="form-group row_foto" style="display: none;">
                            <label for="foto_maklumat">Foto Maklumat</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image" name="image[]" accept=".jpg,.png" multiple >s
                                <label class="custom-file-label" for="customFile">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            <div id="foto_maklumat-preview" class="mt-3"></div>
                        </div>

                        <div class="form-group row_pdf" style="display: none;">
                            <label for="video">Upload Artikel PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="dokumen" id="dokumen"
                                    accept=".pdf*">
                                <label class="custom-file-label" for="video">Pilih PDF</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file yang diizinkan .PDF <b class="text-danger">Max 5.mb</b>
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="form_foto">Thumbnail maklumat</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="gambar" id="customFile"
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
    <div id="modal-maklumat-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-maklumat-updateLabel" aria-hidden="true">
        <form action="{{ route('maklumat.update') }}" method="post" id="form-maklumat-update" autocomplete="off"
            enctype="multipart/form-data">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-maklumat-updateLabel">Form Edit maklumat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Judul maklumat</label>
                                    <input type="text" class="form-control" name="judul_maklumat"
                                        id="update-judul_maklumat" placeholder="Masukan Judul" Required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_inputan">Jenis Inputan</label>
                                    <select id="jenis_inputan-edit" name="jenis" class="form-control">
                                        <option value="#">Pilih Jenis Inputan</option>
                                        <option value="foto">Upload Foto</option>
                                        <option value="pdf">Upload PDF</option>
                                    </select>
                                </div>

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

                        </div>
                        <div class="form-group row_foto" style="display: none;">
                            <label for="foto-maklumats">Foto Maklumat</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto_maklumat"
                                    id="update-foto_maklumat" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="UpdateFotomaklumat">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>

                        </div>
                        <div class="form-group">
                            <label for="tumb">Thumbnail maklumat</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="gambar" id="update-CustomFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="UpdatecustomFile">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pdf_preview">Thumbnail Preview</label>
                                        <div id="updateImagePreview" class="mt-3"></div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row_foto">
                                        <label for="foto preview">Foto Maklumat Preview</label>
                                        <div id="updatemaklumatPreview" class="mt-3"></div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row_pdf">
                                        <label for="pdf_preview">File PDF Preview</label>
                                        <iframe id="pdf_preview" width="100%" height="300px"
                                            style="border: 1px solid #ddd;"></iframe>
                                    </div>
                                </div>
                            </div>
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
        document.getElementById("foto_maklumat").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="foto_maklumat"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("foto_maklumat-preview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });
        document.getElementById("update-CustomFile").addEventListener("change", function() {
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
        document.getElementById("update-foto_maklumat").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="UpdateFotomaklumat"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("updatemaklumatPreview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });

        $('#modal-maklumat').on('hidden.bs.modal', function() {
            document.getElementById("ImagePreview");
            imagePreview.innerHTML = '';
        });
        $('#modal-maklumat-update').on('hidden.bs.modal', function() {
            var imagePreview = document.getElementById("updatemaklumatPreview");
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
    <script src="{{ asset('js/page/maklumat/list.js?q=' . Str::random(5)) }}"></script>
@endpush
