<form method="post" action="<?= base_url('transaksi/checkout_payment/' . $jasa->row_array()['id_ongkir_jasa']) ?>" enctype="multipart/form-data">
   <input type="hidden" name="tambah_data" value="tambah">
   <input type="hidden" name="invoice" value="<?= $ivc; ?>">
   <input type="hidden" name="alamat_costumer" value="<?= $alamat->row_array()['id_alamat']; ?>">
   <input type="hidden" name="jasa_pengiriman" value="<?= $jasa->row_array()['id_ongkir_jasa']; ?>">

   <!-- payment method start -->
   <section class="px-15 payment-method-section top-space pt-2">
      <h2 class="page-title">Metode Pembayaran</h2>
      <div class="accordion" id="accordionExample">
         <?php if ($this->uri->segment(3) == 1) { ?>
            <div class="card">
               <div class="card-header" id="h_one">
                  <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#one">
                     <label for='r_one'>
                        <img src="<?= base_url(); ?>assets/mobile/images/payment/1.png" class="img-fluid" alt="">Cash On Delivery
                        <input type='radio' class="radio_animated" checked id='r_one' name='jenis_pembayaran' value='1' />
                     </label>
                  </div>
               </div>
               <div id="one" class="collapse show" aria-labelledby="h_one" data-bs-parent="#accordionExample">
                  <div class="card-body text-justify">
                     Pembayaran di lakukan setelah anda menerima pesanan yang diantarkan oleh kurir. Kurir akan menagih pembayaran sebanyak total pembayaran anda yang tertera di aplikasi.
                  </div>
               </div>
            </div>
         <?php } ?>
         <div class="card">
            <div class="card-header" id="h_two">
               <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#two">
                  <label for='r_two'>
                     <img src="<?= base_url(); ?>assets/mobile/images/payment/2.png" class="img-fluid" alt="">Transfer Bank
                     <input type='radio' class="radio_animated" id='r_two' name='jenis_pembayaran' value='2' />
                  </label>
               </div>
            </div>
            <div id="two" class="collapse" aria-labelledby="h_two" data-bs-parent="#accordionExample">
               <div class="card-body">
                  <?php foreach ($data_bank->result_array() as $bank) : ?>
                     <div class="d-flex align-items-center mb-2">
                        <input class="radio_animated" type="radio" name="bank_transfer" id="Radios<?= $bank['id_bank']; ?>" value="<?= $bank['id_bank']; ?>">
                        <label for="Radios<?= $bank['id_bank']; ?>" class="content-color"><?= $bank['nm_bank']; ?> (<?= $bank['no_rekening']; ?>).</label>
                     </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
   </section>
   <div class="divider"></div>
   <!-- payment method end -->

   <!-- order details start -->
   <section class="px-15 pt-0">
      <h2 class="title">Detail Pembayaran:</h2>
      <div class="order-details">
         <ul>
            <li>
               <h4>Total Pesanan <span><?= $jumlah->num_rows(); ?> Item</span></h4>
            </li>
            <li>
               <h4>Berat Beban <span class="theme-color"><?= $berat_beban->row_array()['total_berat'] / 1000; ?> kg</span></h4>
            </li>
            <li>
               <h4>Subtotal untuk Produk <span>Rp. <?= number_format($cart_count->row_array()['total_harga'], 0, ".", "."); ?></span></h4>
            </li>
            <li>
               <h4>Subtotal Pengiriman <span class="text-success">Rp. <?= number_format(($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']), 0, ".", "."); ?></span></h4>
            </li>
            <li>
               <h4>PPn <span class="theme-color"><?= $biaya_jp['pajak_jasa']; ?>%</span></h4>
            </li>
         </ul>
         <div class="total-amount">
            <h4>Total Pembayaran <span>Rp. <?= number_format(($cart_count->row_array()['total_harga'] + (($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']))) + (($cart_count->row_array()['total_harga'] + (($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']))) * ($biaya_jp['pajak_jasa'] / 100)), 0, ".", "."); ?></span></h4>

            <?php foreach ($data_keranjang->result_array() as $keranjang) : ?>
               <input type="hidden" name="kode_produk[]" value="<?= $keranjang['kode_produk']; ?>">
               <input type="hidden" name="jumlah_beli[]" value="<?= $keranjang['qty']; ?>">
               <input type="hidden" name="nm_barang[]" value="<?= $keranjang['nm_produk']; ?>">
               <input type="hidden" name="harga_barang[]" value="<?= $keranjang['harga_produk']; ?>">
               <input type="hidden" name="reseler[]" value="<?= $keranjang['reseler']; ?>">
               <input type="hidden" name="variasi_produk[]" value="<?= $keranjang['variasi_produk']; ?>">
            <?php endforeach; ?>

            <input type="hidden" name="total_transaksi" value="<?= ($cart_count->row_array()['total_harga'] + (($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']))) + (($cart_count->row_array()['total_harga'] + (($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']))) * ($biaya_jp['pajak_jasa'] / 100)); ?>">
            <input type="hidden" name="total_pengiriman" value="<?= ($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']); ?>">
            <input type="hidden" name="total_beban" value="<?= $berat_beban->row_array()['total_berat']; ?>">
         </div>
      </div>
   </section>
   <!-- order details end -->

   <!-- panel space start -->
   <section class="panel-space"></section>
   <!-- panel space end -->

   <!-- bottom panel start -->
   <div class="cart-bottom">
      <div>
         <div class="left-content">
            <h4><span>Total Pembayaran:</span> </h4>
            <a class="font-15 theme-color">Rp. <?= number_format(($cart_count->row_array()['total_harga'] + (($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']))) + (($cart_count->row_array()['total_harga'] + (($biaya_pengiriman + $jasa->row_array()['harga_perkilo']) + (($berat_beban->row_array()['total_berat'] / 1000) * $jasa->row_array()['harga_perkilo']))) * ($biaya_jp['pajak_jasa'] / 100)), 0, ".", "."); ?></a>
         </div>
         <button type="submit" class="btn btn-solid">Buat Pesanan</button>
      </div>
   </div>
   <!-- bottom panel end -->
</form>