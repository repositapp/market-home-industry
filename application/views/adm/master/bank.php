<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Data Rekening
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
                     <th>Bank</th>
                     <th>Rekening</th>
                     <th>Pemilik</th>
                     <th class="text-center" width="40"><i class="fa fa-sort"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_bank->result_array() as $bank) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td><?= $bank['nm_bank']; ?></td>
                        <td><?= $bank['no_rekening']; ?></td>
                        <td><?= $bank['pemilik']; ?></td>
                        <td class="text-center">
                           <ul class="list-inline">
                              <li id="aksi" class="dropdown">
                                 <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-ellipsis-v"></i>
                                 </a>
                                 <ul class="dropdown-menu top-dropdown">
                                    <li>
                                       <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit"></i> Ubah</a>
                                    </li>
                                    <li>
                                       <a class="dropdown-item text-danger" href="<?= base_url(); ?>transaksi/hapus_rekening/<?= $bank['id_bank']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </td>
                     </tr>

                     <!-- Modal Ubah Data -->
                     <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <form method="post" action="<?= base_url('transaksi/data_rekening'); ?>" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                    <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" name="ubah_data" value="ubah">

                                    <input type="hidden" id="id_bank" name="id_bank" value="<?= $bank['id_bank']; ?>">

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Bank</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="nm_bank" name="nm_bank" autocomplete="off" value="<?= $bank['nm_bank']; ?>" required>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Rekening</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="no_rekening" name="no_rekening" autocomplete="off" value="<?= $bank['no_rekening']; ?>" required>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Pemilik</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="pemilik" name="pemilik" autocomplete="off" value="<?= $bank['pemilik']; ?>" required>
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
            <form method="post" action="<?= base_url('transaksi/data_rekening'); ?>" enctype="multipart/form-data">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Bank</label>
                     <div class="col-sm-9">
                        <input type="text" id="nm_bank" name="nm_bank" autocomplete="off" required>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Rekening</label>
                     <div class="col-sm-9">
                        <input type="text" id="no_rekening" name="no_rekening" autocomplete="off" required>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Pemilik</label>
                     <div class="col-sm-9">
                        <input type="text" id="pemilik" name="pemilik" autocomplete="off" required>
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