let table;
let konten;
$(() => {
    konten = $('#old-konten').val();
    var encodedContent = encodeURIComponent(konten);
    $('#summernote').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['picture']],
            ['height', ['height']]
        ],
        height: 350,
        charset: 'utf-8'
    });
    $("#summernote").summernote("code", decodeURIComponent(encodedContent));

    // $('#form-update').on('submit', function (e) {
    //     e.preventDefault();

    //     var data = new FormData(this);
    //     $.ajax({
    //         url: $(this).attr('action'),
    //         type: $(this).attr('method'),
    //         data: data,
    //         dataType: 'json',
    //         processData: false,
    //         contentType: false,
    //         beforeSend: () => {
    //             clearErrorMessage();
    //         },
    //         success: (res) => {
    //             console.log(res);
    //             showSuccessToastr('sukses', 'Berhasil memperbarui data');
    //             window.location.href = BASE_URL + 'list_agenda';
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
    //     })
    // })


    $("#form-update").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let url = $(this).attr("action");

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
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
            success: function (response) {
                Swal.close();
                if (response.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Berhasil Menyimpan Data",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        window.location.href = BASE_URL + 'list_agenda';
                    });
                } else {
                    toastr.error("Periksa Inputan Anda", {
                        timeOut: 2000,
                        fadeOut: 2000,
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.close();
                toastr.error("Ada inputan yang belum terisi", "Gagal", {
                    timeOut: 2000,
                    fadeOut: 2000,
                });
            }
        });
    });


})
