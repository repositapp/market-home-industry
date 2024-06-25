<div class="toastr1"></div>
<!-- product detail start -->
<div class="map-product-section px-15">
   <div class="product-inline">
      <a href="product.html">
         <?php $gbr = $this->m_produk->getData('gambar_produk', array('kode_produk' => $transaksi->row_array()['kode_barang']), 'id_gambar_produk', null)->row_array(); ?>
         <img src="<?= base_url(); ?>assets/upload/<?= $gbr['gambar_produk']; ?>" class="img-fluid" alt="">
      </a>
      <div class="product-inline-content">
         <div>
            <a href="product.html">
               <h4 class="font-13">Inv. <?= $transaksi->row_array()['invoice']; ?></h4>
            </a>
            <h5 class="content-color">Total Pembelian: <?= $transaksi->row_array()['jumlah_belanja']; ?> Items</h5>
            <h5 class="content-color">Pembayaran:
               <?php if ($transaksi->row_array()['jenis_pembayaran'] == 1) { ?>
                  COD
               <?php } elseif ($transaksi->row_array()['jenis_pembayaran'] == 2) { ?>
                  Transfer Bank
               <?php } ?>
            </h5>
            <div class="price">
               <h4>Total Harga: Rp. <?= number_format($transaksi->row_array()['total_transaksi'], 0, ".", "."); ?></h4>
               <h4>Waktu: <?= date('d M Y, H:i', strtotime($transaksi->row_array()['change_transaksi'])); ?></h4>
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
            <h4 class="fw-bold mt-2">Tujuan Pengiriman</h4>
            <p><?= $transaksi->row_array()['detail_alamat']; ?>, Kelurahan <?= $transaksi->row_array()['nm_kelurahan']; ?>, Kecamatan <?= $transaksi->row_array()['nm_kecamatan']; ?>, Kota <?= $transaksi->row_array()['nm_kota']; ?></p>
            <a class="text-green">Penerima : <?= $costumer->row_array()['nm_costumer']; ?></a><br />
            <a href="tel:<?= $transaksi->row_array()['telp_alamat']; ?>" class="text-green">Telepon : <?= $transaksi->row_array()['telp_alamat']; ?></a>
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
         <?php foreach ($produk_transaksi->result_array() as $produk) :
            $hg_diskon = $this->m_produk->getData('diskon', array('kode_produk' => $produk['kode_barang']), 'id_diskon', null);
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $produk['kode_barang']), 'id_gambar_produk', null)->row_array();
         ?>
            <div class="col-12">
               <div class="product-inline">
                  <a>
                     <img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" class="img-fluid" alt="">
                  </a>
                  <div class="product-inline-content">
                     <div>
                        <a>
                           <h4><?= $produk['nm_barang']; ?></h4>
                        </a>
                        <div class="price">
                           <h4>
                              Qty: <?= $produk['jumlah_beli']; ?> Items <br>
                              Varian:
                              <?php if ($produk['warna_rasa'] != 'none') { ?>
                                 <?= $produk['warna_rasa']; ?>
                              <?php } ?>
                              <?php if ($produk['size'] != 'none') { ?>
                                 | <?= $produk['nm_size']; ?>
                              <?php } ?>
                           </h4>
                           <h4>Harga: Rp. <?= number_format($produk['harga_barang'] * $produk['jumlah_beli'], 0, ".", "."); ?></h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
</section>
<div class="divider"></div>
<!-- deals section end -->

<!-- order details section start -->
<div class="px-15 section-b-space">
   <h6 class="tracking-title content-color">Detail Pembayaran</h6>
   <div class="order-details">
      <ul>
         <li>
            <h4>Total Pesanan <span><?= $transaksi->num_rows(); ?> Items</span></h4>
         </li>
         <li>
            <h4>Berat Beban <span class="theme-color"><?= $transaksi->row_array()['total_beban'] / 1000; ?> kg</span></h4>
         </li>
         <li>
            <h4>Subtotal untuk Produk <span>Rp. <?= number_format($transaksi->row_array()['total_transaksi'] - $transaksi->row_array()['total_pengiriman'], 0, ".", "."); ?></span></h4>
         </li>
         <li>
            <h4>Subtotal Pengiriman <span class="text-success">Rp. <?= number_format($transaksi->row_array()['total_pengiriman'], 0, ".", "."); ?></span></h4>
         </li>
      </ul>
      <div class="total-amount">
         <h4>Total Pembayaran <span>Rp. <?= number_format($transaksi->row_array()['total_transaksi'], 0, ".", "."); ?></span></h4>
      </div>
      <?php if ($transaksi->row_array()['jenis_pembayaran'] == '2') {
         $pay = $this->m_transaksi->getData('transaksi_pembayaran', array('invoice' => $transaksi->row_array()['invoice']), 'id_pembayaran', null)->row_array();
      ?>
         <?php if ($pay['bukti_pembayaran'] != 'none') { ?>
            <a href="javascript:void(0)" class="btn btn-outline content-color w-100 mt-4" data-bs-toggle="offcanvas" data-bs-target="#proofPay">Bukti Pembayaran</a>

            <!-- Bukti Pembayaran -->
            <div class="offcanvas offcanvas-bottom h-auto removecart-canvas" id="proofPay">
               <div class="offcanvas-body small">
                  <div class="content">
                     <h4 class="mb-3">Bukti Transfer:</h4>
                     <img src="<?= base_url(); ?>assets/upload/<?= $pay['bukti_pembayaran']; ?>" alt="" class="img-fluid rounded" style="width:100%;">
                  </div>
                  <div class="bottom-cart-panel">
                     <div class="row">
                        <div class="col-12">
                           <a href="javascript:void(0)" class="theme-color" data-bs-dismiss="offcanvas">Close</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>
      <?php } ?>
   </div>
</div>
<!-- order details section end -->

<?php if ($transaksi->row_array()['penyerahan_barang'] == '0') { ?>
   <!-- panel space start -->
   <section class="panel-space-2"></section>
   <!-- panel space end -->

   <!-- fixed panel start -->
   <div class="fixed-panel">
      <div class="row">
         <div class="col-12">
            <a href="javascript:void(0)" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#Submission">Upload Order Submission</a>
         </div>
      </div>
   </div>
   <!-- fixed panel end -->

   <!-- Upload Bukti Terima -->
   <div class="offcanvas offcanvas-bottom h-auto qty-canvas" id="Submission">
      <form>
         <fieldset>
            <input type="hidden" id="invoice" name="invoice" value="<?= $transaksi->row_array()['invoice']; ?>">
            <input type="hidden" id="costumer" name="costumer" value="<?= $transaksi->row_array()['costumer']; ?>">

            <div class="offcanvas-body small">
               <h4>Ambil Gambar:</h4>
               <div class="search-coupons mt-2">
                  <input type="file" class="form-control form-theme" id="gambar" name="gambar" onchange="validate(this);" required>
               </div>
               <button id="submit" class="btn btn-solid w-100 mt-3" type="button"> Upload Bukti</button>
            </div>
         </fieldset>
      </form>
   </div>
<?php } elseif ($transaksi->row_array()['penyerahan_barang'] == '1') { ?>
   <!-- panel space start -->
   <section class="panel-space-2"></section>
   <!-- panel space end -->

   <!-- fixed panel start -->
   <div class="fixed-panel">
      <div class="row">
         <div class="col-12">
            <a href="javascript:void(0)" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#penyerahan">Order Submission</a>
         </div>
      </div>
   </div>
   <!-- fixed panel end -->

   <!-- Bukti Penyerahan Barang -->
   <div class="offcanvas offcanvas-bottom h-auto removecart-canvas" id="penyerahan">
      <div class="offcanvas-body small">
         <div class="content">
            <h4 class="mb-3">Bukti Penyerahan Barang:</h4>
            <img src="<?= base_url(); ?>assets/upload/<?= $transaksi->row_array()['bukti_penyerahan']; ?>" alt="" class="img-fluid rounded" style="width:100%;">
         </div>
         <div class="bottom-cart-panel">
            <div class="row">
               <div class="col-12">
                  <a href="javascript:void(0)" class="theme-color" data-bs-dismiss="offcanvas">Close</a>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } ?>