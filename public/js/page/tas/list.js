let table;
$(() => {
    $('#konten').summernote();
    $('#update-konten').summernote({
         disableHtml: true,
        height: 200,
        color: 'black',
    });


    $("#jenis_inputan").on("change", function () {
        var val = $(this).val();
        $(".row_link, .row_link_video, .row_video, .row_foto, .row_pdf").css(
            "display",
            "none"
        );
        if (val == "link") {
            $(".row_link").css("display", "block");
        } else if (val == "link_video") {
            $(".row_link_video").css("display", "block");
        } else if (val == "video") {
            $(".row_video").css("display", "block");
        } else if (val == "foto") {
            $(".row_foto").css("display", "block");
        } else if (val == "pdf") {
            $(".row_pdf").css("display", "block");
        }
    });
    $("#jenis_inputan-edit").on("change", function () {
        var val = $(this).val();
        $(".row_link, .row_video, .row_foto, .row_pdf").css("display", "none");
        if (val == "link") {
            $(".row_link").css("display", "block");
        } else if (val == "video") {
            $(".row_video").css("display", "block");
        } else if (val == "foto") {
            $(".row_foto").css("display", "block");
        } else if (val == "pdf") {
            $(".row_pdf").css("display", "block");
        }
    });

    $("#table-data").on("click", ".btn-delete", function () {
        let data = table.row($(this).closest("tr")).data();

        let { id, judul } = data;

        Swal.fire({
            title: "Anda yakin?",
            html: `Anda akan menghapus TAS"<b>${judul}</b>"!`,
            footer: "Data yang sudah dihapus tidak bisa dikembalikan kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + "tas/delete", {
                    id,
                    _method: "DELETE",
                })
                    .done((res) => {
                        showSuccessToastr(
                            "sukses",
                            "tas berhasil dihapus"
                        );
                        table.ajax.reload();
                    })
                    .fail((res) => {
                        let { status, responseJSON } = res;
                        showErrorToastr("oops", responseJSON.message);
                    });
            }
        });
    });

    $("#table-data").on("change", ".switch-active", function () {
        var id = $(this).data("id");
        var value = $(this).val();

        $.post(BASE_URL + "tas/switch", {
            id,
            value,
            _method: "PATCH",
        })
            .done((res) => {
                showSuccessToastr(
                    "sukses",
                    value == "1"
                        ? "tas berhasil diaktifkan"
                        : "tas berhasil dinonaktifkan"
                );
                table.ajax.reload();
            })
            .fail((res) => {
                let { status, responseJSON } = res;
                showErrorToastr("oops", responseJSON.message);
                console.log(res);
            });
    });

    $("#form-tas-update").on("submit", function (e) {
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
                $("#modal-tas-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-tas-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $("#modal-tas-update").modal("hide");
                showSuccessToastr("sukses", "tas berhasil diubah");
            },
            error: function (xhr, status, error) {
                $("#modal-tas-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);

                if (xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "Terjadi Kesalahan:<br>";

                    $.each(errors, function (key, value) {
                        errorMessage += value + "<br>";
                    });

                    Swal.fire({
                        title: "Error",
                        html: errorMessage,
                        icon: "error",
                    });
                } else {
                    console.error("Error:", error);
                    Swal.fire(
                        "Error",
                        "Terjadi kesalahan. Silakan coba lagi nanti.",
                        "error"
                    );
                }
            },
        });
    });
    // Mengatur ulang modal saat ditutup
    $("#modal-tas-update").on("hidden.bs.modal", function () {
        // Mengatur ulang form
        $("#form-tas-update")[0].reset();
        // Menyembunyikan input PDF
        // $(".row_pdf").hide();
        // $(".row_foto").hide();
    });

    // Event handler untuk tombol batal
    $("#modal-tas-update").on(
        "click",
        '[data-dismiss="modal"]',
        function () {
            // Mengatur ulang form
            $("#form-tas-update")[0].reset();
            // Menyembunyikan input PDF
            // $(".row_pdf").hide();
            // $(".row_foto").hide();
        }
    );
    $("#table-data").on("click", ".btn-update", function () {
        var tr = $(this).closest("tr");
        var data = table.row(tr).data();

        clearErrorMessage();
        $("#form-tas-update")[0].reset();

        if (data) {
            $.each(data, (key, value) => {
                if (key === "gambar") {
                    // Show image preview for 'gambar' field
                    if (value) {
                        $("#updateImagePreview").html(
                            '<img src="' +
                                value +
                                '" style="height: 100px; margin-top: 10px;">'
                        );
                    }
                } else if (key === "file_pdf") {
                    if (value && value.endsWith(".pdf")) {
                        $(".row_pdf").show();
                        $(".row_foto").hide();
                    }

                }else if (key === "konten") {
                    // Set konten to textarea
                    $("#update-konten").summernote('code', value);

                }
                 else  {
                    // Set other input fields normally
                    $("#update-" + key).val(value);
                }
            });

            // Handle showing/hiding input sections based on the selected 'jenis' value
            var jenisInputan = data["jenis"];
            if (jenisInputan) {
                $(".row_foto, .row_pdf").hide();
                if (jenisInputan === "foto") {
                    $(".row_foto").show();
                } else if (jenisInputan === "pdf") {
                    $(".row_pdf").show();
                }
            } else {
                // If jenisInputan is not available, show the appropriate input section based on the existing data
                if (data["file_pdf"]) {
                    $(".row_pdf").show();
                } else if (data["image"]) {
                    $(".row_foto").show();
                }
            }

            // Show file PDF input if file PDF is available
            if (data["file_pdf"]) {
                $(".row_pdf").show();

                // Set PDF file URL to iframe src attribute
                var pdfUrl = data["file_pdf"];
                $("#pdf_preview").attr("src", pdfUrl);
            } else {
                // Hide iframe if no PDF file available
                $("#pdf_preview").attr("src", "");
                $(".row_pdf").hide();
            }

            var id = data["id"];
            $.ajax({
                url: "/get-images",
                method: "GET",
                data: { id: id }, // Kirim parameter ID sebagai bagian dari permintaan
                success: function(response) {
                    console.log("Response:", response); // Periksa respon dari server
                    $("#updatetasPreview").empty(); // Kosongkan pratinjau sebelumnya
                    if (response && response.status && response.status === true && response.images && response.images.length > 0) {
                        // Jika gambar tersedia, tampilkan
                        response.images.forEach(function(image) {
                            $("#updatetasPreview").append(
                                '<img src="' + image + '" alt="foto" style="width: 200px;">'
                            );
                        });
                    } else {
                        // Jika tidak ada gambar yang tersedia, tampilkan pesan atau tangani sesuai kebutuhan
                        $("#updatetasPreview").text("No images found");
                    }
                    console.log("Response:", response);
                    $("#modal-tas-update").modal("show");
                },
                error: function(xhr, status, error) {
                    console.error("Error retrieving images:", error); // Log pesan kesalahan
                    // Tangani kesalahan sesuai kebutuhan
                }
            });



            $("#modal-tas-update").modal("show");
        } else {
            // Handle the case when data is not available
            console.error("Data is not available.");
        }
    });


        $("#form-tas").on("submit", function (e) {
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
                    $("#modal-tas")
                        .find(".modal-dialog")
                        .LoadingOverlay("show");
                },
                success: (res) => {
                    $("#modal-tas")
                        .find(".modal-dialog")
                        .LoadingOverlay("hide", true);
                    clearErrorMessage("#modal-tas"); // Ubah clearErrorMessage() menjadi clearErrorMessage("#modal-tas")
                    // $(this)[0].reset(); // Hapus ini
                    table.ajax.reload();
                    $("#imagePreview").html("");
                    $("#konten").val("");
                    $("#modal-tas").modal("hide");
                    showSuccessToastr("sukses", "tas baik berhasil ditambahkan");
                },
                error: ({ status, responseJSON }) => {
                    $("#modal-tas")
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
    $(".btn-tambah").on("click", function () {
        $("#form-tas")[0].reset();
        clearErrorMessage();
        $("#modal-tas").modal("show");

        // Reset pratinjau gambar
        var imagePreview = document.getElementById("foto_tas-preview");
        imagePreview.innerHTML = "";

        // Reset label file input
        var fileLabel = document.querySelector('label[for="foto_tas"]');
        fileLabel.innerHTML = "Cari Gambar";

        // Sembunyikan elemen form
        $("#modal-tas").find(".row_pdf").hide();
        $("#modal-tas").find(".row_foto").hide();
    });

    $("#table-data").on("click", ".btn-detail", function (e) {
        e.preventDefault(); // Mencegah aksi default dari link
        var laboranId = $(this).data("id");
        // Memanggil endpoint untuk mendapatkan gambar
        $.ajax({
            url: BASE_URL + "tas/get-images/" + laboranId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    // Mengosongkan modal body
                    $("#gambarModal .modal-body").empty();

                    // Menambahkan gambar-gambar ke dalam modal body
                    response.images.forEach(function (image) {
                        $("#gambarModal .modal-body").append(
                            '<img src="' + image + '" class="img-fluid mb-3" style="height: 200px; margin-top: 10px;">'
                        );
                    });

                    // Menampilkan modal
                    $("#gambarModal").modal("show");
                } else {
                    // Menampilkan pesan jika terjadi kesalahan
                    alert("Gagal memuat gambar");
                }
            },
            error: function (xhr, status, error) {
                // Menampilkan pesan jika terjadi kesalahan
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + xhr.responseText);
            },
        });
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "tas/data",
            type: "get",
            dataType: "json",
        },
        order: [[7, "desc"]],
        columnDefs: [
            {
                targets: [0, 6],
                orderable: false,
                searchable: false,
                className: "text-center align-top",
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
                data: "judul",
                render: (data, type, row) => {
                    return data ?? "-";
                },
            },
            {
                data: "gambar",
                render: (data, type, row) => {
                    return data
                        ? '<img src="' +
                              data +
                              '" class="img-thumbnail" style="height: 75px">'
                        : "-";
                },
            },
            {
                data: "file_pdf",
                render: (data, type, row) => {
                    if (data) {
                        return `
                            <a href="${data}" class="btn btn-success btn-rounded btn-sm" target="_blank"><i class="bx bx-file"></i> Lihat Dokumen</a>
                        `;
                    } else {
                        return ` <a class="btn btn-danger btn-rounded btn-sm" target="_blank">Tidak Ada Dokumen</a>`;
                    }
                },
            },
            {
                data: "id",
                render: (data, type, row) => {
                    if (data) {
                        const buttonDetail = $("<a>", {
                            class: "btn btn-info btn-rounded btn-sm btn-detail",
                            "data-id": data,
                            title: "lihat gambar",
                            "data-placement": "top",
                            "data-toggle": "tooltip",
                            href: BASE_URL + "tas/get-images/" + row.id,
                            role: "button",
                            html: '<i class="bx bx-eye"></i> lihat gambar',
                        });

                        return $("<div>", {
                            class: "d-flex justify-content-center align-items-center", // Bootstrap classes for centering
                            style: "height: 100%;", // Specify a fixed height to keep the button size constant
                            html: buttonDetail,
                        }).prop("outerHTML");
                    } else {
                        return `<a class="btn btn-danger btn-rounded btn-sm" target="_blank">Tidak Ada Gambar</a>`;
                    }
                },
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
                        }">${data == "1" ? "Aktif" : "Nonaktif"}</label>
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
    // table = $("#table-data").DataTable({
    //     language: dtLang,
    //     serverSide: true,
    //     processing: true,
    //     ajax: {
    //         url: BASE_URL + "tas/data",
    //         type: "get",
    //         dataType: "json",
    //     },
    //     order: [[6, "desc"]],
    //     columnDefs: [
    //         {
    //             targets: [0, 5],
    //             orderable: false,
    //             searchable: false,
    //             className: "text-center align-top",
    //         },
    //         {
    //             targets: [6],
    //             visible: false,
    //         },
    //     ],
    //     columns: [
    //         {
    //             data: "DT_RowIndex",
    //         },
    //         {
    //             data: "judul",
    //             render: (data, type, row) => {
    //                 return data ?? "-";
    //             },
    //         },
    //         {
    //             data: "gambar",
    //             render: (data, type, row) => {
    //                 return data
    //                     ? '<img src="' + data + '" style="height: 75px">'
    //                     : "-";
    //             },
    //         },
    //         {
    //             data: "file_pdf",
    //             render: (data, type, row) => {
    //                 if (data) {
    //                     return `
    //                         <a href="${data}" class="btn btn-success btn-rounded btn-sm" target="_blank"><i class="bx bx-file"></i> Lihat Dokumen</a>
    //                     `;
    //                 } else {
    //                     return ` <a class="btn btn-danger btn-rounded btn-sm" target="_blank">Tidak Ada Dokumen</a>`;
    //                 }
    //             },
    //         },
    //         {
    //             data: "is_active",
    //             render: (data, type, row) => {
    //                 return `
    //                 <div class="custom-control custom-switch mb-3" dir="ltr">
    //                     <input type="checkbox" class="custom-control-input switch-active" id="aktif-${row.id}" data-id="${row.id}" ${data == '1' ? 'checked' : ''} value="${data == '1' ? 0 : 1}">
    //                     <label class="custom-control-label" for="aktif-${row.id}">${data == '1' ? 'Aktif' : 'Nonaktif'}</label>
    //                 </div>
    //                 `;
    //             }
    //         },
    //         {
    //             data: "id",
    //             render: (data, type, row) => {
    //                 const button_edit = $("<button>", {
    //                     class: "btn btn-primary btn-update",
    //                     html: '<i class="bx bx-pencil"></i>',
    //                     "data-id": data,
    //                     title: "Update Data",
    //                     "data-placement": "top",
    //                     "data-toggle": "tooltip",
    //                 });

    //                 const button_delete = $("<button>", {
    //                     class: "btn btn-danger btn-delete",
    //                     html: '<i class="bx bx-trash"></i>',
    //                     "data-id": data,
    //                     title: "Delete Data",
    //                     "data-placement": "top",
    //                     "data-toggle": "tooltip",
    //                 });

    //                 return $("<div>", {
    //                     class: "btn-group",
    //                     html: () => {
    //                         let arr = [];

    //                         if (permissions.update) {
    //                             arr.push(button_edit);
    //                         }
    //                         // if (UPDATE) arr.push(button_edit)
    //                         if (permissions.delete) arr.push(button_delete);

    //                         return arr;
    //                     },
    //                 }).prop("outerHTML");
    //             },
    //         },
    //         {
    //             data: "created_at",
    //         },
    //     ],
    // });
});
