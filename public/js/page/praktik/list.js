let table;
$(() => {
    $("#jenis_inputan").on("change", function () {
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

    // $("input[name=jenis]").on("change", function () {
    //     var val = $("input[name=jenis]:checked").val();
    //     if (val == "link") {
    //         $(".row_link").css("display", "block");
    //         $(".row_video").css("display", "none");
    //         $(".row_foto").css("display", "none");
    //         $(".row_pdf").css("display", "none");
    //     } else if (val == "video") {
    //         $(".row_link").css("display", "none");
    //         $(".row_video").css("display", "block");
    //         $(".row_foto").css("display", "none");
    //         $(".row_pdf").css("display", "none");
    //     } else if (val == "foto") {
    //         $(".row_link").css("display", "none");
    //         $(".row_video").css("display", "none");
    //         $(".row_foto").css("display", "block");
    //         $(".row_pdf").css("display", "none");
    //     } else if(val == "pdf") {
    //         $(".row_link").css("display", "none");
    //         $(".row_video").css("display", "none");
    //         $(".row_foto").css("display", "none");
    //         $(".row_pdf").css("display", "block");
    //     }
    // });

    // $("input[name=jenis]").on("change", function () {
    //     // Get the value of the checked radio button
    //     var val = $("input[name=jenis]:checked").val();
    //     // Show/hide divs based on the selected value
    //     if (val == "link") {
    //         $(".row_link").css("display", "block");
    //         $(".row_video").css("display", "none");
    //     } else if (val == "video") {
    //         $(".row_link").css("display", "none");
    //         $(".row_video").css("display", "block"); // Corrected class name
    //     }
    // });

    $("#table-data").on("click", ".btn-delete", function () {
        let data = table.row($(this).closest("tr")).data();

        let { id, judul } = data;

        Swal.fire({
            title: "Anda yakin?",
            html: `Anda akan menghapus praktik baik "<b>${judul}</b>"!`,
            footer: "Data yang sudah dihapus tidak bisa dikembalikan kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + "praktik_baik/delete", {
                    id,
                    _method: "DELETE",
                })
                    .done((res) => {
                        showSuccessToastr("sukses", "praktik baik berhasil dihapus");
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

        $.post(BASE_URL + "praktik_baik/switch", {
            id,
            value,
            _method: "PATCH",
        })
            .done((res) => {
                showSuccessToastr(
                    "sukses",
                    value == "1"
                        ? "praktik baik berhasil diaktifkan"
                        : "praktik baik berhasil dinonaktifkan"
                );
                table.ajax.reload();
            })
            .fail((res) => {
                let { status, responseJSON } = res;
                showErrorToastr("oops", responseJSON.message);
                console.log(res);
            });
    });

    $("#form-praktik-update").on("submit", function (e) {
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
                $("#modal-praktik-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-praktik-update")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $("#modal-praktik-update").modal("hide");
                showSuccessToastr("sukses", "praktik baik berhasil diubah");
            },
            // error: ({ status, responseJSON }) => {
            //     $('#modal-praktik-update').find('.modal-dialog').LoadingOverlay('hide', true);

            //     if (status == 422) {
            //         generateErrorMessage(responseJSON, true);
            //         return false;
            //     }

            //     showErrorToastr('oops', responseJSON.msg);
            // }
            error: function (xhr, status, error) {
                $("#modal-praktik-update")
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
    $("#modal-praktik-update").on("hidden.bs.modal", function () {
        // Mengatur ulang form
        $("#form-praktik-update")[0].reset();
        // Menyembunyikan input PDF
        $(".row_pdf").hide();
        $(".row_link").hide();
        $(".row_link_video").hide();
        $(".row_video").hide();
        $(".row_foto").hide();
    });

    // Event handler untuk tombol batal
    $("#modal-praktik-update").on(
        "click",
        '[data-dismiss="modal"]',
        function () {
            // Mengatur ulang form
            $("#form-praktik-update")[0].reset();
            // Menyembunyikan input PDF
            $(".row_pdf").hide();
            $(".row_link").hide();
            $(".row_link_video").hide();
            $(".row_video").hide();
            $(".row_foto").hide();
        }
    );

   $("#table-data").on("click", ".btn-update", function () {
        var tr = $(this).closest("tr");
        var data = table.row(tr).data();

        clearErrorMessage();
        $("#form-praktik-update")[0].reset();

        if (data) {
            $.each(data, (key, value) => {
                if (key === 'foto') {
                    // Show image preview for 'foto' field
                    if (value) {
                        $("#foto").html(
                            '<img src="' +
                            value +
                            '" style="height: 100px; margin-top: 10px;">'
                        );
                    }
                } else if (key === 'foto_praktik') {
                    // Show image preview for 'foto_praktik' field
                    if (value) {
                        $("#updatepraktikPreview").html(
                            '<img src="' +
                            value +
                            '" style="height: 100px; margin-top: 10px;">'
                        );
                    }
                }else if (key === 'file_pdf') {
                    // Check if value exists and it is a PDF file
                    if (value && value.endsWith('.pdf')) {
                        $(".row_pdf").show();
                        // console.log(value);
                    }
                } else if (key === 'video') {
                    // Check if value exists and it is a PDF file
                    if (value) {
                        $(".row_video").show();
                        // console.log(value);
                    }
                }
                 else {
                    // Set other input fields normally
                    $("#update-" + key).val(value);
                }
            });

            // Handle showing/hiding input sections based on the selected 'jenis' value
            var jenisInputan = data['jenis'];
            if (jenisInputan) {
                $(".row_link, .row_video, .row_foto, .row_pdf").hide();
                if (jenisInputan === 'link') {
                    $(".row_link").show();
                } else if (jenisInputan === 'video') {
                    $(".row_video").show();
                } else if (jenisInputan === 'foto') {
                    $(".row_foto").show();
                } else if (jenisInputan === 'pdf') {
                    $(".row_pdf").show();
                }
            } else {
                // If jenisInputan is not available, show the appropriate input section based on the existing data
                if (data['link_video']) {
                    $(".row_link").show();
                } else if (data['video']) {
                    $(".row_video").show();
                } else if (data['file_pdf']) {
                    $(".row_pdf").show();
                } else if (data['foto_praktik']) {
                    $(".row_foto").show();
                }
            }

            // Show file PDF input if file PDF is available
            if (data['file_pdf']) {
                $(".row_pdf").show();
            }

            $("#modal-praktik-update").modal("show");
        } else {
            // Handle the case when data is not available
            console.error("Data is not available.");
        }
    });
    // $("#table-data").on("click", ".btn-update", function () {
    //     var tr = $(this).closest("tr");
    //     var data = table.row(tr).data();

    //     clearErrorMessage();
    //     $("#form-praktik-update")[0].reset();

    //     if (data) {
    //         $.each(data, (key, value) => {
    //             $("#update-" + key).val(value);
    //         });

    //         if (data.foto) {
    //             $("#foto").html(
    //                 '<img src="' +
    //                     data.foto +
    //                     '" style="height: 100px; margin-top: 10px;">'
    //             );
    //         }
    //         if (data.foto_praktik) {
    //             $("#updatepraktikPreview").html(
    //                 '<img src="' +
    //                     data.foto +
    //                     '" style="height: 100px; margin-top: 10px;">'
    //             );
    //         }

    //         if (data.file_pdf) {
    //             $("#pdf_preview").attr("src", data.file_pdf);
    //         } else {
    //             // Handle the case when file_pdf is not available or empty
    //             // For instance, you might want to hide the pdf preview element
    //             $("#pdf_preview").hide();
    //         }

    //         // Periksa apakah data link terisi
    //         if (data.link_video !== null && data.link_video !== "") {
    //             $(".row_link").css("display", "block");
    //             $(".row_video").css("display", "none");
    //         } else {
    //             $(".row_link").css("display", "none");
    //             $(".row_video").css("display", "block");
    //         }

    //         $("#modal-praktik-update").modal("show");
    //     } else {
    //         // Handle the case when data is not available
    //         console.error("Data is not available.");
    //     }
    // });


    $("#form-praktik").on("submit", function (e) {
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
                $("#modal-praktik")
                    .find(".modal-dialog")
                    .LoadingOverlay("show");
            },
            success: (res) => {
                $("#modal-praktik")
                    .find(".modal-dialog")
                    .LoadingOverlay("hide", true);
                $(this)[0].reset();
                clearErrorMessage();
                table.ajax.reload();
                $("#modal-praktik").modal("hide");
                showSuccessToastr("sukses", "praktik baik berhasil ditambahkan");
            },
            error: ({ status, responseJSON }) => {
                $("#modal-praktik")
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
        $("#form-praktik")[0].reset();
        clearErrorMessage();
        $("#modal-praktik").modal("show");
    });

    table = $("#table-data").DataTable({
        language: dtLang,
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + "praktik_baik/data",
            type: "get",
            dataType: "json",
        },
        order: [[5, "desc"]],
        columnDefs: [
            {
                targets: [0, 4],
                orderable: false,
                searchable: false,
                className: "text-center align-top",
            },
            {
                targets: [1, 2],
                className: "text-left align-top",
            },
            {
                targets: [4],
                className: "text-center align-top",
            },
            {
                targets: [5],
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
                data: "link_video",
                render: (data, type, row) => {
                    return data ?? "-";
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
