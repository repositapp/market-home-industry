<!-- Detail Produk start -->
<div class="toastr1"></div>
<form id="produkAddForm">
   <fieldset style="padding-bottom: 0px;">
      <input type="hidden" name="tambah_data" value="tambah">
      <input type="hidden" name="kode_produk" value="<?= $produk['kode_produk']; ?>">

      <section class="product-page-section top-space pt-0">
         <div class="home-slider slick-default theme-dots ratio_asos overflow-hidden">
            <?php foreach ($data_gambar->result_array() as $gambar) :
               $exp = explode(".", $gambar['gambar_produk']); ?>
               <div>
                  <div class="home-img">
                     <?php if ($exp[1] == 'mp4' || $exp[1] == 'avi' || $exp[1] == 'mkv' || $exp[1] == '3gp' || $exp[1] == 'mgp' || $exp[1] == 'mpeg') { ?>
                        <video controls playsinline style="width: 340px !important;">
                           <source src="<?= base_url(); ?>assets/upload/<?= $gambar['gambar_produk']; ?>">
                        </video>
                     <?php } else { ?>
                        <img src="<?= base_url(); ?>assets/upload/<?= $gambar['gambar_produk']; ?>" alt="" class="img-fluid bg-img">
                     <?php } ?>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
         <div class="product-detail-box px-15 pt-2">
            <div class="main-detail">
               <h2 id="product" class="text-capitalize"><?= $produk['nm_produk']; ?></h2>
               <div class="price">
                  <?php if ($diskon->num_rows() > 0) { ?>
                     <h4><?= $produk['nm_kategori_produk']; ?> <span>Rp. <?= number_format(($produk['harga_produk'] - (($diskon->row_array()['jumlah_diskon'] / 100) * $produk['harga_produk'])) + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></span></h4>
                     <h4 class="diskon"><del>Rp. <?= number_format($produk['harga_produk'] + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></del> <span>(Diskon <?= $diskon->row_array()['jumlah_diskon']; ?>%)</span></h4>

                     <input type="hidden" id="harga_produk" name="harga_produk" value="<?= ($produk['harga_produk'] - (($diskon->row_array()['jumlah_diskon'] / 100) * $produk['harga_produk'])) + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)); ?>">
                  <?php } elseif ($diskon->num_rows() == 0) { ?>
                     <h4><?= $produk['nm_kategori_produk']; ?> <span>Rp. <?= number_format($produk['harga_produk'] + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)), 0, ".", "."); ?></span></h4>

                     <input type="hidden" id="harga_produk" name="harga_produk" value="<?= $produk['harga_produk'] + ($produk['harga_produk'] * ($biaya_jp['persen_jasa'] / 100)); ?>">
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="divider"></div>

         <!-- Rincian Produk start -->
         <div class="product-detail-box px-15">
            <h4 class="page-title">Rincian Produk</h4>
            <table>
               <tr>
                  <th width="140">Stok</th>
                  <td class="content-color"><?= $produk['stok']; ?> <?= $produk['satuan_jual']; ?></td>
               </tr>
               <tr>
                  <th>Satuan Jual</th>
                  <td class="content-color"><?= $produk['ukuran_jual']; ?>/<?= $produk['satuan_jual']; ?></td>
               </tr>
               <tr>
                  <th>Berat Produk</th>
                  <td class="content-color"><?= $produk['berat']; ?>g</td>
               </tr>
               <?php foreach ($data_atribut->result_array() as $atribut_produk) : ?>
                  <tr>
                     <th><?= $atribut_produk['judul_taribut']; ?></th>
                     <td class="content-color"><?= $atribut_produk['isian_atribut']; ?></td>
                  </tr>
               <?php endforeach; ?>
            </table>

            <h4 class="mb-1">Deskripsi Produk</h4>
            <h5 class="content-color"><?= $produk['deskripsi_produk']; ?></h5>
         </div>
         <div class="divider"></div>
         <!-- Rincian Produk end -->

         <!-- Toko Start -->
         <section class="deals-section px-15 pt-0">
            <div class="product-section">
               <div class="row gy-3">
                  <div class="col-12">
                     <div id="toko" class="product-inline">
                        <a href="#">
                           <img src="<?= base_url(); ?>assets/upload/<?= $produk['logo_toko']; ?>" class="img-circle" alt="">
                        </a>
                        <div class="product-inline-content">
                           <div>
                              <a href="#">
                                 <h4><?= $produk['nm_toko']; ?></h4>
                              </a>
                              <h5 class="ellipsis"><i class="iconly-Location icli"></i> <?= $produk['alamat_toko']; ?></h5>
                              <div class="price">
                                 <h4><?= $produk_toko->num_rows(); ?> Produk</h4>
                              </div>
                           </div>
                        </div>
                        <div class="wishlist-btn">
                           <a href="<?= base_url(); ?>user/detail_market/<?= $produk['id_user']; ?>" class="btn btn-outline">Kunjungi</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <div class="divider"></div>
         <!-- Toko End -->
      </section>
      <!-- Detail Produk end -->

      <!-- related section start -->
      <section class="pt-0 product-slider-section overflow-hidden">
         <div class="title-part px-15">
            <h2 class="page-title">
               Produk Serupa
               <a href="<?= base_url(); ?>produk/detail_kategori/<?= $produk['kategori_produk']; ?>">Lihat Semua</a>
            </h2>
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

      <!-- panel space start -->
      <section class="panel-space"></section>
      <!-- panel space end -->

      <!-- fixed panel start -->
      <div class="fixed-panel">
         <div class="row">
            <div class="col-12">
               <a href="javascript:void(0)" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#addCart"><i class="iconly-Buy icli"></i>TAMBAH KE KERANJANG</a>
            </div>
         </div>
      </div>
      <!-- fixed panel end -->

      <!-- select qty offcanvas start -->

      <div class="offcanvas offcanvas-bottom h-auto qty-canvas" id="addCart">
         <div class="offcanvas-body small">
            <?php if ($data_variasi->num_rows() > 0) { ?>
               <h4>Varian Produk:</h4>
               <div class="mb-2 mt-2">
                  <div class="row">
                     <div class="radio-select">
                        <?php $no = 1;
                        foreach ($data_variasi->result_array() as $variasi) : ?>
                           <input class="checkbox-tools" type="radio" id="variasi_produk<?= $no; ?>" name="variasi_produk" value="<?= $variasi['id_produk_variasi']; ?>" <?= $variasi['stok_variasi'] == 0 ? "disabled" : "" ?>>
                           <label class="for-checkbox-tools" for="variasi_produk<?= $no; ?>">
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
               </div>
            <?php } else { ?>
               <input type="hidden" name="variasi_produk" value="none">
            <?php } ?>
            <h4>Pilih Jumlah:</h4>
            <div class="qty-counter">
               <div class="input-group">
                  <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                     <img src="<?= base_url(); ?>assets/mobile/svg/minus-square.svg" class="img-fluid" alt="">
                  </button>
                  <input type="text" name="quantity" class="form-control form-theme qty-input input-number" value="1">
                  <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                     <img src="<?= base_url(); ?>assets/mobile/svg/plus-square.svg" class="img-fluid" alt="">
                  </button>
               </div>
            </div>
            <button type="submit" class="btn btn-solid w-100">TAMBAH KE KERANJANG</button>
         </div>
      </div>
   </fieldset>
</form>
<!-- select qty offcanvas end -->