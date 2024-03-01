@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (rbacCheck('program_layanan', 2))
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="text-sm-right">
                                    <a type="button" class="btn btn-success btn-rounded waves-effect waves-light btn-tambah"
                                    href="{{ route('program_layanan.create') }}"><i class="bx bx-plus-circle mr-1"></i> Tambah</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Judul Program</th>
                                    <th>Kanal</th>
                                    <th>kategori</th>
                                    <th>Status</th>
                                    <th>Tanggal Publish</th>
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

    <script src="{{ asset('js/page/programlayanan/list.js?q=' . Str::random(5)) }}"></script>
@endpush
