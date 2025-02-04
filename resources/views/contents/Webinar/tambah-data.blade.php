@extends('layouts.app')

@php
$plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('webinar.store') }}" method="post" name="form-store" id="form-store">
                    {{--  <div class="form-group ">
                        <label class="col-form-label">Pilih Kategori</label>
                        <div class="">
                            <select class="form-control" style="width: 100%" id="id_kategori" name="id_kategori">
                                <option>Pilih kategori</option>
                                @foreach ($list_kategori as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  --}}
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" required>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Deskripsi Webinar</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>


                    <div class="form-group mt-2">
                        <label for="file">Gambar</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div id="imagePreview" class="mt-3"></div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_agenda">Tanggal Webinar</label>
                        <input type="datetime-local" name="tanggal_webinar" id="tanggal_webinar" class="form-control" placeholder="Masukkan tanggal webinar" required>
                        <div id="error-waktu-tayang"></div>
                    </div>
                    <div class="form-group">
                        <label for="judul">Link Webinar</label>
                        <input type="text" name="link_webinar" id="link_webinar" class="form-control" placeholder="Masukkan link webinar" required>
                        <div id="error-judul"></div>
                    </div>


                    <button type="submit" class="btn btn-primary float-right mt-3 mr-3 btn-simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

</script>
<script src="{{ asset('js/page/Webinar/store.js?q=' . Str::random(5)) }}"></script>
@endpush
