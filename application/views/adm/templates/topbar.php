<?php
$website = $this->db->get('set_web')->row_array();
?>
<div class="top-bar primary-top-bar">
   <div class="container-fluid">
      <div class="row">
         <div class="col">
            <a class="admin-logo" href="index-2.html">
               <h1>
                  <img alt="" src="<?= base_url(); ?>assets/upload/<?= $website['logo_web']; ?>" class="logo-icon margin-r-10" width="40">
                  <span class="toggle-none"><?= $website['sidebar_title']; ?></span>
               </h1>
            </a>
            <div class="left-nav-toggle">
               <a href="#" class="nav-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <div class="left-nav-collapsed">
               <a href="#" class="nav-collapsed"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="list-inline top-right-nav">
               <li class="dropdown avtar-dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <img alt="" class="rounded-circle" src="<?= base_url(); ?>assets/upload/<?= $user['foto_admin']; ?>" width="40" height="37">
                     <?= $user['nm_admin']; ?>
                  </a>
                  <ul class="dropdown-menu top-dropdown">
                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>settings/admin_profile"><i class="icon-user"></i> Profile</a>
                     </li>
                     <li class="dropdown-divider"></li>
                     <li>
                        <a class="dropdown-item" href="<?= base_url(); ?>auth/logout_admin"><i class="icon-logout"></i> Logout</a>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>