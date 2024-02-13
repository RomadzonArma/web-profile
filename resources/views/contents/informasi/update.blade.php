@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('informasi-publik.do_update') }}" method="post" name="form-update" id="form-update">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="hidden" name="informasi_publik_id" id="informasi_publik_id" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->id }}">
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" value="{{ $data->judul }}"
                                required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->kategori }}"
                                required>
                            <div id="error-kategori"></div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Konten</label>
                            {{-- <input type="hidden" name="old-konten" id="old-konten" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->konten }}"> --}}
                            <textarea class="form-control" id="summernote" name="konten" required>{{ $data->konten }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/pengguna/update.js?q=' . Str::random(5)) }}"></script>
@endpush
