@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2','editor'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Penanya</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Penjawab</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal edit  -->
    <div id="edit-list-faq" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="edit-list-faq">Form Jawab Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post"  name="form-update" id="form-update">
                        <div class="form-group">
                            <label for="konten">Jawaban</label>
                            <textarea class="form-control" id="jawaban" name="jawaban" required></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" form="form-update" class="btn btn-primary waves-effect waves-light edit-data">Jawab </button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('js/page/Faq/list.js?q=' . Str::random(5)) }}"></script>
@endpush
