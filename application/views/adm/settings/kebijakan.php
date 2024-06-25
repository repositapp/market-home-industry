<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Kebijakan
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="#" class="btn btn-success btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#ubahData"><i class="fa fa-edit"></i> Ubah Data</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <?= $kebijakan['konten_kebijakan']; ?>
         </div>
      </div>
   </div>

</div>

<!-- Modal Ubah Data -->
<form method="post" action="<?= base_url('settings/kebijakan'); ?>" enctype="multipart/form-data">
   <div id="ubahData" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="ubah_data" value="ubah">
               <input type="hidden" name="id_kebijakan" value="<?= $kebijakan['id_kebijakan']; ?>">
               <input type="hidden" id="change_kebijakan" name="change_kebijakan" value="<?= $tanggalwaktu; ?>">

               <div class="form-group row">
                  <div class="col-sm-12">
                     <textarea id="konten_kebijakan" name="konten_kebijakan" class="summernote2" required><?= $kebijakan['konten_kebijakan']; ?></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
         </div>
      </div>
   </div>
</form>