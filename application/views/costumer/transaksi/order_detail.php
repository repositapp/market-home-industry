<div class="toastr1"></div>
<!-- product detail start -->
<div class="map-product-section px-15">
   <div class="product-inline">
      <a>
         <?php $gbr = $this->m_produk->getData('gambar_produk', array('kode_produk' => $transaksi->row_array()['kode_barang']), 'id_gambar_produk', null)->row_array(); ?>
         <img src="<?= base_url(); ?>assets/upload/<?= $gbr['gambar_produk']; ?>" class="img-fluid" alt="">
      </a>
      <div class="product-inline-content">
         <div>
            <a>
               <h4 class="font-13">Inv. <?= $transaksi->row_array()['invoice']; ?></h4>
            </a>
            <h5 class="content-color">Total Pembelian: <?= $transaksi->row_array()['jumlah_belanja']; ?> Items</h5>
            <div class="price">
               <h4>Total Harga: Rp. <?= number_format($transaksi->row_array()['total_transaksi'], 0, ".", "."); ?></h4>
               <h4>Waktu: <?= date('d M Y, H:i', strtotime($transaksi->row_array()['change_transaksi'])); ?></h4>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- product detail end -->

<!-- order tracking start -->
<div class="order-track px-15">
   <?php if ($transaksi->row_array()['status_transaksi'] == 5) { ?>
      <div class="order-track-step">
         <div class="order-track-status">
            <span class="order-track-status-dot">
               <img src="assets/svg/check.svg" class="img-fluid" alt="">
            </span>
            <span class="order-track-status-line"></span>
         </div>
         <div class="order-track-text">
            <p class="order-track-text-stat"> Pesanan Dibatalkan</p>
            <span class="order-track-text-sub"><?= date('H:i, d/m/Y', strtotime($transaksi->row_array()['change_transaksi'])); ?></span>
         </div>
      </div>
   <?php } else { ?>
      <div class="order-track-step <?= $riwayat->num_rows() > 0 ? "" : "in-process" ?>">
         <div class="order-track-status">
            <span class="order-track-status-dot">
               <img src="assets/svg/check.svg" class="img-fluid" alt="">
            </span>
            <span class="order-track-status-line"></span>
         </div>
         <div class="order-track-text">
            <p class="order-track-text-stat">Transaksi Selesai</p>
            <?php if ($success->num_rows() > 0) { ?>
               <span class="order-track-text-sub"><?= date('H:i, d/m/Y', strtotime($success->row_array()['change_to'])); ?></span>
            <?php } else { ?>
               <span class="order-track-text-sub">Pending</span>
            <?php } ?>
         </div>
      </div>
      <div class="order-track-step <?= $success->num_rows() > 0 ? "" : "in-process" ?>">
         <div class="order-track-status">
            <span class="order-track-status-dot">
               <img src="assets/svg/check.svg" class="img-fluid" alt="">
            </span>
            <span class="order-track-status-line"></span>
         </div>
         <div class="order-track-text">
            <p class="order-track-text-stat">Pesanan Diterima</p>
            <?php if ($success->num_rows() > 0) { ?>
               <span class="order-track-text-sub"><?= date('H:i, d/m/Y', strtotime($success->row_array()['change_to'])); ?></span>
            <?php } else { ?>
               <span class="order-track-text-sub">Pending</span>
            <?php } ?>
         </div>
      </div>
      <div class="order-track-step <?= $trasit->num_rows() > 0 ? "" : "in-process" ?>">
         <div class="order-track-status">
            <span class="order-track-status-dot">
               <img src="assets/svg/check.svg" class="img-fluid" alt="">
            </span>
            <span class="order-track-status-line"></span>
         </div>
         <div class="order-track-text">
            <p class="order-track-text-stat"> Dalam Pengiriman</p>
            <?php if ($trasit->num_rows() > 0) { ?>
               <span class="order-track-text-sub"><?= date('H:i, d/m/Y', strtotime($trasit->row_array()['change_to'])); ?></span>
            <?php } else { ?>
               <span class="order-track-text-sub">Pending</span>
            <?php } ?>
         </div>
      </div>
      <div class="order-track-step <?= $packing->num_rows() > 0 ? "" : "in-process" ?>">
         <div class="order-track-status">
            <span class="order-track-status-dot">
               <img src="assets/svg/check.svg" class="img-fluid" alt="">
            </span>
            <span class="order-track-status-line"></span>
         </div>
         <div class="order-track-text">
            <p class="order-track-text-stat"> Pengemasan</p>
            <?php if ($packing->num_rows() > 0) { ?>
               <span class="order-track-text-sub"><?= date('H:i, d/m/Y', strtotime($packing->row_array()['change_to'])); ?></span>
            <?php } else { ?>
               <span class="order-track-text-sub">Pending</span>
            <?php } ?>
         </div>
      </div>
      <div class="order-track-step <?= $ordered->num_rows() > 0 ? "" : "in-process" ?>">
         <div class="order-track-status">
            <span class="order-track-status-dot">
               <img src="assets/svg/check.svg" class="img-fluid" alt="">
            </span>
            <span class="order-track-status-line"></span>
         </div>
         <div class="order-track-text">
            <p class="order-track-text-stat"> Pemesanan</p>
            <span class="order-track-text-sub"><?= date('H:i, d/m/Y', strtotime($ordered->row_array()['change_to'])); ?></span>
         </div>
      </div>
   <?php } ?>
</div>
<div class="divider"></div>
<!-- order tracking end -->

<!-- address section start -->
<div class="px-15">
   <h6 class="tracking-title content-color">Detail Pengiriman</h6>
   <ul class="coupon-listing">
      <li>
         <div class="coupon-box">
            <div class="top-bar">
               <h4>Jasa Pengiriman</h4>
               <?php if ($transaksi->row_array()['jasa_pengiriman'] == '1') { ?>
                  <a><?= $jasa->row_array()['jasa_pengiriman']; ?></a>
               <?php } else { ?>
                  <a><?= $jasa->row_array()['jasa_pengiriman']; ?></a>
               <?php } ?>
            </div>
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
         <?php foreach ($produk_transaksi->result_array() as $produk) :
            $hg_diskon = $this->m_produk->getData('diskon', array('kode_produk' => $produk['kode_barang']), 'id_diskon', null);
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $produk['kode_barang']), 'id_gambar_produk', null)->row_array();
            $varian = $this->m_produk->getData('produk_variasi', array('id_produk_variasi' => $produk['variasi_produk']), 'id_produk_variasi', null);
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
                              <?php if ($varian->row_array()['warna_rasa'] != 'none') { ?>
                                 <?= $varian->row_array()['warna_rasa']; ?>
                              <?php } ?>
                              <?php if ($varian->row_array()['size'] != 'none') { ?>
                                 | <?= $varian->row_array()['nm_size']; ?>
                              <?php } ?>
                           </h4>
                           <h4>Harga: Rp. <?= number_format(($produk['harga_barang'] * $produk['jumlah_beli']) + ($produk['harga_barang'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></h4>
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
<div class="px-15">
   <h6 class="tracking-title content-color">Detail Pembayaran</h6>
   <div class="order-details">
      <ul>
         <li>
            <h4>Total Pesanan <span><?= $produk_transaksi->num_rows(); ?> Items</span></h4>
         </li>
         <li>
            <h4>Berat Beban <span class="theme-color"><?= $transaksi->row_array()['total_beban'] / 1000; ?> kg</span></h4>
         </li>
         <li>
            <h4>Subtotal untuk Produk <span>Rp. <?= number_format($harga_pt->row_array()['total_hp'] + ($harga_pt->row_array()['total_hp'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></span></h4>
         </li>
         <li>
            <h4>Subtotal Pengiriman <span class="text-success">Rp. <?= number_format($transaksi->row_array()['total_pengiriman'], 0, ".", "."); ?></span></h4>
         </li>
         <li>
            <h4>PPn <span class="theme-color"><?= $biaya_jp['pajak_jasa']; ?>%</span></h4>
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
<section class="panel-space-2"></section>
<!-- order details section end -->

<?php if ($transaksi->row_array()['jenis_pembayaran'] == '2') { ?>
   <div class="divider"></div>
   <!-- order bank account section start -->
   <div class="px-15 section-b-space">
      <h6 class="tracking-title content-color">Rekening Bank</h6>
      <div class="order-details">
         <ul>
            <li>
               <h4>Rekening <span class="theme-color"><?= $pembayaran->row_array()['no_rekening']; ?></span></h4>
            </li>
            <li>
               <h4>Pemilik <span><?= $pembayaran->row_array()['pemilik']; ?></span></h4>
            </li>
            <li>
               <h4>Bank <span><?= $pembayaran->row_array()['nm_bank']; ?></span></h4>
            </li>
         </ul>
      </div>
   </div>
   <!-- order details section end -->
<?php } ?>

<?php if ($transaksi->row_array()['status_transaksi'] == '0') { ?>
   <!-- panel space start -->
   <section class="panel-space-2"></section>
   <!-- panel space end -->

   <!-- fixed panel start -->
   <div class="fixed-panel">
      <div class="row">
         <?php if ($transaksi->row_array()['jenis_pembayaran'] == '1') { ?>
            <div class="col-12">
               <a href="javascript:void(0)" class="text-danger" data-bs-toggle="offcanvas" data-bs-target="#cancel">Cancel Order</a>
            </div>
         <?php } elseif ($transaksi->row_array()['jenis_pembayaran'] == '2') {
            $pay = $this->m_transaksi->getData('transaksi_pembayaran', array('invoice' => $transaksi->row_array()['invoice']), 'id_pembayaran', null)->row_array();
         ?>
            <?php if ($pay['bukti_pembayaran'] == 'none') { ?>
               <div class="col-6">
                  <a href="javascript:void(0)" class="text-danger" data-bs-toggle="offcanvas" data-bs-target="#cancel">Cancel Order</a>
               </div>
               <div class="col-6">
                  <a href="javascript:void(0)" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#pay">Pay Now</a>
               </div>
            <?php } else { ?>
               <div class="col-12">
                  <a href="javascript:void(0)" class="theme-color">Menunggu Konfirmasi Pembayaran</a>
               </div>
            <?php } ?>
         <?php } ?>
      </div>
   </div>
   <!-- fixed panel end -->

   <!-- Batalkan Pemesanan -->
   <div class="offcanvas offcanvas-bottom h-auto removecart-canvas" id="cancel">
      <div class="offcanvas-body small">
         <div class="content">
            <h4>Batalkan Pemesanan:</h4>
            <p>Jika anda yakin ingin membatalkan pesanan ini klik "Batalkan Pesanan" dibawah ini</p>
         </div>
         <div class="bottom-cart-panel">
            <div class="row">
               <div class="col-12">
                  <a href="<?= base_url(); ?>transaksi/cancel_order/<?= $transaksi->row_array()['invoice']; ?>" class="theme-color">Batalkan Pesanan</a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Upload Bukti Pembayaran -->
   <div class="offcanvas offcanvas-bottom h-auto qty-canvas" id="pay">
      <form method="post" action="<?= base_url('transaksi/order_detail/' . $transaksi->row_array()['invoice']) ?>" enctype="multipart/form-data">
         <input type="hidden" name="ubah_data" value="ubahPembayaran">
         <input type="hidden" id="invoice" name="invoice" value="<?= $transaksi->row_array()['invoice']; ?>">

         <div class="offcanvas-body small">
            <h4>Ambil Gambar:</h4>
            <div class="search-coupons mt-2">
               <input type="file" class="form-control form-theme" id="gambar" name="bukti_pembayaran" onchange="validate(this);" required>
            </div>
            <button type="submit" class="btn btn-solid w-100 mt-3"> Upload Bukti</button>
         </div>
      </form>
   </div>
<?php } elseif ($transaksi->row_array()['status_transaksi'] == '2' || $transaksi->row_array()['status_transaksi'] == '3') { ?>
   <?php if ($transaksi->row_array()['terima_barang'] == '0') { ?>
      <!-- panel space start -->
      <section class="panel-space-2"></section>
      <!-- panel space end -->

      <!-- fixed panel start -->
      <div class="fixed-panel">
         <div class="row">
            <div class="col-12">
               <a href="javascript:void(0)" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#receipt">confirm receipt order</a>
            </div>
         </div>
      </div>
      <!-- fixed panel end -->

      <!-- Upload Bukti Terima -->
      <div class="offcanvas offcanvas-bottom h-auto qty-canvas" id="receipt">
         <form id="orderec">
            <fieldset>
               <input type="hidden" id="invoice" name="invoice" value="<?= $transaksi->row_array()['invoice']; ?>">
               <input type="hidden" id="jasa_pengiriman" name="jasa_pengiriman" value="<?= $transaksi->row_array()['jasa_pengiriman']; ?>">

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
   <?php } elseif ($transaksi->row_array()['terima_barang'] == '1') { ?>
      <!-- panel space start -->
      <section class="panel-space-2"></section>
      <!-- panel space end -->

      <!-- fixed panel start -->
      <div class="fixed-panel">
         <div class="row">
            <div class="col-12">
               <a href="javascript:void(0)" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#terima">Order Submission</a>
            </div>
         </div>
      </div>
      <!-- fixed panel end -->

      <!-- Bukti Pembayaran -->
      <div class="offcanvas offcanvas-bottom h-auto removecart-canvas" id="terima">
         <div class="offcanvas-body small">
            <div class="content">
               <h4 class="mb-3">Bukti Penyerahan Barang:</h4>
               <img src="<?= base_url(); ?>assets/upload/<?= $transaksi->row_array()['bukti_penyerahan']; ?>" alt="" class="img-fluid rounded mb-3" style="width:100%;">

               <h4 class="mb-3">Bukti Terima Barang:</h4>
               <img src="<?= base_url(); ?>assets/upload/<?= $transaksi->row_array()['bukti_terima']; ?>" alt="" class="img-fluid rounded" style="width:100%;">
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