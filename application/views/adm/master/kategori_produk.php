<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Data Kategori Produk
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
                     <th class="text-center" width="90">Gambar</th>
                     <th>Kategori Produk</th>
                     <th class="text-center" width="130">Status</th>
                     <th class="text-center" width="40"><i class="fa fa-sort"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_kategori->result_array() as $kategori) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td class="text-center">
                           <img class="img-fluid rounded" src="<?= base_url(); ?>assets/upload/<?= $kategori['gambar_kategori_produk']; ?>" width="80" height="80">
                        </td>
                        <td><?= $kategori['nm_kategori_produk']; ?></td>
                        <td class="text-center">
                           <?php if ($kategori['status_kategori_produk'] == '1') { ?>
                              <span class="badge badge-pill badge-success">Aktif</span>
                           <?php } elseif ($kategori['status_kategori_produk'] == '0') { ?>
                              <span class="badge badge-pill badge-danger">Tidak Aktif</span>
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
                                       <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#ubahData<?= $no; ?>"><i class="fa fa-edit"></i> Ubah</a>
                                    </li>
                                    <li>
                                       <a class="dropdown-item text-danger" href="<?= base_url(); ?>produk/hapus_kategori_produk/<?= $kategori['id_kategori_produk']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
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
                              <form method="post" action="<?= base_url('produk/kategori_produk'); ?>" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                    <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" name="ubah_data" value="ubah">
                                    <input type="hidden" id="id_kategori_produk" name="id_kategori_produk" value="<?= $kategori['id_kategori_produk']; ?>">

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Kategori Informasi</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="nm_kategori_produk" name="nm_kategori_produk" class="form-control" autocomplete="off" value="<?= $kategori['nm_kategori_produk']; ?>" required>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Status</label>
                                       <div class="col-sm-9">
                                          <select class="form-control m-b" id="status_kategori_produk" name="status_kategori_produk" required>
                                             <option <?php if ($kategori['status_kategori_produk'] == '1') {
                                                         echo 'selected';
                                                      } ?> value="1">Aktif</option>
                                             <option <?php if ($kategori['status_kategori_produk'] == '0') {
                                                         echo 'selected';
                                                      } ?> value="0">Tidak Aktif</option>
                                          </select>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Gambar Kategori</label>
                                       <div class="col-sm-9">
                                          <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $kategori['gambar_kategori_produk']; ?>">

                                          <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                             <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                                             <span class="input-group-addon btn btn-primary btn-file ">
                                                <span class="fileinput-new">Select</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="gambar_kategori_produk" onchange="validateIkon(this);">
                                             </span>
                                             <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>

                                          <div class="checkbox checkbox-primary" style="margin-top: -25px;padding-left: 0px;">
                                             <input type="checkbox" id="checkbox<?= $no; ?>" name="ubah_gambar">
                                             <label for="checkbox<?= $no; ?>"> Ubah Gambar </label>
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
            <form method="post" action="<?= base_url('produk/kategori_produk'); ?>" enctype="multipart/form-data">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Tambah Data</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Kategori Informasi</label>
                     <div class="col-sm-9">
                        <input type="text" id="nm_kategori_produk" name="nm_kategori_produk" class="form-control" autocomplete="off" required>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Gambar Kategori</label>
                     <div class="col-sm-9">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                           <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                           <span class="input-group-addon btn btn-primary btn-file ">
                              <span class="fileinput-new">Select</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" name="gambar_kategori_produk" onchange="validateIkon(this);" required>
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