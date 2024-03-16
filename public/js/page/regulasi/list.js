let table;
$(() => {
    function preview(target, image) {
        $(target).attr("src", window.URL.createObjectURL(image)).show();
    }

    $('#table-data').on('change', '.switch-active', function () {
        var id = $(this).data('id');
        var value = $(this).val();

        $.post(BASE_URL + 'regulasi/switch', {
            id,
            value,
            _method: 'PATCH'
        }).done((res) => {
            showSuccessToastr('sukses', value == '1' ? 'Regulasi berhasil diaktifkan' : 'Regulasi berhasil dinonaktifkan');
            table.ajax.reload();
        }).fail((res) => {
            let { status, responseJSON } = res;
            showErrorToastr('oops', responseJSON.message);
            console.log(res);
        })
    })

    $("#table-data").on("click", ".btn-delete", function () {
        let data = table.row($(this).closest("tr")).data();

        let { id, judul } = data;

        Swal.fire({
            title: "Anda yakin?",
            html: `Anda akan menghapus regulasi "<b>${judul}</b>"!`,
            footer: "Data yang sudah dihapus tidak bisa dikembalikan kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + "regulasi/delete",
                    type: "POST",
                    data: {
                        id,
                        _method: "DELETE",
                    },
                    success: (res) => {
                        Swal.fire({
                            icon: "success",
                            title: "Sukses",
                            text: "Regulasi berhasil dihapus",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            table.ajax.reload();
                        });
                    },
                    error: (res) => {
                        let { status, responseJSON } = res;
                        showErrorToastr("Oops", responseJSON.message);
                    },
                });
            }
        });
    });


    $("#form-update-regulasi").on("submit", function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: () => {
                clearErrorMessage();
                $("#modal-update-regulasi")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-update-regulasi")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                $("#modal-update-regulasi").modal("hide");

                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Data Regulasi berhasil diubah',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                $('#modal-update-regulasi').find('.modal-dialog').LoadingOverlay('hide', true);

                if (xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = 'Terjadi Kesalahan:<br>';

                    $.each(errors, function (key, value) {
                        errorMessage += value + '<br>';
                    });

                    // Tampilkan pesan error menggunakan SweetAlert
                    Swal.fire({
                        title: 'Error',
                        html: errorMessage,
                        icon: 'error'
                    });
                } else {
                    console.error('Error:', error);
                    // Tampilkan pesan kesalahan umum
                    Swal.fire('Error', 'Terjadi kesalahan. Silakan coba lagi nanti.', 'error');
                }
            }
        });
    });

    $("#table-data").on("click", ".btn-update", function () {
        let data = table.row($(this).closest("tr")).data();

        $("#form-update-regulasi")[0].reset();
        clearErrorMessage();

        let { id, judul, cover, file, id_kategori } = data;
        // console.log(id);
        $("#update-id").val(id);
        $("#update-id_kategori").val(id_kategori);
        $("#judul_edit").val(judul);
        $('#cover-preview').html('<img src="' + asset_url + 'storage/uploads/regulasi/cover/' + cover + '" alt="foto" style="width: 200px; height: 200px;">');
        $('#pdf_preview').attr('src', asset_url + 'storage/uploads/regulasi/file/' + file);

        $("#modal-update-regulasi").modal("show");
    });

    $("#form-regulasi").on("submit", function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: () => {
                clearErrorMessage();
                $("#modal-regulasi")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-regulasi")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                $("#modal-regulasi").modal("hide");

                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Data Regulasi berhasil disimpan',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                $('#modal-regulasi').find('.modal-dialog').LoadingOverlay('hide', true);

                if (xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = 'Terjadi Kesalahan:<br>';

                    $.each(errors, function (key, value) {
                        errorMessage += value + '<br>';
                    });

                    // Tampilkan pesan error menggunakan SweetAlert
                    Swal.fire({
                        title: 'Error',
                        html: errorMessage,
                        icon: 'error'
                    });
                } else {
                    console.error('Error:', error);
                    // Tampilkan pesan kesalahan umum
                    Swal.fire('Error', 'Terjadi kesalahan. Silakan coba lagi nanti.', 'error');
                }
            }
        });
    });


    $('.btn-tambah').on('click', function () {
        $('#form-regulasi')[0].reset();
        clearErrorMessage();
        $('#modal-regulasi').modal('show');
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "regulasi/data",
            type: "get",
            dataType: "json",
        },
        order: [[8, "desc"]],
        columnDefs: [
            {
                targets: [0, 6, 7],
                orderable: false,
                searchable: false,
            },
            {
                targets: [8],
                visible: false,
            },
        ],
        columns: [
            {
                data: "DT_RowIndex",
            },
            {
                data: "kategori.list_kanal.nama_kanal",
            },
            {
                data: "kategori.nama_kategori",
            },
            {
                data: "judul",
            },
            {
                data: "tanggal",
            },
            {
                data: "jumlah_lihat",
                render: function(data, type, row) {
                    return data ? data : '0';
                }
            },
            {
                data: 'is_active',
                render: (data, type, row) => {
                    return `
                    <div class="custom-control custom-switch mb-3" dir="ltr">
                        <input type="checkbox" class="custom-control-input switch-active" id="aktif-${row.id}" data-id="${row.id}" ${data == '1' ? 'checked' : ''} value="${data == '1' ? 0 : 1}">
                        <label class="custom-control-label" for="aktif-${row.id}">${data == '1' ? 'Aktif' : 'Nonaktif'}</label>
                    </div>
                    `;
                }
            },
            {
                data: "id",
                render: (data, type, row) => {
                    const button_edit = $("<button>", {
                        class: "btn btn-primary btn-update",
                        html: '<i class="bx bx-pencil"></i>',
                        "data-id": data,
                        title: "Update Data",
                        "data-placement": "top",
                        "data-toggle": "tooltip",
                    });

                    const button_delete = $("<button>", {
                        class: "btn btn-danger btn-delete",
                        html: '<i class="bx bx-trash"></i>',
                        "data-id": data,
                        title: "Delete Data",
                        "data-placement": "top",
                        "data-toggle": "tooltip",
                    });

                    return $("<div>", {
                        class: "btn-group",
                        html: () => {
                            let arr = [];


                            if (permissions.update) {
                                arr.push(button_edit);
                            }

                            if (permissions.delete) arr.push(button_delete);

                            return arr;
                        },
                    }).prop("outerHTML");
                },
            },
            {
                data: "created_at",
            },
        ],
    });
});

$(document).ready(function() {
    $('#id_kategori').select2();
});

$(document).ready(function() {
    $('#update-id_kategori').select2();
});

