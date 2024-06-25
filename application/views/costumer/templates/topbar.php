<?php
$website = $this->db->get('set_web')->row_array();
?>
<?php if ($sub_nums == 0) { ?>
   <header>
      <a href="<?= base_url(); ?>home/costumer" class="brand-logo">
         <!-- <img src="<?= base_url(); ?>assets/upload/<?= $website['logo_web']; ?>" class="img-fluid" alt=""> -->
         <span><?= $website['title_web']; ?></span>
      </a>
      <div class="header-option">
         <ul>
            <li>
               <a href="<?= base_url(); ?>produk/keranjang"><i class="iconly-Buy icli"></i> <span id="cart_info" class="cart-info"></span></a>
            </li>
            <li>
               <a href="<?= base_url(); ?>user/costumer_profile"><i class=" iconly-Profile icli"></i></a>
            </li>
            <li>
               <div class="nav-bar">
                  <img src="<?= base_url(); ?>assets/mobile/svg/bar.svg" class="img-fluid" alt="">
               </div>
            </li>
         </ul>
      </div>
   </header>
   <a href="javascript:void(0)" class="overlay-sidebar"></a>
<?php } elseif ($sub_nums == 1) { ?>
   <header>
      <div class="back-links">
         <a href="<?= $menu_link ?>">
            <?php if ($sub_menu != 'Checkout Success') { ?>
               <i class="iconly-Arrow-Left icli"></i>
            <?php } ?>
            <div class="content">
               <h2><?= $sub_menu; ?> </h2>
               <?php if (isset($sum_data)) { ?>
                  <h6><?= $sum_data; ?></h6>
               <?php } ?>
            </div>
         </a>
      </div>
      <div class="header-option">
         <ul>
            <?php if (!isset($cart)) { ?>
               <li>
                  <a href="<?= base_url(); ?>produk/keranjang"><i class="iconly-Buy icli"></i><span id="cart_info" class="cart-info"></span></a>
               </li>
            <?php } ?>
            <li>
               <a href="<?= base_url(); ?>user/costumer_profile"><i class=" iconly-Profile icli"></i></a>
            </li>
            <li>
               <div class="nav-bar">
                  <img src="<?= base_url(); ?>assets/mobile/svg/bar.svg" class="img-fluid" alt="">
               </div>
            </li>
         </ul>
      </div>
   </header>
   <a href="javascript:void(0)" class="overlay-sidebar"></a>
<?php } elseif ($sub_nums == 2) { ?>
   <header class="bg-transparent">
      <div class="back-links">
         <a href="<?= $menu_link ?>">
            <i class="iconly-Arrow-Left icli"></i>
            <div class="content">
               <h2><?= $sub_menu; ?> </h2>
               <?php if (isset($sum_data)) { ?>
                  <h6><?= $sum_data; ?></h6>
               <?php } ?>
            </div>
         </a>
      </div>
      <div class="header-option">
         <ul>
            <li>
               <a href="<?= base_url(); ?>produk/keranjang"><i class="iconly-Buy icli"></i><span id="cart_info" class="cart-info"></span></a>
            </li>
            <li>
               <a href="<?= base_url(); ?>user/costumer_profile"><i class=" iconly-Profile icli"></i></a>
            </li>
            <li>
               <div class="nav-bar">
                  <img src="<?= base_url(); ?>assets/mobile/svg/bar.svg" class="img-fluid" alt="">
               </div>
            </li>
         </ul>
      </div>
   </header>
   <a href="javascript:void(0)" class="overlay-sidebar"></a>
<?php } elseif ($sub_nums == 3) { ?>
   <header class="bg-transparent">
      <a href="<?= base_url(); ?>home/costumer" class="brand-logo">
         <!-- <img src="<?= base_url(); ?>assets/upload/<?= $website['logo_web']; ?>" class="img-fluid" alt=""> -->
         <span><?= $website['title_web']; ?></span>
      </a>
      <div class="header-option">
         <ul>
            <li>
               <a href="<?= base_url(); ?>produk/keranjang"><i class="iconly-Buy icli"></i> <span id="cart_info" class="cart-info"></span></a>
            </li>
            <li>
               <a href="<?= base_url(); ?>user/costumer_profile"><i class=" iconly-Profile icli"></i></a>
            </li>
            <li>
               <div class="nav-bar">
                  <img src="<?= base_url(); ?>assets/mobile/svg/bar.svg" class="img-fluid" alt="">
               </div>
            </li>
         </ul>
      </div>
   </header>
   <a href="javascript:void(0)" class="overlay-sidebar"></a>
<?php } ?>