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
                        <label for="kategori">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control select2 data-filter">
                            <option value="Berita" {{ $data->kategori == 'Berita' ? 'selected' : ''}}>Berita</option>
                            <option value="Artikel" {{ $data->kategori == 'Artikel' ? 'selected' : ''}}>Artikel</option>
                        </select>
                        <div id="error-kategori"></div>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="hidden" name="informasi_publik_id" id="informasi_publik_id" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->id }}">
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" value="{{ $data->judul }}" required>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Konten</label>
                        <input type="hidden" name="old-konten" id="old-konten" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->konten }}">
                        <textarea class="form-control" id="summernote" name="konten" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag Dinamis</label>
                        <input type="text" name="tag" id="tag" class="form-control" placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi" required>
                        <div id="error-tag"></div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/page/informasi/update.js?q=' . Str::random(5)) }}"></script>
@endpush