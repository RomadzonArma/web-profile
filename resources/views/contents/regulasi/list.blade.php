@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (rbacCheck('regulasi', 2))
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
                                    <th style="width: 5%;">No</th>
                                    <th>Kanal</th>
                                    <th>Kategori</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Download</th>
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
    <div id="modal-regulasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-regulasiLabel"
        aria-hidden="true">
        <form action="{{ route('regulasi.store') }}" method="post" id="form-regulasi" enctype="multipart/form-data"
            autocomplete="off">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-regulasiLabel">Form Regulasi</h5>
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
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="file">Cover</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="cover" onchange="preview('.cover', this.files[0])" name="cover"
                                    accept=".jpg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format image .jpeg, .jpg, & .png max .5 mb )
                                </div>
                            </div>
                            <div id="image_preview">
                                <div id="cover" class="cover">

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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-simpan">Simpan </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal -->
    <!-- sample modal content -->
    <div id="modal-update-regulasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-update-menuLabel"
        aria-hidden="true">
        <form action="{{ route('regulasi.update') }}" method="post" id="form-update-regulasi" autocomplete="off">
            <input type="hidden" name="id" id="update-id">
            @method('PATCH')
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-update-regulasiLabel">Form Regulasi</h5>
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
                            <label for="file">Cover</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="cover_edit" name="cover"
                                    accept=".jpg,.png" onchange="preview('.cover', this.files[0])">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format image .jpeg, .jpg, & .png )
                                </div>

                            </div>
                            <div class="cover" id="cover-preview"></div>

                        </div>
                        <div class="form-group">
                            <label for="file">File PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="file_edit" name="file"
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
    </script>
    <!-- Setelah memuat jQuery dan Bootstrap -->
    <script>
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

        // Panggil fungsi previewPdf() saat ada perubahan pada input file PDF
        document.getElementById('file_edit').addEventListener('change', function() {
            previewPdf(this);
        });
    </script>

    <script src="{{ asset('js/page/regulasi/list.js?q=' . Str::random(5)) }}"></script>
@endpush
