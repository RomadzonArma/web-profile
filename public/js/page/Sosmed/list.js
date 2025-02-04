$("#form-sosmed").submit(function (e) {
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
                    window.location.href = BASE_URL + 'sosmed';
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

