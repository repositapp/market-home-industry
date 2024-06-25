<?php if ($data_kategori->num_rows() > 0) { ?>
   <!-- category start -->
   <section class="category-listing px-15 lg-space top-space pt-0">
      <!-- <a href="<?= base_url(); ?>produk/diskon_costumer" class="category-wrap">
         <div class="content-part">
            <img src="<?= base_url(); ?>assets/mobile/images/sale.gif" class="img-fluid sale-gif" alt="">
            <h4>produk diskon untuk anda </h4>
         </div>
         <div class="img-part">
            <img src="<?= base_url(); ?>assets/mobile/images/category/sale.png" class="img-fluid" alt="">
         </div>
      </a> -->
      <?php foreach ($data_kategori->result_array() as $kategori) :
         $jumlah = $this->m_produk->getData('produk', array('kategori_produk' => $kategori['id_kategori_produk']), 'id_produk', null);
      ?>
         <a href="<?= base_url(); ?>produk/detail_kategori/<?= $kategori['id_kategori_produk']; ?>" class="category-wrap">
            <div class="content-part">
               <h2><?= $kategori['nm_kategori_produk']; ?></h2>
               <h4><?= $jumlah->num_rows(); ?> Produk untuk anda</h4>
            </div>
            <div class="img-part">
               <?php if ($kategori['gambar_kategori_produk'] != "") { ?>
                  <img src="<?= base_url(); ?>assets/upload/<?= $kategori['gambar_kategori_produk']; ?>" class="img-fluid category" alt="">
               <?php } else { ?>
                  <img src="<?= base_url(); ?>assets/upload/img-none.png" class="img-fluid category" alt="">
               <?php } ?>
            </div>
         </a>
      <?php endforeach; ?>
   </section>
   <!-- category end -->
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf !! Data kategori belum ada</h2>
         <p>Data kategori belum ditambahkan atau sistem sedang dalam perbaikan. Mohon menunggu</p>
      </div>
   </section>
<?php } ?>