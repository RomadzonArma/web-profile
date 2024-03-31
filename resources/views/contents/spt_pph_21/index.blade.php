@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header rounded-lg" style="background-color: #365984; color: white;">
                @if (rbacCheck('s_p_t_p_p_h21', 2))
                    <div class="text-sm-right">
                        <button type="button"
                            class="btn btn-rounded waves-effect waves-light btn-tambah"
                            style="background-color: #E59537; color: white;"
                            onclick="tambah();">
                            <i class="bx bx-plus-circle mr-1"></i> Tambah
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table class="table table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 10%;">Gambar</th>
                                <th>Judul</th>
                                <th style="width: 20%;">Dokumen</th>
                                <th style="width: 15%;">Aksi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-custom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-customLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #365984;">
                    <h5 class="modal-title text-white mt-0" id="modal-customLabel">Form SPT PPH 21</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                    
                </div>
            </div>
        </div><!-- /.modal-content -->
</div><!-- /.modal -->
@endsection

@push('scripts')
<script>
    let table;
    $(() => {
        load_table();
    })

    function load_table() { 
        table = $('#table-data').DataTable({
            language: dtLang,
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('spt_pph_21.data') }}",
                type: 'get',
                dataType: 'json'
            },
            order: [
                [5, 'desc']
            ],
            columnDefs: [{
                targets: [0, 4],
                orderable: false,
                searchable: false,
                className: 'text-center align-middle'
            }, {
                targets: [1, 2],
                className: 'text-left align-middle'
            }, {
                targets: [3],
                className: 'text-center align-middle'
            }, {
                targets: [5],
                visible: false,
            }],
            columns: [{
                data: 'DT_RowIndex'
            }, {
                data: 'gambar',
                render: (data, type, row) => {
                    return data ? `<img src="${data}" style="height: 100px">` : '-';
                }
            }, {
                data: 'judul',
            }, {
                data: 'files',
            }, {
                data: 'id',
                render: (data, type, row) => {
                    const button_edit = $('<a>', {
                        class: 'btn btn-primary btn-update',
                        html: '<i class="bx bx-pencil"></i>',
                        href: 'javascript:void(0);',
                        'data-id': data,
                        title: 'Update Data',
                        'data-placement': 'top',
                        'data-toggle': 'tooltip'
                    });

                    const button_delete = $('<button>', {
                        class: 'btn btn-danger btn-delete',
                        html: '<i class="bx bx-trash"></i>',
                        'data-id': data,
                        title: 'Delete Data',
                        'data-placement': 'top',
                        'data-toggle': 'tooltip'
                    });

                    const button_detail = $('<button>', {
                        class: 'btn btn-secondary btn-detail',
                        html: '<i class="bx bx-eye"></i>',
                        'data-id': data,
                        title: 'Detail Data',
                        'data-placement': 'top',
                        'data-toggle': 'tooltip'
                    });

                    return $('<div>', {
                        class: 'btn-group',
                        html: () => {
                            let arr = [];

                            if (permissions.update) {
                                arr.push(button_edit)
                            }
                            if (permissions.delete) arr.push(button_delete)
                            return arr;
                        }
                    }).prop('outerHTML');
                }
            },{
                data: 'created_at',
            }]
        })
     }

    function tambah() { 
        $.ajax({
            type: "POST",
            url: "{{ route('spt_pph_21.form') }}",
            data: {},
            dataType: "HTML",
            beforeSend: () => {
                $('#modal-custom').find('.modal-body').html(`<div class="d-flex align-items-center justify-content-center" style="min-height: 300px;"><img src="{{ asset('assets/images/loading.gif') }}" style="width: auto;"></div>`)
                $('#modal-custom').find('#modal-customLabel').html(`Form Tambah SPT PPH 21`)
                $('#modal-custom').modal('show')
            }
        }).then(res => {
            $('#modal-custom').find('.modal-body').html(res)
        })
    }

    $('#table-data').on('click', '.btn-update', function () {
        let tr = $(this).closest('tr');
        let data = table.row(tr).data();
        console.log(data)
        $.ajax({
            type: "POST",
            url: "{{ route('spt_pph_21.form') }}",
            data: {
                id: data.id
            },
            dataType: "HTML",
            beforeSend: () => {
                $('#modal-custom').find('.modal-body').html(`<div class="d-flex align-items-center justify-content-center" style="min-height: 300px;"><img src="{{ asset('assets/images/loading.gif') }}" style="width: auto;"></div>`)
                $('#modal-custom').find('#modal-customLabel').html(`Form Ubah SPT PPH 21`)
                $('#modal-custom').modal('show')
            }
        }).then(res => {
            $('#modal-custom').find('.modal-body').html(res)
        })
    })

    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();
        let {
            id,
            judul
        } = data;

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus data "<b>${judul}</b>"!`,
            footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('spt_pph_21.delete') }}",
                    type: 'DELETE',
                    data: {
                        id,
                    }
                }).then(res => {
                    Swal.fire({
                            icon: "success",
                            title: "Berhasil menghapus data!",
                            text: "Data berhasil dihapus",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    // Reload tabel setelah penghapusan data
                    table.ajax.reload()

                }).catch(err => {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal menghapus data!",
                        text: "Terjadi kesalahan saat menghapus data",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
            }
        });
    });

    function lihat_dokumen(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('spt_pph_21.lihat_dokumen') }}",
            data: {id:id},
            dataType: "HTML",
            beforeSend: () => {
                $('#modal-custom').find('.modal-body').html(`<div class="d-flex align-items-center justify-content-center" style="min-height: 300px;"><img src="{{ asset('assets/images/loading.gif') }}" style="width: auto;"></div>`)
                $('#modal-custom').find('#modal-customLabel').html(`Lihat Dokumen SPT PPH 21`)
                $('#modal-custom').modal('show')
            }
        }).then(res => {
            $('#modal-custom').find('.modal-body').html(res)
        })
    }

    function upload_dokumen(ctx) {
        let formData = new FormData()
        let files = $(ctx)[0].files;
        for (const key in files) {
            if (Object.hasOwnProperty.call(files, key)) {
                const file = files[key];
                formData.append('dokumen[]', file)
            }
        }
        formData.append('id', $(ctx).data('id'))
            
        $.ajax({
            type: "POST",
            url: "{{ route('spt_pph_21.upload_dokumen') }}",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: () => {
                Swal.fire({
                    icon: 'info',
                    title: "Mohon ditunggu...",
                    didOpen: () => Swal.showLoading(),
                    showConfirmButton: false,
                    showCancelButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            }
        }).then(res => {
            Swal.close()
            if (res.status) {
                showSuccessToastr('Sukses', res.message);
                table.ajax.reload(null, false)
            } else {
                showErrorToastr('Gagal', res.message);
            }
        }).catch(err => {
            Swal.close()
            console.error(err)
            showErrorToastr('Gagal', 'Terjadi kesalahan.');
        })
    }

</script>
@endpush
