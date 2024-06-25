<?php if ($sub_nums == 0 || $sub_nums == 3) { ?>
   <section class="panel-space"></section>
   <div class="bottom-panel">
      <ul>
         <li class="<?php if ($title == 'Beranda') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>home/kurir">
               <div class="icon">
                  <i class="iconly-Home icli"></i>
                  <i class="iconly-Home icbo"></i>
               </div>
               <span>Beranda</span>
            </a>
         </li>
         <li class="<?php if ($title == 'Riwayat Pengiriman') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>transaksi/delivery_history">
               <div class="icon">
                  <i class="iconly-Document icli"></i>
                  <i class="iconly-Document icbo"></i>
               </div>
               <span>Riwayat Pengiriman</span>
            </a>
         </li>
         <li class="<?php if ($title == 'Settings') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>settings/kurir_settings">
               <div class="icon">
                  <i class="iconly-Setting icli"></i>
                  <i class="iconly-Setting icbo"></i>
               </div>
               <span>Settings</span>
            </a>
         </li>
      </ul>
   </div>
<?php } ?>