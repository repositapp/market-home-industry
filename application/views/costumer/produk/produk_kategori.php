<?php if ($data_produk->num_rows() > 0) { ?>
   <!-- Produk start -->
   <section class="px-15 lg-t-space top-space pt-2">
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
   <!-- Produk end -->
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf !! Data produk belum ada</h2>
         <p>Data produk belum ditambahkan atau sistem sedang dalam perbaikan. Mohon menunggu</p>
      </div>
   </section>
<?php } ?>
<section class="panel-space-2"></section>