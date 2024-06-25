<div class="header-sidebar">
   <a href="<?= base_url(); ?>user/kurir_profile" class="user-panel">
      <img src="<?= base_url(); ?>assets/upload/<?= $user['foto_kurir']; ?>" class="img-fluid user-img" alt="">
      <span>Hello, <?= $user['nm_kurir']; ?></span>
      <i class="iconly-Arrow-Right-2 icli"></i>
   </a>
   <div class="sidebar-content">
      <ul class="link-section">
         <li>
            <a href="<?= base_url(); ?>home/kurir">
               <i class="iconly-Home icli"></i>
               <div class="content">
                  <h4>Beranda</h4>
                  <h6>Orderan siap diantarkan</h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>transaksi/delivery_history">
               <i class="iconly-Document icli"></i>
               <div class="content">
                  <h4>Riwayat Pengiriman</h4>
                  <h6>Orderan telah selesai diantarkan </h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>settings/kurir_settings">
               <i class="iconly-Setting icli"></i>
               <div class="content">
                  <h4>Settings</h4>
                  <h6>Atur akun, Profil, Kebijakan</h6>
               </div>
            </a>
         </li>
      </ul>
      <div class="divider"></div>
      <ul class="link-section">
         <li>
            <a href="<?= base_url(); ?>user/kurir_profile">
               <i class="iconly-Profile icli"></i>
               <div class="content">
                  <h4>Pengaturan Profil</h4>
                  <h6>Nama, Nomor Telpon, Email</h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>user/kurir_akun">
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