@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

<script>
    location.href = "{{ route('index') }}";
</script>
