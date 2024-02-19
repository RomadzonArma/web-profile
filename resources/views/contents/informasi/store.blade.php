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
                        <label for="kategori">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control select2 data-filter">
                            <option value="Berita">Berita</option>
                            <option value="Artikel">Artikel</option>
                        </select>
                        <div id="error-kategori"></div>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" required>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Konten</label>
                        <textarea class="form-control" id="summernote" name="konten" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag Dinamis</label>
                        <input type="text" name="tag" id="tag" class="form-control" placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi" required>
                        <div id="error-tag"></div>
                    </div>
                    <div class="form-group">
                        <label for="file">Gambar</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div id="imagePreview" class="mt-3"></div>
                    </div>
                    <div class="form-group">
                        <label for="caption_gambar">Caption Gambar</label>
                        <input type="text" name="caption_gambar" id="caption_gambar" class="form-control" placeholder="Masukkan Caption Gambar">
                        <div id="error-caption_gambar"></div>
                    </div>
                    <button type="" class="btn btn-success float-right mt-3">Publish</button>
                    <button type="submit" class="btn btn-primary float-right mt-3 mr-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById("customFile").addEventListener("change", function() {
        var file = this.files[0];
        var fileLabel = document.querySelector('label[for="customFile"]');
        fileLabel.innerHTML = file.name;

        var reader = new FileReader();
        reader.onload = function(e) {
            var imagePreview = document.getElementById("imagePreview");
            imagePreview.innerHTML = '<img src="' + e.target.result + '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
        };
        reader.readAsDataURL(file);
    });
</script>
<script src="{{ asset('js/page/informasi/store.js?q=' . Str::random(5)) }}"></script>
@endpush