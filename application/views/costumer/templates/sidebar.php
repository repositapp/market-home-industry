<div class="header-sidebar">
   <a href="<?= base_url(); ?>user/costumer_profile" class="user-panel">
      <img src="<?= base_url(); ?>assets/upload/<?= $user['foto_costumer']; ?>" class="img-fluid user-img" alt="">
      <span>Hello, <?= $user['nm_costumer']; ?></span>
      <i class="iconly-Arrow-Right-2 icli"></i>
   </a>
   <div class="sidebar-content">
      <ul class="link-section">
         <li>
            <a href="<?= base_url(); ?>home/costumer">
               <i class="iconly-Home icli"></i>
               <div class="content">
                  <h4>Beranda</h4>
                  <h6>Informasi, Prodak, Penawaran</h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>produk/kategori">
               <i class="iconly-Category icli"></i>
               <div class="content">
                  <h4>Belanja Berdasarkan Kategori</h4>
                  <h6>Lihat kategori kesukaanmu </h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>user/market">
               <i class="iconly-Wallet icli"></i>
               <div class="content">
                  <h4>Belanja Berdasarkan Lapak</h4>
                  <h6>Pilih lapak yang diinginkan </h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>produk/keranjang">
               <i class="iconly-Buy icli"></i>
               <div class="content">
                  <h4>Keranjang</h4>
                  <h6>Checkout sekarang</h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>transaksi/order/0">
               <i class="iconly-Document icli"></i>
               <div class="content">
                  <h4>Pesanan</h4>
                  <h6>Produk yang telah dipesan</h6>
               </div>
            </a>
         </li>
         <li>
            <a href="<?= base_url(); ?>settings/costumer_settings/0">
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
            <a href="<?= base_url(); ?>settings/about_aplikasi">
               <i class="iconly-Info-Square icli"></i>
               <div class="content">
                  <h4>About Us</h4>
                  <h6>Apa itu SMART UMKM?</h6>
               </div>
            </a>
         </li>
      </ul>
      <div class="mt-4 px-15">
         <a href="<?= base_url(); ?>auth/logout_user" class="btn btn-solid w-100">LOG OUT</a>
      </div>
   </div>
</div>