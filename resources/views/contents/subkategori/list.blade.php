@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('sub_kategori', 2))
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
                                    <th>Sub Kategori</th>
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
    <div id="tambah-list-subkategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="tambah-list-subkategori">Form Tambah Sub Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sub_kategori.store') }}" method="post" name="form-store" id="form-store">
                        <div class="form-group ">
                            <label class="col-form-label">Pilih Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="id_kategori" name="id_kategori">
                                    <option>Pilih Kategori</option>
                                    @foreach ($list_kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }} -
                                            {{ $data->list_kanal->nama_kanal }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Sub Kategori</label>
                            <input type="text" class="form-control" id="sub_kategori" name="sub_kategori" required>
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
    <div id="edit-list-subkategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="edit-sublist-kategori">Form Edit Sub Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" name="form-update" id="form-update">
                        <div class="form-group ">
                            <label class="col-form-label">Pilih Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="id_kategori_edit"
                                    name="id_kategori_edit">
                                    <option>Pilih Kategori</option>
                                    @foreach ($list_kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }} -
                                            {{ $data->list_kanal->nama_kanal }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Sub Kategori</label>
                            <input type="text" class="form-control" id="sub_kategori_edit" name="sub_kategori_edit"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" form="form-update" class="btn btn-primary waves-effect waves-light edit-data">Edit </button>                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/SubKategori/list.js?q=' . Str::random(5)) }}"></script>
@endpush
