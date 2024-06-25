<div class="toastr1"></div>
<!-- product detail start -->
<div class="map-product-section px-15">
   <div class="product-inline">
      <a href="product.html">
         <img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk->row_array()['gambar_produk']; ?>" class="img-fluid" alt="">
      </a>
      <div class="product-inline-content">
         <div>
            <a href="product.html">
               <h4 class="font-13">Inv. <?= $transaksi->row_array()['invoice']; ?></h4>
            </a>
            <h5 class="content-color">Total Pembelian: <?= $transaksi->row_array()['jumlah_beli']; ?> Items</h5>
            <div id="order-cek" class="price">
               <h4>Waktu: <?= date('d M Y, H:i', strtotime($transaksi->row_array()['change_transaksi'])); ?></h4>
               <?php if ($transaksi->row_array()['status_pengemasan'] == '1') { ?>
                  <span class="status-label label-success">Pengemasan Sudah Dilakukan</span>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- product detail end -->

<!-- address section start -->
<div class="px-15 pt-3">
   <h6 class="tracking-title content-color">Detail Pengiriman</h6>
   <ul class="coupon-listing">
      <li>
         <div class="coupon-box">
            <div class="top-bar">
               <h4>Jasa Pengiriman</h4>
               <?php if ($transaksi->row_array()['jasa_pengiriman'] == '1') { ?>
                  <a class="font-12"><?= $jasa->row_array()['jasa_pengiriman']; ?></a>
               <?php } else { ?>
                  <a class="font-12"><?= $jasa->row_array()['jasa_pengiriman']; ?></a>
               <?php } ?>
            </div>
            <h4 class="fw-bold mt-2">Costumer</h4>
            <p><?= $transaksi->row_array()['nm_costumer']; ?></p>
            <h4 class="fw-bold mt-2">Tujuan Pengiriman</h4>
            <p><?= $transaksi->row_array()['detail_alamat']; ?>, Kelurahan <?= $transaksi->row_array()['nm_kelurahan']; ?>, Kecamatan <?= $transaksi->row_array()['nm_kecamatan']; ?>, Kota <?= $transaksi->row_array()['nm_kota']; ?></p>
            <a class="text-green">Telepon Penerima : <?= $transaksi->row_array()['telp_alamat']; ?></a>
         </div>
      </li>
   </ul>
</div>
<div class="divider"></div>
<!-- address section end -->

<!-- deals section start -->
<section class="deals-section px-15 pt-0">
   <h6 class="tracking-title content-color">Detail Pemesanan</h6>
   <div class="product-section">
      <div class="row gy-3">
         <div class="col-12">
            <div class="product-inline">
               <a>
                  <img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk->row_array()['gambar_produk']; ?>" class="img-fluid" alt="">
               </a>
               <div class="product-inline-content">
                  <div>
                     <a>
                        <h4><?= $transaksi->row_array()['nm_barang']; ?></h4>
                     </a>
                     <div class="price">
                        <h4>
                           Qty: <?= $transaksi->row_array()['jumlah_beli']; ?> Items
                        </h4>
                        <h4>
                           Varian:
                           <?php if ($varian->row_array()['warna_rasa'] != 'none') { ?>
                              <?= $varian->row_array()['warna_rasa']; ?>
                           <?php } ?>
                           <?php if ($varian->row_array()['size'] != 'none') { ?>
                              | <?= $varian->row_array()['nm_size']; ?>
                           <?php } ?>
                        </h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="panel-space-2"></section>
<!-- deals section end -->

<?php if ($transaksi->row_array()['status_pengemasan'] == '0') { ?>
   <section class="panel-space-2"></section>
   <!-- fixed panel start -->
   <div class="fixed-panel">
      <div class="row">
         <div class="col-12">
            <a href="javascript:void(0)" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#konfirmasi">Konfirmasi Packing Selesai</a>
         </div>
      </div>
   </div>
   <!-- fixed panel end -->

   <!-- Konfirmasi Packing -->
   <div class="offcanvas offcanvas-bottom h-auto removecart-canvas" id="konfirmasi">
      <div class="offcanvas-body small">
         <div class="content">
            <input type="hidden" id="id_transaksi" name="id_transaksi" value="<?= $transaksi->row_array()['id_transaksi']; ?>">
            <h4>Konfirmasi Packing:</h4>
            <p>Silahkan menekan tombol konfirmasi dibawah ini jika pesanan telah disiapkan</p>
         </div>
         <div class="bottom-cart-panel">
            <div class="row">
               <div class="col-12">
                  <a id="submit" class="theme-color">Konfirmasi</a>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } ?>