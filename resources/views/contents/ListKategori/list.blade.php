@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('list_kategori', 2))
                        <div class="text-sm-right">
                            <a type="button" class="btn btn-rounded waves-effect waves-light btn-tambah"
                                style="background-color: #E59537; color: white;">
                                <i class="bx bx-plus-circle mr-1"></i> Tambah
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Kategori</th>
                                    <th>Kanal</th>
                                    <th>Status</th>
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
    <div id="tambah-list-kategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="tambah-list-kategori">Form Tambah List Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Pilih Kanal</label>
                        <div class="">
                            <select class="form-control" id="nama_kanal" name="nama_kanal">
                                <option>Pilih kanal</option>
                                @foreach ($list_kanal as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kanal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light btn-simpan">Save </button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal edit  -->
    <div id="edit-list-kategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="edit-list-kategori">Form Edit List Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori_edit" name="nama_kategori_edit"
                            required>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Pilih Kanal</label>
                        <div class="">
                            <select class="form-control" id="nama_kanal_edit" name="nama_kanal_edit">
                                <option>Pilih kanal</option>
                                @foreach ($list_kanal as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kanal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light edit-data">Edit </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/ListKategori/list.js?q=' . Str::random(5)) }}"></script>
@endpush
