@extends('layouts.app')

@php
    $plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('list_agenda.update', ['id' => encrypt($data->id)]) }}" method="post"
                        name="form-update" id="form-update">
                        <div class="form-group ">
                            <label class="col-form-label">Pilih Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="id_kategori" name="id_kategori">
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
                        {{-- <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                placeholder="Masukkan judul" value="{{ $data->slug }}" disabled>
                            <div id="error-judul"></div>
                        </div> --}}

                        <div class="form-group">
                            <label for="kategori">Konten</label>
                            <input type="hidden" name="old-konten" id="old-konten" class="form-control"
                                placeholder="Masukkan Kategori" value="{{ $data->konten }}">
                            <textarea class="form-control" id="summernote" name="konten" required></textarea>
                        </div>

                        <div class="form-group ">
                            <label class="col-form-label">Pilih Penulis</label>
                            <div class="">
                                <select class="form-control" id="id_penulis" name="id_penulis">
                                    <option>Pilih penulis</option>
                                    @foreach ($penulis as $penulis)
                                        <option value="{{ $penulis->id }}"
                                            {{ $data->id_penulis == $penulis->id ? 'selected' : '' }}>
                                            {{ $penulis->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="gambar">Gambar</label><br>

                            <div class="custom-file mb-3" style="margin-top: 1%">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar"
                                    accept=".jpg,.jpeg,.png" onchange="preview('.cover', this.files[0])">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="cover" id="cover-preview">
                                <img src="{{ asset('agenda/' . $data->gambar) }}" style="width:15%;"><br>S
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="waktu tayang">Tanggal Agenda</label>
                            <input type="datetime-local" name="tanggal_agenda" id="tanggal_agenda" class="form-control"
                                value="{{ $data->tanggal_agenda }}"required>
                            <div id="error-tanggal-agenda"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Link Agenda</label>
                            <input type="text" name="link_agenda" id="link_agenda" class="form-control"
                                placeholder="Masukkan judul" value="{{ $data->link_agenda }}" required>
                            <div id="error-judul"></div>
                        </div>
                        <a href="{{ route('list_agenda') }}" class="btn btn-secondary">
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
    <script src="{{ asset('js/page/Agenda/update.js?q=' . Str::random(5)) }}"></script>
    <script>
        function preview(selector, temporaryFile, width = 200) {
            $(selector).empty();

            if (temporaryFile.type.startsWith('image/')) {
                $(selector).append(`<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`);
            } else {
                // Handle non-image file types (e.g., show a placeholder or a different preview)
                $(selector).text('File preview not available for non-image types.');
            }
        }
    </script>
@endpush
