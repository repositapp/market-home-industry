<?php if ($sub_nums == 0 || $sub_nums == 3) { ?>
   <section class="panel-space"></section>
   <div class="bottom-panel">
      <ul>
         <li class="<?php if ($title == 'Beranda') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>home/costumer">
               <div class="icon">
                  <i class="iconly-Home icli"></i>
                  <i class="iconly-Home icbo"></i>
               </div>
               <span>Beranda</span>
            </a>
         </li>
         <li class="<?php if ($title == 'Kategori') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>produk/kategori">
               <div class="icon">
                  <i class="iconly-Category icli"></i>
                  <i class="iconly-Category icbo"></i>
               </div>
               <span>Kategori</span>
            </a>
         </li>
         <li class="<?php if ($title == 'Market') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>user/market">
               <div class="icon">
                  <i class="iconly-Wallet icli"></i>
                  <i class="iconly-Wallet icbo"></i>
               </div>
               <span>Market</span>
            </a>
         </li>
         <li class="<?php if ($title == 'Settings') {
                        echo 'active';
                     } ?>">
            <a href="<?= base_url(); ?>settings/costumer_settings">
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