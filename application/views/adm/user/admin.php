<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-6 align-self-center">
                  Data Admin
               </div>
               <div class="col-md-6 align-self-center">
                  <div class="float-right">
                     <a href="#" class="btn btn-primary btn-rounded box-shadow btn-icon" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Data</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <table id="datatable" class="table table-striped table-hover">
               <thead>
                  <tr>
                     <th width="40">No.</th>
                     <th class="text-center" width="90">Foto</th>
                     <th width="200">Nama</th>
                     <th class="text-center" width="60">JK</th>
                     <th width="200">Email</th>
                     <th width="250">Alamat</th>
                     <th class="text-center" width="80">Status</th>
                     <th class="text-center" width="40"><i class="fa fa-sort"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_admin as $admin) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td class="text-center">
                           <img alt="profile" class="rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $admin['foto_admin']; ?>" width="50" height="50">
                        </td>
                        <td><?= $admin['nm_admin']; ?></td>
                        <td class="text-center">
                           <?php if ($admin['jk_admin'] == "Laki-Laki") { ?>
                              L
                           <?php } elseif ($admin['jk_admin'] == "Perempuan") { ?>
                              P
                           <?php } ?>
                        </td>
                        <td><?= $admin['email_admin']; ?></td>
                        <td><?= $admin['alamat_admin']; ?></td>
                        <td class="text-center">
                           <?php if ($admin['sts_akun'] == '1') { ?>
                              <span class="badge badge-pill badge-info">Active</span>
                           <?php } elseif ($admin['sts_akun'] == '0') { ?>
                              <span class="badge badge-pill badge-danger">Not Active</span>
                           <?php } ?>
                        </td>
                        <td class="text-center">
                           <ul class="list-inline">
                              <li id="aksi" class="dropdown">
                                 <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-ellipsis-v"></i>
                                 </a>
                                 <ul class="dropdown-menu top-dropdown">
                                    <li>
                                       <a class="dropdown-item text-info" href="#" data-toggle="modal" data-target="#lihatData<?= $no; ?>"><i class="fa fa-search"></i> Detail</a>
                                    </li>
                                    <?php if ($admin['sts_akun'] == '1') { ?>
                                       <li>
                                          <a class="dropdown-item text-danger" href="<?= base_url(); ?>user/akun_status/<?= $admin['id_user']; ?>" onclick="return confirm('Anda yakin ingin memblokir akun ini? Silahkan klik YES untuk memblokir akun.');"><i class="fa fa-lock"></i> Block</a>
                                       </li>
                                    <?php } elseif ($admin['sts_akun'] == '0') { ?>
                                       <li>
                                          <a class="dropdown-item text-success" href="<?= base_url(); ?>user/akun_status/<?= $admin['id_user']; ?>" onclick="return confirm('Anda yakin ingin membuka blokiran akun ini? Silahkan klik YES untuk membuka blokir akun.');"><i class="fa fa-unlock"></i> Unblock</a>
                                       </li>
                                    <?php } ?>
                                    <li>
                                       <a class="dropdown-item text-danger" href="<?= base_url(); ?>user/hapus_admin/<?= $admin['id_user']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </td>
                     </tr>

                     <!-- Modal Lihat Data -->
                     <div id="lihatData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                 <h5 class="modal-title" id="myDefaultModalLabel">Lihat Data</h5>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-4 col-form-label">Username</label>
                                          <div class="col-sm-8">
                                             <input type="text" class="form-control" value="<?= $admin['username']; ?>" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-4 col-form-label">Nama</label>
                                          <div class="col-sm-8">
                                             <input type="text" class="form-control" value="<?= $admin['nm_admin']; ?>" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                          <div class="col-sm-8">
                                             <input type="text" class="form-control" value="<?= $admin['jk_admin']; ?>" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                                          <div class="col-sm-8">
                                             <input type="text" class="form-control" value="<?= $admin['telp_admin']; ?>" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-4 col-form-label">Email</label>
                                          <div class="col-sm-8">
                                             <input type="text" class="form-control" value="<?= $admin['email_admin']; ?>" disabled>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group row">
                                          <label for="label" class="col-sm-4 col-form-label">Alamat</label>
                                          <div class="col-sm-8">
                                             <textarea id="alamat_admin" disabled><?= $admin['alamat_admin']; ?></textarea>
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <label for="label" class="col-sm-4 col-form-label">Foto User</label>
                                          <div class="col-sm-8">
                                             <img class="img-fluid" src="<?= base_url() ?>assets/upload/<?= $admin['foto_admin']; ?>" style="width: 90%; height:100%">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
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
   <div id="tambahData" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <form method="post" action="<?= base_url('user/data_admin'); ?>" enctype="multipart/form-data">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="tambah_data" value="tambah">
                  <input type="hidden" id="change_user" name="change_user" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="akses" name="akses" value="1">

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Nama</label>
                           <div class="col-sm-8">
                              <input type="text" id="nm_admin" name="nm_admin" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                           <div class="col-sm-8">
                              <select id="jk_admin" name="jk_admin" class="form-control m-b" required>
                                 <option selected="selected" disabled>-Pilih Jenis Kelamin-</option>
                                 <option value="Laki-Laki">Laki-Laki</option>
                                 <option value="Perempuan">Perempuan</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                           <div class="col-sm-8">
                              <input type="text" id="telp_admin" name="telp_admin" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Email</label>
                           <div class="col-sm-8">
                              <input type="email" id="email_admin" name="email_admin" class="form-control" autocomplete="off" required>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Alamat</label>
                           <div class="col-sm-8">
                              <textarea id="alamat_admin" name="alamat_admin" class="form-control" required></textarea>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Foto User</label>
                           <div class="col-sm-8">
                              <div class="fileinput-new" data-provides="fileinput">
                                 <div class="fileinput-preview" data-trigger="fileinput" style="width: auto; height:150px; text-align: center;"></div>
                                 <span class="btn btn-primary  btn-file">
                                    <span class="fileinput-new">Select</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" id="gambar" name="foto_admin" onchange="validate(this);" required>
                                 </span>
                                 <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="label" class="col-sm-4 col-form-label">Username</label>
                                 <div class="col-sm-8">
                                    <input type="text" id="username" name="username" class="form-control" autocomplete="off" required>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="thresholdconfig" class="col-sm-4 col-form-label">Password</label>
                                 <div class="col-sm-8">
                                    <input type="password" id="thresholdconfig" name="password" class="form-control" autocomplete="off" required>
                                    <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                                       <input type="checkbox" onclick="Toggle()" id="show-hide" name="password">
                                       <label for="show-hide"> Show Password </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
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