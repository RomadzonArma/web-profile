let table;
let konten;
$(() => {
    konten = $('#isi_konten').val();
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
                showSuccessToastr('sukses', 'Berhasil memperbarui data');
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

                showErrorToastr('oops', responseJSON.msg)
            }
        })
    })

})

