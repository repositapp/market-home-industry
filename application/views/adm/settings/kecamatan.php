<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Data Kecamatan
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
                     <th>Kabupaten/Kota</th>
                     <th>Kecamatan</th>
                     <th class="text-center" width="130">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_kecamatan as $kecamatan) : ?>
                     <tr>
                        <td><?= $no; ?></td>
                        <td><?= $kecamatan['nm_kota']; ?></td>
                        <td><?= $kecamatan['nm_kecamatan']; ?></td>
                        <td class="text-center">
                           <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"></i></a>
                           <a href="<?= base_url(); ?>wilayah/hapus_kecamatan/<?= $kecamatan['id_kecamatan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus Data"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>

                     <!-- Modal Ubah Data -->
                     <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <form method="post" action="<?= base_url('wilayah/kecamatan'); ?>" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                    <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" name="ubah_data" value="ubah">

                                    <input type="hidden" id="id_kecamatan" name="id_kecamatan" value="<?= $kecamatan['id_kecamatan']; ?>">

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Kota</label>
                                       <div class="col-sm-9">
                                          <select id="id_kota" name="id_kota" class="form-control m-b" required>
                                             <option selected="selected" disabled>-Pilih Kota-</option>
                                             <?php foreach ($data_kota->result_array() as $kota) : ?>
                                                <option <?php if ($kota['id_kota'] == $kecamatan['id_kota']) {
                                                            echo 'selected';
                                                         } ?> value="<?= $kota['id_kota']; ?>"><?= $kota['nm_kota']; ?></option>
                                             <?php endforeach; ?>
                                          </select>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Kecamatan</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="nm_kecamatan" name="nm_kecamatan" class="form-control" autocomplete="off" value="<?= $kecamatan['nm_kecamatan']; ?>" required>
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
            <form method="post" action="<?= base_url('wilayah/kecamatan'); ?>" enctype="multipart/form-data">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Kota</label>
                     <div class="col-sm-9">
                        <select id="id_kota" name="id_kota" class="form-control m-b" required>
                           <option selected="selected" disabled>-Pilih Kota-</option>
                           <?php foreach ($data_kota->result_array() as $kota) : ?>
                              <option value="<?= $kota['id_kota']; ?>"><?= $kota['nm_kota']; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Kecamatan</label>
                     <div class="col-sm-9">
                        <input type="text" id="nm_kecamatan" name="nm_kecamatan" class="form-control" autocomplete="off" required>
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