<?php
if ($this->session->userdata('LOGGED_IN')) {
   if ($this->session->userdata('akses') == '4') {
      redirect('home/kurir');
   } elseif ($this->session->userdata('akses') == '3') {
      redirect('home/costumer');
   } elseif ($this->session->userdata('akses') == '2') {
      redirect('home/reseler');
   } else {
      redirect('auth/logout_user');
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

<body class="register">

   <div class="misc-wrapper register">
      <div class="misc-content">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-sm-6 col-xl-4 ">
                  <div class="misc-box">
                     <div class="misc-header text-center">
                        <?= $title_header; ?>
                     </div>
                     <!-- <div id="responseDiv" class="alert alert-dismissible text-center" role="alert" style="display:none;">
                        <span id="message"></span>
                     </div> -->
                     <form id="regForm">
                        <fieldset style="padding-bottom: 0px;">
                           <div class="form-group">
                              <label for="eampleuser1">Nama</label>
                              <div class="group-icon">
                                 <input id="eampleuser1" name="nama" type="text" placeholder="Nama Lengkap" class="form-control" autocomplete="off" required autofocus>
                                 <span class="icon-user text-muted icon-input"></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="eampleuser1">Jenis Kelamin</label>
                              <select name="jk" class="form-control m-b" required>
                                 <option selected="selected" disabled>-Pilih Jenis Kelamin-</option>
                                 <option>Laki-Laki</option>
                                 <option>Perempuan</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="eampleuser1">Nomor Telepon</label>
                              <div class="group-icon">
                                 <input id="eampleuser1" name="telepon" type="number" placeholder="Nomor telepon aktif" class="form-control" required>
                                 <span class="icon-call-end text-muted icon-input"></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="eampleuser1">Email</label>
                              <div class="group-icon">
                                 <input id="eampleuser1" name="email" type="email" placeholder="Email aktif" class="form-control" autocomplete="off" required>
                                 <span class="icon-envelope text-muted icon-input"></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="exampleuser1">Username</label>
                              <div class="group-icon">
                                 <input id="exampleuser1" name="username" type="text" placeholder="Username" class="form-control" value="<?= set_value('username'); ?>" autocomplete="off" onkeyup="this.value = this.value.toLowerCase()" required>
                                 <span class="icon-user text-muted icon-input"></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="thresholdconfig">Password</label>
                              <div class="group-icon">
                                 <input id="thresholdconfig" name="password" type="password" placeholder="Password" class="form-control" required>
                                 <span class="icon-lock text-muted icon-input"></span>
                              </div>
                              <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                                 <input type="checkbox" onclick="Toggle()" id="show-hide" name="show-hide">
                                 <label for="show-hide"> Show Password </label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="eampleuser1">User Login</label>
                              <select name="akses" class="form-control m-b" required>
                                 <option disabled="" selected="">-Pilih-</option>
                                 <option value="2">Reseller/Penjual</option>
                                 <option value="3">Costumer</option>
                              </select>
                           </div>
                           <button id="submit" class="btn btn-block btn-primary btn-rounded box-shadow" type="submit"><span id="regText"></span></button>
                        </fieldset>
                     </form>
                     <div id="responseDiv" class="alert alert-dismissible text-center" role="alert" style="display:none;">
                        <span id="message"></span>
                     </div>
                     <hr>
                     <p class="text-center">Sudah punya akun?</p>
                     <a href="<?= base_url(); ?>auth/login_user" class="btn btn-block btn-success btn-rounded box-shadow">Login Sekarang</a>
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