<?php if ($data_reseler->num_rows() > 0) { ?>
   <!-- Market/Toko start -->
   <section class="category-listing px-15 lg-space top-space pt-0">
      <?php foreach ($data_reseler->result_array() as $reseler) :
         $jumlah = $this->m_produk->getData('produk', array('reseler' => $reseler['reseler']), 'id_produk', null);
      ?>
         <?php if ($jumlah->num_rows() > 0) { ?>
            <a href="<?= base_url(); ?>user/detail_market/<?= $reseler['reseler']; ?>" class="category-wrap">
               <div class="content-part">
                  <h2><?= $reseler['nm_toko']; ?></h2>
                  <h4><?= $jumlah->num_rows(); ?> Produk Toko</h4>
               </div>
               <div class="img-part">
                  <?php if ($reseler['logo_toko'] != "") { ?>
                     <img src="<?= base_url(); ?>assets/upload/<?= $reseler['logo_toko']; ?>" class="img-circle" alt="">
                  <?php } else { ?>
                     <img src="<?= base_url(); ?>assets/upload/img-none.png" class="img-circle" alt="">
                  <?php } ?>
               </div>
            </a>
         <?php } ?>
      <?php endforeach; ?>
   </section>
   <!-- Market/Toko end -->
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf !! Data market belum ada</h2>
         <p>Data market belum ditambahkan atau sistem sedang dalam perbaikan. Mohon menunggu</p>
      </div>
   </section>
<?php } ?>