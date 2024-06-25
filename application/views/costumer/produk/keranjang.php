<div class="toastr1"></div>
<?php if ($data_reseler->num_rows() > 0) { ?>
   <div class="pt-0 top-space xl-space"></div>
   <!-- Keranjang section -->
   <?php foreach ($data_reseler->result_array() as $reseler) :
      $data_keranjang = $this->m_produk->getKeranjang($this->session->userdata('id_user'), $reseler['id_user']);
   ?>
      <section id="order-details" class="px-15 pt-0 mb-3">
         <div class="order-details">
            <a href="<?= base_url(); ?>user/detail_market/<?= $reseler['id_user']; ?>">
               <div class="delivery-info">
                  <img src="<?= base_url(); ?>assets/upload/<?= $reseler['logo_toko']; ?>" class="img-fluid rounded-circle" alt="">
                  <h4><?= $reseler['nm_toko']; ?></h4>
                  <i class="iconly-Arrow-Right-2 icli icon-right"></i>
               </div>
            </a>
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
                  <div class="price">
                     <?php if ($hg_diskon->num_rows() > 0) { ?>
                        <h4>Rp. <?= number_format(($keranjang['harga_produk'] - (($hg_diskon->row_array()['jumlah_diskon'] / 100) * $keranjang['harga_produk'])) + ($keranjang['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?> <del>Rp. <?= number_format($keranjang['harga_produk'] + ($keranjang['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></del><span>20%</span></h4>
                     <?php } elseif ($hg_diskon->num_rows() == 0) { ?>
                        <h4>Rp. <?= number_format($keranjang['harga_produk'] + ($keranjang['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></h4>
                     <?php } ?>
                  </div>
                  <div class="select-size-sec">
                     <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#selectQty<?= $keranjang['id_keranjang']; ?>" class="opion">
                        <h6>Qty: <?= $keranjang['qty']; ?></h6><i class="iconly-Arrow-Down-2 icli"></i>
                     </a>
                     <?php if ($varian->num_rows() > 0) { ?>
                        <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#selectVarian<?= $keranjang['id_keranjang']; ?>" class="opion">
                           <h6>
                              <?php if ($varian->row_array()['warna_rasa'] != 'none') { ?>
                                 <?= $varian->row_array()['warna_rasa']; ?>
                              <?php } ?>
                              <?php if ($varian->row_array()['size'] != 'none') { ?>
                                 | <?= $varian->row_array()['nm_size']; ?>
                              <?php } ?>
                           </h6><i class="iconly-Arrow-Down-2 icli"></i>
                        </a>
                     <?php } ?>
                  </div>
                  <div class="cart-option">
                     <h5 data-bs-toggle="offcanvas" data-bs-target="#removecart<?= $keranjang['id_keranjang']; ?>"><i class="iconly-Delete icli"></i>
                        Remove
                     </h5>
                  </div>
               </div>
            </div>

            <!-- select qty offcanvas start -->
            <div class="offcanvas offcanvas-bottom h-auto qty-canvas" id="selectQty<?= $keranjang['id_keranjang']; ?>">
               <form method="post" action="<?= base_url('produk/keranjang') ?>" enctype="multipart/form-data">
                  <input type="hidden" name="ubah_data" value="ubahQty">
                  <input type="hidden" id="id_keranjang" name="id_keranjang" value="<?= $keranjang['id_keranjang']; ?>">

                  <div class="offcanvas-body small">
                     <h4>Select Quanity:</h4>
                     <div class="qty-counter">
                        <div class="input-group">
                           <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                              <img src="<?= base_url(); ?>assets/mobile/svg/minus-square.svg" class="img-fluid" alt="">
                           </button>
                           <input type="text" name="quantity" class="form-control form-theme qty-input input-number" value="<?= $keranjang['qty']; ?>">
                           <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                              <img src="<?= base_url(); ?>assets/mobile/svg/plus-square.svg" class="img-fluid" alt="">
                           </button>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-solid w-100" id="add_cart">Done</button>
                  </div>
               </form>
            </div>
            <!-- select qty offcanvas end -->

            <!-- color offcanvas start -->
            <div class="offcanvas offcanvas-bottom h-auto qty-canvas" id="selectVarian<?= $keranjang['id_keranjang']; ?>">
               <form method="post" action="<?= base_url('produk/keranjang') ?>" enctype="multipart/form-data">
                  <input type="hidden" name="ubah_data" value="ubahVarian">
                  <input type="hidden" id="id_keranjang" name="id_keranjang" value="<?= $keranjang['id_keranjang']; ?>">

                  <div class="offcanvas-body small">
                     <h4>Pilih Varian:</h4>
                     <div class="mb-2 mt-2">
                        <div class="radio-select">
                           <?php $no = 1;
                           foreach ($data_variasi->result_array() as $variasi) : ?>
                              <input class="checkbox-tools" type="radio" id="variasi_produk_<?= $keranjang['id_keranjang']; ?>_<?= $no; ?>" name="variasi_produk" value="<?= $variasi['id_produk_variasi']; ?>" <?= $variasi['stok_variasi'] == 0 ? "disabled" : "" ?> <?= $variasi['id_produk_variasi'] == $keranjang['variasi_produk'] ? "checked" : "" ?>>
                              <label class="for-checkbox-tools" for="variasi_produk_<?= $keranjang['id_keranjang']; ?>_<?= $no; ?>">
                                 <?php if ($variasi['warna_rasa'] != 'none') { ?>
                                    <?= $variasi['warna_rasa']; ?> |
                                 <?php } ?>

                                 <?php if ($variasi['size'] != 'none') { ?>
                                    Size <?= $variasi['nm_size']; ?> |
                                 <?php } ?>

                                 Stok <?= $variasi['stok_variasi']; ?>
                              </label>
                           <?php $no++;
                           endforeach; ?>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-solid w-100" id="add_cart">Done</button>
                  </div>
               </form>
            </div>
            <!-- color offcanvas end -->

            <!-- Hapus Keranjang -->
            <div class="offcanvas offcanvas-bottom h-auto removecart-canvas" id="removecart<?= $keranjang['id_keranjang']; ?>">
               <div class="offcanvas-body small">
                  <div class="content">
                     <h4>Hapus Data:</h4>
                     <p>Jika anda yakin ingin menghapus pesanan ini klik "Hapus Pesanan" dibawah ini</p>
                  </div>
                  <div class="bottom-cart-panel">
                     <div class="row">
                        <div class="col-12">
                           <a href="<?= base_url(); ?>produk/hapus_keranjang/<?= $keranjang['id_keranjang']; ?>" class="theme-color">Hapus Pesanan</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </section>
      <!-- cart items end -->

      <div class="divider"></div>
   <?php endforeach; ?>
   <!-- Keranjang end -->

   <!-- related section start -->
   <section class="pt-0 product-slider-section overflow-hidden">
      <div class="title-section px-15">
         <h2>Mungkin anda sukai</h2>
      </div>
      <div class="product-slider slick-default pl-15">
         <?php foreach ($data_produk->result_array() as $produk) :
            $hg_diskon = $this->m_produk->getData('diskon', array('kode_produk' => $produk['kode_produk']), 'id_diskon', null);
            $gbr_produk = $this->m_produk->getData('gambar_produk', array('kode_produk' => $produk['kode_produk']), 'id_gambar_produk', null)->row_array();
         ?>
            <div>
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
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </section>
   <!-- related section end -->
<?php } else { ?>
   <section class="px-15">
      <div class="empty-cart-section text-center">
         <img src="<?= base_url(); ?>assets/mobile/images/empty-cart.png" class="img-fluid" alt="">
         <h2>Maaf !! Keranjang anda kosong</h2>
         <p>Lihatlah beberapa produk yang anda sukai dengan mengklik tombol mulai belanja dibawah ini</p>
         <a href="<?= base_url(); ?>produk/kategori" class="btn btn-solid w-100">mulai belanja</a>
      </div>
   </section>
<?php } ?>

<!-- panel space start -->
<section class="panel-space"></section>
<!-- panel space end -->

<!-- bottom panel start -->
<div class="cart-bottom">
   <div>
      <div class="left-content">
         <h4><span>Total Harga:</span> </h4>
         <a class="font-15 theme-color">Rp. <?= number_format($cart_count->row_array()['total_harga'], 0, ".", "."); ?></a>
      </div>
      <a href="<?= base_url(); ?>transaksi/checkout_delivery" class="btn btn-solid">Checkout</a>
   </div>
</div>
<!-- bottom panel end -->