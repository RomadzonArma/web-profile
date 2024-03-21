@extends('layouts.app')

@php
    $plugins = ['datatable', 'editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('manajemen_renstra', 2))
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
                                    <th>Jumlah Dilihat</th>
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
    <div id="modal-renstra" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-renstraLabel"
        aria-hidden="true">
        <form action="{{ route('manajemen_renstra.store') }}" method="post" id="form-renstra" enctype="multipart/form-data"
            autocomplete="off">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-renstraLabel">Form Tambah Renstra</h5>
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
                                        <select class="form-control" style="width: 100%" id="id_kategori"
                                            name="id_kategori">
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
                                    <input type="text" class="form-control" id="judul" name="judul">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Tag</label>
                                    <input type="text" class="form-control" id="tag" name="tag">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Link</label>
                                    <input type="text" class="form-control" id="link" name="link">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file">Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="gambar"
                                    onchange="preview('.gambar', this.files[0])" name="gambar" accept=".jpg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format image .jpeg, .jpg, & .png max .5 mb )
                                </div>
                            </div>
                            <div id="image_preview">
                                <div id="gambar" class="gambar">

                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="file">File PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="file" name="file"
                                    accept=".PDF">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format PDF max 3.mb )
                                </div>

                            </div>

                        </div>
                        {{-- <div class="form-group">
                            <label for="judul">Konten</label>
                            <textarea class="form-control" id="konten" name="konten" required></textarea>
                        </div> --}}


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-simpan">Simpan </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal -->
    <!-- sample modal content -->
    <div id="modal-update-renstra" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-renstraLabel" aria-hidden="true">
        <form action="{{ route('manajemen_renstra.update') }}" method="post" id="form-update-renstra"
            autocomplete="off">
            <input type="hidden" name="id" id="update-id">
            @method('PATCH')
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-update-renstraLabel">Form Renstra</h5>
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
                                        <select class="form-control" style="width: 100%" id="update-id_kategori"
                                            name="id_kategori">
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
                            <label for="file">Cover</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="gambar_edit" name="gambar"
                                    accept=".jpg,.png" onchange="preview('.cover', this.files[0])">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format image .jpeg, .jpg, & .png )
                                </div>

                            </div>
                            <div class="cover" id="gambar-preview"></div>

                        </div>

                        <div class="form-group">
                            <label for="judul">Konten</label>
                            <textarea class="form-control" id="konten_edit" name="konten"></textarea>
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
            $('#konten').summernote();
        });

        $(document).ready(function() {
            $('#id_kategori').select2();
        });

        $(document).ready(function() {
            $('#update-id_kategori').select2();
        });

        $(document).ready(function() {
            $('#konten_edit').summernote({
                height: 300,
                color: 'black',
            });
        });

        function preview(selector, temporaryFile, width = 200) {
            $(selector).empty();

            if (temporaryFile.type.startsWith('image/')) {
                $(selector).append(`<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`);
            } else {
                $(selector).text('File preview not available for non-image types.');
            }
        }
    </script>
    <script src="{{ asset('js/page/renstra/list.js?q=' . Str::random(5)) }}"></script>
@endpush
