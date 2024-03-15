@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                    @if (rbacCheck('zi_wbk', 2))
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-rounded waves-effect waves-light btn-tambah text-white"
                                style="background-color: #E59537;"><i class="bx bx-plus-circle mr-1"></i>
                                Tambah
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Kanal</th>
                                    <th>Kategori</th>
                                    <th>Sub Kategori</th>
                                    <th>Link Kategori</th>
                                    <th>Link Sub</th>
                                    <th>status</th>
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


    <!-- sample modal content -->
    <div id="modal-ziwbk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-ziwbkLabel"
        aria-hidden="true">
        <form action="{{ route('zi_wbk.store') }}" method="post" id="form-ziwbk" enctype="multipart/form-data"
            autocomplete="off">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-ziwbkLabel">Form Tambah Zi WbKS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="id_kategori" name="id_kategori"
                                    required>
                                    <option>Pilih kategori</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 0px;">
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-primary mb-3">
                                        <input type="radio" id="jenis_link" name="jenis" class="custom-control-input"
                                            value="link">
                                        <label class="custom-control-label" for="jenis_link"> Link Kategori </label>
                                    </div>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-success mb-3">
                                        <input type="radio" id="jenis_form" name="jenis" class="custom-control-input"
                                            value="form">
                                        <label class="custom-control-label" for="jenis_form"> Sub Kategori </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group row_link" style="display: none;">
                            <label class="col-form-label">Link</label>
                            <div class="">
                                <input type="text" name="link_kategori" id="link-kategori" class="form-control">
                            </div>
                        </div>
                        <div class="row_form" style="display: none;">
                            <div class="form-group form-repe">
                                <div class="rep">
                                    <div class="form-group">
                                        <label class="col-form-label">Sub Kategori</label>
                                        <div class="">
                                            <select class="form-control" style="width: 100%" id="id_subkategori"
                                                name="links[0][id_subkategori]">
                                                <option selected disabled> Pilih Sub kategori</option>
                                                @foreach ($sub as $data)
                                                    <option value="{{ $data->id }}">{{ $data->sub_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Link Sub Kategori</label>
                                        <input type="text" name="links[0][link]" id="link" class="form-control">
                                    </div>
                                    <a class="btn btn-primary add-more-btn">Add</a>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-simpan">Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div>
    {{-- <div id="modal-ziwbk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-ziwbkLabel"
        aria-hidden="true">
        <form action="{{ route('zi_wbk.store') }}" method="post" id="form-ziwbk" enctype="multipart/form-data"
            autocomplete="off">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-ziwbkLabel">Form Tambah panduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="id_kategori" name="id_kategori"
                                    required>
                                    <option>Pilih kategori</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 0px;">
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-primary mb-3">
                                        <input type="radio" id="jenis_link" name="jenis" class="custom-control-input"
                                            value="link">
                                        <label class="custom-control-label" for="jenis_link"> Link Kategori </label>
                                    </div>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-success mb-3">
                                        <input type="radio" id="jenis_form" name="jenis" class="custom-control-input"
                                            value="form">
                                        <label class="custom-control-label" for="jenis_form"> Sub Kategori </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group row_link" style="display: none;">
                            <label class="col-form-label">Link</label>
                            <div class="">
                                <input type="text" name="link_kategori" id="link-kategori" class="form-control">
                            </div>
                        </div>
                        <div class="row_form" style="display: none;">
                            <div class="form-group form-repe">
                                <div class="rep">
                                    <div class="form-group">
                                        <label class="col-form-label">Sub Kategori</label>
                                        <input type="text" name="sub_kategori[]"
                                            class="form-control" id="sub_kategori">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Link Sub Kategori</label>
                                        <input type="text" name="link[]" id="link" class="form-control">
                                    </div>
                                    <a class="btn btn-primary add-more-btn">Add</a>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-simpan">Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div> --}}
    <!-- /.modal -->
    <!-- sample modal content -->
    {{-- <div id="modal-update-ziwbk" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-menuLabel" aria-hidden="true">
        <form action="{{ route('zi_wbk.update') }}" method="post" id="form-update-ziwbk" autocomplete="off">
            <input type="hidden" name="id" id="update-id">
            @method('PATCH')
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-update-ziwbkLabel">Form panduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group ">
                            <label class="col-form-label">Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="update-id_kategori"
                                    name="id_kategori">
                                    <option>Pilih kategori</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 0px;">
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-primary mb-3">
                                        <input type="radio" id="jenis_link-edit" name="jenis-edit"
                                            class="custom-control-input" value="link">
                                        <label class="custom-control-label" for="jenis_link"> Link </label>
                                    </div>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-success mb-3">
                                        <input type="radio" id="jenis_form-edit" name="jenis-edit"
                                            class="custom-control-input" value="form">
                                        <label class="custom-control-label" for="jenis_form"> Sub Kategori </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group row_link" style="display: none;">
                            <label class="col-form-label">Link</label>
                            <div class="">
                                <input type="text" name="link_kategori" id="edit-link-kategori" class="form-control">
                            </div>
                        </div>
                        <div class="row_form" style="display: none;">
                            <div class="form-group">
                                <label class="col-form-label">Sub Kategori</label>
                                <div class="">
                                    <input type="text" name="sub_kategori" id="edit-sub_kategori"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Link Sub Kategori</label>
                                    <div id="form-repeater-edit">
                                        <div class="input-group mb-3">
                                            <input type="text" name="addMoreInputFields[0][link]" id="edit-link"
                                                class="form-control">
                                            <div class="input-group-append">
                                                <button type="button" id="edit-dynamic" class="btn btn-primary">Add
                                                    Subject</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}
    <div id="modal-update-ziwbk" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-menuLabel" aria-hidden="true">
        <form action="{{ route('zi_wbk.update') }}" method="post" id="form-update-ziwbk" autocomplete="off">
            <input type="hidden" name="id" id="update-id">
            @method('PATCH')
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-update-ziwbkLabel">Form panduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group ">
                            <label class="col-form-label">Kategori</label>
                            <div class="">
                                <select class="form-control" style="width: 100%" id="update-id_kategori"
                                    name="id_kategori">
                                    <option>Pilih kategori</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 0px;">
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-primary mb-3">
                                        <input type="radio" id="jenis_link-edit" name="jenis-edit"
                                            class="custom-control-input" value="link">
                                        <label class="custom-control-label" for="jenis_link"> Link </label>
                                    </div>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <div class="custom-control custom-radio custom-radio-success mb-3">
                                        <input type="radio" id="jenis_form-edit" name="jenis-edit"
                                            class="custom-control-input" value="form">
                                        <label class="custom-control-label" for="jenis_form"> Sub Kategori </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group row_link" style="display: none;">
                            <label class="col-form-label">Link</label>
                            <div class="">
                                <input type="text" name="link_kategori" id="edit-link-kategori" class="form-control">
                            </div>
                        </div>
                        <div class="row_form" style="display: none;">
                            <div class="form-group form-repe">
                                <div class="rep">
                                    <div class="form-group">
                                        <label class="col-form-label">Sub Kategori</label>
                                        <div class="">
                                            <select class="form-control" style="width: 100%" id="edit-id_subkategori"
                                                name="links[0][id_subkategori]">
                                                <option selected disabled> Pilih Sub kategori</option>
                                                @foreach ($sub as $data)
                                                    <option value="{{ $data->id }}">{{ $data->sub_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Link Sub Kategori</label>
                                        <input type="text" name="links[0][link]" id="edit-link" class="form-control">
                                    </div>
                                    <a class="btn btn-primary add-more-btn">Add</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/zi_wbk/list.js?q=' . Str::random(5)) }}"></script>
    <script type="text/javascript">
        var i = 0;
        $(document).ready(function() {
        // Memanggil fungsi untuk menangani tampilan berdasarkan nilai radio yang terpilih
        handleRadioChange();
    });
        $(document).ready(function() {
            $("#dynamic-ar").click(function() {
                ++i;
                $("#form-repeater").append(
                    '<div class="input-group mb-3"><input type="text" name="addMoreInputFields[' + i +
                    '][link]" placeholder="Enter Link" class="form-control" /><div class="input-group-append"><button type="button" class="btn btn-danger remove-input-field">Delete</button></div></div>'
                );
            });


            $(document).on('click', '.remove-input-field', function() {
                $(this).closest('.input-group').remove();
            });

            $(".add-more-btn").click(function() {
                var index = $('.form-repe').length; // Hitung jumlah elemen yang sudah ada
                var newRow = $('<div class="form-group form-repe">' +
                    '<div class="rep">' +
                    '<div class="form-group">' +
                    '<label class="col-form-label">Sub Kategori</label>' +
                    '<div class="">' +
                    '<select class="form-control" style="width: 100%" name="links[' + index +
                    '][id_subkategori]">' + // Perbarui nama input menjadi 'id_subkategori'
                    '<option value="">Pilih Sub Kategori</option>' +
                    '@foreach ($sub as $data)' +
                    '<option value="{{ $data->id }}">{{ $data->sub_kategori }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="col-form-label">Link Sub Kategori</label>' +
                    '<input type="text" name="links[' + index +
                    '][link]" class="form-control edit-link">' +
                    '</div>' +
                    '<a class="btn btn-primary remove-btn">Remove</a>' +
                    '</div>' +
                    '</div>');
                $('.row_form').append(newRow);
            });


            // Tambahkan event handler untuk menghapus elemen
            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.form-repe').remove();
            });



            // $(".add-more-btn").click(function() {
            //     var newRow = $('<div class="form-group form-repe">' +
            //         '<div class="rep">' +
            //         '<div class="form-group">' +
            //         '<label class="col-form-label">Sub Kategori</label>' +
            //         '<input type="text" name="sub_kategori[]" class="form-control edit-sub_kategori">' +
            //         '</div>' +
            //         '<div class="form-group">' +
            //         '<label class="col-form-label">Link Sub Kategori</label>' +
            //         '<input type="text" name="link[]" class="form-control edit-link">' +
            //         '</div>' +
            //         '<a class="btn btn-primary add-more-btn">Add</a>' +
            //         '</div>' +
            //         '</div>');
            //     $('.row_form').append(newRow);
            // });
        });

        $(document).ready(function() {
            $("#edit-dynamic").click(function() {
                ++i;
                $("#form-repeater-edit").append(
                    '<div class="input-group mb-3"><input type="text" name="addMoreInputFields[' + i +
                    '][link]" placeholder="Enter Link" class="form-control" /><div class="input-group-append"><button type="button" class="btn btn-danger remove-input-field">Delete</button></div></div>'
                );
            });

            $(document).on('click', '.remove-input-field', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
@endpush
