let table;
$(() => {

    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();

        let {
            id,
            judul
        } = data;

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus pengguna "<b>${judul}</b>"!`,
            footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'informasi-publik/delete', {
                    id,
                    _method: 'DELETE'
                }).done((res) => {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil menghapus data!",
                        text: "Data berhasil dihapus",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table.ajax.reload();
                }).fail((res) => {
                    let {
                        status,
                        responseJSON
                    } = res;
                    Swal.fire({
                        icon: "error",
                        title: "Gagal menghapus data!",
                        text: "Terjadi kesalahan saat menghapus data",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
            }
        })
    })


    table = $('#table-data').DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + 'informasi-publik/data',
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
            targets: [7],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, {
            data: 'judul',
        }, {
            data: 'list_kategori.list_kanal.nama_kanal'
        }, {
            data: 'list_kategori.nama_kategori'
        }, {
            data: 'jumlah_lihat',
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
                    href: BASE_URL + 'informasi-publik/update/' + row.id,
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

$('#table-data').on('change', '.switch-active', function () {
    var id = $(this).data('id');
    var value = $(this).prop('checked') ? 1 : 0;


    $.post(BASE_URL + 'informasi-publik/switch', {
        id,
        value,
        _method: 'PATCH'
    }).done((res) => {
        showSuccessToastr('sukses', value == '1' ? 'Informasi publik berhasil di publish' : 'Informasi publik berhasil di unpublish');
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
