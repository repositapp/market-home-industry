<div class="main-sidebar-nav default-navigation">
   <div class="nano">
      <div class="nano-content sidebar-nav">

         <div class="card-body border-bottom text-center nav-profile">
            <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
            <img alt="profile" class="margin-b-10" src="<?= base_url(); ?>assets/upload/<?= $user['foto_admin']; ?>" width="80">
            <p class="lead margin-b-0 toggle-none"><?= $user['nm_admin']; ?></p>
            <p class="text-muted mv-0 toggle-none">Welcome</p>
         </div>

         <ul class="metisMenu nav flex-column" id="menu">
            <li class="nav-heading"><span>MAIN</span></li>
            <li class="nav-item <?php if ($title == "Dashboard") {
                                    echo "active";
                                 } ?>"><a class="nav-link" href="<?= base_url(); ?>home/admin"><i class="fa fa-home"></i> <span class="toggle-none">Dashboard </span></a></li>

            <li class="nav-item <?php if ($title == 'Master Data') {
                                    echo 'active';
                                 } ?>">
               <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-cubes"></i> <span class="toggle-none">Master Data <span class="fa arrow"></span></span></a>
               <ul class="nav-second-level nav flex-column " aria-expanded="false">
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>produk/kategori_produk">Kategori Produk</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>produk/data_produk">Data Produk</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>transaksi/data_rekening">Data Rekening</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>ongkir/ongkir_wilayah">Ongkir Wilayah</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>ongkir/ongkir_jasa">Ongkir Jasa</a></li>
               </ul>
            </li>

            <li class="nav-item <?php if ($title == 'Transaksi') {
                                    echo 'active';
                                 } ?>">
               <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-random"></i> <span class="toggle-none">Transaksi <span class="fa arrow"></span></span></a>
               <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>transaksi/transaksi_baru">Pesanan Baru</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>transaksi/transaksi_packing">Pesanan Packing</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>transaksi/transaksi_pengiriman">Pesanan Pengiriman</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>transaksi/transaksi_take_order">Pesanan Diterima</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>transaksi/transaksi_batal">Pesanan Batal</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>transaksi/riwayat_transaksi">Riwayat Transaksi</a></li>
               </ul>
            </li>

            <li class="nav-item <?php if ($title == 'User') {
                                    echo 'active';
                                 } ?>">
               <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-users"></i> <span class="toggle-none">User Management <span class="fa arrow"></span></span></a>
               <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>user/data_admin">Admin</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>user/data_costumer">Costumer</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>user/data_reseler">Reseler</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>user/data_kurir">Kurir</a></li>
               </ul>
            </li>

            <li class="nav-item <?php if ($title == "Laporan") {
                                    echo "active";
                                 } ?>"><a class="nav-link" href="<?= base_url(); ?>laporan"><i class="fa fa-print"></i> <span class="toggle-none">Laporan </span></a></li>

            <li class="nav-heading"><span>MORE</span></li>

            <li class="nav-item <?php if ($title == 'Settings') {
                                    echo 'active';
                                 } ?>">
               <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-cogs"></i> <span class="toggle-none">Settings <span class="fa arrow"></span></span></a>
               <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>user/admin_profile">Profil Admin</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>settings/apk_profile">Profil Aplikasi</a></li>
                  <li class="nav-item <?php if ($menu == 'Wilayah') {
                                          echo 'active';
                                       } ?>">
                     <a class="nav-link" href="javascript: void(0);" aria-expanded="false">Wilayah <span class="fa arrow"></span></a>
                     <ul class="nav-third-level nav flex-column sub-menu" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>wilayah/kota">Kota</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>wilayah/kecamatan">Kecamatan</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>wilayah/kelurahan">Kelurahan</a></li>
                     </ul>
                  </li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>settings/kebijakan">Kebijakan</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>settings/slider">Slider</a></li>
               </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>auth/logout_admin"><i class="fa fa-sign-out"></i> <span class="toggle-none">Logout </span></a></li>
         </ul>
      </div>
   </div>
</div>