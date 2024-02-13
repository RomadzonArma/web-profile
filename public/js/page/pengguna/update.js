let table;
$(() => {
    $('#summernote').summernote({
        height: 350,
        charset: 'utf-8',
    });

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
                showSuccessToastr('sukses','Berhasil memperbarui data');
                window.location.href=BASE_URL+'informasi-publik';
            },
            error: ({ status, responseJSON }) => {

                if (status == 422) {
                    generateErrorMessage(responseJSON);
                    return false;
                }

                showErrorToastr('oops', responseJSON.msg)
            }
        })
    })

})
