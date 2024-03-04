@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('webinar', 2))
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-rounded waves-effect waves-light btn-tambah"
                                style="background-color: #E59537; color: white;"
                                onclick="window.location.href='{{ route('webinar.tambah_data') }}'">
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
                                    <th>Judul Webinar</th>
                                    <th>Kanal</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Webinar</th>
                                    <th>Jumlah Lihat</th>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/page/Webinar/list.js?q=' . Str::random(5)) }}"></script>
@endpush
