<?php if ($list_order->num_rows() > 0) { ?>
   <!-- Produk Order start -->
   <section class="deals-section px-15 top-space pt-2">
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
   <!-- Produk Order End -->
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf!!</h2>
         <p>Belum ada produk yang dipesan untuk saat ini.</p>
      </div>
   </section>
<?php } ?>
<section class="panel-space-2"></section>