<div class="row justify-content-between page-header">
   <div class="col-lg-4 align-self-center">
      <h2><?= $title; ?></h2>
   </div>
   <div class="col-lg-8 align-self-end text-right">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url(); ?>home/admin"><i class="icon-home" data-toggle="tooltip" data-original-title="Dashboard"></i></a></li>
         <?php if ($menu == "None") { ?>
         <?php } else { ?>
            <?php if ($sub_nums == "0") { ?>
               <li class="breadcrumb-item active"><a href="<?= base_url(); ?><?= $menu_link; ?>"><?= $menu; ?></a></li>
            <?php } elseif ($sub_nums == "1") { ?>
               <?php if ($menu_link == 'javascript:window.history.go(-1);') { ?>
                  <li class="breadcrumb-item"><a href="<?= $menu_link; ?>"><?= $menu; ?></a></li>
               <?php } else { ?>
                  <li class="breadcrumb-item"><a href="<?= base_url(); ?><?= $menu_link; ?>"><?= $menu; ?></a></li>
               <?php } ?>
               <li class="breadcrumb-item active"><?= $sub_menu; ?></li>
            <?php } ?>
         <?php } ?>
      </ol>
   </div>
</div>

<section class="main-content">