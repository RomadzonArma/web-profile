let table;
$(() => {
    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();

        let { id, judul } = data;

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus Swiper "<b>${judul}</b>"!`,
            footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'swiper/delete', {
                    id,
                    _method: 'DELETE'
                }).done((res) => {
                    showSuccessToastr('sukses', 'Swiper berhasil dihapus');
                    table.ajax.reload();
                }).fail((res) => {
                    let { status, responseJSON } = res;
                    showErrorToastr('oops', responseJSON.message);
                })
            }
        })
    })

    $('#table-data').on('change', '.switch-active', function () {
        var id = $(this).data('id');
        var value = $(this).val();

        $.post(BASE_URL + 'swiper/switch', {
            id,
            value,
            _method: 'PATCH'
        }).done((res) => {
            showSuccessToastr('sukses', value == '1' ? 'Swiper berhasil diaktifkan' : 'Swiper berhasil dinonaktifkan');
            table.ajax.reload();
        }).fail((res) => {
            let { status, responseJSON } = res;
            showErrorToastr('oops', responseJSON.message);
            console.log(res);
        })
    })

    $('#form-swiper-update').on('submit', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                clearErrorMessage();
                $('#modal-swiper-update').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-swiper-update').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-swiper-update').modal('hide');
                showSuccessToastr('sukses', 'Swiper berhasil diubah');
            },
            // error: ({ status, responseJSON }) => {
            //     $('#modal-swiper-update').find('.modal-dialog').LoadingOverlay('hide', true);

            //     if (status == 422) {
            //         generateErrorMessage(responseJSON, true);
            //         return false;
            //     }

            //     showErrorToastr('oops', responseJSON.msg);
            // }
            error: function (xhr, status, error) {
                $('#modal-swiper-update').find('.modal-dialog').LoadingOverlay('hide', true);

                if (xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = 'Terjadi Kesalahan:<br>';

                    $.each(errors, function (key, value) {
                        errorMessage += value + '<br>';
                    });

                    Swal.fire({
                        title: 'Error',
                        html: errorMessage,
                        icon: 'error'
                    });
                } else {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Terjadi kesalahan. Silakan coba lagi nanti.', 'error');
                }
            }
        })
    })

    $('#table-data').on('click', '.btn-update', function () {
        var tr = $(this).closest('tr');
        var data = table.row(tr).data();

        clearErrorMessage();
        $('#form-swiper-update')[0].reset();

        $.each(data, (key, value) => {
            $('#update-' + key).val(value);
        })

        $('#modal-swiper-update').modal('show');
    })

    $('#form-swiper').on('submit', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                clearErrorMessage();
                $('#modal-swiper').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-swiper').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-swiper').modal('hide');
                showSuccessToastr('sukses', 'Swiper berhasil ditambahkan');
            },
            error: ({ status, responseJSON }) => {
                $('#modal-swiper').find('.modal-dialog').LoadingOverlay('hide', true);

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg);
            }
        })
    })

    $('.btn-tambah').on('click', function () {
        $('#form-swiper')[0].reset();
        clearErrorMessage();
        $('#modal-swiper').modal('show');
    });

    table = $('#table-data').DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + 'swiper/data',
            type: 'get',
            dataType: 'json'
        },
        order: [[5, 'desc']],
        columnDefs: [{
            targets: [0, 4],
            orderable: false,
            searchable: false,
            className: 'text-center align-top'
        }, {
            targets: [1, 2],
            className: 'text-left align-top'
        }, {
            targets: [3],
            className: 'text-center align-top'
        }, {
            targets: [5],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, {
            data: 'judul',
            render: (data, type, row) => {
                return data ?? '-';
            }
        }, {
            data: 'foto',
            render: (data, type, row) => {
                return '<img src="' + data + '" style="height: 50px">' ?? '-';
            }
        }, {
            data: 'is_active',
            render: (data, type, row) => {
                return `
                <div class="custom-control custom-switch mb-3" dir="ltr">
                    <input type="checkbox" class="custom-control-input switch-active" id="aktif-${row.id}" data-id="${row.id}" ${data == '1' ? 'checked' : ''} value="${data == '1' ? 0 : 1}">
                    <label class="custom-control-label" for="aktif-${row.id}">${data == '1' ? 'Aktif' : 'Nonaktif'}</label>
                </div>
                `;
            }
        }, {
            data: 'id',
            render: (data, type, row) => {
                const button_edit = $('<button>', {
                    class: 'btn btn-primary btn-update',
                    html: '<i class="bx bx-pencil"></i>',
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

                return $('<div>', {
                    class: 'btn-group',
                    html: () => {
                        let arr = [];

                        if (permissions.update) {
                            arr.push(button_edit)
                        }
                        // if (UPDATE) arr.push(button_edit)
                        if (permissions.delete) arr.push(button_delete)

                        return arr;
                    }
                }).prop('outerHTML');
            }
        }, {
            data: 'created_at'
        }]
    })
})
