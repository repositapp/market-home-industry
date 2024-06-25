<?php
if ($this->session->userdata('LOGGED_IN')) {
   if ($this->session->userdata('akses') == '1') {
      redirect('home/admin');
   } else {
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

   <!-- Custom Css-->
   <link href="<?= base_url(); ?>assets/desktop/scss/style.css" rel="stylesheet">
   <link href="<?= base_url(); ?>assets/desktop/scss/login.css" rel="stylesheet">
</head>

<body>

   <div class="misc-wrapper">
      <div class="misc-content">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-sm-6 col-xl-4 ">
                  <div class="misc-box">
                     <div class="misc-header text-center">
                        <?= $title_header; ?>
                     </div>
                     <div id="responseDiv" class="alert alert-dismissible text-center" role="alert" style="display:none;">
                        <span id="message"></span>
                     </div>
                     <form id="logForm">
                        <fieldset>
                           <div class="form-group">
                              <label for="exampleuser1">Username</label>
                              <div class="group-icon">
                                 <input id="exampleuser1" name="username" type="text" placeholder="Username" class="form-control" value="<?= set_value('username'); ?>" autocomplete="off" autofocus>
                                 <span class="icon-user text-muted icon-input"></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="thresholdconfig">Password</label>
                              <div class="group-icon">
                                 <input id="thresholdconfig" name="password" type="password" placeholder="Password" class="form-control">
                                 <span class="icon-lock text-muted icon-input"></span>
                              </div>
                              <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                                 <input type="checkbox" onclick="Toggle()" id="show-hide" name="show-hide">
                                 <label for="show-hide"> Show Password </label>
                              </div>
                           </div>
                           <button id="submit" class="btn btn-block btn-primary btn-rounded box-shadow" type="submit"><span id="logText"></span></button>
                        </fieldset>
                     </form>
                     <div class="text-center mt-3">
                        <p>Copyright &copy; 2022 HINDES</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script type="text/javascript">
      function Toggle() {
         var temp = document.getElementById("thresholdconfig");
         if (temp.type === "password") {
            temp.type = "text";
         } else {
            temp.type = "password";
         }
      }

      let url = '<?= base_url(); ?>';
   </script>

   <!-- Common Plugins -->
   <script src="<?= base_url(); ?>assets/desktop/lib/jquery/dist/jquery.min.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/js/app/auth.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/lib/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/lib/pace/pace.min.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/lib/slimscroll/jquery.slimscroll.min.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/lib/metisMenu/metisMenu.min.js"></script>
   <script src="<?= base_url(); ?>assets/desktop/js/custom.js"></script>

</body>

</html>