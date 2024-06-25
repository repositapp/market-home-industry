<?php
if (empty($this->session->userdata('LOGGED_IN'))) {
   redirect('auth/login_user');
} else {
   if ($this->session->userdata('akses') != '3') {
      redirect('auth/logout_user');
   }
}
$website = $this->db->get('set_web')->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="<?= base_url(); ?>assets/upload/<?= $website['logo_web']; ?>" type="image/x-icon" />
   <title><?= $website['title_web']; ?> | <?= $title; ?></title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />

   <!--Google font-->
   <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

   <!-- bootstrap css -->
   <link rel="stylesheet" id="rtl-link" type="text/css" href="<?= base_url(); ?>assets/mobile/css/vendors/bootstrap.css">

   <!-- slick css -->
   <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/mobile/css/vendors/slick-theme.css">
   <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/mobile/css/vendors/slick.css">

   <!-- iconly css -->
   <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/mobile/css/vendors/iconly.css">

   <!-- Theme css -->
   <link rel="stylesheet" id="change-link" type="text/css" href="<?= base_url(); ?>assets/mobile/css/style.css">

   <!-- Toats -->
   <link href="<?= base_url(); ?>assets/desktop/lib/toast/jquery.toast.min.css" rel="stylesheet">
   <link rel="stylesheet" id="change-link" type="text/css" href="<?= base_url(); ?>assets/mobile/css/custom.css">

</head>

<body>

   <!-- loader strat -->
   <?php if ($sub_nums == 0 || $sub_nums == 3) { ?>
      <div class="loader">
         <span></span>
         <span></span>
      </div>
   <?php } ?>
   <!-- loader end -->