let table;
let isi_konten;
$(() => {
    isi_konten = $('#old-konten').val();
    var encodedContent = encodeURIComponent(isi_konten);
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
                window.location.href = BASE_URL + 'list_berita/index';
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
document.addEventListener("DOMContentLoaded", function () {
    var statusVideoCheckbox = document.getElementById("status_video");
    var urlVideoContainer = document.getElementById("url_video_container");

    statusVideoCheckbox.addEventListener("change", function () {
        if (this.checked) {
            urlVideoContainer.style.display = "block";
        } else {
            urlVideoContainer.style.display = "none";
        }
    });
});
