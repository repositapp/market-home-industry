<div class="toastr1"></div>
<form method="post" action="<?= base_url('user/reseler_profile') ?>" enctype="multipart/form-data">
   <input type="hidden" name="ubah_data" value="ubah">
   <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">

   <section class="detail-form-section px-15 top-space pt-2">
      <div class="form-floating mb-4">
         <input type="text" class="form-control" id="nik_reseler" name="nik_reseler" placeholder="Nik Anda" autocomplete="off" value="<?= $user['nik_reseler']; ?>" required>
         <label for="nik_reseler">Nik</label>
      </div>

      <div class="form-floating mb-4">
         <input type="text" class="form-control" id="nm_reseler" name="nm_reseler" placeholder="Nama Anda" autocomplete="off" value="<?= $user['nm_reseler']; ?>" required>
         <label for="nm_reseler">Nama</label>
      </div>

      <div class="form-floating mb-4">
         <select class="form-select" id="jk_reseler" name="jk_reseler" required>
            <option selected="selected" disabled>-Pilih Jenis Kelamin-</option>
            <option <?php if ($user['jk_reseler'] == 'Laki-Laki') {
                        echo 'selected';
                     } ?> value="Laki-Laki">Laki-Laki</option>
            <option <?php if ($user['jk_reseler'] == 'Perempuan') {
                        echo 'selected';
                     } ?> value="Perempuan">Perempuan</option>
         </select>
         <label for="jk_reseler">Jenis Kelamin</label>
      </div>

      <div class="form-floating mb-4">
         <input type="number" class="form-control" id="telp_reseler" name="telp_reseler" placeholder="Nomor Telepon" autocomplete="off" value="<?= $user['telp_reseler']; ?>" required>
         <label for="telp_reseler">Nomor Telepon</label>
      </div>

      <div class="form-floating mb-4">
         <input type="email" class="form-control" id="email_reseler" name="email_reseler" placeholder="Email Anda" autocomplete="off" value="<?= $user['email_reseler']; ?>" required>
         <label for="email_reseler">Email</label>
      </div>

      <div class="form-floating mb-4">
         <textarea name="alamat_reseler" id="alamat_reseler" class="form-control" required><?= $user['alamat_reseler']; ?></textarea>
         <label for="alamat_reseler">Alamat</label>
      </div>

      <div class="form-floating mb-4">
         <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $user['foto_reseler']; ?>">

         <input type="file" class="form-control" id="gambar" name="foto_reseler" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);">
         <label for="foto_reseler">Foto Profil</label>

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
            <a href="<?= base_url(); ?>settings/reseler_settings" class="title-color">CANCEL</a>
         </div>
         <button type="submit" class="btn btn-solid w-100">Simpan</button>
      </div>
   </div>
</form>
<section class="panel-space"></section>