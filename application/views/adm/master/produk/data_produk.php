<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Data Produk
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="<?= base_url(); ?>produk/tambah_produk" class="btn btn-primary btn-rounded box-shadow btn-icon"><i class="fa fa-plus"></i> Tambah Data</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <table id="datatable" class="table table-striped dt-responsive table-hover">
               <thead>
                  <tr>
                     <th width="40">No.</th>
                     <th width="130">Reseler</th>
                     <th width="130">Kategori</th>
                     <th width="200">Produk</th>
                     <th width="150">Harga</th>
                     <th class="text-center" width="80">Stok</th>
                     <th class="text-center" width="80">Status</th>
                     <th class="text-center" width="40"><i class="fa fa-sort"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_produk->result_array() as $produk) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td>
                           <a href="<?= base_url(); ?>user/detail_reseler/<?= $produk['reseler']; ?>"><?= $produk['nm_reseler']; ?></a>
                        </td>
                        <td><?= $produk['nm_kategori_produk']; ?></td>
                        <td><?= $produk['nm_produk']; ?></td>
                        <td>Rp. <?= number_format($produk['harga_produk'], 0, ".", "."); ?> / <?= $produk['satuan_jual']; ?></td>
                        <td class="text-center">
                           <?php if ($produk['stok'] <= '0') { ?>
                              <div class="text-danger"><?= $produk['stok']; ?></div>
                           <?php } elseif ($produk['stok'] >= '1' && $produk['stok'] <= '10') { ?>
                              <div class="text-warning"><?= $produk['stok']; ?></div>
                           <?php } else { ?>
                              <div class="text-info"><?= $produk['stok']; ?></div>
                           <?php } ?>
                        </td>
                        <td class="text-center">
                           <?php if ($produk['status_produk'] == '0') { ?>
                              <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                           <?php } elseif ($produk['status_produk'] == '1') { ?>
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
                                       <a class="dropdown-item text-info" href="<?= base_url(); ?>produk/detail_produk/<?= $produk['kode_produk']; ?>"><i class="fa fa-search"></i> Detail</a>
                                    </li>
                                    <li>
                                       <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#ubahStatus<?= $no; ?>"><i class="fa fa-edit"></i> Ubah Status</a>
                                    </li>
                                    <li>
                                       <a class="dropdown-item text-danger" href="<?= base_url(); ?>produk/hapus_produk/<?= $produk['kode_produk']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
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
                              <form method="post" action="<?= base_url('produk/data_produk'); ?>" enctype="multipart/form-data">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                    <h5 class="modal-title" id="myDefaultModalLabel">Ubah Status</h5>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" name="ubah_data" value="ubahStatus">
                                    <input type="hidden" id="id_produk" name="id_produk" value="<?= $produk['id_produk']; ?>">
                                    <input type="hidden" id="change_produk" name="change_produk" value="<?= $tanggalwaktu; ?>">

                                    <div class="form-group row">
                                       <label for="label" class="col-sm-3 col-form-label">Status</label>
                                       <div class="col-sm-9">
                                          <select class="form-control m-b" id="status_produk" name="status_produk" required>
                                             <option <?php if ($produk['status_produk'] == '1') {
                                                         echo 'selected';
                                                      } ?> value="1">Aktif</option>
                                             <option <?php if ($produk['status_produk'] == '0') {
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