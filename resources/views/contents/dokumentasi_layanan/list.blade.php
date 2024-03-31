@extends('layouts.app')

@php
    $plugins = ['datatable', 'editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('dokumentasi_layanan', 2))
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-rounded waves-effect waves-light btn-tambah text-white"
                                style="background-color: #E59537;"><i class="bx bx-plus-circle mr-1"></i>
                                Tambah
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Kanal</th>
                                    <th>Kategori</th>
                                    <th>Judul</th>
                                    {{-- <th>Jumlah Dilihat</th> --}}
                                    <th>Video</th>
                                    <th>Foto</th>
                                    <th>Status Publish</th>
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
    <div id="modal-galeri" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-galeriLabel"
        aria-hidden="true">
        <form action="{{ route('dokumentasi_layanan.store') }}" method="post" id="form-galeri" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-galeriLabel">Form Tambah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Kategori</label>
                                    <div class="">
                                        <select class="form-control" id="id_kategori" name="id_kategori">
                                            <option>Pilih kategori</option>
                                            @foreach ($kategori as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"  placeholder="Masukkan Judul" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Tag</label>
                                    <input type="text" class="form-control" id="tag" name="tag"  placeholder="Masukkan url video" >
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Link Video</label>
                                    <input type="text" class="form-control" id="link" name="link">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox custom-control-right">
                                    <input type="checkbox" class="custom-control-input" id="status_video" name="status_video">
                                    <label class="custom-control-label" for="status_video">Url Video</label>
                                </div>
                                <div class="form-group mt-2" id="url_video_container" style="display: none;">
                                    <input type="text" name="link" id="link" class="form-control" placeholder="Masukkan url video" >
                                    <div id="error-url_video"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="images">Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image" onchange="preview('.image', this.files)" name="image[]" accept=".jpg,.png" multiple >
                                <label class="custom-file-label" for="images">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: italic; margin-top: 5px; margin-bottom: 5px; text-align: left;" class="text-danger">
                                    (Format image .jpeg, .jpg, & .png max .5 mb)
                                </div>
                            </div>
                            <div id="image_preview">
                                <div id="image" class="image"></div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="judul">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-simpan">Simpan
                            </button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal -->
    <!-- sample modal content -->
    <div id="modal-update" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="modal-update-galeriLabel" aria-hidden="true">
    <form action="{{ route('dokumentasi_layanan.update') }}" method="post" id="form-update-galeri" autocomplete="off">
        <input type="hidden" name="id" id="update-id">
        @method('PATCH')
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="modal-update-galeriLabel">Form Edit Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Kategori</label>
                                <div class="">
                                    <select class="form-control" id="update-id_kategori" name="id_kategori">
                                        <option>Pilih kategori</option>
                                        @foreach ($kategori as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul_edit" name="judul">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul">Tag</label>
                                <input type="text" class="form-control" id="tag_edit" name="tag">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul">Link</label>
                                <input type="text" class="form-control" id="link_edit" name="link">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="images">Gambar</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="image_edit" onchange="preview('.image', this.files)" name="image[]" accept=".jpg,.png" multiple >
                            <label class="custom-file-label" for="images">Choose file</label>
                            <div style="font-size: 11px; line-height: 13px; font-style: italic; margin-top: 5px; margin-bottom: 5px; text-align: left;" class="text-danger">
                                (Format image .jpeg, .jpg, & .png max .5 mb)
                            </div>
                        </div>
                        <div id="image_preview">
                            <div id="image" class="image"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_edit" name="deskripsi"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#deskripsi').summernote();
        });
        $(document).ready(function() {
            $('#deskripsi_edit').summernote({
                height: 300,
                color: 'black',
            });
        });

        function preview(container, files) {
        var previewContainer = $(container);
        previewContainer.empty();

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {
                previewContainer.append('<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 100px; max-height: 100px; margin-right: 5px;">');
            };

            reader.readAsDataURL(files[i]);
        }
    }
    </script>
    <script src="{{ asset('js/page/dokumentasi_layanan/list.js?q=' . Str::random(5)) }}"></script>
@endpush
