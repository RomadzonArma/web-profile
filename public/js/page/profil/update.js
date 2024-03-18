let table;
let konten;
$(() => {
    konten = $('#old-konten').val();
    var encodedContent = encodeURIComponent(konten);
    $('#summernote').summernote({
        // toolbar: [
        //     // [groupName, [list of button]]
        //     ['style', ['bold', 'italic', 'underline', 'clear']],
        //     ['font', ['strikethrough', 'superscript', 'subscript']],
        //     ['fontsize', ['fontsize']],
        //     ['color', ['color']],
        //     ['para', ['ul', 'ol', 'paragraph']],
        //     ['insert', ['picture']],
        //     ['height', ['height']]
        // ],
        height: 350,
        charset: 'utf-8'
    });
    $("#summernote").summernote("code", decodeURIComponent(encodedContent));

    $('#form-update').on('submit', function (e) {
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
                    text: 'Berhasil mengubah profil',
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
        })
    })

    $(document).ready(function () {
        $('#id_kategori').select2();
    });
})
