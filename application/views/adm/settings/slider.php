<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Slider/Papan Informasi
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="#" class="btn btn-primary btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Data</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <table id="datatable" class="table table-striped dt-responsive table-hover">
               <thead>
                  <tr>
                     <th width="40">No.</th>
                     <th class="text-center" width="150">Gambar/Video</th>
                     <th>Keterangan Slider</th>
                     <th class="text-center" width="130">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_slider->result_array() as $slider) :
                     $exp = explode(".", $slider['gbr_slider']);
                  ?>
                     <tr>
                        <td><?= $no; ?></td>
                        <td class="text-center">
                           <?php if ($exp[1] == 'mp4' || $exp[1] == 'avi' || $exp[1] == 'mkv' || $exp[1] == '3gp' || $exp[1] == 'mgp' || $exp[1] == 'mpeg') { ?>
                              <video controls playsinline class="img-fluid rounded" style="width:80px !important;">
                                 <source src="<?= base_url(); ?>assets/upload/<?= $slider['gbr_slider']; ?>">
                              </video>
                           <?php } else { ?>
                              <img src="<?= base_url(); ?>assets/upload/<?= $slider['gbr_slider']; ?>" alt="" class="img-fluid rounded" style="width:80px !important;">
                           <?php } ?>
                        </td>
                        <td><?= $slider['ket_slider']; ?></td>
                        <td class="text-center">
                           <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"></i></a>
                           <a href="<?= base_url(); ?>settings/hapus_slider/<?= $slider['id_slider']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>

                     <!-- Modal Ubah Data -->
                     <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <form method="post" action="<?= base_url('settings/slider'); ?>" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                    <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" name="ubah_data" value="ubah">
                                    <input type="hidden" id="id_slider" name="id_slider" value="<?= $slider['id_slider']; ?>">

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Keterangan Slider</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="ket_slider" name="ket_slider" class="form-control" autocomplete="off" value="<?= $slider['ket_slider']; ?>" required>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Gambar/Video</label>
                                       <div class="col-sm-9">
                                          <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $slider['gbr_slider']; ?>">

                                          <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                             <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                                             <span class="input-group-addon btn btn-primary btn-file ">
                                                <span class="fileinput-new">Select</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="gbr_slider" onchange="validate(this);">
                                             </span>
                                             <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>

                                          <div class="checkbox checkbox-primary" style="margin-top: -25px;padding-left: 0px;">
                                             <input type="checkbox" id="checkbox<?= $no; ?>" name="ubah_gambar">
                                             <label for="checkbox<?= $no; ?>"> Ubah Gambar/Video </label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  <?php $no++;
                  endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <!-- Modal Tambah Data -->
   <div id="tambahData" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form method="post" action="<?= base_url('settings/slider'); ?>" enctype="multipart/form-data">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Keterangan Slider</label>
                     <div class="col-sm-9">
                        <input type="text" id="ket_slider" name="ket_slider" class="form-control" autocomplete="off" required>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Gambar/Video</label>
                     <div class="col-sm-9">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                           <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                           <span class="input-group-addon btn btn-primary btn-file ">
                              <span class="fileinput-new">Select</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" name="gbr_slider" onchange="validate(this);" required>
                           </span>
                           <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
               </div>
            </form>
         </div>
      </div>
   </div>

</div>