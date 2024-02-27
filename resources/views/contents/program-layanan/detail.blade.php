@extends('layouts.app')

@php
$plugins = ['editor', 'swal', 'select2'];
@endphp

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="section-title mb-4 text-center">
                    <h4 class="title mb-4">Detail Program Layanan</h4>
                </div>
                <div class="flex-1 py-1">
                    <h6 class="text mb-0">Judul :</h6>
                    <a href="javascript:void(0)" class="text-muted">{{ $list->title }}</a>
                </div>
                <div class="flex-1 py-1">
                    <h6 class="text mb-0">Deskripsi Singkat :</h6>
                    <a href="javascript:void(0)" class="text-muted">{{ $list->short_description }}</a>
                </div>
                <div class="flex-1 py-1">
                    <h6 class="text mb-0">Konten :</h6>
                    <a href="javascript:void(0)" class="text-muted">{{ $list->body }}</a>
                </div>
                <div class="flex-1 py-1">
                    <h6 class="text mb-0">Iamge :</h6>
                    <img src="{{ asset('program-image/'. $list->image)}}" alt="program-image" width="200px">
                    <a href="javascript:void(0)" class="text-muted">{{ $list->iamge }}</a>
                    <p><small>{{$list->caption_image}}</small></p>
                </div>
                <div class="flex-1 py-1">
                    <h6 class="text mb-0">Tag :</h6>
                    <a href="javascript:void(0)" class="text-muted">{{ $list->tag }}</a>
                </div>
                <div class="flex-1 py-1">
                    <h6 class="text mb-0">Status :</h6>
                    <a href="javascript:void(0)" class="text-muted">{{ $list->status }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
        <script src="{{ asset('js/page/programlayanan/list.js?q=' . Str::random(5)) }}"></script>
</script>

@endpush
