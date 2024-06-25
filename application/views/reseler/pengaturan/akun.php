<div class="toastr1"></div>
<form method="post" action="<?= base_url('user/reseler_akun') ?>" enctype="multipart/form-data">
   <input type="hidden" name="ubah_data" value="ubah">
   <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">

   <section class="detail-form-section px-15 top-space pt-2">
      <div class="form-floating mb-4">
         <input type="text" class="form-control" value="<?= $user['username']; ?>" disabled>
         <label for="username">Username</label>
      </div>

      <div class="form-floating mb-4">
         <input type="text" class="form-control" id="old_password" name="old_password" placeholder="Nama Anda" autocomplete="off" required>
         <label for="old_password">Password Lama</label>
      </div>

      <div class="form-floating mb-4">
         <input type="text" class="form-control" id="new_password" name="new_password" placeholder="Nama Anda" autocomplete="off" required>
         <label for="new_password">Password Baru</label>
      </div>
   </section>

   <div class="cart-bottom row m-0">
      <div>
         <div class="left-content col-5">
            <a href="<?= base_url(); ?>settings/reseler_settings" class="title-color">CANCEL</a>
         </div>
         <button type="submit" class="btn btn-solid w-100">Simpan</button>
      </div>
   </div>
</form>
<section class="panel-space"></section>