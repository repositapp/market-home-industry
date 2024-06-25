<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-6 align-self-center">
                  Data Reseler
               </div>
               <div class="col-md-6">
                  <div class="float-right">
                     <a href="<?= base_url(); ?>user/tambah_reseler" class="btn btn-primary btn-rounded box-shadow btn-icon"><i class="fa fa-plus"></i> Tambah Data</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <table id="datatable" class="table table-striped table-hover">
               <thead>
                  <tr>
                     <th width="10">No.</th>
                     <th class="text-center" width="60">Foto</th>
                     <th width="200">Reseler</th>
                     <th width="150">Lapak</th>
                     <th class="text-center" width="50">JK</th>
                     <th class="text-center" width="100">Waktu Daftar</th>
                     <th class="text-center" width="80">Status</th>
                     <th class="text-center" width="40">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_reseler as $reseler) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td class="text-center">
                           <img alt="profile" class="rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $reseler['foto_reseler']; ?>" width="50" height="50">
                        </td>
                        <td><?= $reseler['nm_reseler']; ?></td>
                        <td><?= $reseler['nm_toko']; ?></td>
                        <td class="text-center">
                           <?php if ($reseler['jk_reseler'] == "Laki-Laki") { ?>
                              L
                           <?php } elseif ($reseler['jk_reseler'] == "Perempuan") { ?>
                              P
                           <?php } ?>
                        </td>
                        <td class="text-center"><?= date('d M Y, H:i', strtotime($reseler['change_reseler'])); ?></td>
                        <td class="text-center">
                           <?php if ($reseler['status_toko'] == '0') { ?>
                              <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                           <?php } elseif ($reseler['status_toko'] == '1') { ?>
                              <span class="badge badge-pill badge-info">Aktif</span>
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
                                       <a class="dropdown-item text-info" href="<?= base_url(); ?>user/detail_reseler/<?= $reseler['id_user']; ?>"><i class="fa fa-search"></i> Detail</a>
                                    </li>
                                    <li>
                                       <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#ubahStatus<?= $no; ?>"><i class="fa fa-edit"></i> Ubah Status</a>
                                    </li>
                                    <li>
                                       <a class="dropdown-item text-danger" href="<?= base_url(); ?>user/hapus_reseler/<?= $reseler['id_user']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini? Hal yang berkaitan dengan data ini akan ikut terhapus (Data Reseler, Data Toko, dan Data Produk). Mohon dipikirkan kembali.');"><i class="fa fa-trash"></i> Hapus</a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </td>
                     </tr>

                     <!-- Modal Ubah Data -->
                     <div id="ubahStatus<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <form method="post" action="<?= base_url('user/data_reseler'); ?>" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                    <h5 class="modal-title" id="myDefaultModalLabel">Ubah Status</h5>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" name="ubah_data" value="ubahStatus">
                                    <input type="hidden" id="id_user" name="id_user" value="<?= $reseler['id_user']; ?>">
                                    <input type="hidden" id="change_user" name="change_user" value="<?= $tanggalwaktu; ?>">

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Status</label>
                                       <div class="col-sm-9">
                                          <select class="form-control m-b" id="status_toko" name="status_toko" required>
                                             <option <?php if ($reseler['status_toko'] == '1') {
                                                         echo 'selected';
                                                      } ?> value="1">Aktif</option>
                                             <option <?php if ($reseler['status_toko'] == '0') {
                                                         echo 'selected';
                                                      } ?> value="0">Tidak Aktif</option>
                                          </select>
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
</div>