@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('manajemen_panduan', 2))
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
    <div id="modal-panduan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-panduanLabel"
        aria-hidden="true">
        <form action="{{ route('manajemen_panduan.store') }}" method="post" id="form-panduan" enctype="multipart/form-data"
            autocomplete="off">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-panduanLabel">Form Tambah panduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group ">
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
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="judul">Deskripsi Singkat</label>
                            <textarea class="form-control" id="konten" name="konten" required></textarea>
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
                                <input type="file" class="custom-file-input" id="file_pdf" name="file_pdf"
                                    accept=".PDF">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format PDF max 3.mb )
                                </div>

                            </div>

                        </div>
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
    <div id="modal-update-panduan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-update-menuLabel"
        aria-hidden="true">
        <form action="{{ route('manajemen_panduan.update') }}" method="post" id="form-update-panduan" autocomplete="off">
            <input type="hidden" name="id" id="update-id">
            @method('PATCH')
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-update-panduanLabel">Form panduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group ">
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
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul_edit" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="judul">Deskripsi Singkat</label>
                            <textarea class="form-control" id="konten_edit" name="konten"></textarea>
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
                            <label for="file">File PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="file_pdf_edit" name="file_pdf"
                                    accept=".pdf ">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format PDF max 3.mb )
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pdf_preview">File PDF Preview</label>
                            <iframe id="pdf_preview" width="100%" height="500px"
                                style="border: 1px solid #ddd;"></iframe>
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
        function preview(selector, temporaryFile, width = 200) {
            $(selector).empty();

            if (temporaryFile.type.startsWith('image/')) {
                $(selector).append(`<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`);
            } else {
                // Handle non-image file types (e.g., show a placeholder or a different preview)
                $(selector).text('File preview not available for non-image types.');
            }
        }

        function previewPdf(input) {
            var pdfPreview = document.getElementById('pdf_preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    pdfPreview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById('file_pdf_edit').addEventListener('change', function() {
            previewPdf(this);
        });
    </script>

    <script src="{{ asset('js/page/Panduan/list.js?q=' . Str::random(5)) }}"></script>
@endpush
