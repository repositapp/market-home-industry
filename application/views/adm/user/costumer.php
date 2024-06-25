<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-12 align-self-center">
                  Data Costumer
               </div>
            </div>
         </div>

         <div class="card-body">
            <table id="datatable" class="table table-striped table-hover">
               <thead>
                  <tr>
                     <th width="10">No.</th>
                     <th class="text-center" width="60">Foto</th>
                     <th width="200">Costumer</th>
                     <th class="text-center" width="50">JK</th>
                     <th width="150">Telepon</th>
                     <th width="150">Email</th>
                     <th class="text-center" width="80">Status</th>
                     <th class="text-center" width="40">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_costumer as $costumer) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td class="text-center">
                           <img alt="profile" class="rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $costumer['foto_costumer']; ?>" width="50" height="50">
                        </td>
                        <td><?= $costumer['nm_costumer']; ?></td>
                        <td class="text-center">
                           <?php if ($costumer['jk_costumer'] == "Laki-Laki") { ?>
                              L
                           <?php } elseif ($costumer['jk_costumer'] == "Perempuan") { ?>
                              P
                           <?php } ?>
                        </td>
                        <td><?= $costumer['telp_costumer']; ?></td>
                        <td><?= $costumer['email_costumer']; ?></td>
                        <td class="text-center">
                           <?php if ($costumer['sts_akun'] == '1') { ?>
                              <span class="badge badge-pill badge-info">Active</span>
                           <?php } elseif ($costumer['sts_akun'] == '0') { ?>
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
                                       <a class="dropdown-item text-info" href="<?= base_url(); ?>user/detail_costumer/<?= $costumer['id_user']; ?>"><i class="fa fa-search"></i> Detail</a>
                                    </li>
                                    <?php if ($costumer['sts_akun'] == '1') { ?>
                                       <li>
                                          <a class="dropdown-item text-danger" href="<?= base_url(); ?>user/akun_status/<?= $costumer['id_user']; ?>" onclick="return confirm('Anda yakin ingin memblokir akun ini? Silahkan klik YES untuk memblokir akun.');"><i class="fa fa-lock"></i> Block</a>
                                       </li>
                                    <?php } elseif ($costumer['sts_akun'] == '0') { ?>
                                       <li>
                                          <a class="dropdown-item text-success" href="<?= base_url(); ?>user/akun_status/<?= $costumer['id_user']; ?>" onclick="return confirm('Anda yakin ingin membuka blokiran akun ini? Silahkan klik YES untuk membuka blokir akun.');"><i class="fa fa-unlock"></i> Unblock</a>
                                       </li>
                                    <?php } ?>
                                    <li>
                                       <a class="dropdown-item text-danger" href="<?= base_url(); ?>user/hapus_costumer/<?= $costumer['id_user']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini? Hal yang berkaitan dengan data ini akan ikut terhapus. Mohon dipirkan kembali.');"><i class="fa fa-trash"></i> Hapus</a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </td>
                     </tr>
                  <?php $no++;
                  endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>