let table;
$(() => {
    function preview(target, image) {
        $(target).attr("src", window.URL.createObjectURL(image)).show();
    }
    $("#table-data").on("change", ".switch-active", function () {
        var id = $(this).data("id");
        var value = $(this).prop("checked") ? 1 : 0;

        $.post(BASE_URL + "akuntabilitas_list/switch", {
            id,
            value,
            _method: "PATCH",
        })
            .done((res) => {
                Swal.fire({
                    title: "Sukses",
                    text:
                        value === 1 ? "Artikel berhasil di publish" : "Artikels berhasil di unpublish",
                    icon: "success",
                }).then(() => {
                    table.ajax.reload();
                });
            })
            .fail((res) => {
                let { status, responseJSON } = res;
                Swal.fire({
                    title: 'Oops',
                    text: responseJSON.message,
                    icon: 'error'
                });
                console.log(res);
            });
    });

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
                $.post(BASE_URL + "akuntabilitas_list/delete", {
                    id,
                    _method: "DELETE",
                })
                    .done((res) => {
                        Swal.fire({
                            title: "Sukses",
                            text: "Unduhan berhasil dihapus",
                            icon: "success",
                        });
                        table.ajax.reload();
                    })
                    .fail((res) => {
                        let { status, responseJSON } = res;
                        Swal.fire({
                            title: "agal menghapus data!",
                            text: responseJSON.message,
                            icon: "error",
                        });
                    });
            }
        });
    });

    $("#form-update-artikel").on("submit", function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
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
            success: (res) => {
                console.log(res);
                Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: "Berhasil Menyimpan Data",
                    showConfirmButton: false,
                    timer: 2000,
                });
                window.location.href = BASE_URL + "akuntabilitas_list";
            },
            error: ({ status, responseJSON }) => {
                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr("oops", responseJSON.msg);
            },
        });
    });
    function sanitizeHtml(html) {
        var doc = new DOMParser().parseFromString(html, "text/html");
        return doc.body.textContent || "";
    }

    $("#table-data").on("click", ".btn-update", function () {
        let data = table.row($(this).closest("tr")).data();

        $("#form-update-artikel")[0].reset();
        clearErrorMessage();

        let { id, judul, gambar, link, id_kategori, tag, konten } = data;
        var sanitizedContent = sanitizeHtml(konten);

        $("#update-id").val(id);
        $("#update-id_kategori").val(id_kategori);
        $("#judul_edit").val(judul);

        $("#konten_edit").summernote({
            height: 300,
            color: "balck",
        });

        $("#konten_edit").summernote("code", sanitizedContent);

        $("#tag_edit").val(tag);
        $("#link_edit").val(link);
        $("#gambar-preview").html(
            '<img src="' +
                asset_url +
                "gambar-artikel/" +
                gambar +
                '" alt="oto" style="width: 200px;">'
        );
        $("#modal-update-artikel").modal("show");
    });

    $('#form-cerita').on('submit', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                clearErrorMessage();
                $('#modal-cerita').find('.modal-dialog').LoadingOverlay('show');
            },
            success: (res) => {
                $('#modal-cerita').find('.modal-dialog').LoadingOverlay('hide', true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $('#modal-cerita').modal('hide');
                showSuccessToastr('sukses', 'Cerita berhasil ditambahkan');
            },
            error: ({ status, responseJSON }) => {
                $('#modal-cerita').find('.modal-dialog').LoadingOverlay('hide', true);

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg);
            }
        })
    })

    $(".btn-tambah").on("click", function () {
        $("#form-akuntabilitas")[0].reset();
        clearErrorMessage();

        $("#modal-akuntabilitas").modal("show");
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "akuntabilitas_list/data",
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
                data: "sub.list_kategori.list_kanal.nama_kanal",
            },
            {
                data: "sub.list_kategori.nama_kategori",
            },
            {
                data: "judul",
            },
            {
                data: "jumlah_lihat",
            },
            {
                data: "is_active",
                render: (data, type, row) => {
                    return `
                    <div class="custom-control custom-switch mb-3" dir="ltr">
                        <input type="checkbox" class="custom-control-input switch-active" id="aktif-${
                            row.id
                        }" data-id="${row.id}" ${
                        data == "1" ? "checked" : ""
                    } value="${data == "1" ? 0 : 1}">
                        <label class="custom-control-label" for="aktif-${
                            row.id
                        }">${data == "1" ? "Publish" : "Unpublish"}</label>
                    </div>
                    `;
                },
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
