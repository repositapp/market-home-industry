<form method="post" action="<?= base_url('transaksi/checkout_delivery') ?>" enctype="multipart/form-data">
   <input type="hidden" name="tambah_data" value="tambah">
   <!-- delivery option section start -->
   <section class="top-space px-15 pt-2">
      <h2 class="page-title"><i class="iconly-Location icli theme-color"></i>&nbsp; Alamat Pengiriman</h2>
      <div class="delivery-option-section">
         <?php if ($alamat->num_rows() > 0) { ?>
            <ul>
               <li>
                  <div class="check-box">
                     <div class="form-check d-flex ps-0">
                        <div>
                           <h4 class="name"><?= $alamat->row_array()['nama_alamat']; ?></h4>
                           <div class="addess">
                              <h4>Kota <?= $alamat->row_array()['nm_kota']; ?>, </h4>
                              <h4>Kecamatan <?= $alamat->row_array()['nm_kecamatan']; ?>,</h4>
                              <h4>Kelurahan <?= $alamat->row_array()['nm_kelurahan']; ?>,</h4>
                              <h4><?= $alamat->row_array()['detail_alamat']; ?></h4>
                           </div>
                           <h4>Tipe Alamat: <?= $alamat->row_array()['tipe_alamat']; ?></h4>
                           <h4>No. Telepon: <?= $alamat->row_array()['telp_alamat']; ?></h4>
                           <?php if ($alamat->row_array()['status_alamat'] == 1) { ?>
                              <h6 class="label">Utama</h6>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="buttons">
                     <a href="<?= base_url(); ?>user/costumer_alamat/1">Ganti Alamat Pengiriman</a>
                  </div>
               </li>
            </ul>
         <?php } else { ?>
            <a href="<?= base_url(); ?>user/costumer_alamat/1" class="btn btn-outline text-capitalize w-100 mt-3">Tambah Alamat Baru</a>
         <?php } ?>
      </div>
   </section>
   <div class="divider"></div>
   <!-- delivery option section end -->

   <!-- payment method start -->
   <section id="checkout" class="px-15 payment-method-section pt-0">
      <h2 class="page-title"><i class="iconly-Swap icli theme-color"></i>&nbsp; Jasa Pengiriman</h2>
      <div class="accordion" id="accordionExample">
         <?php $no = 1;
         foreach ($data_jasa->result_array() as $jasa) : ?>
            <div class="card">
               <div class="card-header" id="h_one">
                  <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#one<?= $no; ?>">
                     <label for='jasa<?= $no; ?>'>
                        <img src="<?= base_url(); ?>assets/upload/<?= $jasa['logo_jasa']; ?>" class="img-fluid" alt=""><?= $jasa['jasa_pengiriman']; ?>
                        <input type='radio' class="radio_animated" checked id='jasa<?= $no; ?>' name='jasa' value='<?= $jasa['id_ongkir_jasa']; ?>' required />
                     </label>
                  </div>
               </div>
               <div id="one<?= $no; ?>" class="collapse show" aria-labelledby="h_one" data-bs-parent="#accordionExample">
                  <div class="card-body p-0">
                  </div>
               </div>
            </div>
         <?php $no++;
         endforeach; ?>
      </div>
   </section>
   <div class="divider"></div>
   <!-- payment method end -->

   <!-- Produk Keranjang section -->
   <div class="px-15">
      <h2 class="page-title"><i class="iconly-Bag-2 icli theme-color"></i>&nbsp; Produk Checkout</h2>
   </div>
   <?php foreach ($data_reseler->result_array() as $reseler) :
      $data_keranjang = $this->m_produk->getKeranjang($this->session->userdata('id_user'), $reseler['id_user']);
   ?>
      <section id="order-details" class="px-15 pt-0 mb-3">
         <div class="order-details">
            <div class="delivery-info">
               <img src="<?= base_url(); ?>assets/upload/<?= $reseler['logo_toko']; ?>" class="img-fluid rounded-circle" alt="">
               <h4><?= $reseler['nm_toko']; ?></h4>
               <i class="iconly-Arrow-Right-2 icli icon-right"></i>
            </div>
         </div>
      </section>

      <!-- cart items start -->
      <section class="cart-section pt-0">
         <?php foreach ($data_keranjang->result_array() as $keranjang) :
            $hg_diskon = $this->m_produk->getData('diskon', array('kode_produk' => $keranjang['kode_produk']), 'id_diskon', null);
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $keranjang['kode_produk']), 'id_gambar_produk', null)->row_array();
            $varian = $this->m_produk->getData('produk_variasi', array('id_produk_variasi' => $keranjang['variasi_produk']), 'id_produk_variasi', null);
            $data_variasi = $this->m_produk->getData('produk_variasi', array('kode_produk' => $keranjang['kode_produk']), 'id_produk_variasi', null);
         ?>
            <div class="cart-box px-15 mb-3">
               <a href="<?= base_url(); ?>produk/produk_detail/<?= $keranjang['kode_produk']; ?>" class="cart-img">
                  <img src="<?= base_url(); ?>assets/upload/<?= $gbr_produk['gambar_produk']; ?>" class="img-fluid" alt="">
               </a>
               <div class="cart-content">
                  <a href="<?= base_url(); ?>produk/produk_detail/<?= $keranjang['kode_produk']; ?>">
                     <h4><?= $keranjang['nm_produk']; ?> </h4>
                  </a>
                  <h5 class="content-color"><?= $keranjang['nm_kategori_produk']; ?></h5>
                  <div class="price">
                     <?php if ($hg_diskon->num_rows() > 0) { ?>
                        <h4>Rp. <?= number_format(($keranjang['harga_produk'] - (($hg_diskon->row_array()['jumlah_diskon'] / 100) * $keranjang['harga_produk'])) + ($keranjang['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?> <del>Rp. <?= number_format($keranjang['harga_produk'] + ($keranjang['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></del><span>20%</span></h4>
                     <?php } elseif ($hg_diskon->num_rows() == 0) { ?>
                        <h4>Rp. <?= number_format($keranjang['harga_produk'] + ($keranjang['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></h4>
                     <?php } ?>
                  </div>
                  <div class="select-size-sec">
                     <a href="javascript:void(0)" class="opion">
                        <h6>Qty: <?= $keranjang['qty']; ?></h6>
                     </a>
                     <?php if ($varian->num_rows() > 0) { ?>
                        <a href="javascript:void(0)" class="opion">
                           <h6>
                              <?php if ($varian->row_array()['warna_rasa'] != 'none') { ?>
                                 <?= $varian->row_array()['warna_rasa']; ?>
                              <?php } ?>
                              <?php if ($varian->row_array()['size'] != 'none') { ?>
                                 | <?= $varian->row_array()['nm_size']; ?>
                              <?php } ?>
                           </h6>
                        </a>
                     <?php } ?>
                  </div>
                  <div class="cart-option">
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </section>
      <!-- cart items end -->
   <?php endforeach; ?>
   <!-- Produk Keranjang end -->

   <!-- panel space start -->
   <section class="panel-space"></section>
   <!-- panel space end -->

   <!-- bottom panel start -->
   <div class="cart-bottom">
      <div>
         <div class="left-content">
            <h4><span>Total Checkout:</span> </h4>
            <a class="font-15 theme-color"><?= $jumlah->num_rows(); ?> Produk</a>
         </div>
         <button type="submit" class="btn btn-solid">Pembayaran</button>
      </div>
   </div>
   <!-- bottom panel end -->
</form>