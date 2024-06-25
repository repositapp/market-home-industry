<?php
$cek = $this->m_transaksi->getData('costumer', array('id_user' => $transaksi['costumer']), 'id_user', 1);
$costumer = $cek->row_array();
?>
<div class="row">
   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-6 align-self-center">
                  Detail Pesanan
               </div>
               <div class="col-md-6">
                  <div class="float-right">
                     <a href="javascript:window.history.go(-1);" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <table style="width: 100%;">
               <tbody>
                  <tr>
                     <th style="font-size: 16px; font-weight:700;" colspan="2">Invoice. <?= $transaksi['invoice']; ?></th>
                     <td style="font-size: 12px;">Costumer</td>
                     <td style="font-size: 12px;">:
                        <?php if ($cek->num_rows() > 0) { ?>
                           <?= $costumer['nm_costumer']; ?>
                        <?php } elseif ($cek->num_rows() == 0) { ?>
                           Not Found
                        <?php } ?>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-size: 12px; width: 130px;">Jumlah Pesanan</td>
                     <td style="font-size: 12px;">: <?= $transaksi['jumlah_belanja']; ?> Items</td>
                     <td style="font-size: 12px; width: 150px;">Metode Pembayaran</td>
                     <td style="font-size: 12px; width: 130px;">:
                        <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
                           COD
                        <?php } elseif ($transaksi['jenis_pembayaran'] == 2) { ?>
                           Transfer Bank
                        <?php } ?>
                     </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #e9ecef;">
                     <td style="font-size: 12px;">Jasa Pengiriman</td>
                     <td style="font-size: 12px;">:
                        <?php if ($transaksi['jenis_pembayaran'] == 1) {
                           $kurir = $this->m_user->getData('kurir', array('id_user' => $transaksi['kurir']), 'id_kurir', 1)->row_array();
                        ?>
                           <?= $jasa['jasa_pengiriman']; ?>
                           (<?= $kurir['nm_kurir']; ?>)
                        <?php } else { ?>
                           <?= $jasa['jasa_pengiriman']; ?>
                        <?php } ?>
                     </td>
                     <td style="font-size: 12px;">Tanggal Pesanan</td>
                     <td style="font-size: 12px;">: <?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></td>
                  </tr>
               </tbody>
            </table>

            <table class="table mt-20" style="font-size: 12px;">
               <thead>
                  <tr>
                     <th width="10">No.</th>
                     <th>Produk</th>
                     <th>Reseler</th>
                     <th>Toko</th>
                     <th class="text-center">Packing</th>
                     <th class="text-center" width="40">Qty</th>
                     <th class="text-center" width="100">Harga</th>
                     <th class="text-center" width="130">Sub Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_pesanan as $pesanan) :
                     $cek = $this->m_transaksi->cekPembelianBarang($pesanan['kode_barang']);
                     $reseler = $cek->row_array();
                  ?>
                     <tr>
                        <td><?= $no; ?></td>
                        <td><?= $pesanan['nm_barang']; ?></td>
                        <?php if ($cek->num_rows() > 0) { ?>
                           <td><?= $reseler['nm_reseler']; ?></td>
                           <td><?= $reseler['nm_toko']; ?></td>
                        <?php } else { ?>
                           <td colspan="2">Not Found</td>
                        <?php } ?>
                        <td class="text-center">
                           <?php if ($pesanan['status_pengemasan'] > 0) { ?>
                              <span class="badge badge-pill badge-success">Sudah</span>
                           <?php } else { ?>
                              <span class="badge badge-pill badge-danger">Belum</span>
                           <?php } ?>
                        </td>
                        <td class="text-center"><?= $pesanan['jumlah_beli']; ?></td>
                        <td class="text-center">Rp. <?= number_format($pesanan['harga_barang'] + ($pesanan['harga_barang'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></td>
                        <td class="text-center">Rp. <?= number_format(($pesanan['jumlah_beli'] * $pesanan['harga_barang']) + ($pesanan['harga_barang'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></td>
                     </tr>
                  <?php $no++;
                  endforeach; ?>
                  <tr>
                     <td colspan="7" class="text-center" style="font-weight: 700;">Total Harga</td>
                     <td style="font-weight: 700;" class="text-center"> Rp. <?= number_format($transaksi['total_transaksi'], 0, ".", "."); ?></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="col-md-12">
      <div class="row">
         <?php if ($transaksi['jenis_pembayaran'] == 2) { ?>
            <div class="col-md-4">
               <div class="card">
                  <div class="card-header card-default border-bottom">
                     <div class="row justify-content-between">
                        <div class="col-md-12 align-self-center">
                           Bukti Pembayaran
                        </div>
                     </div>
                  </div>

                  <div class="card-body">
                     <?php if ($bukti_bayar['bukti_pembayaran'] != 'none') { ?>
                        <img src="<?= base_url(); ?>assets/upload/<?= $bukti_bayar['bukti_pembayaran']; ?>" alt="" class="img-fluid rounded" style="width:100%;height: 260px !important;">
                     <?php } else { ?>
                        <div class="alert bg-danger alert-dismissible text-center" role="alert" style="font-size: 10px;">--Pembayaran Belum Dilakukan--</div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         <?php } ?>
         <div class="col-md-4">
            <div class="card">
               <div class="card-header card-default border-bottom">
                  <div class="row justify-content-between">
                     <div class="col-md-12 align-self-center">
                        Bukti Penyerahan
                     </div>
                  </div>
               </div>

               <div class="card-body">
                  <?php if ($transaksi['penyerahan_barang'] == 1) { ?>
                     <img src="<?= base_url(); ?>assets/upload/<?= $transaksi['bukti_penyerahan']; ?>" alt="" class="img-fluid rounded" style="width:100%;height: 260px !important;">
                  <?php } else { ?>
                     <div class="alert bg-danger alert-dismissible text-center" role="alert" style="font-size: 10px;">--Penyerahan Belum Dilakukan--</div>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card">
               <div class="card-header card-default border-bottom">
                  <div class="row justify-content-between">
                     <div class="col-md-12 align-self-center">
                        Bukti Terima Barang
                     </div>
                  </div>
               </div>

               <div class="card-body">
                  <?php if ($transaksi['terima_barang'] == 1) { ?>
                     <img src="<?= base_url(); ?>assets/upload/<?= $transaksi['bukti_terima']; ?>" alt="" class="img-fluid rounded" style="width:100%;height: 260px !important;">
                  <?php } else { ?>
                     <div class="alert bg-danger alert-dismissible text-center" role="alert" style="font-size: 10px;">--Pesanan Belum Diterima--</div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>