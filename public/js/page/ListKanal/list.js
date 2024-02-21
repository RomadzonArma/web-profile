let table;
$(() => {

    $('body').on('click', '.btn-tambah', function (e) {
        e.preventDefault(); //agar saat di klik tidak refresh
        $('#tambah-list-kanal').modal('show');

    })

    $('#tambah-list-kanal').on('shown.bs.modal', function (e) {
        $('#status_kanal').val('');
        $('#nama_kanal').val('');
    });

    $('.btn-simpan').click(function () {
        var nama_kanal = $('#nama_kanal').val();
        var status = $('#status_kanal').val();

        if (nama_kanal.trim() === '' || status.trim() === '') {
            Swal.fire({
                icon: "error",
                title: "Terdapat kolom inputan yang kosong",
                text: "Silakan coba lagi",
                showConfirmButton: false,
                timer: 1500
            });

            return;
        }

        //fungsi simpan
        $.ajax({
            url: BASE_URL + 'list_kanal/store',
            type: 'POST',
            data: {
                nama_kanal: nama_kanal,
                status: status,
            },
            success: function (response) {
                $('#table-data').DataTable().ajax.reload();
                $('#tambah-list-kanal').modal('hide');
                Swal.fire({
                    icon: "success",
                    title: "Berhasil Menyimpan data!",
                    text: "Data berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1500
                });

            },
            error: function (response) {
                $('#table-data').DataTable().ajax.reload();
                $('#tambah-list-kanal').modal('hide');
                Swal.fire({
                    icon: "error",
                    title: "Gagal Menyimpan data!",
                    text: "Terjadi kesalahan saat menyimpan data",
                    showConfirmButton: false,
                    timer: 1500
                });
            }

        });
    });



    $('#table-data').on('click', '.btn-delete', function () {
        let data = table.row($(this).closest('tr')).data();
        let {
            id,
            nama_kanal
        } = data;

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus data "<b>${nama_kanal}</b>"!`,
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
                    url: BASE_URL + 'list_kanal/delete/' + id,
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
            url: BASE_URL + 'list_kanal/data',
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
            targets: [4],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, {
            data: 'nama_kanal',
        }, {
            data: 'status',
            render: function (data, type, full, meta) {
                return data === 1 ? 'Active' : 'Inactive';
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

$('body').on('click', '.btn-update', function (e) {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + 'list_kanal/edit/' + id,
        type: 'GET',
        success: function (response) {
            $('#edit-list-kanal').modal('show');
            $('#nama_kanal_edit').val(response.result.nama_kanal);
            $('#status_kanal_edit').val(response.result.status);

            $('.edit-data').click(function () {
                var nama_kanal = $('#nama_kanal_edit').val();
                var status = $('#status_kanal_edit').val();

                if (nama_kanal.trim() === '' || status.trim() === '') {
                    Swal.fire({
                        icon: "error",
                        title: "Terdapat kolom inputan yang kosong",
                        text: "Silakan coba lagi",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    return;
                }


                $.ajax({
                    url: BASE_URL + 'list_kanal/update/' + id,
                    // url: 'magang_data/' + id,
                    type: 'POST',
                    data: {
                        nama_kanal: nama_kanal,
                        status: status,

                    },
                    success: function (response) {
                        $('#table-data').DataTable().ajax.reload();
                        $('#edit-list-kanal').modal('hide');
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil Mengedit Data!",
                            text: "Data berhasil diedit",
                            showConfirmButton: false,
                            timer: 1500
                        });


                    },
                    error: function (response) {
                        $('#table-data').DataTable().ajax.reload();
                        $('#modal-edit').modal('hide');

                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengedit Data!",
                            text: "Terjadi kesalahan saat mengedit data",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                });
            });
        }
    })
})
