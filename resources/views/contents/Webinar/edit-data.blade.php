@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('webinar.update', ['id' => encrypt($data->id)]) }}" method="post" name="form-update" id="form-update">
                        <div class="form-group ">
                            <label class="col-form-label">Pilih Kategori</label>
                            <div class="">
                                <select class="form-control"  style="width: 100%" id="id_kategori" name="id_kategori">
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
                            <input type="text" name="judul" id="judul" class="form-control"
                                placeholder="Masukkan judul" value="{{ $data->judul }}" required>
                            <div id="error-judul"></div>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                placeholder="Masukkan judul" value="{{ $data->slug }}" disabled>
                            <div id="error-judul"></div>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Deskripsi Webinar</label>
                            <input type="hidden" name="old-konten" id="old-konten" class="form-control"
                                placeholder="Masukkan Kategori" value="{{ $data->deskripsi }}">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                        </div>



                        <div class="form-group mt-2">
                            <label for="gambar">Gambar</label><br>
                            <img src="{{ asset('webinar/' . $data->gambar) }}" style="width:15%;"><br>
                            <div class="custom-file mb-3" style="margin-top: 1%">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>

                        <div class="form-group">
                            <label for="waktu tayang">Tanggal Webinar</label>
                            <input type="datetime-local" name="tanggal_webinar" id="tanggal_webinar" class="form-control"
                                value="{{ $data->tanggal_webinar }}"required>
                            <div id="error-tanggal-agenda"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Link Webinar</label>
                            <input type="text" name="link_webinar" id="link_webinar" class="form-control"
                                placeholder="Masukkan judul" value="{{ $data->link_webinar }}" required>
                            <div id="error-judul"></div>
                        </div>
                        <a href="{{ route('webinar') }}" class="btn btn-secondary">
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
    <script src="{{ asset('js/page/Webinar/update.js?q=' . Str::random(5)) }}"></script>
@endpush
