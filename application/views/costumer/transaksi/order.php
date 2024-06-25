<?php if ($data_transaksi->num_rows() > 0) { ?>
   <!-- Produk Order start -->
   <section id="order-cek" class="top-space pt-0 px-15">
      <ul class="order-listing">
         <?php foreach ($data_transaksi->result_array() as $transaksi) :
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $transaksi['kode_barang']), 'id_gambar_produk', null)->row_array();
            $jasa = $this->m_produk->getData('ongkir_jasa', array('id_ongkir_jasa' => $transaksi['jasa_pengiriman']), 'id_ongkir_jasa', null)->row_array();
         ?>
            <li>
               <div class="order-box">
                  <div class="d-flex align-items-center">
                     <img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" class="img-fluid order-img" alt="">
                     <div class="media-body">
                        <h4 class="font-13">Inv. <?= $transaksi['invoice']; ?> </h4>
                        <h5 class="content-color my-1">Total Pembelian: <?= $transaksi['jumlah_belanja']; ?> Items</h5>
                        <h5 class="content-color my-1">Total Harga: Rp. <?= number_format($transaksi['total_transaksi'], 0, ".", "."); ?></h5>
                        <a class="theme-color" href="<?= base_url(); ?>transaksi/order_detail/<?= $transaksi['invoice']; ?>">Lihat Detail</a>
                     </div>
                     <!-- <?php if ($transaksi['jenis_pembayaran'] == '1') { ?>
                        <span class="status-label label-danger">Pending</span>
                     <?php } elseif ($transaksi['jenis_pembayaran'] == '2') { ?>
                        <span class="status-label label-danger">Pay Now</span>
                     <?php } ?> -->
                  </div>
                  <div class="delivery-status">
                     <div class="d-flex">
                        <div>
                           <h6 class="content-color">Waktu Pesan:</h6>
                           <h6><?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?> Wita</h6>
                        </div>
                        <div>
                           <h6 class="content-color">Tujuan:</h6>
                           <h6><?= $transaksi['nm_kelurahan']; ?></h6>
                        </div>
                        <div>
                           <h6 class="content-color">Jasa:</h6>
                           <h6><?= $jasa['jasa_pengiriman']; ?></h6>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         <?php endforeach; ?>
      </ul>
   </section>
   <!-- Produk Order End -->

   <!-- panel space start -->
   <section class="panel-space-2"></section>
   <!-- panel space end -->
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf !! Anda belum mengorder</h2>
         <p>Lihatlah beberapa produk yang anda sukai dengan mengklik tombol mulai belanja dibawah ini</p>
         <a href="<?= base_url(); ?>produk/kategori" class="btn btn-solid w-100">mulai belanja</a>
      </div>
   </section>
<?php } ?>