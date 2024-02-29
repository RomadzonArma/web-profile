@extends('layouts.app')

@php
$plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('list_agenda.store') }}" method="post" name="form-store" id="form-store">
                    <div class="form-group ">
                        <label class="col-form-label">Pilih Kategori</label>
                        <div class="">
                            <select class="form-control" id="id_kategori" name="id_kategori">
                                <option>Pilih kategori</option>
                                @foreach ($list_kategori as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul" required>
                        <div id="error-judul"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Konten</label>
                        <textarea class="form-control" id="konten" name="konten" required></textarea>
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Penulis</label>
                        <div class="">
                            <select class="form-control" id="id_penulis" name="id_penulis">
                                <option>Pilih kategori</option>
                                @foreach ($penulis as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <label for="tanggal_agenda">Tanggal Agenda</label>
                        <input type="datetime-local" name="tanggal_agenda" id="tanggal_agenda" class="form-control" placeholder="Masukkan tanggal agenda" required>
                        <div id="error-waktu-tayang"></div>
                    </div>
                    <div class="form-group">
                        <label for="judul">Link Agenda</label>
                        <input type="text" name="link_agenda" id="link_agenda" class="form-control" placeholder="Masukkan link agenda" required>
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
<script src="{{ asset('js/page/Agenda/store.js?q=' . Str::random(5)) }}"></script>
@endpush
