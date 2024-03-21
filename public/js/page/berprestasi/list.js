let table;
$(() => {

    $("input[name=jenis]").on("change", function () {
        var val = $("input[name=jenis]:checked").val();
        if (val == "link") {
            $(".row_link").css("display", "block");
            $(".row_video").css("display", "none");
        } else if (val == "video") {
            $(".row_link").css("display", "none");
            $(".row_video").css("display", "block");
        }
    });

    $("input[name=jenis-edit]").on("change", function () {
        // Get the value of the checked radio button
        var val = $("input[name=jenis-edit]:checked").val();
        // Show/hide divs based on the selected value
        if (val == "link") {
            $(".row_link").css("display", "block");
            $(".row_video").css("display", "none");
        } else if (val == "video") {
            $(".row_link").css("display", "none");
            $(".row_video").css("display", "block"); // Corrected class name
        }
    });

    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();

        let { id, judul } = data;

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus Data "<b>${judul}</b>"!`,
            footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'kspstk-berprestasi/delete', {
                    id,
                    _method: 'DELETE'
                }).done((res) => {
                    showSuccessToastr('sukses', 'data berhasil dihapus');
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

        $.post(BASE_URL + 'kspstk-berprestasi/switch', {
            id,
            value,
            _method: 'PATCH'
        }).done((res) => {
            showSuccessToastr('sukses', value == '1' ? 'data berhasil diaktifkan' : 'data berhasil dinonaktifkan');
            table.ajax.reload();
        }).fail((res) => {
            let { status, responseJSON } = res;
            showErrorToastr('oops', responseJSON.message);
            console.log(res);
        })
    })

    $('#form-berprestasi-update').on('submit', function (e) {
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
                $('#modal-berprestasi-update').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-berprestasi-update').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-berprestasi-update').modal('hide');
                showSuccessToastr('sukses', 'data berhasil diubah');
            },
            // error: ({ status, responseJSON }) => {
            //     $('#modal-berprestasi-update').find('.modal-dialog').LoadingOverlay('hide', true);

            //     if (status == 422) {
            //         generateErrorMessage(responseJSON, true);
            //         return false;
            //     }

            //     showErrorToastr('oops', responseJSON.msg);
            // }
            error: function (xhr, status, error) {
                $('#modal-berprestasi-update').find('.modal-dialog').LoadingOverlay('hide', true);

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

    $('#manualCheckbox').change(function () {
        if ($(this).is(':checked')) {
            $('#linkGroup').hide();
            $('#videoGroup').show();
        } else {
            $('#linkGroup').show();
            $('#videoGroup').hide();
        }
    });

    $('#modal-berprestasi').on('hidden.bs.modal', function () {
        $('#manualCheckbox').prop('checked', false);
        $('#linkGroup').show();
        $('#videoGroup').hide();
    });

    $('#updateManualCheckbox').change(function () {
        if ($(this).is(':checked')) {
            $('#updateLinkGroup').hide();
            $('#updateVideoGroup').show();
        } else {
            $('#updateLinkGroup').show();
            $('#updateVideoGroup').hide();
        }
    });

    $('#modal-berprestasi-update').on('hidden.bs.modal', function () {
        $('#form-berprestasi-update')[0].reset();
        $('#updateLinkGroup').show();
        $('#updateVideoGroup').hide();
    });

    $('#table-data').on('click', '.btn-update', function () {
        var tr = $(this).closest('tr');
        var data = table.row(tr).data();

        clearErrorMessage();
        $('#form-berprestasi-update')[0].reset();

        $.each(data, (key, value) => {
            $('#update-' + key).val(value);
        })
        $('#foto').html('<img src="' + '' + data.foto + '" style="height: 200px; margin-top: 5px;">');

        if (data.video !== null && data.video !== '') {
            $('#updateManualCheckbox').prop('checked', true);
            $('#updateLinkGroup').hide();
            $('#updateVideoGroup').show();

            $('#btn-open-video').show();
        } else {
            $('#updateManualCheckbox').prop('checked', false);
            $('#updateLinkGroup').show();
            $('#updateVideoGroup').hide();

            $('#btn-open-video').hide();
        }
        if (data.link !== null && data.link !== "") {
            $(".row_link").css("display", "block");
            $(".row_video").css("display", "none");
        } else {
            $(".row_link").css("display", "none");
            $(".row_video").css("display", "block");
        }

        $('#modal-berprestasi-update').modal('show');
    })

    $('#modal-berprestasi-update').on('click', '#btn-open-video', function() {
        console.log(videoPath);
        var videoPath = $('#video_edit').val();
        if (videoPath) {
            window.open(videoPath, '_blank');
        }
    });

    $('#form-berprestasi').on('submit', function (e) {
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
                $('#modal-berprestasi').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-berprestasi').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-berprestasi').modal('hide');
                showSuccessToastr('sukses', 'data berhasil ditambahkan');
            },
            error: ({ status, responseJSON }) => {
                $('#modal-berprestasi').find('.modal-dialog').LoadingOverlay('hide', true);

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg);
            }
        })
    })

    $('.btn-tambah').on('click', function () {
        $('#form-berprestasi')[0].reset();
        clearErrorMessage();
        $('#modal-berprestasi').modal('show');
    });

    table = $('#table-data').DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + 'kspstk-berprestasi/data',
            type: 'get',
            dataType: 'json'
        },
        order: [[6, 'desc']],
        columnDefs: [{
            targets: [0, 5],
            orderable: false,
            searchable: false,
            className: 'text-center align-top'
        }, {
            targets: [1, 2],
            className: 'text-left align-top'
        }, {
            targets: [4],
            className: 'text-center align-top'
        }, {
            targets: [6],
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
                return data ? '<img src="' + data + '" style="height: 50px">' : '-';
            }
        }, {
            data: 'link',
            render: (data, type, row) => {
                return data ?? '-';
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
