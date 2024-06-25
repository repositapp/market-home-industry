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
               <h4><?= $produk['nm_kategori_produk']; ?> <span>Rp. <?= number_format($produk['harga_produk'] - (($diskon->row_array()['jumlah_diskon'] / 100) * $produk['harga_produk']), 0, ".", "."); ?></span></h4>
               <h4 class="diskon"><del>Rp. <?= number_format($produk['harga_produk'], 0, ".", "."); ?></del> <span>(Diskon <?= $diskon->row_array()['jumlah_diskon']; ?>%)</span></h4>
            <?php } elseif ($diskon->num_rows() == 0) { ?>
               <h4><?= $produk['nm_kategori_produk']; ?> <span>Rp. <?= number_format($produk['harga_produk'], 0, ".", "."); ?></span></h4>
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
            <td class="content-color"><?= $produk['stok']; ?> Produk</td>
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
   <!-- Rincian Produk end -->
</section>
<!-- Detail Produk end -->

<!-- panel space start -->
<section class="panel-space"></section>
<!-- panel space end -->

<!-- fixed panel start -->
<div class="fixed-panel">
   <div class="row">
      <div class="col-12">
         <a href="javascript:void(0)" class="theme-color">UBAH DATA PRODUK</a>
      </div>
   </div>
</div>
<!-- fixed panel end -->