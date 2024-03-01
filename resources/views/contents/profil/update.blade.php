@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profil.do_update', ['id' => encrypt($data->id)]) }}" method="post"
                        name="form-update" id="form-update" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="form-group">
                            <label class="col-form-label">Pilih Kanal</label>
                            <div class="">
                                <select class="form-control" id="id_kanal" name="id_kanal">
                                    <option value="" disabled selected>Pilih kanal</option>
                                    @foreach ($list_kanal as $kanal)
                                        <option value="{{ $kanal->id }}"
                                            {{ $kanal->id == $data->id_kanal ? 'selected' : '' }}>
                                            {{ $kanal->nama_kanal }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="col-form-label">Pilih Kategori</label>
                            <div class="">
                                <select class="form-control" id="id_kategori" name="id_kategori">
                                    <option value="" disabled selected>Pilih kategori</option>
                                    @foreach ($list_kategori as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $kategori->id == $data->id_kategori ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                                placeholder="Masukkan judul" value="{{ $data->judul }}">
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Konten</label>
                            {{-- <textarea class="form-control" id="summernote" name="konten" required>{{ $data->konten }}</textarea> --}}
                            <input type="hidden" name="old-konten" id="old-konten" class="form-control"
                                placeholder="Masukkan Kategori" value="{{ $data->konten }}">
                            <textarea class="form-control" id="summernote" name="konten"></textarea>
                        </div>
                        <a href="{{ route('profil') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{ asset('js/page/profil/update.js?q=' . Str::random(5)) }}"></script>
@endpush
