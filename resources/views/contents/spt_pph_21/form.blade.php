<form autocomplete="off" id="form-submit">
    <div class="form-group">
        <label for="judul">Judul <span class="text-danger">*)</span></label>
        <input type="text" name="judul" id="judul" class="form-control" value="{{@$data->judul}}"
            placeholder="Masukkan judul" required>
        <div id="error-judul"></div>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar <span class="text-danger">*)</span></label>
        <input @if(empty($data->id)) required @endif type="file" name="gambar" id="gambar" class="form-control" accept=".jpg, .jpeg, .png">
        <div id="error-gambar"></div>
        <img class="img-fluid mt-3" style="width: 250px; object-fit: cover;" src="{{@$data->gambar}}" alt="">
    </div>
    @if(empty($data->id))
    <div class="form-group">
        <label for="dokumen">Dokumen <span class="text-danger">*)</span></label>
        <input required type="file" name="dokumen[]" id="dokumen" class="form-control" accept=".pdf" multiple>
        <div id="error-dokumen"></div>
    </div>
    @endif
    <div class="form-group mb-0">
        <button class="btn btn-primary btn-rounded btn-block font-weight-bold">
            <i class="fas fa-plus"></i> KLIK DISINI UNTUK SIMPAN
        </button>
    </div>
</form>

<script>
    $('#form-submit').on('submit', function (event) {
        event.preventDefault()
        let formData = new FormData(this);
        let url;
        @if(empty($data->id))
            url = "{{ route('spt_pph_21.store') }}";
        @else
            url = "{{ route('spt_pph_21.update') }}";
            formData.append('id', '{{ $data->encrypted_id }}');
        @endif
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: () => {
                $('button[type=submit]').prop('disabled', true)
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
            $('button[type=submit]').prop('disabled', false)
            if (res.status) {
                showSuccessToastr('Sukses', res.message);
                table.ajax.reload(null, false)
                $('#modal-custom').modal('hide')
            } else {
                showErrorToastr('Gagal', res.message);
            }
        }).catch(err => {
            Swal.close()
            console.error(err)
            showErrorToastr('Gagal', 'Terjadi kesalahan.');
        })
    });
</script>