@extends('layouts.app')

@php
$plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('informasi-publik.do_update', ['id' => encrypt($data->id)]) }}" method="post" name="form-update" id="form-update">
                    <div class="form-group ">
                        <label class="col-form-label">Pilih Kategori</label>
                        <div class="">
                            <select class="form-control" id="id_kategori" name="id_kategori">
                                <option>Pilih kategori</option>
                                @foreach ($list_kategori as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ $data->id_kategori == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="hidden" name="informasi_publik_id" id="informasi_publik_id" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->id }}">
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" value="{{ $data->judul }}" required>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            placeholder="Masukkan judul" value="{{ $data->slug }}" disabled>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Konten</label>
                        <input type="hidden" name="old-konten" id="old-konten" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->konten }}">
                        <textarea class="form-control" id="summernote" name="konten" required></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="gambar">Gambar</label><br>
                        <img src="{{ asset('informasi_publik/' . $data->gambar) }}" style="width:15%;"><br>
                        <div class="custom-file mb-3" style="margin-top: 1%">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div id="imagePreview" class="mt-3"></div>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag Dinamis</label>
                        <input type="text" name="tag" id="tags" class="form-control"
                            placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi"
                            value="{{ $data->tag }}"required>
                        <div id="error-tag"></div>
                    </div>
                    <div class="form-group">
                        <label for="caption_gambar">Caption Gambar</label>
                        <input type="text" name="caption_gambar" id="caption_gambar" class="form-control"
                            value="{{ $data->caption_gambar }}">
                        <div id="error-caption_gambar"></div>
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
