<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-3">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header card-default border-bottom">
                  <div class="row justify-content-between">
                     <div class="col-md-12 align-self-center">
                        Profil
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <ul class="list-group list-unstyled">
                     <li class="margin-b-0">
                        <a class="media-box" href="#">
                           <span class="float-right">
                              <span class="circle circle-danger circle-lg"></span>
                           </span>
                           <span class="float-left margin-r-10">
                              <img alt="user" class="media-box-object rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $reseler['foto_reseler']; ?>" width="40" height="40">
                           </span>
                           <span class="media-box-body">
                              <span class="media-box-heading">
                                 <strong><?= $reseler['nm_reseler']; ?></strong><br>
                                 <small class="text-muted"><?= $reseler['nik_reseler']; ?></small>
                              </span>
                           </span>
                        </a>
                     </li>
                  </ul>
                  <hr>
                  <div class="friends-group clearfix">
                     <small class="text-muted">Email</small>
                     <p><?= $reseler['telp_reseler']; ?></p>
                     <small class="text-muted">No.Telepon</small>
                     <p><?= $reseler['email_reseler']; ?></p>
                     <small class="text-muted">Alamat Rumah</small>
                     <p><?= $reseler['alamat_reseler']; ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-9">
      <div class="card">
         <div class="card-header card-default">
            <div class="row justify-content-between">
               <div class="col-md-6 align-self-center">
                  Lapak
               </div>
               <div class="col-md-6">
                  <div class="float-right">
                     <a href="javascript:window.history.go(-1);" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <div id="lapak" class="tabs">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs">
                  <li class="nav-item" role="presentation"><a class="nav-link active" href="#profil_lapak" aria-controls="profil_lapak" role="tab" data-toggle="tab">Profil Lapak</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#berkas" aria-controls="berkas" role="tab" data-toggle="tab">Berkas Lapak</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#produk" aria-controls="produk" role="tab" data-toggle="tab">Produk</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#transaksi" aria-controls="transaksi" role="tab" data-toggle="tab">Riwayat Transaksi</a></li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="profil_lapak">
                     <table class="table">
                        <tbody>
                           <tr>
                              <td width="170">Nama Lapak</td>
                              <td>: <?= $reseler['nm_toko']; ?></td>
                           </tr>
                           <tr>
                              <td>Telepon Lapak</td>
                              <td>: <?= $reseler['telp_toko']; ?></td>
                           </tr>
                           <tr>
                              <td>Email Lapak</td>
                              <td>: <?= $reseler['email_toko']; ?></td>
                           </tr>
                           <tr>
                              <td>Alamat Lapak</td>
                              <td>: <?= $reseler['alamat_toko']; ?></td>
                           </tr>
                           <tr>
                              <td>Waktu Terdaftar</td>
                              <td>: <?= date('d M Y, H:i', strtotime($reseler['change_reseler'])); ?></td>
                           </tr>
                           <tr>
                              <td>Foto/Logo Toko</td>
                              <td>: <img alt="user" class="media-box-object rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $reseler['logo_toko']; ?>" width="40" height="40"></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="berkas">
                     <table class="table">
                        <tbody>
                           <tr>
                              <td width="140">Foto KTP</td>
                              <td>
                                 <img src="<?= base_url(); ?>assets/upload/<?= $reseler['foto_ktp']; ?>" style="width: 50%;">
                              </td>
                           </tr>
                           <tr>
                              <td>Izin Usaha</td>
                              <td>
                                 <img src="<?= base_url(); ?>assets/upload/<?= $reseler['izin_usaha']; ?>" style="width: 100%;">
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="produk">
                     <table id="datatable" class="table table-striped dt-responsive table-hover">
                        <thead>
                           <tr>
                              <th width="40">No.</th>
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
                  <div role="tabpanel" class="tab-pane" id="transaksi">
                     <table id="datatable2" class="table table-striped table-hover">
                        <thead>
                           <tr>
                              <th width="40">No.</th>
                              <th class="text-center">Invoice</th>
                              <th width="110">Costumer</th>
                              <th class="text-center" width="110">Pembelian</th>
                              <th class="text-center" width="90">Waktu</th>
                              <th class="text-center" width="60">Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1;
                           foreach ($data_transaksi as $transaksi) :
                              $cek = $this->m_transaksi->getData('costumer', array('id_user' => $transaksi['costumer']), 'id_user', 1);
                              $costumer = $cek->row_array();
                           ?>
                              <tr>
                                 <td class="text-center"><?= $no; ?>.</td>
                                 <td class="text-center">
                                    <a href="<?= base_url(); ?>transaksi/detail_transaksi/<?= $transaksi['invoice']; ?>" class="text-yellow">
                                       <?= substr($transaksi['invoice'], 0, 6); ?>...
                                    </a>
                                 </td>
                                 <td>
                                    <?php if ($cek->num_rows() > 0) { ?>
                                       <?= $costumer['nm_costumer']; ?>
                                    <?php } elseif ($cek->num_rows() == 0) { ?>
                                       Not Found
                                    <?php } ?>
                                 </td>
                                 <td class="text-center">
                                    <?= $transaksi['nm_produk']; ?> <br>
                                    (<?= $transaksi['jumlah_beli']; ?> Items)
                                 </td>
                                 <td class="text-center"><?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></td>
                                 <td class="text-center">
                                    <?php if ($transaksi['status_transaksi'] == 0) { ?>
                                       <span class="badge badge-pill badge-danger">Pending</span>
                                    <?php } elseif ($transaksi['status_transaksi'] == 1) { ?>
                                       <span class="badge badge-pill badge-danger">Menunggu Pembayaran</span>
                                    <?php } elseif ($transaksi['status_transaksi'] == 2) { ?>
                                       <span class="badge badge-pill badge-warning">Packing</span>
                                    <?php } elseif ($transaksi['status_transaksi'] == 3) { ?>
                                       <span class="badge badge-pill badge-success">Pengiriman</span>
                                    <?php } elseif ($transaksi['status_transaksi'] == 4) { ?>
                                       <span class="badge badge-pill badge-info">Selesai</span>
                                    <?php } elseif ($transaksi['status_transaksi'] == 5) { ?>
                                       <span class="badge badge-pill badge-danger">Pesanan Batal</span>
                                    <?php } ?>
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
      </div>
   </div>

</div>