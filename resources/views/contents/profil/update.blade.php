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
                        <div class="form-group">
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
                        </div>
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
                                placeholder="Masukkan judul" value="{{ $data->judul }}" required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Konten</label>
                            {{-- <textarea class="form-control" id="summernote" name="konten" required>{{ $data->konten }}</textarea> --}}
                            <input type="hidden" name="old-konten" id="old-konten" class="form-control"
                                placeholder="Masukkan Kategori" value="{{ $data->konten }}">
                            <textarea class="form-control" id="summernote" name="konten" required></textarea>
                        </div>
                        {{-- <div class="form-group">
                            <label for="tag">Tag Dinamis</label>
                            <input type="text" name="tag" id="tag" class="form-control"
                                placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi"
                                value="{{ $data->tag }}" required>
                            <div id="error-tag"></div>
                        </div>
                        <div class="form-group">
                            <label for="file">Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="gambar"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="caption_gambar">Caption Gambar</label>
                            <input type="text" name="caption_gambar" id="caption_gambar" class="form-control"
                                placeholder="Masukkan Caption Gambar" value="{{ $data->caption_gambar }}">
                            <div id="error-caption_gambar"></div>
                        </div> --}}

                        <a href="{{ route('profil') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-primary float-right mt-3 mr-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script>
        document.getElementById("customFile").addEventListener("change", function() {
            var file = this.files[0];
            var fileLabel = document.querySelector('label[for="customFile"]');
            fileLabel.innerHTML = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("imagePreview");
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });
    </script> --}}
    <script src="{{ asset('js/page/profil/update.js?q=' . Str::random(5)) }}"></script>
@endpush
