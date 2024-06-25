<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Profil Admin
               </div>
               <div class="col-md-8">
                  <div class="float-right">
                     <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahBiodata"><i class="fa fa-edit"></i> Ubah Biodata</a>
                     <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ubahData"><i class="fa fa-edit"></i> Ubah Password</a>
                     <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahGambar"><i class="fa fa-edit"></i> Ubah Foto</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-3">
                  <img alt="" src="<?= base_url(); ?>assets/upload/<?= $user['foto_admin']; ?>" class="img-fluid rounded" width="300">
               </div>
               <div class="col-md-9">
                  <table class="table bordered">
                     <tbody>
                        <tr>
                           <td>Nama</td>
                           <td><b>: <?= $user['nm_admin']; ?></b></td>
                        </tr>
                        <tr>
                           <td>Jenis Kelamin</td>
                           <td><b>: <?= $user['jk_admin']; ?></b></td>
                        </tr>
                        <tr>
                           <td>Telepon</td>
                           <td><b>: <?= $user['telp_admin']; ?></b></td>
                        </tr>
                        <tr>
                           <td>Email</td>
                           <td><b>: <?= $user['email_admin']; ?></b></td>
                        </tr>
                        <tr>
                           <td>Alamat</td>
                           <td><b>: <?= $user['alamat_admin']; ?></b></td>
                        </tr>
                        <tr>
                           <td>Username</td>
                           <td><b>: <?= $user['username']; ?></b></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>

<!-- Modal Ubah Data -->
<form method="post" action="<?= base_url('user/admin_profile'); ?>" enctype="multipart/form-data">
   <div id="ubahBiodata" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Ubah Biodata</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="ubah_data" value="ubahBiodata">
               <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">
               <input type="hidden" id="change_admin" name="change_admin" value="<?= $tanggalwaktu; ?>">

               <div class="form-group row">
                  <label for="label" class="col-sm-4 col-form-label">Nama Petugas</label>
                  <div class="col-sm-8">
                     <input type="text" id="nm_admin" name="nm_admin" class="form-control" autocomplete="off" required value="<?= $user['nm_admin']; ?>">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-8">
                     <select id="jk_admin" name="jk_admin" class="form-control m-b" required>
                        <option selected="selected" disabled>-Pilih Jenis Kelamin-</option>
                        <option <?php if ($user['jk_admin'] == 'Laki-Laki') {
                                    echo 'selected';
                                 } ?> value="Laki-Laki">Laki-Laki</option>
                        <option <?php if ($user['jk_admin'] == 'Perempuan') {
                                    echo 'selected';
                                 } ?> value="Perempuan">Perempuan</option>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                  <div class="col-sm-8">
                     <input type="text" id="telp_admin" name="telp_admin" class="form-control" autocomplete="off" required value="<?= $user['telp_admin']; ?>">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                     <input type="email" id="email_admin" name="email_admin" class="form-control" autocomplete="off" required value="<?= $user['email_admin']; ?>">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-4 col-form-label">Alamat</label>
                  <div class="col-sm-8">
                     <textarea id="alamat_admin" name="alamat_admin" class="form-control" required><?= $user['alamat_admin']; ?></textarea>
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

<!-- Modal Ubah Password -->
<form method="post" action="<?= base_url('user/admin_profile'); ?>" enctype="multipart/form-data">
   <div id="ubahData" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Ubah Password</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="ubah_data" value="ubahPassword">
               <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">
               <input type="hidden" id="change_user" name="change_user" value="<?= $tanggalwaktu; ?>">

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Password Lama</label>
                  <div class="col-sm-9">
                     <input type="text" id="old_password" name="old_password" class="form-control" autocomplete="off" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Password Baru</label>
                  <div class="col-sm-9">
                     <input type="text" id="new_password" name="new_password" class="form-control" autocomplete="off" required>
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

<!-- Modal Ubah Foto -->
<form method="post" action="<?= base_url('user/admin_profile'); ?>" enctype="multipart/form-data">
   <div id="ubahGambar" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Ubah Foto Profil</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="ubah_data" value="ubahGambar">
               <input type="hidden" id="change_admin" name="change_admin" value="<?= $tanggalwaktu; ?>">
               <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">
               <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $user['foto_admin']; ?>">

               <div class="form-group row">
                  <label for="label" class="col-sm-4 col-form-label">Foto Admin</label>
                  <div class="col-sm-4">
                     <div class="fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview" data-trigger="fileinput" style="width: 150px; height:150px;"></div>
                        <span class="btn btn-primary  btn-file">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" id="gambar" name="foto_admin" onchange="validate(this);">
                        </span>
                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <img alt="" src="<?= base_url(); ?>assets/upload/<?= $user['foto_admin']; ?>" class="img-fluid rounded" style="width: 150px;">
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