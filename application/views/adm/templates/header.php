<?php
if (empty($this->session->userdata('LOGGED_IN'))) {
   redirect('auth/login_admin');
} else {
   if ($this->session->userdata('akses') != '1') {
      redirect('error');
   }
}
$website = $this->db->get('set_web')->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?= $website['title_web']; ?> | <?= $title; ?></title>
   <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/upload/<?= $website['logo_web']; ?>">

   <!-- Common Plugins -->
   <link href="<?= base_url(); ?>assets/desktop/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   <!-- DataTables -->
   <link href="<?= base_url(); ?>assets/desktop/lib/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
   <link href="<?= base_url(); ?>assets/desktop/lib/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="<?= base_url(); ?>assets/desktop/lib/toast/jquery.toast.min.css" rel="stylesheet">

   <!-- DataTimePicker -->
   <link href="<?= base_url(); ?>assets/desktop/lib/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

   <!-- Custom Css-->
   <link href="<?= base_url(); ?>assets/desktop/scss/style.css" rel="stylesheet">
   <link href="<?= base_url(); ?>assets/desktop/scss/custom.css" rel="stylesheet">

   <!-- Summernote -->
   <link href="<?= base_url(); ?>assets/desktop/lib/summernote/summernote.css" rel="stylesheet">
</head>

<body>