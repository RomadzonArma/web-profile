let table;
$(() => {



    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();
        let {
            id,
            nama,
            email,
        } = data;


        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus pertanyaan dari "<b>${nama}</b>" dengan email "<b>${email}</b>"!`,
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
                    url: BASE_URL + 'faq/delete/' + id,
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
            url: BASE_URL + 'faq/data',
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
            data: 'nama',
            render: (data, type, row) => {
                return `
                <p >${row.nama ?? '-'}</p>
                    <span class="badge badge-primary">${row.email ?? '-'}</span>
                `;
            }
        }, {
            data: 'pertanyaan',
        }, {
            data: 'jawaban',
            render: (data, type, row) => {
                return `
                <p >${row.jawaban ?? '-'}</p>
                `;
            }
        }, {
            data: 'user.name',
            render: (data, type, row) => {
                return `<p>${data ?? '-'}</p>`;
            }

        }, {
            data: 'id',
            render: (data, type, row) => {
                const button_edit = $('<a>', {
                    class: 'btn btn-primary btn-update',
                    html: '<i class="bx bx-pencil"></i>',
                    'data-id': data,
                    title: 'Jawab Pertanyaan',
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



$('body').on('click', '.btn-update', function (e) {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + 'faq/edit/' + id,
        type: 'GET',
        success: function (response) {
            $('#edit-list-faq').modal('show');
            console.log(response.result.jawaban);
            $('#jawaban').val(response.result.jawaban);




            $("#form-update").submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: BASE_URL + 'faq/update/' + id,
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
                                text: "Jawaban berhasil dikirim",
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(() => {
                                window.location.href = BASE_URL + 'faq';
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


$(document).ready(function () {
    $('#id_kategori').select2();
});

$(document).ready(function () {
    $('#id_kategori_edit').select2();
});
