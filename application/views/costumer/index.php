<!-- Kategori start -->
<?php if ($data_kategori->num_rows() > 0) { ?>
   <section class="category-section top-space">
      <ul class="category-slide">
         <?php foreach ($data_kategori->result_array() as $kategori) : ?>
            <li>
               <a href="<?= base_url(); ?>produk/detail_kategori/<?= $kategori['id_kategori_produk']; ?>" class="category-box">
                  <div class="img-category">
                     <?php if ($kategori['gambar_kategori_produk'] != "") { ?>
                        <img src="<?= base_url(); ?>assets/upload/<?= $kategori['gambar_kategori_produk']; ?>" class="img-fluid category" alt="">
                     <?php } else { ?>
                        <img src="<?= base_url(); ?>assets/upload/img-none.png" class="img-fluid category" alt="">
                     <?php } ?>
                  </div>
                  <h4><?= $kategori['nm_kategori_produk']; ?></h4>
               </a>
            </li>
         <?php endforeach; ?>
      </ul>
   </section>
   <div class="divider t-12 b-20"></div>
<?php } else { ?>
   <div class="top-space"></div>
<?php } ?>
<!-- Kategori end -->

<!-- home slider start -->
<section class="pt-0 home-section ratio_55">
   <div class="home-slider slick-default theme-dots">
      <?php foreach ($data_slider->result_array() as $slider) :
         $exp_slider = explode(".", $slider['gbr_slider']); ?>
         <div>
            <div class="slider-box">
               <?php if ($exp_slider[1] == 'mp4' || $exp_slider[1] == 'avi' || $exp_slider[1] == 'mkv' || $exp_slider[1] == '3gp' || $exp_slider[1] == 'mgp' || $exp_slider[1] == 'mpeg') { ?>
                  <video controls autoplay muted loop alt="" style="width: 325px; height: 182px; border-radius: 6px;">
                     <source src="<?= base_url(); ?>assets/upload/<?= $slider['gbr_slider']; ?>">
                  </video>
               <?php } else { ?>
                  <img src="<?= base_url(); ?>assets/upload/<?= $slider['gbr_slider']; ?>" class="img-fluid bg-img" alt="">
               <?php } ?>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</section>
<!-- home slider end -->

<!-- Produk Terlaris start -->
<?php if ($data_terlaris->num_rows() > 0) { ?>
   <section class="product-slider-section overflow-hidden lg-t-space">
      <div class="title-section px-15">
         <h2>Produk Terlaris </h2>
         <h3>Pilihan untuk anda </h3>
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
         <a href="<?= base_url(); ?>produk/diskon_costumer">Lihat Semua</a>
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
      <div class="title-section">
         <h2>Temukan Kesukaanmu</h2>
         <h3>Apa yang anda sukai?</h3>
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