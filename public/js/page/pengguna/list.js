let table;
$(() => {

    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();

        let { id, judul } = data;

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
                    showSuccessToastr('sukses', 'Pengguna berhasil dihapus');
                    table.ajax.reload();
                }).fail((res) => {
                    let { status, responseJSON } = res;
                    showErrorToastr('oops', responseJSON.message);
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
        order: [[4, 'desc']],
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
            targets: [4],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, {
            data: 'judul',
        }, {
            data: 'kategori'
        }, {
            data: 'id',
            render: (data, type, row) => {
                const button_edit = $('<a>', {
                    class: 'btn btn-primary btn-update',
                    html: '<i class="bx bx-pencil"></i>',
                    href: BASE_URL + 'informasi-publik/update/'+row.id,
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
