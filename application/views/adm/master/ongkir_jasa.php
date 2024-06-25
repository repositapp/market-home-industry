<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Data Ongkir Per Jasa
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
                     <th>Jasa Pengiriman</th>
                     <th width="200">Ongkos Kirim</th>
                     <th class="text-center" width="40"><i class="fa fa-sort"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_ongkir->result_array() as $ongkir) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td><?= $ongkir['jasa_pengiriman']; ?></td>
                        <td>Rp. <?= number_format($ongkir['harga_perkilo'], 0, ".", "."); ?> /kg</td>
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
                                    <?php if ($ongkir['id_ongkir_jasa'] != 1) { ?>
                                       <li>
                                          <a class="dropdown-item text-danger" href="<?= base_url(); ?>ongkir/hapus_ongkir_jasa/<?= $ongkir['id_ongkir_jasa']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
                                       </li>
                                    <?php } ?>
                                 </ul>
                              </li>
                           </ul>
                        </td>
                     </tr>

                     <!-- Modal Ubah Data -->
                     <div id="ubahData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <form method="post" action="<?= base_url('ongkir/ongkir_jasa'); ?>" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                    <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" name="ubah_data" value="ubah">

                                    <input type="hidden" id="id_ongkir_jasa" name="id_ongkir_jasa" value="<?= $ongkir['id_ongkir_jasa']; ?>">

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Jasa</label>
                                       <div class="col-sm-9">
                                          <select id="jasa_pengiriman" name="jasa_pengiriman" class="form-control m-b" required>
                                             <option selected="selected" disabled>-Pilih Jasa Pengiriman-</option>
                                             <option <?php if ('Kurir' == $ongkir['jasa_pengiriman']) {
                                                         echo 'selected';
                                                      } ?>>Kurir</option>
                                             <option <?php if ('JNE' == $ongkir['jasa_pengiriman']) {
                                                         echo 'selected';
                                                      } ?>>JNE</option>
                                             <option <?php if ('JNT' == $ongkir['jasa_pengiriman']) {
                                                         echo 'selected';
                                                      } ?>>JNT</option>
                                             <option <?php if ('Tiki' == $ongkir['jasa_pengiriman']) {
                                                         echo 'selected';
                                                      } ?>>Tiki</option>
                                          </select>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Harga Ongkir</label>
                                       <div class="col-sm-9">
                                          <div class="form-group">
                                             <div class="input-group">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" id="harga_perkilo" name="harga_perkilo" autocomplete="off" value="<?= $ongkir['harga_perkilo']; ?>" required>
                                                <span class="input-group-addon">/kg</span>
                                             </div>
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
            <form method="post" action="<?= base_url('ongkir/ongkir_jasa'); ?>" enctype="multipart/form-data">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Jasa</label>
                     <div class="col-sm-9">
                        <select id="jasa_pengiriman" name="jasa_pengiriman" class="form-control m-b" required>
                           <option selected="selected" disabled>-Pilih Jasa Pengiriman-</option>
                           <option>Kurir</option>
                           <option>JNE</option>
                           <option>JNT</option>
                           <option>Tiki</option>
                        </select>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Harga Ongkir</label>
                     <div class="col-sm-9">
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon">Rp.</span>
                              <input type="text" id="harga_perkilo" name="harga_perkilo" autocomplete="off" required>
                              <span class="input-group-addon">/kg</span>
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