let table;
$(() => {
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

        let { id, judul_maklumat } = data;

        Swal.fire({
            title: "Anda yakin?",
            html: `Anda akan menghapus maklumat baik "<b>${judul_maklumat}</b>"!`,
            footer: "Data yang sudah dihapus tidak bisa dikembalikan kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + "maklumat/delete", {
                    id,
                    _method: "DELETE",
                })
                    .done((res) => {
                        showSuccessToastr(
                            "sukses",
                            "maklumat berhasil dihapus"
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

        $.post(BASE_URL + "maklumat/switch", {
            id,
            value,
            _method: "PATCH",
        })
            .done((res) => {
                showSuccessToastr(
                    "sukses",
                    value == "1"
                        ? "maklumat berhasil diaktifkan"
                        : "maklumat berhasil dinonaktifkan"
                );
                table.ajax.reload();
            })
            .fail((res) => {
                let { status, responseJSON } = res;
                showErrorToastr("oops", responseJSON.message);
                console.log(res);
            });
    });

    $("#form-maklumat-update").on("submit", function (e) {
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
                $("#modal-maklumat-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-maklumat-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $("#modal-maklumat-update").modal("hide");
                showSuccessToastr("sukses", "maklumat berhasil diubah");
            },
            error: function (xhr, status, error) {
                $("#modal-maklumat-update")
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
    $("#modal-maklumat-update").on("hidden.bs.modal", function () {
        // Mengatur ulang form
        $("#form-maklumat-update")[0].reset();
        // Menyembunyikan input PDF
        // $(".row_pdf").hide();
        // $(".row_foto").hide();
    });

    // Event handler untuk tombol batal
    $("#modal-maklumat-update").on(
        "click",
        '[data-dismiss="modal"]',
        function () {
            // Mengatur ulang form
            $("#form-maklumat-update")[0].reset();
            // Menyembunyikan input PDF
            // $(".row_pdf").hide();
            // $(".row_foto").hide();
        }
    );
    $("#table-data").on("click", ".btn-update", function () {
        var tr = $(this).closest("tr");
        var data = table.row(tr).data();

        clearErrorMessage();
        $("#form-maklumat-update")[0].reset();

        if (data) {
            $.each(data, (key, value) => {
                if (key === "gambar") {
                    // Show image preview for 'foto' field
                    if (value) {
                        $("#updateImagePreview").html(
                            '<img src="' +
                            value +
                            '" style="height: 200px; margin-top: 10px;">'
                        );
                    }
                } else if (key === "file_pdf") {
                    // Check if jenis inputan yang dipilih adalah PDF
                    if (jenis_inputan-edit === "pdf") {
                        // Check if value exists and it is a PDF file
                        if (value && value.endsWith(".pdf")) {
                            $(".row_pdf").show();
                            // console.log(value);
                        }
                    }
                } else {
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
                if (data["dokumen"]) {
                    $(".row_pdf").show();
                } else if (data["image"]) {
                    $(".row_foto").show();
                }
            }


            // Show file PDF input if file PDF is available
            if (data["dokumen"]) {
                $(".row_pdf").show();

                // Menetapkan URL file PDF ke atribut src iframe
                var pdfUrl = data["file_pdf"];
                $("#pdf_preview").attr("src", pdfUrl);
            } else {
                // Sembunyikan iframe jika tidak ada file PDF yang tersedia
                $("#pdf_preview").attr("src", "");
                $(".row_pdf").hide();
            }
            var id = data['id']; // Ambil ID dari data
            $.ajax({
                url: '/get-images/' + id, // Endpoint to retrieve images
                method: 'GET',
                success: function (response) {
                    // Clear previous image previews
                    $("#updatemaklumatPreview").empty();

                    // Display new image previews
                    response.images.forEach(function (image) {
                        $("#updatemaklumatPreview").append(
                            '<img src="' + image + '" alt="oto" style="width: 200px;">'
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
            $("#modal-maklumat-update").modal("show");
        } else {
            // Handle the case when data is not available
            console.error("Data is not available.");
        }
    });

    // $("#table-data").on("click", ".btn-update", function () {
    //     var tr = $(this).closest("tr");
    //     var data = table.row(tr).data();

    //     clearErrorMessage();
    //     $("#form-maklumat-update")[0].reset();

    //     if (data) {
    //         $.each(data, (key, value) => {
    //             if (key === "gambar") {
    //                 // Show image preview for 'foto' field
    //                 if (value) {
    //                     $("#updateImagePreview").html(
    //                         '<img src="' +
    //                             value +
    //                             '" style="height: 200px; margin-top: 10px;">'
    //                     );
    //                 }
    //             } else if (key === "image") {
    //                 // Show image preview for 'foto_maklumat' field
    //                 if (value) {
    //                     $("#updatemaklumatPreview").html(
    //                         '<img src="' +
    //                             value +
    //                             '" style="height: 200px; margin-top: 10px;">'
    //                     );
    //                 }
    //             } else if (key === "file_pdf") {
    //                 // Check if jenis inputan yang dipilih adalah PDF
    //                 if (jenisInputan === "pdf") {
    //                     // Check if value exists and it is a PDF file
    //                     if (value && value.endsWith(".pdf")) {
    //                         $(".row_pdf").show();
    //                         // console.log(value);
    //                     }
    //                 }
    //             } else if (key === "video") {
    //                 // Check if value exists and it is a PDF file
    //                 if (value) {
    //                     $(".row_video").show();
    //                     // console.log(value);
    //                 }
    //             } else {
    //                 // Set other input fields normally
    //                 $("#update-" + key).val(value);
    //             }
    //         });

    //         // Handle showing/hiding input sections based on the selected 'jenis' value
    //         var jenisInputan = data["jenis"];
    //         if (jenisInputan) {
    //             $(
    //                 ".row_link, .row_link_video, .row_video, .row_foto, .row_pdf"
    //             ).hide();
    //             if (jenisInputan === "link") {
    //                 $(".row_link").show();
    //             } else if (jenisInputan === "link_video") {
    //                 $(".row_link_video").show();
    //             } else if (jenisInputan === "video") {
    //                 $(".row_video").show();
    //             } else if (jenisInputan === "foto") {
    //                 $(".row_foto").show();
    //             } else if (jenisInputan === "pdf") {
    //                 $(".row_pdf").show();
    //             }
    //         } else {
    //             // If jenisInputan is not available, show the appropriate input section based on the existing data
    //             if (data["link"]) {
    //                 $(".row_link").show();
    //             } else if (data["link_video"]) {
    //                 $(".row_link_video").show();
    //             } else if (data["video"]) {
    //                 $(".row_video").show();
    //             } else if (data["file_pdf"]) {
    //                 $(".row_pdf").show();
    //             } else if (data["foto_maklumat"]) {
    //                 $(".row_foto").show();
    //             }
    //         }

    //         // Show file PDF input if file PDF is available
    //         if (data["file_pdf"]) {
    //             $(".row_pdf").show();

    //             // Menetapkan URL file PDF ke atribut src iframe
    //             var pdfUrl = data["file_pdf"];
    //             $("#pdf_preview").attr("src", pdfUrl);
    //         } else {
    //             // Sembunyikan iframe jika tidak ada file PDF yang tersedia
    //             $("#pdf_preview").attr("src", "");
    //             $(".row_pdf").hide();
    //         }
    //         $.ajax({
    //             url: '/get-images/' + id, // Endpoint to retrieve images
    //             method: 'GET',
    //             success: function (response) {
    //                 // Clear previous image previews
    //                 $("#updatemaklumatPreview").empty();

    //                 // Display new image previews
    //                 response.images.forEach(function (image) {
    //                     $("#updatemaklumatPreview").append(
    //                         '<img src="' + asset_url + 'file-galeri/gambar/' + image + '" alt="oto" style="width: 200px;">'
    //                     );
    //                 });

    //                 // Show the update modal
    //                 $("#modal-update").modal("show");
    //             },
    //             error: function (error) {
    //                 console.error("Error retrieving images:", error);
    //                 // Handle error as needed
    //             }
    //         });
    //         $("#modal-maklumat-update").modal("show");
    //     } else {
    //         // Handle the case when data is not available
    //         console.error("Data is not available.");
    //     }
    // });
    $("#form-maklumat").on("submit", function (e) {
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
                $("#modal-maklumat").find(".modal-dialog").LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-maklumat")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $("#modal-maklumat").modal("hide");
                showSuccessToastr("sukses", "maklumat baik berhasil ditambahkan");
            },
            error: ({ status, responseJSON }) => {
                $("#modal-maklumat")
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
        $("#form-maklumat")[0].reset();
        clearErrorMessage();
        $("#modal-maklumat").modal("show");
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "maklumat/data",
            type: "get",
            dataType: "json",
        },
        order: [[6, "desc"]],
        columnDefs: [
            {
                targets: [0, 5],
                orderable: false,
                searchable: false,
                className: "text-center align-top",
            },
            {
                targets: [6],
                visible: false,
            },
        ],
        columns: [
            {
                data: "DT_RowIndex",
            },
            {
                data: "judul_maklumat",
                render: (data, type, row) => {
                    return data ?? "-";
                },
            },
            {
                data: "gambar",
                // render: (data, type, row) => {
                //     return data ?? "-";
                // },
                render: (data, type, row) => {
                    return data ? '<img src="' + data + '" style="height: 50px">' : '-';
                }
            },
            {
                data: "dokumen",
                render: (data, type, row) => {
                    if (data) {
                        return `
                            <a href="${data}" class="btn btn-info btn-sm" target="_blank">Lihat Dokumen</a>
                        `;
                    } else {
                        return "-";
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
                    <label class="custom-control-label" for="aktif-${row.id}">${
                        data == "1" ? "Aktif" : "Nonaktif"
                    }</label>
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
});
