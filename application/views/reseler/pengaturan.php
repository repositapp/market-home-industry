<!-- Biodata Toko start -->
<div id="costumer" class="map-product-section px-15">
   <div class="product-inline">
      <a class="cart-img">
         <img src="<?= base_url(); ?>assets/upload/<?= $user['foto_reseler']; ?>" class="img-circle" alt="">
      </a>
      <div class="cart-content">
         <a>
            <h4 class="font-16"><?= $user['nm_reseler']; ?></h4>
         </a>
         <h5 class="content-color"><i class="iconly-Call icli"></i> <?= $user['telp_reseler']; ?></h5>
         <div class="price">
            <h4 class="font-12">Terdaftar Sejak <?= date('d M, Y | H:i', strtotime($user['change_user'])); ?> Wita</h4>
         </div>
      </div>
   </div>
</div>
<!-- Biodata Toko End -->

<div class="sidebar-content">
   <ul class="link-section">
      <li>
         <a href="<?= base_url(); ?>user/reseler_profile">
            <i class="iconly-Profile icli"></i>
            <div class="content">
               <h4>Pengaturan Profil</h4>
               <h6>Nama, Nomor Telpon, Email..</h6>
            </div>
         </a>
      </li>
      <li>
         <a href="<?= base_url(); ?>user/reseler_profile_toko">
            <i class="iconly-Wallet icli"></i>
            <div class="content">
               <h4>Pengaturan Toko</h4>
               <h6>Nama Toko, Kontak, Berkas..</h6>
            </div>
         </a>
      </li>
      <li>
         <a href="<?= base_url(); ?>user/reseler_akun">
            <i class="iconly-Password icli"></i>
            <div class="content">
               <h4>Pengaturan Akun</h4>
               <h6>Username, Password..</h6>
            </div>
         </a>
      </li>
   </ul>
</div>
<div class="px-15">
   <a href="<?= base_url(); ?>auth/logout_user" class="btn btn-outline w-100 content-color">LOG OUT</a>
</div>