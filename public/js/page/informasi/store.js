let table;
$(() => {
    $('#summernote').summernote({
        height: 350,
    });

    $('#form-store').on('submit', function (e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
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
                window.location.href = BASE_URL + 'informasi-publik';
            },
            error: ({
                status,
                responseJSON
            }) => {

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                Swal.fire({
                    icon: "error",
                    title: "Gagal menghapus data!",
                    text: "Terjadi kesalahan saat menghapus data",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })

})
