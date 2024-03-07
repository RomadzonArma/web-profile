let table;
$(() => {

    $('#table-data').on('change', '.switch-active', function () {
        var id = $(this).data('id');
        var value = $(this).val();

        $.post(BASE_URL + 'program_fokus/switch', {
            id,
            value,
            _method: 'PATCH'
        }).done((res) => {
            showSuccessToastr('sukses', value == '1' ? 'Program berhasil diaktifkan' : 'Program berhasil dinonaktifkan');
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
            html: `Anda akan menghapus program_fokus "<b>${judul}</b>"!`,
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
                    url: BASE_URL + "program_fokus/delete",
                    type: "POST",
                    data: {
                        id,
                        _method: "DELETE",
                    },
                    success: (res) => {
                        Swal.fire({
                            icon: "success",
                            title: "Sukses",
                            text: "Program berhasil dihapus",
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


    $("#form-update-program_fokus").on("submit", function (e) {
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
                $("#modal-update-program_fokus")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-update-program_fokus")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                $("#modal-update-program_fokus").modal("hide");

                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Data Program berhasil diubah',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                $('#modal-update-program_fokus').find('.modal-dialog').LoadingOverlay('hide', true);

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

    function sanitizeHtml(html) {
        var doc = new DOMParser().parseFromString(html, 'text/html');
        return doc.body.textContent || "";
    }

    // $("#table-data").on("click", ".btn-update", function () {
    //     let data = table.row($(this).closest("tr")).data();

    //     $("#form-update-program_fokus")[0].reset();
    //     clearErrorMessage();

    //     $.each(data, (key, value) => {
    //         $('#update-' + key).val(value);
    //     });
    //     // $('#update-body').summernote('destroy');

    //     // $('#update-body').summernote({
    //     //     height: 350,
    //     //     disableHtml: true, // Menonaktifkan eksekusi HTML
    //     // });
    //     $("#konten_edit").summernote('code', body);

    //     $("#modal-update-program_fokus").modal("show");
    // });

    $("#table-data").on("click", ".btn-update", function () {
        let data = table.row($(this).closest("tr")).data();

        $("#form-update-program_fokus")[0].reset();
        clearErrorMessage();

        let { id, title, tag, body, publish_date } = data;

        // Sanitize the HTML content for the specific 'konten' variable
        var sanitizedContent = sanitizeHtml(body);

        $("#update-id").val(id);
        $("#update-title").val(title);

        $("#body_edit").summernote({
            height: 150,
            scrolling: true,
        });

        $("#body_edit").summernote('code', sanitizedContent);

        $("#tag_edit").val(tag);
        $("#publish_date_edit").val(publish_date);
        $("#modal-update-program_fokus").modal("show");
        $('#modal-update-program_fokus .modal-body').css({
            'max-height': '450px', // Adjust the height as needed
            'overflow-y': 'auto', // Enable vertical scrolling
        });
    });


    $("#form-program_fokus").on("submit", function (e) {
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
                $("#modal-program_fokus")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-program_fokus")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                $("#modal-program_fokus").modal("hide");

                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Data Program berhasil disimpan',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                $('#modal-program_fokus').find('.modal-dialog').LoadingOverlay('hide', true);

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
        $('#form-program_fokus')[0].reset();
        clearErrorMessage();
        $('#modal-program_fokus').modal('show');
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "program_fokus/data",
            type: "get",
            dataType: "json",
        },
        order: [[0, "desc"]],
        // columnDefs: [
        //     {
        //         targets: [0, 6, 7],
        //         orderable: false,
        //         searchable: false,
        //     },
        //     {
        //         targets: [8],
        //         visible: false,
        //     },
        // ],
        columns: [
            {
                data: "DT_RowIndex",
            },
            {
                data: "title",
                render: (data, type, row) => {
                    return data ?? '-';
                }
            },
            {
                data: "publish_date",
                render: (data, type, row) => {
                    return data ?? '-';
                }
            },
            {
                data: 'status',
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
            // {
            //     data: "created_at",
            // },
        ],
    });
});
