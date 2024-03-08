let table;
$(() => {
    function preview(target, image) {
        $(target).attr("src", window.URL.createObjectURL(image)).show();
    }
    $("#table-data").on("change", ".switch-active", function () {
        var id = $(this).data("id");
        var value = $(this).prop("checked") ? 1 : 0;

        $.post(BASE_URL + "manajemen_galeri/switch", {
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
                $.post(BASE_URL + "manajemen_galeri/delete", {
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

    $("#form-update-galeri").on("submit", function (e) {
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
                window.location.href = BASE_URL + "manajemen_galeri";
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

    $("#table-data").on("click", ".btn-update", function () {
        let data = table.row($(this).closest("tr")).data();

        $("#form-update-galeri")[0].reset();
        clearErrorMessage();

        let { id, judul, link, id_kategori, tag, deskripsi } = data;
        var sanitizedContent = sanitizeHtml(deskripsi);

        $("#update-id").val(id);
        $("#update-id_kategori").val(id_kategori);
        $("#judul_edit").val(judul);
        $("#tag_edit").val(tag);
        $("#link_edit").val(link);
        $("#deskripsi_edit").summernote({
            height: 300,
            color: "balck",
        });
        $("#deskripsi_edit").summernote("code", sanitizedContent);

        $.ajax({
            url: '/get-images/' + id, // Endpoint to retrieve images
            method: 'GET',
            success: function (response) {
                // Clear previous image previews
                $("#gambar-preview").empty();

                // Display new image previews
                response.images.forEach(function (image) {
                    $("#gambar-preview").append(
                        '<img src="' + asset_url + 'file-galeri/gambar/' + image + '" alt="oto" style="width: 200px;">'
                    );
                });

                // Show the update modal
                $("#modal-update").modal("show");
            },
            error: function (error) {
                console.error("Error retrieving images:", error);
                // Handle error as needed
            }
        });
        $("#modal-update").modal("show");
    });



    function sanitizeHtml(html) {
        var doc = new DOMParser().parseFromString(html, "text/html");
        return doc.body.textContent || "";
    }


    $("#form-galeri").on("submit", function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
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
                window.location.href = BASE_URL + "manajemen_galeri";
                Swal.fire({
                    icon: "success",
                    title: "Berhasil Menyimpan data!",
                    text: "Data berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1500,
                });
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

    $(".btn-tambah").on("click", function () {
        $("#form-galeri")[0].reset();
        clearErrorMessage();

        $("#modal-galeri").modal("show");
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "manajemen_galeri/data",
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
                targets: [9],
                visible: false,
            },
        ],
        columns: [
            {
                data: "DT_RowIndex",
            },
            {
                data: "list_kategori.list_kanal.nama_kanal",
            },
            {
                data: "list_kategori.nama_kategori",
            },
            {
                data: "judul",
            },
            {
                data: "jumlah_lihat",
            },
            {
                data: "is_video",
                render: (data, type, row) => {
                    // Jika is_video bernilai 1, tampilkan tanda centang biasa
                    if (data === 1) {
                        return '<span class="badge badge-success">✔</span>';
                    } else {
                        // Jika is_video tidak bernilai 1, tampilkan kosong atau teks sesuai kebutuhan
                        return '<span class="badge badge-danger">✘</span>';
                    }
                },
            },
            {
                data: "is_image",
                render: (data, type, row) => {
                    // Jika is_video bernilai 1, tampilkan tanda centang biasa
                    if (data === 1) {
                        return '<span class="badge badge-success">✔</span>';
                    } else {
                        // Jika is_video tidak bernilai 1, tampilkan kosong atau teks sesuai kebutuhan
                        return '<span class="badge badge-danger">✘</span>';
                    }
                },
            },
            {
                data: "status_publish",
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
document.addEventListener("DOMContentLoaded", function () {
    var statusVideoCheckbox = document.getElementById("status_video");
    var urlVideoContainer = document.getElementById("url_video_container");

    statusVideoCheckbox.addEventListener("change", function () {
        if (this.checked) {
            urlVideoContainer.style.display = "block";
        } else {
            urlVideoContainer.style.display = "none";
        }
    });
});
