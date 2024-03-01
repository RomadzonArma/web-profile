let table;
$(() => {
    function preview(target, image) {
        $(target).attr("src", window.URL.createObjectURL(image)).show();
    }

    $("#table-data").on("click", ".btn-delete", function () {
        let data = table.row($(this).closest("tr")).data();

        let { id, judul } = data;

        Swal.fire({
            title: "Anda yakin?",
            html: `Anda akan menghapus unduhan "<b>${judul}</b>"!`,
            footer: "Data yang sudah dihapus tidak bisa dikembalikan kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + "unduhan/delete", {
                    id,
                    _method: "DELETE",
                })
                    .done((res) => {
                        showSuccessToastr("sukses", "unduhan berhasil dihapus");
                        table.ajax.reload();
                    })
                    .fail((res) => {
                        let { status, responseJSON } = res;
                        showErrorToastr("oops", responseJSON.message);
                    });
            }
        });
    });

    $("#form-update-unduhan").on("submit", function (e) {
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
                $("#modal-update-unduhan")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-update-unduhan")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $("#modal-update-unduhan").modal("hide");
            },
            error: ({ status, responseJSON }) => {
                $("#modal-otoritas-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                    table.ajax.reload();

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr("oops", responseJSON.msg);
            },
        });
    });

    $("#table-data").on("click", ".btn-update", function () {
        let data = table.row($(this).closest("tr")).data();

        $("#form-update-unduhan")[0].reset();
        clearErrorMessage();

        let { id, judul, cover, file, id_kategori} = data;
        // console.log(id);
        $("#update-id").val(id);
        $("#update-id_kategori").val(id_kategori);
        $("#judul_edit").val(judul);
        $('#cover-preview').html('<img src="' + asset_url + 'cover-unduhan/' + cover + '" alt="oto" style="width: 200px; height: 200px;">');
        $('#pdf_preview').attr('src', asset_url + 'file-unduhan/' + file);

        $("#modal-update-unduhan").modal("show");
    });

    $("#form-unduhan").on("submit", function (e) {
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
                $("#modal-unduhan")
                    .find(".modal-dialog")
                    .LoadingOverlay("show"); // Fix the modal ID here
            },
            success: (res) => {
                $("#modal-unduhan")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                $("#modal-unduhan").modal("hide");
                table.ajax.reload();
            },
            error: ({ status, responseJSON }) => {
                $("#modal-unduhan")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr("oops", responseJSON.msg);
            },
        });
    });

    $('.btn-tambah').on('click', function () {
        $('#form-unduhan')[0].reset();
        clearErrorMessage();
        $('#modal-unduhan').modal('show');
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "unduhan/data",
            type: "get",
            dataType: "json",
        },
        order: [[5, "desc"]],
        columnDefs: [
            {
                targets: [0, 4],
                orderable: false,
                searchable: false,
            },
            {
                targets: [7],
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
                data: "jumlah_download",
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
