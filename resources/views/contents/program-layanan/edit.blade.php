@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('program_layanan.update', ['id' => encrypt($list->id)]) }}" method="post" name="form-update" id="form-update"
                        enctype="multipart/form-data">
                        <div class="form-group ">
                            <label class="col-form-label">Pilih Kanal</label>
                            <div class="">
                                <select class="form-control" id="kanal_id" name="kanal_id">
                                    <option>Pilih kanal</option>
                                    @foreach ($kanal as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $list->kanal_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kanal }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label class="col-form-label">Pilih Kategori</label>
                            <div class="">
                                <select class="form-control" id="kategori_id" name="kategori_id">
                                    <option>Pilih kategori</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}"
                                            {{ $list->kategori_id == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukkan judul" value="{{ $list->title }}">
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Deskripsi Singkat</label>
                            <textarea class="form-control" id="short_description" name="short_description">{{ $list->short_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Konten</label>
                            <textarea class="form-control" id="body" name="body">{{ $list->body }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag Dinamis</label>
                            <input type="text" name="tag" id="tag" class="form-control"
                                placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi"
                                value="{{ $list->tag }}">
                            <div id="error-tag"></div>
                        </div>
                        <div class="form-group">
                            <label for="publish_date">Tanggal Publish</label>
                            <input type="date" name="publish_date" id="publish_date" class="form-control" value="{{ $list->publish_date }}">
                            <div id="error-publish-date"></div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">Tanggal Berakhir</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $list->end_date }}">
                                    <div id="error-end-date"></div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="file">Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="image"
                                    value="{{ $list->image }}"id="customFile" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="caption_image">Caption Gambar</label>
                            <input type="text" name="caption_image" id="caption_image"
                                value="{{ $list->caption_image }}"class="form-control"
                                placeholder="Masukkan Caption Gambar">
                            <div id="error-caption_gambar"></div>
                        </div>

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
                imagePreview.innerHTML = '<img src="' + e.target.result +
                    '" class="img-fluid" style="height:200px;width:auto" alt="Selected Image">';
            };
            reader.readAsDataURL(file);
        });
         $('#body').summernote({
            height: 350,
        });
    </script>
    <script src="{{ asset('js/page/programlayanan/update.js?q=' . Str::random(5)) }}"></script>
@endpush
