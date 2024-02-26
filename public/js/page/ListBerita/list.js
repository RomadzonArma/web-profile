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
            html: `Anda akan menghapus data "<b>${judul}</b>"!`,
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
                    url: BASE_URL + 'list_berita/delete/' + id,
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
            url: BASE_URL + 'list_berita/data',
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
            targets: [9],
            visible: false,
        }],
        columns: [{
            data: 'DT_RowIndex'
        }, {
            data: 'judul',
        }, {
            data: 'list_kanal.nama_kanal',
        }, {
            data: 'list_kategori.nama_kategori',
        }, {
            data: 'status_headline',
            render: function(data) {
                if (data == 1) {
                    return 'Aktif';
                } else if (data == 0) {
                    return 'Tidak Aktif';
                } else {
                    return 'Nilai tidak valid';
                }
            }
        }, {
            data: 'date',
            render: function(data) {
                // Mengonversi string tanggal ke objek tanggal JavaScript
                var date = new Date(data);
                // Daftar nama bulan untuk digunakan dalam format
                var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                // Mendapatkan tanggal, bulan, dan tahun dari objek tanggal
                var day = date.getDate();
                var monthIndex = date.getMonth();
                var year = date.getFullYear();
                // Mendapatkan waktu dalam format 24 jam
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                // Menggabungkan semua komponen untuk membentuk format yang diinginkan
                var formattedDate = day + ' ' + monthNames[monthIndex] + ' ' + year + ' ' + (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                return formattedDate;
            }
        }, {
            data: 'counter',
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
                        // if (UPDATE) arr.push(button_edit)
                        if (permissions.delete) arr.push(button_delete)

                        return arr;
                    }
                }).prop('outerHTML');
            }
        },{
            data: 'created_at',
        }]
    })
})


$('#table-data').on('change', '.switch-active', function () {
    var id = $(this).data('id');
    var value = $(this).prop('checked') ? 1 : 0;


    $.post(BASE_URL + 'list_berita/switch', {
        id,
        value,
        _method: 'PATCH'
    }).done((res) => {
        showSuccessToastr('sukses', value == '1' ? 'Berita berhasil di publish' : 'User berhasil di unpublish');
        table.ajax.reload();
    }).fail((res) => {
        let { status, responseJSON } = res;
        showErrorToastr('oops', responseJSON.message);
        console.log(res);
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
