<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-3">
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
                        <img alt="user" class="media-box-object rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $costumer['foto_costumer']; ?>" width="40" height="40">
                     </span>
                     <span class="media-box-body">
                        <span class="media-box-heading">
                           <strong><?= $costumer['nm_costumer']; ?></strong><br>
                           <small class="text-muted"><?= $costumer['jk_costumer']; ?></small>
                        </span>
                     </span>
                  </a>
               </li>
            </ul>
            <hr>
            <div class="friends-group clearfix">
               <small class="text-muted">Email</small>
               <p><?= $costumer['telp_costumer']; ?></p>
               <small class="text-muted">No.Telepon</small>
               <p><?= $costumer['email_costumer']; ?></p>
               <small class="text-muted">Alamat</small><br>
               <?php if ($data_alamat->num_rows() > 0) { ?>
                  <?php foreach ($data_alamat->result_array() as $alamat) : ?>
                     <span class="badge badge-success"><?= $alamat['tipe_alamat']; ?></span>
                     <p><?= $alamat['detail_alamat']; ?>, Kel. <?= $alamat['nm_kelurahan']; ?>, Kec. <?= $alamat['nm_kecamatan']; ?>, Kota <?= $alamat['nm_kota']; ?></p>
                  <?php endforeach; ?>
               <?php } else { ?>
                  Alamat belum diterakan
               <?php } ?>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-9">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-6 align-self-center">
                  Histori Belanja
               </div>
               <div class="col-md-6">
                  <div class="float-right">
                     <a href="javascript:window.history.go(-1);" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <table id="datatable" class="table table-striped table-hover">
               <thead>
                  <tr>
                     <th width="40">No.</th>
                     <th class="text-center">Invoice</th>
                     <th>Produk</th>
                     <th class="text-center" width="110">Pembelian</th>
                     <th class="text-center">Waktu</th>
                     <th class="text-center" width="100">Status</th>
                  </tr>
               </thead>
               <tbody style="font-size: 12px !important;">
                  <?php $no = 1;
                  foreach ($data_transaksi as $transaksi) : ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td class="text-center">
                           <a href="<?= base_url(); ?>transaksi/detail_transaksi/<?= $transaksi['invoice']; ?>" class="text-yellow">
                              <?= substr($transaksi['invoice'], 0, 6); ?>...
                           </a>
                        </td>
                        <td><?= $transaksi['nm_produk']; ?></td>
                        <td class="text-center">
                           Rp. <?= number_format($transaksi['harga_produk'], 0, ".", "."); ?> <br>
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