@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('pos_layanan', 2))
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-rounded waves-effect waves-light btn-tambah text-white"
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
                                    <th>Tim Kerja</th>
                                    <th>Nama Pos Layanan</th>
                                    <th>Tautan Dokumen</th>
                                    <th>Status Publish</th>
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



    <!-- modal tambah  -->
    <div id="tambah-list-poslayanan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="tambah-list-poslayanan">Form Tambah List Pos Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pos_layanan.store') }}" method="post" name="form-store" id="form-store">
                        <div class="form-group">
                            <label for="judul">Tim Kerja</label>
                            <input type="text" name="tim_kerja" id="tim_kerja" class="form-control"
                                placeholder="Masukkan tim kerja" required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Nama Pos Layanan</label>
                            <input type="text" name="nama_pos" id="nama_pos" class="form-control"
                                placeholder="Masukkan pos layanan" required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Tautan Dokumen</label>
                            <input type="text" name="tautan_dok" id="tautan_dok" class="form-control"
                                placeholder="Masukkan tautan dokumen" required>
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
    <div id="edit-list-poslayanan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="edit-list-poslayanan">Form Edit List Tautan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post"  name="form-update" id="form-update">
                        <div class="form-group">
                            <label for="judul">Tim Kerja</label>
                            <input type="text" name="tim_kerja_edit" id="tim_kerja_edit" class="form-control"
                                placeholder="Masukkan tim kerja" required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Nama Pos Layanan</label>
                            <input type="text" name="nama_pos_edit" id="nama_pos_edit" class="form-control"
                                placeholder="Masukkan pos layanan" required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Tautan Dokumen</label>
                            <input type="text" name="tautan_dok_edit" id="tautan_dok_edit" class="form-control"
                                placeholder="Masukkan tautan dokumen" required>
                            <div id="error-judul"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" form="form-update" class="btn btn-primary waves-effect waves-light edit-data">Edit </button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('js/page/pos_layanan/list.js?q=' . Str::random(5)) }}"></script>
@endpush
