 <!-- sample modal content -->
 <div id="modal-update-unduhan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-update-unduhanLabel"
     aria-hidden="true">
     <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{ route('manajemen_unduhan.update') }}"
         id="form-simpan-edit">
         @csrf
         <input type="hidden" id="id_ubah" name="id" value="{{ $data->id ?? '' }}">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title mt-0" id="modal-update-unduhanLabel">Form unduhan</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>

                 <div class="modal-body">
                     <div class="form-group">
                         <label for="judul">Nama unduhan</label>
                         <input type="text" class="form-control" id="judul_edit" name="judul"
                             value="{{ $data->judul ?? '' }}">
                     </div>

                     <div class="form-group">
                         <label for="file">Cover</label>
                         <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="cover_edit" name="cover"
                                 accept=".jpg,.png" onchange="preview('.cover', this.files[0])">
                             <label class="custom-file-label" for="customFile">Choose file</label>
                             <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                 class="text-danger">
                                 (Format image .jpeg, .jpg, & .png )
                             </div>
                             <img src="{{ asset($data->foto) }}" style="width:50%;">
                         </div>

                         <div id="image_preview">
                             <div id="cover" class="cover">

                             </div>
                         </div>

                     </div>
                     <div class="form-group">
                         <label for="file">File PDF</label>
                         <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="file_edit" name="file"
                                 accept=".pdf onchange="handlePdfUpload()>
                             <label class="custom-file-label" for="customFile">Choose file</label>
                             <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;"
                                 class="text-danger">
                                 (Format PDF max 3.mb )
                             </div>

                         </div>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary waves-effect waves-light edit-data">Edit </button>
                 </div>
             </div>
         </div>
 </div>
