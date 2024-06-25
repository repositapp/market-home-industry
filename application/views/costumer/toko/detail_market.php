<!-- Biodata Toko start -->
<div id="toko-header" class="map-product-section">
   <div class="cart-box px-15 pt-2">
      <a class="cart-img">
         <img src="<?= base_url(); ?>assets/upload/<?= $reseler['logo_toko']; ?>" class="img-circle" alt="">
      </a>
      <div class="cart-content">
         <a>
            <h4><?= $reseler['nm_toko']; ?></h4>
         </a>
         <h5 class="content-color">Pemilik <?= $reseler['nm_reseler']; ?></h5>
         <div class="price">
            <h4 class="ellipsis-2"><i class="iconly-Location icli"></i> <?= $reseler['alamat_toko']; ?> </h4>
         </div>
         <div class="cart-option">
            <h5><a href="tel:<?= $reseler['telp_toko']; ?>"> <i class="iconly-Call icli"></i> Telepon </a></h5>
            <span class="divider-cls">|</span>
            <h5><a href="mailto:<?= $reseler['email_toko']; ?>"> <i class="iconly-Message icli"></i> Email </a></h5>
            <span class="divider-cls">|</span>
            <h5><i class="iconly-Discount icli"></i> Produk <?= $data_produk->num_rows(); ?></h5>
         </div>
      </div>
   </div>
   <div class="px-15">
      <hr>
   </div>
</div>
<!-- Biodata Toko End -->


<!-- Produk Terlaris start -->
<?php if ($data_terlaris->num_rows() > 0) { ?>
   <section class="product-slider-section overflow-hidden lg-t-space">
      <div class="title-section px-15">
         <h2>Produk Terlaris</h2>
         <h3><?= $data_terlaris->num_rows(); ?> Produk</h3>
      </div>
      <div class="product-slider slick-default pl-15">
         <?php foreach ($data_terlaris->result_array() as $terlaris) :
            $hg_diskon = $this->m_produk->getData('diskon', array('kode_produk' => $terlaris['kode_produk']), 'id_diskon', null);
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $terlaris['kode_produk']), 'id_gambar_produk', null)->row_array();
         ?>
            <div>
               <div class="product-box ratio_square">
                  <div class="img-part">
                     <a href="<?= base_url(); ?>produk/produk_detail/<?= $terlaris['kode_produk']; ?>"><img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" alt="" class="img-fluid bg-img"></a>
                     <?php if ($hg_diskon->num_rows() > 0) { ?>
                        <label>Diskon <?= $hg_diskon->row_array()['jumlah_diskon']; ?>%</label>
                     <?php } ?>
                  </div>
                  <div class="product-content">
                     <a href="<?= base_url(); ?>produk/produk_detail/<?= $terlaris['kode_produk']; ?>">
                        <h4><?= $terlaris['nm_produk']; ?></h4>
                     </a>
                     <div class="price">
                        <?php if ($hg_diskon->num_rows() > 0) { ?>
                           <h5>Rp. <?= number_format(($terlaris['harga_produk'] - (($hg_diskon->row_array()['jumlah_diskon'] / 100) * $terlaris['harga_produk'])) + ($terlaris['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?> <del>Rp. <?= number_format($terlaris['harga_produk'] + ($terlaris['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></del></h5>
                        <?php } elseif ($hg_diskon->num_rows() == 0) { ?>
                           <h5>Rp. <?= number_format($terlaris['harga_produk'] + ($terlaris['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></h5>
                        <?php } ?>
                     </div>
                     <div class="kategori-sold">
                        <h5 class="ellipsis-4"><?= $terlaris['nm_kategori_produk']; ?></h5>
                        <a><?= $terlaris['jumlah_belanja']; ?> Terjual</a>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </section>
   <div class="divider t-12 b-20"></div>
<?php } ?>
<!-- Produk Terlaris end -->

<!-- Penawaran (Diskon) start -->
<?php if ($data_diskon->num_rows() > 0) { ?>
   <section class="deals-section px-15 pt-0">
      <div class="title-part">
         <h2>Penawaran Kami</h2>
         <a href="<?= base_url(); ?>produk/diskon_costumer"><?= $data_diskon->num_rows(); ?> Produk</a>
      </div>
      <div class="product-section">
         <div class="row gy-3">
            <?php foreach ($data_diskon->result_array() as $diskon) :
               $gbr_diskon = $this->m_produk->getData('gambar_produk', array('kode_produk' => $diskon['kode_produk']), 'id_gambar_produk', null)->row_array();
            ?>
               <div class="col-12">
                  <div class="product-inline">
                     <a href="<?= base_url(); ?>produk/produk_detail/<?= $diskon['kode_produk']; ?>">
                        <img src="<?= base_url(); ?>assets/upload/<?= $gbr_diskon['gambar_produk']; ?>" class="img-fluid" alt="">
                     </a>
                     <div class="product-inline-content">
                        <div>
                           <a href="<?= base_url(); ?>produk/produk_detail/<?= $diskon['kode_produk']; ?>">
                              <h4><?= $diskon['nm_produk']; ?></h4>
                           </a>
                           <h5><?= $diskon['nm_kategori_produk']; ?></h5>
                           <div class="price">
                              <h4>Rp. <?= number_format(($diskon['harga_produk'] - (($diskon['jumlah_diskon'] / 100) * $diskon['harga_produk'])) + ($diskon['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?> <del>Rp. <?= number_format($diskon['harga_produk'] + ($diskon['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></del> <span class="font-12">(<?= $diskon['jumlah_diskon']; ?>%)</span></h4>
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
<?php } ?>
<!-- Penawaran (Diskon) end -->

<!-- Produk start -->
<?php if ($data_produk->num_rows() > 0) { ?>
   <section class="pt-0 px-15 lg-t-space">
      <div class="title-all-market">
         <h2>Semua Produk</h2>
         <a href="#!"><?= $data_produk->num_rows(); ?> Produk</a>
      </div>
      <div class="row gy-3 gx-3">
         <?php foreach ($data_produk->result_array() as $produk) :
            $hg_diskon = $this->m_produk->getData('diskon', array('kode_produk' => $produk['kode_produk']), 'id_diskon', null);
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $produk['kode_produk']), 'id_gambar_produk', null)->row_array();
            $sold = $this->m_produk->getProdukTerlaris(null, array('produk.kode_produk' =>  $produk['kode_produk']));
         ?>
            <div class="col-md-4 col-6">
               <div class="product-box ratio_square">
                  <div class="img-part">
                     <a href="<?= base_url(); ?>produk/produk_detail/<?= $produk['kode_produk']; ?>"><img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" alt="" class="img-fluid bg-img"></a>
                     <?php if ($hg_diskon->num_rows() > 0) { ?>
                        <label>Diskon <?= $hg_diskon->row_array()['jumlah_diskon']; ?>%</label>
                     <?php } ?>
                  </div>
                  <div class="product-content">
                     <a href="<?= base_url(); ?>produk/produk_detail/<?= $produk['kode_produk']; ?>">
                        <h4><?= $produk['nm_produk']; ?></h4>
                     </a>
                     <div class="price">
                        <?php if ($hg_diskon->num_rows() > 0) { ?>
                           <h5>Rp. <?= number_format(($produk['harga_produk'] - (($hg_diskon->row_array()['jumlah_diskon'] / 100) * $produk['harga_produk'])) + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?> <del>Rp. <?= number_format($produk['harga_produk'] + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></del></h5>
                        <?php } elseif ($hg_diskon->num_rows() == 0) { ?>
                           <h5>Rp. <?= number_format($produk['harga_produk'] + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></h5>
                        <?php } ?>
                     </div>
                     <div class="kategori-sold">
                        <h5 class="ellipsis-3"><?= $produk['nm_kategori_produk']; ?></h5>
                        <?php if ($sold->num_rows() > 0) { ?>
                           <a><?= $sold->row_array()['jumlah_belanja']; ?> Terjual</a>
                        <?php } else { ?>
                           <a>0 Terjual</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </section>
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf !! Data produk belum ada</h2>
         <p>Data produk belum ditambahkan atau sistem sedang dalam perbaikan. Mohon menunggu</p>
      </div>
   </section>
<?php } ?>
<!-- Produk end -->

<!-- panel space start -->
<section class="panel-space-2"></section>
<!-- panel space end -->