<?php if ($list_order->num_rows() > 0) { ?>
   <!-- Produk Order start -->
   <section id="order-cek" class="top-space pt-2 px-15">
      <div class="title-section">
         <h2>Data Order</h2>
         <h3>Pesanan Siap Di Antarkan</h3>
      </div>
      <ul class="order-listing">
         <?php foreach ($list_order->result_array() as $transaksi) :
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $transaksi['kode_barang']), 'id_gambar_produk', null)->row_array();
         ?>
            <li>
               <div class="order-box">
                  <div class="d-flex align-items-center">
                     <img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" class="img-fluid order-img" alt="">
                     <div class="media-body">
                        <h4 class="font-13">Inv. <?= $transaksi['invoice']; ?> </h4>
                        <h5 class="content-color my-1">Total Pembelian: <?= $transaksi['jumlah_belanja']; ?> Items</h5>
                        <h5 class="content-color my-1">Total Harga: Rp. <?= number_format($transaksi['total_transaksi'], 0, ".", "."); ?></h5>
                        <a class="theme-color" href="<?= base_url(); ?>transaksi/delivery_detail/<?= $transaksi['invoice']; ?>">Lihat Detail</a>
                     </div>
                     <?php if ($transaksi['status_transaksi'] == '2') { ?>
                        <span class="status-label label-info">Delivery</span>
                     <?php } elseif ($transaksi['status_transaksi'] == '3') { ?>
                        <span class="status-label label-success">Received</span>
                     <?php } ?>
                  </div>
                  <div class="delivery-status">
                     <div class="d-flex">
                        <div>
                           <h6 class="content-color">Waktu Pesan:</h6>
                           <h6><?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></h6>
                        </div>
                        <div>
                           <h6 class="content-color">Tujuan:</h6>
                           <h6><?= $transaksi['nm_kelurahan']; ?></h6>
                        </div>
                        <div>
                           <h6 class="content-color">Pembayaran:</h6>
                           <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
                              <h6>COD</h6>
                           <?php } elseif ($transaksi['jenis_pembayaran'] == 2) { ?>
                              <h6>Transfer Bank</h6>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         <?php endforeach; ?>
      </ul>
   </section>
   <!-- Produk Order End -->
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf !! Belum ada orderan</h2>
         <p>Anda dapat istirahat sejenak sembari menunggu orderan masuk.</p>
      </div>
   </section>
<?php } ?>