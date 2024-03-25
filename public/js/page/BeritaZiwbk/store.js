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
                        window.location.href = BASE_URL + 'berita_zi_wbk';
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


$(document).ready(function() {
    $('#id_kategori').select2();
});

$(document).ready(function() {
    $('#id_penulis').select2();
});

