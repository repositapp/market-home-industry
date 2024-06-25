<!-- order success section start -->
<section class="order-success-section px-15 top-space xl-space">
   <div>
      <img src="<?= base_url(); ?>assets/mobile/images/check-circle.gif" class="img-fluid" alt="">
      <h1 class="theme-color">Transaksi Berhasil</h1>
      <h2>Mohon menunggu pesanan anda dikonfirmasi oleh reseler..</h2>
   </div>
</section>
<!-- order success section end -->

<!-- order details section start -->
<section class="px-15">
   <h2 class="page-title">Detail Pemesanan</h2>
   <div class="details">
      <ul>
         <li class="mb-3 d-block">
            <h4 class="fw-bold mb-1">Kode pemesanan anda: <?= $data_produk->row_array()['invoice']; ?></h4>
         </li>
         <li class="mb-3 d-block">
            <h4 class="fw-bold mb-1">Pesanan ini akan dikirim ke:</h4>
            <h4 class="content-color"><?= $alamat->row_array()['detail_alamat']; ?></h4>
            <h4 class="content-color">Kelurahan <?= $alamat->row_array()['nm_kelurahan']; ?>, Kecamatan <?= $alamat->row_array()['nm_kecamatan']; ?></h4>
            <h4 class="content-color">Kota <?= $alamat->row_array()['nm_kota']; ?></h4>
         </li>
         <li class="d-block">
            <h4 class="fw-bold mb-1">Metode Pembayaran</h4>
            <?php if ($data_produk->row_array()['invoice'] == 0) { ?>
               <h4 class="content-color">Cash On Delivery</h4>
            <?php } elseif ($data_produk->row_array()['invoice'] == 1) { ?>
               <h4 class="content-color">Transfer Bank</h4>
            <?php } ?>
         </li>
      </ul>
   </div>
</section>
<div class="divider"></div>
<!-- order details section end -->

<!-- expected delivery section start -->
<section class="px-15 pt-0">
   <h2 class="page-title">Ringkasan Pesanan</h2>
   <div class="product-section">
      <div class="row gy-3">
         <?php foreach ($data_produk->result_array() as $produk) :
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $produk['kode_produk']), 'id_gambar_produk', null)->row_array();
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
                           <h4><?= $produk['nm_produk']; ?> </h4>
                        </a>
                        <h5 class="content-color">
                           Qty: <?= $produk['jumlah_beli']; ?>
                           <?php if ($varian->num_rows() > 0) { ?>
                              , Varian: <?php if ($varian->row_array()['warna_rasa'] != 'none') { ?>
                                 <?= $varian->row_array()['warna_rasa']; ?>
                              <?php } ?>
                              <?php if ($varian->row_array()['size'] != 'none') { ?>
                                 | <?= $varian->row_array()['nm_size']; ?>
                              <?php } ?>
                           <?php } ?>
                        </h5>
                        <div class="price">
                           <h4>Rp. <?= number_format($produk['harga_barang'] + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
</section>
<!-- expected delivery section end -->

<!-- order details start -->
<section class="px-15">
   <div class="order-details">
      <ul>
         <li>
            <h4>Total Pesanan <span><?= $data_produk->num_rows(); ?> Items</span></h4>
         </li>
         <li>
            <h4>Berat Beban <span class="theme-color"><?= $data_produk->row_array()['total_beban'] / 1000; ?> kg</span></h4>
         </li>
         <li>
            <h4>Subtotal untuk Produk <span>Rp. <?= number_format($harga_pt->row_array()['total_hp'] + ($harga_pt->row_array()['total_hp'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></span></h4>
         </li>
         <li>
            <h4>Subtotal Pengiriman <span class="text-success">Rp. <?= number_format($data_produk->row_array()['total_pengiriman'], 0, ".", "."); ?></span></h4>
         </li>
         <li>
            <h4>PPn <span class="theme-color"><?= $biaya_jp['pajak_jasa']; ?>%</span></h4>
         </li>
      </ul>
      <div class="total-amount">
         <h4>Total Pembayaran <span>Rp. <?= number_format($data_produk->row_array()['total_transaksi'], 0, ".", "."); ?></span></h4>
      </div>
   </div>
</section>
<!-- order details end -->

<!-- panel space start -->
<section class="panel-space"></section>
<!-- panel space end -->

<!-- bottom panel start -->
<div class="delivery-cart cart-bottom">
   <div>
      <div class="left-content">
         <a href="<?= base_url(); ?>home/costumer" class="title-color">Menu Utama</a>
      </div>
      <a href="<?= base_url(); ?>produk/kategori" class="btn btn-solid">Lanjutkan Belanja</a>
   </div>
</div>
<!-- bottom panel end -->