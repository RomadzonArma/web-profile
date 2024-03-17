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
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil menghapus data!",
                        text: "Data berhasil dihapus",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table.ajax.reload();
                }).fail((res) => {
                    let { status, responseJSON } = res;
                    Swal.fire({
                        icon: "error",
                        title: "Gagal menghapus data!",
                        text: "Terjadi kesalahan saat menghapus data",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
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
                window.location.href = BASE_URL + 'unduhan';
                Swal.fire({
                    icon: "success",
                    title: "Berhasil Menyimpan data!",
                    text: "Data berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            error: ({
                status,
                responseJSON
            }) => {

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg)
            }
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
                window.location.href = BASE_URL + 'unduhan';
            },
            error: ({
                status,
                responseJSON
            }) => {

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg)
            }
        });
    });

    // $("#form-unduhan").on("submit", function (e) {
    //     e.preventDefault();

    //     var data = new FormData(this);

    //     $.ajax({
    //         url: $(this).attr("action"),
    //         type: $(this).attr("method"),
    //         data: data,
    //         dataType: "json",
    //         processData: false,
    //         contentType: false,
    //         beforeSend: function () {
    //             Swal.fire({
    //                 title: "Mohon Tunggu",
    //                 allowOutsideClick: false,
    //                 onBeforeOpen: () => {
    //                     Swal.showLoading();
    //                 },
    //                 showConfirmButton: false,
    //                 showCancelButton: false,
    //             });
    //         },
    //         success: (res) => {
    //             console.log(res);
    //             Swal.fire({
    //                 icon: "success",
    //                 title: "Sukses",
    //                 text: "Berhasil Menyimpan Data",
    //                 showConfirmButton: false,
    //                 timer: 2000,
    //             });
    //             window.location.href = BASE_URL + 'unduhan';
    //         },
    //         error: ({
    //             status,
    //             responseJSON
    //         }) => {

    //             if (status == 422) {
    //                 generateErrorMessage(responseJSON);
    //                 return false;
    //             }

    //             showErrorToastr('oops', responseJSON.msg)
    //         }
    //     });
    // });

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


$(document).ready(function() {
    $('#id_kategori').select2();
});

$(document).ready(function() {
    $('#update-id_kategori').select2();
});
