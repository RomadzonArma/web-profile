@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('berprestasi', 2))
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
    <div id="modal-berprestasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-berprestasiLabel"
        aria-hidden="true">
        <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('berprestasi.store') }}"
            id="form-berprestasi">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-bold">
                        <h4 class="modal-title mt-0" id="myModalLabel">Form KSPSTK Berprestasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <textarea class="form-control" placeholder="Judul" name="judul" id="judul" required
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9!%.,()\/'?\-\s]/g, '').replace(/(\..*?)\..*/g, '$1');"></textarea>
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

                        <div class="form-group row_foto" style="display: none;">
                            <label for="foto_praktik">Foto Praktik</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto_praktik" id="foto_praktik"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="foto_praktik">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            <div id="foto_praktik-preview" class="mt-3"></div>
                        </div>

                        <div class="form-group row_link"style="display: none;">
                            <label for="update-konten">Link Video</label>
                            <input type="text" class="form-control" placeholder="Link Youtube" name="link"
                                id="link"></input>
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
                                    Hanya file video yang diizinkan (.mp4, .avi, .mkv, dll.) <b class="text-danger">Max
                                        10.mb</b>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row_pdf" style="display: none;">
                            <label for="video">Upload PDF</label>
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
                            <label for="form_foto">Thumbanil</label>
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
    <div id="modal-berprestasi-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-berprestasi-updateLabel" aria-hidden="true">
        <form action="{{ route('berprestasi.update') }}" method="post" id="form-berprestasi-update" autocomplete="off"
            enctype="multipart/form-data">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-berprestasi-updateLabel">Form KSPSTK Berprestasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="update-judul">Judul</label>
                                    <textarea class="form-control" placeholder="Judul" name="judul" id="update-judul"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9!%.,()\/'?\-\s]/g, '').replace(/(\..*?)\..*/g, '$1');"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <input type="text" class="form-control" placeholder="Link Youtube" name="link"
                                id="update-link"></input>
                        </div>
                        <div class="form-group row_video" style="display: none;">
                            <div class="form-group">
                                <label for="video">Upload Video</label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="video" id="video_edit"
                                        accept="video/*">
                                    <label class="custom-file-label" for="video">Pilih Video</label>
                                </div>
                                <small id="videoHelpBlock" class="form-text text-muted">
                                    Hanya file video yang diizinkan (.mp4, .avi, .mkv, dll.).
                                </small>
                            </div>

                        </div>
                        <div class="form-group  row_pdf" style="display: none;">
                            <label for="video">Upload PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="file_pdf" id="update-file_pdf"
                                    accept=".pdf">
                                <label class="custom-file-label" for="video">Pilih PDF</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan PDF <b class="text-danger">Max 5.mb</b>
                            </small>
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
                            <label for="updateCustomFile">Thumbnail</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="foto" id="updateCustomFile"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="updateCustomFile">Cari Gambar</label>
                            </div>
                            <div id="updateImagePreview" class="mt-3"></div>
                            <div id="foto"></div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="imagePreview" class="mt-2"></div>
                                </div>
                            </div>
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


        $('#modal-berprestasi').on('hidden.bs.modal', function() {
            document.getElementById("ImagePreview");
            imagePreview.innerHTML = '';
        });
        $('#modal-berprestasi-update').on('hidden.bs.modal', function() {
            var imagePreview = document.getElementById("updateImagePreview");
            imagePreview.innerHTML = '';
        });
    </script>
    <script src="{{ asset('js/page/berprestasi/list.js?q=' . Str::random(5)) }}"></script>
@endpush
