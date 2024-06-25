<div class="header-sidebar">
   <a href="<?= base_url(); ?>user/reseler_profile" class="user-panel">
      <img src="<?= base_url(); ?>assets/upload/<?= $user['foto_reseler']; ?>" class="img-fluid user-img" alt="">
      <span>Hello, <?= $user['nm_reseler']; ?></span>
      <i class="iconly-Arrow-Right-2 icli"></i>
   </a>
   <div class="sidebar-content">
      <ul class="link-section">
         <li>
            <a href="<?= base_url(); ?>home/reseler">
               <i class="iconly-Home icli"></i>
               <div class="content">
                  <h4>Beranda</h4>
                  <h6>Produk dan Orderan Baru</h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>transaksi/reseler_order_riwayat">
               <i class="iconly-Document icli"></i>
               <div class="content">
                  <h4>Riwayat Order</h4>
                  <h6>Transaksi yang pernah dilakukan </h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>settings/reseler_settings">
               <i class="iconly-Setting icli"></i>
               <div class="content">
                  <h4>Settings</h4>
                  <h6>Atur akun, Profil</h6>
               </div>
            </a>
         </li>
      </ul>
      <div class="divider"></div>
      <ul class="link-section">
         <li>
            <a href="<?= base_url(); ?>user/reseler_profile">
               <i class="iconly-Profile icli"></i>
               <div class="content">
                  <h4>Pengaturan Profil</h4>
                  <h6>Nama, Nomor Telpon, Email</h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>user/reseler_profile">
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
                  <h6>Username, Password</h6>
               </div>
            </a>
         </li>
      </ul>
      <div class="mt-4 px-15">
         <a href="<?= base_url(); ?>auth/logout_user" class="btn btn-solid w-100">LOG OUT</a>
      </div>
   </div>
</div>