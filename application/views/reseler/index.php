<?php if ($list_order->num_rows() > 0) { ?>
   <!-- Produk Order start -->
   <section class="deals-section px-15 top-space pt-2">
      <div class="title-part">
         <h2>Order Terbaru</h2>
         <a href="<?= base_url(); ?>transaksi/reseler_order">Lihat Semua</a>
      </div>
      <div class="product-section">
         <div class="row gy-3">
            <?php foreach ($list_order->result_array() as $transaksi) :
               $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $transaksi['kode_barang']), 'id_gambar_produk', null)->row_array();
            ?>
               <div class="col-12">
                  <div class="product-inline">
                     <a href="<?= base_url(); ?>transaksi/reseler_order_detail/<?= $transaksi['id_transaksi']; ?>">
                        <img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" class="img-fluid" alt="">
                     </a>
                     <div class="product-inline-content">
                        <div>
                           <a href="<?= base_url(); ?>transaksi/reseler_order_detail/<?= $transaksi['id_transaksi']; ?>">
                              <h4><?= $transaksi['nm_barang']; ?> </h4>
                           </a>
                           <h5>Total Pembelian: <?= $transaksi['jumlah_beli']; ?> Items</h5>
                           <h5><?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></h5>
                           <div class="price">
                              <h4 id="order-cek" class="d-flex">
                                 <a class="theme-color" href="<?= base_url(); ?>transaksi/reseler_order_detail/<?= $transaksi['id_transaksi']; ?>">Lihat Detail</a>
                                 <?php if ($transaksi['status_pengemasan'] == '0') { ?>
                                    <span class="status-label label-danger">In Packing</span>
                                 <?php } elseif ($transaksi['status_pengemasan'] == '1') { ?>
                                    <span class="status-label label-success">Out Packing</span>
                                 <?php } ?>
                              </h4>
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
   <!-- Produk Order End -->
<?php } else { ?>
   <div class="top-space pt-2"></div>
<?php } ?>

<!-- Produk start -->
<?php if ($data_produk->num_rows() > 0) { ?>
   <section class="deals-section pt-0 px-15 lg-t-space">
      <div class="title-part">
         <h2>Produk Anda</h2>
         <a href="<?= base_url(); ?>produk/reseler_produk">Lihat Semua</a>
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
                     <a href="<?= base_url(); ?>produk/reseler_produk_detail/<?= $produk['kode_produk']; ?>"><img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" alt="" class="img-fluid bg-img"></a>
                     <?php if ($hg_diskon->num_rows() > 0) { ?>
                        <label>Diskon <?= $hg_diskon->row_array()['jumlah_diskon']; ?>%</label>
                     <?php } ?>
                  </div>
                  <div class="product-content">
                     <a href="<?= base_url(); ?>produk/reseler_produk_detail/<?= $produk['kode_produk']; ?>">
                        <h4><?= $produk['nm_produk']; ?></h4>
                     </a>
                     <div class="price">
                        <?php if ($hg_diskon->num_rows() > 0) { ?>
                           <h5>Rp. <?= number_format($produk['harga_produk'] - (($hg_diskon->row_array()['jumlah_diskon'] / 100) * $produk['harga_produk']), 0, ".", "."); ?> <del>Rp. <?= number_format($produk['harga_produk'], 0, ".", "."); ?></del></h5>
                        <?php } elseif ($hg_diskon->num_rows() == 0) { ?>
                           <h5>Rp. <?= number_format($produk['harga_produk'], 0, ".", "."); ?></h5>
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
         <p>Silahkan menambah produk dengan menekan tombol dibawah ini.</p>
         <a href="#" data-bs-toggle="offcanvas" data-bs-target="#produkAdd" class="btn btn-solid w-100">tambah produk</a>
      </div>
   </section>

   <!-- canvas start -->
   <div class="offcanvas offcanvas-bottom h-auto removecart-canvas" id="produkAdd">
      <div class="offcanvas-body small">
         <div class="content">
            <h4>Information:</h4>
            <p>Untuk saat ini anda belum dapat menambahkan data produk baru karena sistem sedang dalam perbaikan. Terima kasih!!!</p>
         </div>
         <div class="bottom-cart-panel">
            <div class="row">
               <div class="col-12">
                  <a href="#" class="theme-color" data-bs-dismiss="offcanvas">CLOSE</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- canvas end -->
<?php } ?>
<!-- Produk end -->