<div class="row">
    <div class="col-lg-12">
        <button type="button" onclick="$('#input-file-modal').trigger('click');" class="btn btn-primary mb-3 btn-rounded btn-block">
            <i class="fas fa-upload"></i> KLIK DISINI UNTUK UPLOAD DOKUMEN
        </button>
        <input style="display: none;" accept=".jpg, .jpeg, .png, .pdf" type="file" name="dokumen[]" multiple id="input-file-modal" data-id="{{ $data->encrypted_id }}" onchange="upload_dokumen_modal(this)">
    </div>
    @foreach ($data->dokumen as $item)
        <div class="col-lg-12 pb-3 d-flex flex-column align-items-center justify-content-center">
            @if($item->extension == 'pdf')
                <iframe src="{{ asset($item->file) }}" frameborder="0" style="height: 500px; width: 100%;"></iframe>
                <button onclick="hapus_dokumen(this);" data-id="{{ $item->encrypted_id }}" class="btn btn-danger mt-2 mb-3 btn-rounded font-weight-bold">
                    <i class="fas fa-trash"></i> KLIK UNTUK HAPUS DOKUMEN
                </button>
                @elseif(in_array($item->extension, ['jpg','jpeg', 'png']))
                <button onclick="hapus_dokumen(this);" data-id="{{ $item->encrypted_id }}" class="btn btn-danger mt-2 mb-3 btn-rounded font-weight-bold" style="position: absolute; top: 0; right: 25px;">
                    <i class="fas fa-trash"></i> KLIK UNTUK HAPUS DOKUMEN
                </button>
                <img src="{{ asset($item->file) }}" style="height: 500px; width: 100%;" alt="gambar">
            @endif
        <div style="border: dashed #365984 2px; width: 100%;"></div>
    </div>
    @endforeach
</div>

<script>
    function upload_dokumen_modal(ctx) {
        let formData = new FormData()
        let files = $(ctx)[0].files;
        for (const key in files) {
            if (Object.hasOwnProperty.call(files, key)) {
                const file = files[key];
                formData.append('dokumen[]', file)
            }
        }
        formData.append('id', '{{ $data->encrypted_id }}')
            
        $.ajax({
            type: "POST",
            url: "{{ route('spt_pph_21.upload_dokumen') }}",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: () => {
                Swal.fire({
                    icon: 'info',
                    title: "Mohon ditunggu...",
                    didOpen: () => Swal.showLoading(),
                    showConfirmButton: false,
                    showCancelButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            }
        }).then(res => {
            Swal.close()
            if (res.status) {
                showSuccessToastr('Sukses', res.message);
                table.ajax.reload(null, false)
                lihat_dokumen('{{ $data->encrypted_id }}')
            } else {
                showErrorToastr('Gagal', res.message);
            }
        }).catch(err => {
            console.error(err)
            showErrorToastr('Gagal', 'Terjadi kesalahan.');
        })
    }

    function hapus_dokumen(ctx) {
        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus dokumen!`,
            footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Dokumen!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let { id } = $(ctx).data();
                console.log(id)
                $.ajax({
                    url: "{{ route('spt_pph_21.hapus_dokumen') }}",
                    type: 'DELETE',
                    data: {
                        id,
                        id_ref: '{{ $data->encrypted_id }}',
                        _method: 'delete'
                    },
                    beforeSend: () => {
                        Swal.fire({
                            icon: 'info',
                            title: "Mohon ditunggu...",
                            didOpen: () => Swal.showLoading(),
                            showConfirmButton: false,
                            showCancelButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        });
                    }
                }).then(res => {
                    Swal.close()
                    showSuccessToastr('Sukses', res.message);
                    table.ajax.reload()
                    if (res.reload) {
                        $('#modal-custom').modal('hide')
                    } else  {
                        lihat_dokumen('{{ $data->encrypted_id }}')
                    }
                }).catch(err => {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal menghapus data!",
                        text: "Terjadi kesalahan saat menghapus data",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
            }
        });
    }
</script>