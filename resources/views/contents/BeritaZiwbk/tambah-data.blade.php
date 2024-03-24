@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('berita_zi_wbk.store') }}" method="post" name="form-store" id="form-store">
                        <div class="form-group ">
                            <label class="col-form-label">Pilih Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="id_kategori" name="id_kategori">
                                    <option>Pilih kategori</option>
                                    @foreach ($list_kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                                placeholder="Masukkan judul" required>
                            <div id="error-judul"></div>
                        </div>
                       
                        <div class="form-group">
                            <label for="kategori">Konten</label>
                            <textarea class="form-control" id="isi_konten" name="isi_konten" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag Dinamis</label>
                            <input type="text" name="tag_dinamis" id="tag_dinamis" class="form-control"
                                placeholder="Masukkan tag, contoh: kemendikbud, jakarta, salingberbagi" required>
                            <div id="error-tag"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label">Penulis</label>
                            <div class="">
                                <select class="form-control" style="width: 100%"  id="id_penulis" name="id_penulis">
                                    <option>Pilih kategori</option>
                                    @foreach ($penulis as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox custom-control-right">
                            <input type="checkbox" class="custom-control-input" id="status_video" name="status_video">
                            <label class="custom-control-label" for="status_video">Video</label>
                        </div>
                        <div class="form-group mt-2" id="url_video_container" style="display: none;">
                            <label for="url_video">Url Video</label>
                            <input type="text" name="url_video" id="url_video" class="form-control"
                                placeholder="Masukkan url video">
                            <div id="error-url_video"></div>
                        </div>


                        <div class="form-group mt-2">
                            <label for="file">Gambar</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar"
                                    accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="caption_gambar">Caption Gambar</label>
                            <input type="text" name="caption_gambar" id="caption_gambar" class="form-control"
                                placeholder="Masukkan Caption Gambar">
                            <div id="error-caption_gambar"></div>
                        </div>
                      


                        <button type="submit" class="btn btn-primary float-right mt-3 mr-3 btn-simpan">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script></script>
    <script src="{{ asset('js/page/BeritaZiwbk/store.js?q=' . Str::random(5)) }}"></script>
@endpush
