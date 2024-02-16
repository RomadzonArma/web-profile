@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('informasi-publik.do_store') }}" method="post" name="form-store" id="form-store">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul"
                                required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukkan Kategori"
                                required>
                            <div id="error-kategori"></div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Konten</label>
                            <textarea class="form-control" id="summernote" name="konten" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/pengguna/store.js?q=' . Str::random(5)) }}"></script>
@endpush
