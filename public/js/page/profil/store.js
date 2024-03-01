let table;
$(() => {
    $('#summernote').summernote({
        height: 350,
    });

    $(document).ready(function () {
        $('#id_kategori').select2();
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
            beforeSend: () => {
                clearErrorMessage();
            },
            success: (res) => {
                console.log(res);
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Berhasil menyimpan data',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = BASE_URL + 'profil';
                });
            },
            error: ({ status, responseJSON }) => {
                if (status == 422) {
                    var errors = responseJSON.errors;
                    var errorMessage = '';

                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessage += errors[key][0] + '<br>';
                        }
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorMessage,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: responseJSON.msg,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }
        });
    });
});
