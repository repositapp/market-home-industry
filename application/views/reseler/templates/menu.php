<?php if ($sub_nums == 0 || $sub_nums == 3) { ?>
   <section class="panel-space"></section>
   <div class="bottom-panel">
      <ul>
         <li class="<?php if ($title == 'Beranda') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>home/reseler">
               <div class="icon">
                  <i class="iconly-Home icli"></i>
                  <i class="iconly-Home icbo"></i>
               </div>
               <span>Beranda</span>
            </a>
         </li>
         <li class="<?php if ($title == 'Riwayat Transaksi') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>transaksi/reseler_order_riwayat">
               <div class="icon">
                  <i class="iconly-Document icli"></i>
                  <i class="iconly-Document icbo"></i>
               </div>
               <span>Riwayat Order</span>
            </a>
         </li>
         <li class="<?php if ($title == 'Settings') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>settings/reseler_settings">
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