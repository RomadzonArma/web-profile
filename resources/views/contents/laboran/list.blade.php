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

        .custom-file-label {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        #foto_laboran-preview {
            display: flex;
            flex-wrap: wrap;
        }

        #foto_laboran-preview img {
            margin-right: 10px;
            margin-bottom: 10px;
            max-height: 200px;
        }
    </style>
@endpush
@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('laboran', 2))
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
                                    <th>Foto Laboran</th>
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

    <div id="modal-laboran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-laboranLabel"
        aria-hidden="true">
        <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('laboran.store') }}"
            autocomplete="off" id="form-laboran">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-bold">
                        <h4 class="modal-title mt-0" id="myModalLabel">Form Tambah Laboran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_sub_program">Judul laboran*</label>
                                    <input type="text" class="form-control" name="judul" id="judul"
                                        placeholder="Masukan Judul" Required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="jenis_inputan">Jenis Inputan*</label>
                                    <select id="jenis_inputan" name="jenis" class="form-control">
                                        <option value="#">Pilih Jenis Inputan</option>
                                        <option value="foto">Upload Foto</option>
                                        <option value="pdf">Upload PDF</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row_foto" style="display: none;">
                            <label for="foto">Foto laboran</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="foto_laboran" name="image[]"
                                    accept=".jpg,.png" multiple>
                                <label class="custom-file-label" for="foto_laboran">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            <div id="foto_laboran-preview" class="mt-3"></div>
                        </div>

                        <div class="form-group row_pdf" style="display: none;">
                            <label for="video">Upload Artikel PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="file_pdf" id="file_pdf"
                                    accept=".pdf*" multiple>
                                <label class="custom-file-label" for="video">Pilih PDF</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file yang diizinkan .PDF <b class="text-danger">Max 5.mb</b>
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="form_foto">Thumbnail laboran*</label>
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
                        <div class="form-group">
                            <label for="judul">Konten</label>
                            <textarea class="form-control" id="konten" name="konten"></textarea>
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
    <div id="modal-laboran-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-laboran-updateLabel" aria-hidden="true">
        <form action="{{ route('laboran.update') }}" method="post" id="form-laboran-update" autocomplete="off"
            enctype="multipart/form-data">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-laboran-updateLabel">Form Edit Laboran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Judul laboran</label>
                                    <input type="text" class="form-control" name="judul" id="update-judul"
                                        placeholder="Masukan Judul" Required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_inputan">Jenis Inputan*</label>
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
                            <label for="foto-laboran">Foto laboran</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="image[]" accept=".jpg,.png"
                                    multiple id="update-foto_laboran">
                                <label class="custom-file-label" for="UpdateFotolaboran">Cari Gambar</label>
                            </div>
                            <small id="videoHelpBlock" class="form-text text-muted">
                                Hanya file video yang diizinkan (.jpg, .jpeg, .png) <b class="text-danger">Max 2.mb</b>
                            </small>
                            {{-- <label for="preview_image">Foto laboran Preview</label> --}}
                            <div id="updatelaboranPreview"></div>
                        </div>
                        <div class="form-group">
                            <label for="tumb">Thumbnail laboran*</label>
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
                                        <div id="updateImagePreview"></div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row_foto">

                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Konten</label>
                            <textarea class="form-control" id="update-konten" name="konten"></textarea>
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


    <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gambar Laboran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
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
                    '" class="img-fluid" style="height:150px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });

        document.getElementById("foto_laboran").addEventListener("change", function() {
            var files = this.files;
            var fileLabel = document.querySelector('label[for="foto_laboran"]');
            var imagePreview = document.getElementById("foto_laboran-preview");
            imagePreview.innerHTML = ''; // Clear the preview before adding new images

            // Reset label text
            fileLabel.innerHTML = 'Cari Gambar';

            for (var i = 0; i < files.length; i++) {
                fileLabel.innerHTML += files[i].name + ', '; // Append file names to label
                var reader = new FileReader();
                reader.onload = (function(file) {
                    return function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = "img-fluid";
                        img.style.height = "150px";
                        img.style.width = "auto";
                        img.alt = "Selected Image";
                        imagePreview.appendChild(img); // Append image to preview
                    };
                })(files[i]);
                reader.readAsDataURL(files[i]);
            }
        });

        document.getElementById("update-CustomFile").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="UpdatecustomFile"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("updateImagePreview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:150px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });

        document.getElementById("update-foto_laboran").addEventListener("change", function() {
            var files = this.files;
            var fileLabel = document.querySelector('label[for="UpdateFotolaboran"]');
            var imagePreview = document.getElementById("updatelaboranPreview");
            imagePreview.innerHTML = ''; // Clear previous previews

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                fileLabel.innerHTML = file.name;

                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML += '<img src="' + e.target.result +
                        '" class="img-fluid" style="height:100px;width:auto;margin-right:5px;margin-top:5px;" alt="Selected Image">';
                };
                reader.readAsDataURL(file);
            }
        });


        $('#modal-laboran').on('hidden.bs.modal', function() {
            var imagePreview = document.getElementById("imagePreview");
            imagePreview.innerHTML = '';
        });

        $('#modal-laboran-update').on('hidden.bs.modal', function() {
            var imagePreview = document.getElementById("updatelaboranPreview");
            imagePreview.innerHTML = '';
        });

        // $('#table-data').on('click', '.btn-detail', function () {
        //     var idLaboran = $(this).closest('tr');
        //  // Adjust this based on the structure of your table
        //     $.ajax({
        //         url: BASE_URL + "get-images/" + idLaboran,
        //         type: "GET",
        //         dataType: "json",
        //         success: function(response) {
        //             if(response.status) {
        //                 var images = response.images;
        //                 if(images.length > 0) {
        //                     // Display the first image in the modal
        //                     var imageUrl = BASE_URL + images[0]; // Assuming images[0] is the first image URL
        //                     $('#gambarLaboran').attr('src', imageUrl);
        //                     $('#gambarModal').modal('show');
        //                 } else {
        //                     alert('No images found for this laboran.');
        //                 }
        //             } else {
        //                 alert('Failed to retrieve images: ' + response.msg);
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error:', error);
        //             alert('Failed to retrieve images. Please try again later.');
        //         }
        //     });
        // });


        $('#id_kategori').select2();
        $('#update-id_kategori').select2();
    </script>
    <script src="{{ asset('js/page/laboran/list.js?q=' . Str::random(5)) }}"></script>
@endpush
