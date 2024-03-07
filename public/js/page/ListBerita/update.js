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
                        window.location.href = BASE_URL + 'list_berita/index';
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
