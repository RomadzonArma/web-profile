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
                    <div class="form-group ">
                        <label class="col-form-label">Pilih Kanal</label>
                        <div class="">
                            <select class="form-control" id="id_kanal" name="id_kanal">
                                <option>Pilih kanal</option>
                                @foreach ($list_kanal as $kanal)
                                    <option value="{{ $kanal->id }}" {{ $data->id_kanal == $kanal->id ? 'selected' : '' }}>
                                        {{ $kanal->nama_kanal }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Pilih Kategori</label>
                        <div class="">
                            <select class="form-control" id="id_kategori" name="id_kategori">
                                <option>Pilih kategori</option>
                                @foreach ($list_kategori as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $data->id_kategori == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" value="{{ $data->judul }}" required>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Masukkan judul" value="{{ $data->slug }}" disabled>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="judul">Lead</label>
                        <input type="text" name="lead" id="lead" class="form-control" placeholder="Masukkan lead" value="{{ $data->lead }}" required>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Konten</label>
                        <input type="hidden" name="old-konten" id="old-konten" class="form-control" placeholder="Masukkan Kategori" value="{{ $data->isi_konten }}">
                        <textarea class="form-control" id="summernote" name="konten" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag Dinamis</label>
                        <input type="text" name="tag_dinamis" id="tag_dinamis" class="form-control" placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi" value="{{ $data->tag_dinamis }}"required>
                        <div id="error-tag"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Pilih Penulis</label>
                        <div class="">
                            <select class="form-control" id="id_penulis" name="id_penulis">
                                <option>Pilih penulis</option>
                                @foreach ($penulis as $penulis)
                                    <option value="{{ $penulis->id }}" {{ $data->id_penulis == $penulis->id ? 'selected' : '' }}>
                                        {{ $penulis->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-right">
                        <input type="checkbox" class="custom-control-input" id="status_video" name="status_video" {{ $data->status_video ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status_video">Video</label>
                    </div>
                    <div class="form-group mt-2" id="url_video_container" >
                        <label for="tag">Url Video</label>
                        <input type="text" name="url_video" id="url_video" class="form-control"  value="{{ $data->url_video }}"required>
                        <div id="error-tag"></div>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-right mt-2">
                        <input type="checkbox" class="custom-control-input" id="status_headline" name="status_headline" {{ $data->status_headline ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status_headline">Headline</label>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar </label>
                        <img src="{{ asset('list_berita/' . $data->gambar) }}" alt="Gambar Lama" class="img-thumbnail">                    </div>
                    <div class="form-group">
                        <label for="caption_gambar">Caption Gambar</label>
                        <input type="text" name="caption_gambar" id="caption_gambar" class="form-control" value="{{ $data->caption_gambar }}">
                        <div id="error-caption_gambar"></div>
                    </div>
                    <div class="form-group">
                        <label for="waktu tayang">Waktu Tayang</label>
                        <input type="datetime-local" name="date" id="date" class="form-control" value="{{ $data->date }}"required>
                        <div id="error-waktu-tayang"></div>
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
