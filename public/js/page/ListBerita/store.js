let table;
$(() => {
    $('#isi_konten').summernote({
        height: 350,
    });

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^\w\-]+/g, '') // Remove all non-word chars
            .replace(/\-\-+/g, '-') // Replace multiple - with single -
            .replace(/^-+/, '') // Trim - from start of text
            .replace(/-+$/, ''); // Trim - from end of text
    }



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
                showSuccessToastr('sukses', 'Berhasil menyimpan data');
                window.location.href = BASE_URL + 'list_berita';
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
});



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
