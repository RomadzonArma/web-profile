@extends('layouts.app')

@php
    $plugins = ['editor', 'datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('program_fokus', 2))
                        <div class="text-sm-right">
                            <button type="button" class="btn text-white btn-rounded waves-effect waves-light btn-tambah"
                                style="background-color: #E59537;">
                                <i class="bx bx-plus-circle mr-1"></i> Tambah
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
                                    {{-- <th>Kanal</th>
                                    <th>Kategori</th> --}}
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    {{-- <th>Jumlah Download</th> --}}
                                    <th>Status Keaktifan</th>
                                    <th>Aksi</th>
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
    <div id="modal-program_fokus" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-program_fokusLabel" aria-hidden="true">
        <form action="{{ route('program_fokus.store') }}" method="post" id="form-program_fokus"
            enctype="multipart/form-data" autocomplete="off">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-program_fokusLabel">Form Program Fokus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow-y: auto;">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukkan judul" required>
                            <div id="error-judul"></div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="kategori">Konten</label>
                            <textarea class="form-control" id="body" name="body" required></textarea>
                        </div> --}}
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link" id="link" class="form-control"
                                placeholder="Masukkan link" required>
                            <div id="error-link"></div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="tag">Tag Dinamis</label>
                            <input type="text" name="tag" id="tag" class="form-control"
                                placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi" required>
                            <div id="error-tag"></div>
                        </div> --}}
                        <div class="form-group">
                            <label for="publish_date">Tanggal Publish</label>
                            <input type="date" name="publish_date" id="publish_date" class="form-control" required>
                            <div id="error-publish-date"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-simpan">Simpan </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal -->
    <!-- sample modal content -->
    <div id="modal-update-program_fokus" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-program_fokusLabel" aria-hidden="true">
        <form action="{{ route('program_fokus.update') }}" method="post" id="form-update-program_fokus" autocomplete="off"
            enctype="multipart/form-data">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-update-program_fokusLabel">Form Program Fokus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow-y: auto;">
                        <div class="form-group">
                            <label for="update-title">Judul</label>
                            <input type="text" name="title" id="update-title" class="form-control"
                                placeholder="Masukkan judul" required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="update-link">Link</label>
                            <input type="text" name="link" id="update-link" class="form-control"
                                placeholder="Masukkan link" required>
                            <div id="error-update-link"></div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="update-body">Konten</label>
                            <textarea class="form-control" id="body_edit" name="body" required>{!! $program_fokus->body !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tag_edit">Tag Dinamis</label>
                            <input type="text" name="tag" id="tag_edit" class="form-control"
                                placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi" required>
                            <div id="error-tag"></div>
                        </div> --}}
                        <div class="form-group">
                            <label for="update-publish_date">Tanggal Publish</label>
                            <input type="date" name="publish_date" id="publish_date_edit" class="form-control"
                                required>
                            <div id="error-publish-date"></div>
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
@endsection

@push('scripts')
    <script>
        $('[name="body"]').summernote({
            height: 350,
        });
        // $('#modal-update-program_fokus').on('shown.bs.modal', function() {
        //     $('[name="update-body"]').summernote({
        //         height: 350,
        //     });
        // });
    </script>

    <script src="{{ asset('js/page/program_fokus/list.js?q=' . Str::random(5)) }}"></script>
@endpush
