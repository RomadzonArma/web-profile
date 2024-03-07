let table;
$(() => {

    $('body').on('click', '.btn-tambah', function (e) {
        e.preventDefault(); //agar saat di klik tidak refresh
        $('#tambah-list-tautan').modal('show');

    })

    $('#tambah-list-tautan').on('shown.bs.modal', function (e) {
        $("#form-store").trigger('reset');
    });




    $("#form-store").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let url = $(this).attr("action");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                Swal.fire({
                    title: "Mohon Tunggu",
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                    showConfirmButton: false,
                    showCancelButton: false,
                });
            },
            success: function (response) {
                Swal.close();
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Berhasil Menyimpan Data",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        window.location.href = BASE_URL + 'tautan';
                    });
                } else {
                    toastr.error("Periksa Inputan Anda", {
                        timeOut: 2000,
                        fadeOut: 2000,
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.close();
                toastr.error("Ada inputan yang belum terisi", "Gagal", {
                    timeOut: 2000,
                    fadeOut: 2000,
                });
            }
        });
    });


    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();
        let {
            id,
            list_kategori,
        } = data;


        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus data "<b>${list_kategori.nama_kategori}</b>"!`,
            footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'tautan/delete/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil menghapus data!",
                            text: "Data berhasil dihapus",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Reload tabel setelah penghapusan data
                        $('#table-data').DataTable().ajax.reload();
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal menghapus data!",
                            text: "Terjadi kesalahan saat menghapus data",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        });
    });

    table = $('#table-data').DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + 'tautan/data',
            type: 'get',
            dataType: 'json'
        },
        order: [
            [4, 'desc']
        ],
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
            targets: [6],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, {
            data: 'list_kategori.nama_kategori',
        }, {
            data: 'list_kategori.list_kanal.nama_kanal',
        }, {
            data: 'link_tautan',
        }, {
            data: 'status_publish',
            render: (data, type, row) => {
                return `
                <div class="custom-control custom-switch mb-3" dir="ltr">
                    <input type="checkbox" class="custom-control-input switch-active" id="aktif-${row.id}" data-id="${row.id}" ${data == '1' ? 'checked' : ''} value="${data == '1' ? 0 : 1}">
                    <label class="custom-control-label" for="aktif-${row.id}">${data == '1' ? 'Publish' : 'Unpublish'}</label>
                </div>
                `;
            }
        }, {
            data: 'id',
            render: (data, type, row) => {
                const button_edit = $('<a>', {
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
            data: 'created_at',
        }]
    })
})


$('#table-data').on('change', '.switch-active', function () {
    var id = $(this).data('id');
    var value = $(this).prop('checked') ? 1 : 0;


    $.post(BASE_URL + 'list_agenda/switch', {
        id,
        value,
        _method: 'PATCH'
    }).done((res) => {
        showSuccessToastr('sukses', value == '1' ? 'Agenda berhasil di publish' : 'Agenda berhasil di unpublish');
        table.ajax.reload();
    }).fail((res) => {
        let {
            status,
            responseJSON
        } = res;
        showErrorToastr('oops', responseJSON.message);
        console.log(res);
    })
})

$('body').on('click', '.btn-update', function (e) {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + 'tautan/edit/' + id,
        type: 'GET',
        success: function (response) {
            $('#edit-list-tautan').modal('show');
            $('#id_kategori_edit').val(response.result.id_kategori);
            $('#link_tautan_edit').val(response.result.link_tautan);




            $("#form-update").submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: BASE_URL + 'tautan/update/' + id,
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function () {
                        Swal.fire({
                            title: "Mohon Tunggu",
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            },
                            showConfirmButton: false,
                            showCancelButton: false,
                        });
                    },
                    success: function (response) {
                        Swal.close();
                        if (response.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Sukses",
                                text: "Berhasil Menyimpan Data",
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(() => {
                                window.location.href = BASE_URL + 'tautan';
                            });
                        } else {
                            toastr.error("Periksa Inputan Anda", {
                                timeOut: 2000,
                                fadeOut: 2000,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.close();
                        toastr.error("Ada inputan yang belum terisi", "Gagal", {
                            timeOut: 2000,
                            fadeOut: 2000,
                        });
                    }
                });
            });
        }
    })
})
