<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Profil Aplikasi
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="#" class="btn btn-success btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#ubahData"><i class="fa fa-edit"></i> Ubah Data</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
            <table class="table bordered">
               <tbody>
                  <tr>
                     <td width="250">Nama Aplikasi</td>
                     <td>: <?= $set_web['nama_web']; ?></td>
                  </tr>
                  <tr>
                     <td width="250">Title Aplikasi</td>
                     <td>: <?= $set_web['title_web']; ?></td>
                  </tr>
                  <tr>
                     <td width="250">Title Aplikasi</td>
                     <td>: <?= $set_web['sidebar_title']; ?></td>
                  </tr>
                  <tr>
                     <td>Nama Instansi/Perusahaan</td>
                     <td>: <?= $set_web['nm_instansi']; ?></td>
                  </tr>
                  <tr>
                     <td>Email Kantor</td>
                     <td>: <?= $set_web['email_web']; ?></td>
                  </tr>
                  <tr>
                     <td>Telepon Kantor</td>
                     <td>: <?= $set_web['telepon_web']; ?></td>
                  </tr>
                  <tr>
                     <td>Fax Kantor</td>
                     <td>: <?= $set_web['fax_web']; ?></td>
                  </tr>
                  <tr>
                     <td>Website Kantor</td>
                     <td>: <a href="<?= $set_web['web_kantor']; ?>" target="_blank"><?= $set_web['web_kantor']; ?></a></td>
                  </tr>
                  <tr>
                     <td>Alamat Kantor</td>
                     <td>: <?= $set_web['alamat_web']; ?></td>
                  </tr>
                  <tr>
                     <td>Tentang Aplikasi</td>
                     <td>
                        <div class="d-flex">
                           : <?= $set_web['tentang_aplikasi']; ?>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>Gambar Tentang Aplikasi</td>
                     <td>
                        <div class="d-flex">
                           : <img src="<?= base_url() ?>assets/upload/<?= $set_web['gambar_about']; ?>" class="img-thumbnail rounded d-block ml-1" alt="..." style="width: 100px; height: 100px;">
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>Logo Aplikasi</td>
                     <td>
                        <div class="d-flex">
                           : <img src="<?= base_url() ?>assets/upload/<?= $set_web['logo_web']; ?>" class="img-thumbnail rounded d-block ml-1" alt="..." style="width: 100px; height: 100px;">
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>

<!-- Modal Ubah Data -->
<form method="post" action="<?= base_url('settings/apk_profile'); ?>" enctype="multipart/form-data">
   <div id="ubahData" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data Profil Aplikasi</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="ubah_data" value="ubah">
               <input type="hidden" name="id_web" value="<?= $set_web['id_web']; ?>">
               <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $set_web['gambar_about']; ?>">
               <input type="hidden" class="form-control" id="old_logo" name="old_logo" value="<?= $set_web['logo_web']; ?>">

               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Nama Aplikasi</label>
                  <div class="col-9">
                     <input type="text" class="form-control" id="nama_web" name="nama_web" value="<?= $set_web['nama_web']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Title Aplikasi</label>
                  <div class="col-9">
                     <input type="text" class="form-control" id="title_web" name="title_web" value="<?= $set_web['title_web']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Sidebar Title</label>
                  <div class="col-9">
                     <input type="text" class="form-control" id="sidebar_title" name="sidebar_title" value="<?= $set_web['sidebar_title']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Nama Instansi/Perusahaan</label>
                  <div class="col-9">
                     <input type="text" class="form-control" id="nm_instansi" name="nm_instansi" value="<?= $set_web['nm_instansi']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Email Kantor</label>
                  <div class="col-9">
                     <input type="email" class="form-control" id="email_web" name="email_web" value="<?= $set_web['email_web']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Telepon Kantor</label>
                  <div class="col-9">
                     <input type="text" class="form-control" id="telepon_web" name="telepon_web" value="<?= $set_web['telepon_web']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Fax Kantor</label>
                  <div class="col-9">
                     <input type="text" class="form-control" id="fax_web" name="fax_web" value="<?= $set_web['fax_web']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Website Kantor</label>
                  <div class="col-9">
                     <input type="text" class="form-control" id="web_kantor" name="web_kantor" value="<?= $set_web['web_kantor']; ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-3 col-form-label" for="example-email">Alamat Kantor</label>
                  <div class="col-9">
                     <textarea class="form-control" id="alamat_web" name="alamat_web" rows="5" required><?= $set_web['alamat_web']; ?></textarea>
                     <span class="help-block"><small>Alamat Berisikan : Nama Jalan, Kelurahan, Kecamatan, Kota</small></span>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Tentang Aplikasi</label>
                  <div class="col-sm-9">
                     <textarea id="tentang_aplikasi" name="tentang_aplikasi" class="summernote2" required><?= $set_web['tentang_aplikasi']; ?></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Gambar Tentang Aplikasi</label>
                  <div class="col-sm-3">
                     <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                        <input type="checkbox" id="ubah_gambar" name="ubah_gambar">
                        <label for="ubah_gambar"> Ubah Gambar! </label>
                     </div>
                     <img alt="" src="<?= base_url(); ?>assets/upload/<?= $set_web['gambar_about']; ?>" class="img-fluid rounded" style="width: 100px;">
                  </div>
                  <div class="col-sm-4">
                     <div class="fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview" data-trigger="fileinput" style="width: 150px; height:100px;"></div>
                        <span class="btn btn-primary  btn-file">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" id="gambar" name="gambar_about" onchange="validate(this);">
                        </span>
                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Logo Aplikasi</label>
                  <div class="col-sm-3">
                     <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                        <input type="checkbox" id="ubah_logo" name="ubah_logo">
                        <label for="ubah_logo"> Ubah Logo! </label>
                     </div>
                     <img alt="" src="<?= base_url(); ?>assets/upload/<?= $set_web['logo_web']; ?>" class="img-fluid rounded" style="width: 100px;">
                  </div>
                  <div class="col-sm-4">
                     <div class="fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview" data-trigger="fileinput" style="width: 150px; height:100px;"></div>
                        <span class="btn btn-primary  btn-file">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" id="gambar" name="logo_web" onchange="validateIkon(this);">
                        </span>
                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
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