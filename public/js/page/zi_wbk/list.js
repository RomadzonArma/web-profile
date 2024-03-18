let table;
$(() => {
    $('input[name=jenis]').on('change', function () {
        var val = $('input[name=jenis]:checked').val();
        if (val == 'link') {
            $('.row_link').css('display', 'block');
            $('.row_form').css('display', 'none');
        } else if (val == 'form') {
            $('.row_link').css('display', 'none');
            $('.row_form').css('display', 'block');
        }
    });
    $('input[name=jenis-edit]').on('change', function () {
        var val = $('input[name=jenis-edit]:checked').val();
        if (val == 'link') {
            $('.row_link').css('display', 'block');
            $('.row_form').css('display', 'none');
        } else if (val == 'form') {
            $('.row_link').css('display', 'none');
            $('.row_form_edit').css('display', 'block');
        }
    });
    $(document).ready(function () {
        // Memanggil fungsi untuk menangani tampilan berdasarkan nilai radio yang terpilih
        handleRadioChange();
    });
    $('#modal-ziwbk').on('shown.bs.modal', function (e) {
        $("#form-ziwbk").trigger('reset');
    });


    $('#table-data').on('change', '.switch-active', function () {
        var id = $(this).data('id');
        var value = $(this).prop('checked') ? 1 : 0;


        $.post(BASE_URL + 'zi_wbk/switch', {
            id,
            value,
            _method: 'PATCH'
        }).done((res) => {
            showSuccessToastr('sukses', value == '1' ? 'ZI/WBK berhasil di publish' : 'ZI/WBK berhasil di unpublish');
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

    $("#table-data").on("click", ".btn-delete", function () {
        let data = table.row($(this).closest("tr")).data();

        let {
            id,
            sub_kategori
        } = data;

        Swal.fire({
            title: "Anda yakin?",
            html: `Anda akan menghapus!`,
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
                    url: BASE_URL + "zi_wbk/delete",
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
                            timer: 2000,
                        }).then(() => {
                            table.ajax.reload();
                        });
                    },
                    error: (res) => {
                        let {
                            status,
                            responseJSON
                        } = res;
                        showErrorToastr("Oops", responseJSON.message);
                    },
                });
            }
        });
    });

    $("#form-update-ziwbk").on("submit", function (e) {
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
                $("#modal-update-ziwbki")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-update-ziwbk")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                $("#modal-update-ziwbk").modal("hide");

                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: "Data Regulasi berhasil diubah",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(() => {
                    table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                $("modal-update-ziwbk")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);

                if (xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "Terjadi Kesalahan:<br>";

                    $.each(errors, function (key, value) {
                        errorMessage += value + "<br>";
                    });

                    // Tampilkan pesan error menggunakan SweetAlert
                    Swal.fire({
                        title: "Error",
                        html: errorMessage,
                        icon: "error",
                    });
                } else {
                    console.error("Error:", error);
                    // Tampilkan pesan kesalahan umum
                    Swal.fire(
                        "Error",
                        "Terjadi kesalahan. Silakan coba lagi nanti.",
                        "error"
                    );
                }
            },
        });
    });
    $("#table-data").on("click", ".btn-update", function () {
        let data = table.row($(this).closest("tr")).data();

        // Reset form and clear error messages
        $("#form-update-ziwbk")[0].reset();
        clearErrorMessage();

        // Extract data from the row
        let {
            id,
            id_subkategori,
            link_kategori,
            link,
            id_kategori
        } = data;

        // Populate form fields
        $("#update-id").val(id);
        $("#update-id_kategori").val(id_kategori);
        $("#edit-id_subkategori").val(id_subkategori);
        $("#edit-link-kategori").val(link_kategori);
        $("#edit-link").val(link);

        $("#modal-update-ziwbk").modal("show");
    });



    // $("#table-data").on("click", ".btn-update", function () {
    //     let data = table.row($(this).closest("tr")).data();

    //     $("#form-update-ziwbk")[0].reset();
    //     clearErrorMessage();

    //     let { id, sub_kategori, link, id_kategori } = data;
    //     // console.log(id);
    //     $("#update-id").val(id);
    //     $("#update-id_kategori").val(id_kategori);
    //     $("#edit-sub_kategori").val(sub_kategori);
    //     // $("#edit-link").val(link);
    //     $.each(dataFromDatabase.links, function(index, link) {
    //         $("#form-repeater").append(
    //             '<div class="input-group mb-3"><input type="text" name="addMoreInputFields[' + index +
    //             '][link]" value="' + link + '" class="form-control" /><div class="input-group-append"><button type="button" class="btn btn-danger remove-input-field">Delete</button></div></div>'
    //         );
    //     });
    //     $("#modal-update-ziwbk").modal("show");
    // });

    $("#form-ziwbk").on("submit", function (e) {
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
                $("#modal-ziwbk").find(".modal-dialog").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-ziwbk")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                $("#modal-ziwbk").modal("hide");
                $("#dynamic-ar").prop("disabled", true);

                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: "Data ziwbk berhasil disimpan",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(() => {
                    table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                $("#modal-ziwbk")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);

                if (xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "Terjadi Kesalahan:<br>";

                    $.each(errors, function (key, value) {
                        errorMessage += value + "<br>";
                    });

                    // Tampilkan pesan error menggunakan SweetAlert
                    Swal.fire({
                        title: "Error",
                        html: errorMessage,
                        icon: "error",
                    });
                } else {
                    console.error("Error:", error);
                    // Tampilkan pesan kesalahan umum
                    Swal.fire(
                        "Error",
                        "Terjadi kesalahan. Silakan coba lagi nanti.",
                        "error"
                    );
                }
            },
        });
    });

    $(".btn-tambah").on("click", function () {
        $("#form-ziwbk")[0].reset();
        clearErrorMessage();
        $("#modal-ziwbk").modal("show");
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "zi_wbk/data",
            type: "get",
            dataType: "json",
        },
        order: [8, "desc"],
        columnDefs: [{
                targets: [0, 6, 7],
                orderable: false,
                searchable: false,
            },
            {
                targets: [8],
                visible: false,
            },
        ],
        columns: [{
                data: "DT_RowIndex",
            },
            {
                data: "list_kategori.list_kanal.nama_kanal",
                render: function (data, type, row, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: "list_kategori.nama_kategori",
                render: function (data, type, row, meta) {
                    return data ? data : '-';
                }
            },

            {
                data: "sub_kategori.sub_kategori",
                render: function (data, type, row, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: "link_kategori",
                render: function (data, type, row, meta) {
                    return data ? data : '-';
                }

            },
            {
                data: "link",
                render: function (data, type, row, meta) {
                    return data ? data : '-';
                }

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
            },
            {
                data: "id",
                render: (data, type, row) => {
                    const button_edit = $("<a>", {
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
                            // if (UPDATE) arr.push(button_edit)
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

    $(document).ready(function () {
        $("#id_kategori").select2();
    });

    $(document).ready(function () {
        $("#update-id_kategori").select2();
    });
});
