@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('sosmed.update', ['id' => encrypt($data->id)]) }}" id="form-sosmed">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ encrypt($data->id) }}">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Whatsapp  </label>
                                <input type="text" name="whatsapp" id="whatsapp" placeholder="Nomor WA "
                                    class="form-control" value="{{ $data->whatsapp }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Email </label>
                                <input type="text" name="email" id="email" placeholder="Email "
                                    class="form-control" value="{{ $data->email }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Telepon </label>
                                <input type="text" name="telepon" id="telepon" placeholder="telepon "
                                    class="form-control" value="{{ $data->telepon }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Twitter </label>
                                <input type="text" name="twitter" id="twitter" autocomplete="off" placeholder="Twitter "
                                    class="form-control" value="{{ $data->twitter }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Facebook </label>
                                <input type="text" name="facebook" id="facebook" placeholder="Facebook "
                                    class="form-control" value="{{ $data->facebook }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Instagram </label>
                                <input type="text" name="instagram" id="instagram" placeholder="instagram "
                                    class="form-control" value="{{ $data->instagram }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Youtube </label>
                                <input type="text" name="youtube" id="youtube" placeholder="Youtube "
                                    class="form-control" value="{{ $data->youtube }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-simpan" form="form-sosmed">
                                <i class="mdi mdi-check-circle-outline mr-1"></i> Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/Sosmed/list.js?q=' . Str::random(5)) }}"></script>
@endpush
