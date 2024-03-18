let table;
$(() => {

    $('body').on('click', '.btn-tambah', function (e) {
        e.preventDefault(); //agar saat di klik tidak refresh
        $('#tambah-list-kategori').modal('show');

    })

    $('#tambah-list-kategori').on('shown.bs.modal', function (e) {
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
                        window.location.href = BASE_URL + 'list_kategori';
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
            nama_kategori
        } = data;

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus data "<b>${nama_kategori}</b>"!`,
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
                    url: BASE_URL + 'list_kategori/delete/' + id,
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
            url: BASE_URL + 'list_kategori/data',
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
            targets: [5],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, {
            data: 'nama_kategori',
        }, {
            data: 'list_kanal.nama_kanal',
        }, {
            data: 'status',
            render: (data, type, row) => {
                return `
                <div class="custom-control custom-switch mb-3" dir="ltr">
                    <input type="checkbox" class="custom-control-input switch-active" id="aktif-${row.id}" data-id="${row.id}" ${data == '1' ? 'checked' : ''} value="${data == '1' ? 0 : 1}">
                    <label class="custom-control-label" for="aktif-${row.id}">${data == '1' ? 'Active' : 'In Active'}</label>
                </div>
                `;
            }
        }, {
            data: 'id',
            render: (data, type, row) => {
                const button_edit = $('<a>', {
                    class: 'btn btn-primary btn-update',
                    html: '<i class="bx bx-pencil"></i>',
                    // href: BASE_URL + 'list_kanal/edit/' + row.id,
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

// $('body').on('click', '.btn-update', function (e) {
//     var id = $(this).data('id');

//     $.ajax({
//         url: BASE_URL + 'list_kategori/edit/' + id,
//         type: 'GET',
//         success: function (response) {
//             $('#edit-list-kategori').modal('show');
//             $('#nama_kategori_edit').val(response.result.nama_kategori);
//             $('#status_kategori_edit').val(response.result.status);
//             $('#id_kanal_edit').val(response.result.id_kanal);

//             $('.edit-data').click(function () {
//                 var nama_kanal = $('#nama_kanal_edit').val();
//                 var status = $('#status_kategori_edit').val();
//                 var nama_kategori = $('#nama_kategori_edit').val();

//                 console.log(nama_kanal);
//                 console.log(status);
//                 console.log(nama_kategori);

//                 if (nama_kanal=== '' || status === '' || nama_kategori === '') {
//                     Swal.fire({
//                         icon: "error",
//                         title: "Terdapat kolom inputan yang kosong",
//                         text: "Silakan coba lagi",
//                         showConfirmButton: false,
//                         timer: 1500
//                     });

//                     return;
//                 }


//                 $.ajax({
//                     url: BASE_URL + 'list_kategori/update/' + id,
//                     type: 'POST',
//                     data: {
//                         nama_kanal: nama_kanal,
//                         status: status,
//                         nama_kategori: nama_kategori,

//                     },
//                     success: function (response) {
//                         $('#table-data').DataTable().ajax.reload();
//                         $('#edit-list-kategori').modal('hide');
//                         Swal.fire({
//                             icon: "success",
//                             title: "Berhasil Mengedit Data!",
//                             text: "Data berhasil diedit",
//                             showConfirmButton: false,
//                             timer: 1500
//                         });


//                     },
//                     error: function (response) {
//                         $('#table-data').DataTable().ajax.reload();
//                         $('#edit-list-kategori').modal('hide');

//                         Swal.fire({
//                             icon: "error",
//                             title: "Gagal Mengedit Data!",
//                             text: "Terjadi kesalahan saat mengedit data",
//                             showConfirmButton: false,
//                             timer: 1500
//                         });
//                     }

//                 });
//             });
//         }
//     })
// })

$('body').on('click', '.btn-update', function (e) {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + 'list_kategori/edit/' + id,
        type: 'GET',
        success: function (response) {
            $('#edit-list-kategori').modal('show');
            $('#nama_kategori_edit').val(response.result.nama_kategori);
            $('#id_kanal_edit').val(response.result.id_kanal);



            $("#form-update").submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: BASE_URL + 'list_kategori/update/' + id,
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
                                window.location.href = BASE_URL + 'list_kategori';
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


$('#table-data').on('change', '.switch-active', function () {
    var id = $(this).data('id');
    var value = $(this).prop('checked') ? 1 : 0;


    $.post(BASE_URL + 'list_kategori/switch', {
        id,
        value,
        _method: 'PATCH'
    }).done((res) => {
        showSuccessToastr('sukses', value == '1' ? 'Kategori berhasil di aktifkan' : 'kategori berhasil di non aktifkan');
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
