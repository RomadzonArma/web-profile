@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pengumuman.update', ['id' => encrypt($data->id)]) }}" method="post" name="form-update" id="form-update">
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
                            <input type="text" name="judul" id="judul" class="form-control"
                                placeholder="Masukkan judul" value="{{ $data->judul }}" required>
                            <div id="error-judul"></div>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Deskripsi Pengumuman</label>
                            <input type="hidden" name="old-konten" id="old-konten" class="form-control"
                                placeholder="Masukkan Kategori" value="{{ $data->konten }}">
                            <textarea class="form-control" id="konten" name="konten" required></textarea>
                        </div>



                        <div class="form-group mt-2">
                            <label for="gambar">Gambar</label><br>
                            <img src="{{ asset('pengumuman/' . $data->gambar) }}" style="width:15%;"><br>
                            <div class="custom-file mb-3" style="margin-top: 1%">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="pdf_preview">File PDF Preview</label>
                            <iframe id="pdf_preview" width="100%" height="500px"
                                style="border: 1px solid #ddd;"></iframe>
                        </div>
                        <div class="form-group">
                            <label for="file">File PDF</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="file" name="file"
                                    accept=".pdf" onchange="handlePdfUpload()"">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                    class="text-danger">
                                    (Format PDF max 3.mb )
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="waktu tayang">Tanggal Pengumuman</label>
                            <input type="datetime-local" name="date" id="date" class="form-control"
                                value="{{ $data->date }}"required>
                            <div id="error-tanggal-agenda"></div>
                        </div>
                        <a href="{{ route('pengumuman') }}" class="btn btn-secondary">
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
    <script src="{{ asset('js/page/Pengumuman/update.js?q=' . Str::random(5)) }}"></script>
@endpush
