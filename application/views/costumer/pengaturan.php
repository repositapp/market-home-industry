<!-- Biodata Toko start -->
<div id="costumer" class="map-product-section px-15">
   <div class="product-inline">
      <a class="cart-img">
         <img src="<?= base_url(); ?>assets/upload/<?= $user['foto_costumer']; ?>" class="img-circle" alt="">
      </a>
      <div class="cart-content">
         <a>
            <h4 class="font-16"><?= $user['nm_costumer']; ?></h4>
         </a>
         <h5 class="content-color"><i class="iconly-Message icli"></i> <?= $user['email_costumer']; ?></h5>
         <div class="price">
            <h4 class="font-12">Terdaftar Sejak <?= date('d M, Y | H:i', strtotime($user['change_user'])); ?> Wita</h4>
         </div>
      </div>
   </div>
</div>
<!-- Biodata Toko End -->

<!-- service section start -->
<section class="service-wrapper px-15">
   <div id="order" class="title-part">
      <i class="iconly-Document icli"></i>
      <h2 class="pl-2">Pesanan Saya</h2>
      <a href="<?= base_url(); ?>transaksi/order/4">Riwayat Pesanan</a>
   </div>
   <div class="row">
      <div class="col-3">
         <a href="<?= base_url(); ?>transaksi/order/0">
            <div class="service-wrap">
               <div class="icon-box">
                  <span id="order-info-1"><?= $ordered->num_rows(); ?></span>
                  <img src="<?= base_url(); ?>assets/mobile/svg/payment.svg" class="img-fluid order-img-icon" alt="">
               </div>
               <span>Belum Bayar</span>
            </div>
         </a>
      </div>
      <div class="col-3">
         <a href="<?= base_url(); ?>transaksi/order/1">
            <div class="service-wrap">
               <div class="icon-box">
                  <span id="order-info-2"><?= $packing->num_rows(); ?></span>
                  <img src="<?= base_url(); ?>assets/mobile/svg/returning.svg" class="img-fluid" alt="">
               </div>
               <span>Dikemas</span>
            </div>
         </a>
      </div>
      <div class="col-3">
         <a href="<?= base_url(); ?>transaksi/order/2">
            <div class="service-wrap">
               <div class="icon-box">
                  <span id="order-info-3"><?= $trasit->num_rows(); ?></span>
                  <img src="<?= base_url(); ?>assets/mobile/svg/delivery.svg" class="img-fluid order-img-icon" alt="">
               </div>
               <span>Pengiriman</span>
            </div>
         </a>
      </div>
      <div class="col-3">
         <a href="<?= base_url(); ?>transaksi/order/3">
            <div class="service-wrap">
               <div class="icon-box">
                  <span id="order-info-4"><?= $success->num_rows(); ?></span>
                  <img src="<?= base_url(); ?>assets/mobile/svg/about/delivery.svg" class="img-fluid" alt="">
               </div>
               <span>Diterima</span>
            </div>
         </a>
      </div>
   </div>
</section>
<!-- service section end -->

<div class="sidebar-content">
   <ul class="link-section">
      <li class="top-border">
         <a href="<?= base_url(); ?>user/costumer_alamat/0">
            <i class="iconly-Location icli"></i>
            <div class="content">
               <h4>Alamat Pengiriman</h4>
               <h6>Rumah dan Kantor </h6>
            </div>
         </a>
      </li>
      <li>
         <a href="<?= base_url(); ?>user/costumer_profile">
            <i class="iconly-Profile icli"></i>
            <div class="content">
               <h4>Pengaturan Profil</h4>
               <h6>Nama, Nomor Telpon, Email..</h6>
            </div>
         </a>
      </li>
      <li>
         <a href="<?= base_url(); ?>user/costumer_akun">
            <i class="iconly-Password icli"></i>
            <div class="content">
               <h4>Pengaturan Akun</h4>
               <h6>Username, Password..</h6>
            </div>
         </a>
      </li>
   </ul>
   <div class="divider"></div>
   <ul class="link-section">
      <li>
         <a href="<?= base_url(); ?>settings/kebijakan_aplikasi">
            <i class="iconly-Info-Square icli"></i>
            <div class="content">
               <h4>Kebijakan</h4>
               <h6>Untuk Penggunaan Platform</h6>
            </div>
         </a>
      </li>
      <li>
         <a href="<?= base_url(); ?>settings/kontak_aplikasi">
            <i class="iconly-Call icli"></i>
            <div class="content">
               <h4>Kontak</h4>
               <h6>Dukungan Pelanggan</h6>
            </div>
         </a>
      </li>
      <li>
         <a href="<?= base_url(); ?>settings/about_aplikasi">
            <i class="iconly-Info-Square icli"></i>
            <div class="content">
               <h4>About</h4>
               <h6>Segalanya Tentang Platform</h6>
            </div>
         </a>
      </li>
   </ul>
</div>
<div class="px-15">
   <a href="<?= base_url(); ?>auth/logout_user" class="btn btn-outline w-100 content-color">LOG OUT</a>
</div>