<div class="toastr1"></div>
<form method="post" action="<?= base_url('user/costumer_profile') ?>" enctype="multipart/form-data">
   <input type="hidden" name="ubah_data" value="ubah">
   <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">

   <section class="detail-form-section px-15 top-space pt-2">
      <div class="form-floating mb-4">
         <input type="text" class="form-control" id="nm_costumer" name="nm_costumer" placeholder="Nama Anda" autocomplete="off" value="<?= $user['nm_costumer']; ?>" required>
         <label for="nm_costumer">Nama</label>
      </div>

      <div class="form-floating mb-4">
         <select class="form-select" id="jk_costumer" name="jk_costumer" required>
            <option selected="selected" disabled>-Pilih Jenis Kelamin-</option>
            <option <?php if ($user['jk_costumer'] == 'Laki-Laki') {
                        echo 'selected';
                     } ?> value="Laki-Laki">Laki-Laki</option>
            <option <?php if ($user['jk_costumer'] == 'Perempuan') {
                        echo 'selected';
                     } ?> value="Perempuan">Perempuan</option>
         </select>
         <label for="jk_costumer">Jenis Kelamin</label>
      </div>

      <div class="form-floating mb-4">
         <input type="number" class="form-control" id="telp_costumer" name="telp_costumer" placeholder="Nomor Telepon" autocomplete="off" value="<?= $user['telp_costumer']; ?>" required>
         <label for="telp_costumer">Nomor Telepon</label>
      </div>

      <div class="form-floating mb-4">
         <input type="email" class="form-control" id="email_costumer" name="email_costumer" placeholder="Email Anda" autocomplete="off" value="<?= $user['email_costumer']; ?>" required>
         <label for="email_costumer">Email</label>
      </div>

      <div class="form-floating mb-4">
         <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $user['foto_costumer']; ?>">

         <input type="file" class="form-control" id="foto_costumer" name="foto_costumer" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);">
         <label for="foto_costumer">Foto Profil</label>

         <div class="checkbox_animated mt-2">
            <div class="d-flex align-items-center">
               <input type="checkbox" name="ubah_gambar" id="onecheckbox">
               <label for="onecheckbox">Ubah Foto</label>
            </div>
         </div>
      </div>
   </section>

   <div class="cart-bottom row m-0">
      <div>
         <div class="left-content col-5">
            <a href="<?= base_url(); ?>settings/costumer_settings" class="title-color">CANCEL</a>
         </div>
         <button type="submit" class="btn btn-solid w-100">Simpan</button>
      </div>
   </div>
</form>