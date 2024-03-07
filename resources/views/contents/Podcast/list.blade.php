@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('podcast', 2))
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
                                    <th>Judul Podcast</th>
                                    <th>Tanggal Podcast</th>
                                    <th>Jumlah lihat</th>
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




    <!-- modal tambah  -->
    <div id="tambah-list-podcast" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="tambah-list-podcast">Form Tambah List podcast</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('podcast.store') }}" method="post" name="form-store" id="form-store">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                placeholder="Masukkan judul podcast" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Deskripsi Podcast</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi podcast" required></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="file">Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_agenda">Tanggal Podcast</label>
                            <input type="datetime-local" name="date" id="date" class="form-control"
                                placeholder="Masukkan tanggal webinar" required>
                            <div id="error-waktu-tayang"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Link Podcast</label>
                            <input type="text" name="link_podcast" id="link_podcast" class="form-control"
                                placeholder="Masukkan link podcast" required>
                            <div id="error-judul"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" form="form-store"
                        class="btn btn-primary waves-effect waves-light btn-simpan">Save </button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal edit  -->
    <div id="edit-list-podcast" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="edit-list-kanal">Form Edit List Kanal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" name="form-update" id="form-update">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul_edit" name="judul_edit"
                                placeholder="Masukkan judul podcast">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Deskripsi Podcast</label>
                            <textarea class="form-control" id="deskripsi_edit" name="deskripsi_edit" placeholder="Masukkan deskripsi podcast"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="file">Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="gambar_edit" name="gambar_edit"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_agenda">Tanggal Podcast</label>
                            <input type="datetime-local" name="date_edit" id="date_edit" class="form-control">
                            <div id="error-waktu-tayang"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Link Podcast</label>
                            <input type="text" name="link_podcast_edit" id="link_podcast_edit" class="form-control"
                                placeholder="Masukkan link podcast">
                            <div id="error-judul"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" form="form-update"
                        class="btn btn-primary waves-effect waves-light edit-data">Edit </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/Podcast/list.js?q=' . Str::random(5)) }}"></script>
@endpush
