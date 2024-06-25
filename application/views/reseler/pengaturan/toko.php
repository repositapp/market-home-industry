<div class="toastr1"></div>
<form method="post" action="<?= base_url('user/reseler_profile_toko') ?>" enctype="multipart/form-data">
   <input type="hidden" name="ubah_data" value="ubah">
   <input type="hidden" id="id_toko" name="id_toko" value="<?= $toko['id_toko']; ?>">

   <section class="detail-form-section px-15 top-space pt-2">
      <div class="form-floating mb-4">
         <input type="text" class="form-control" id="nm_toko" name="nm_toko" placeholder="Nama Toko" autocomplete="off" value="<?= $toko['nm_toko']; ?>" required>
         <label for="nm_toko">Nama Toko</label>
      </div>

      <div class="form-floating mb-4">
         <textarea name="alamat_toko" id="alamat_toko" class="form-control" required><?= $toko['alamat_toko']; ?></textarea>
         <label for="alamat_toko">Alamat</label>
      </div>

      <div class="form-floating mb-4">
         <input type="email" class="form-control" id="email_toko" name="email_toko" placeholder="Email Anda" autocomplete="off" value="<?= $toko['email_toko']; ?>" required>
         <label for="email_toko">Email</label>
      </div>

      <div class="form-floating mb-4">
         <input type="number" class="form-control" id="telp_toko" name="telp_toko" placeholder="Nomor Telepon" autocomplete="off" value="<?= $toko['telp_toko']; ?>" required>
         <label for="telp_toko">Nomor Telepon</label>
      </div>

      <div class="form-floating mb-4">
         <input type="hidden" class="form-control" id="old_izin_usaha" name="old_izin_usaha" value="<?= $toko['izin_usaha']; ?>">

         <input type="file" class="form-control" id="gambar" name="izin_usaha" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);">
         <label for="izin_usaha">Izin Usaha</label>

         <div class="checkbox_animated mt-2">
            <div class="d-flex align-items-center">
               <input type="checkbox" name="ubah_izin_usaha" id="onecheckbox">
               <label for="onecheckbox">Ubah Izin Usaha</label>
            </div>
         </div>
      </div>

      <div class="form-floating mb-4">
         <input type="hidden" class="form-control" id="old_foto_ktp" name="old_foto_ktp" value="<?= $toko['foto_ktp']; ?>">

         <input type="file" class="form-control" id="gambar" name="foto_ktp" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);">
         <label for="foto_ktp">Foto KTP</label>

         <div class="checkbox_animated mt-2">
            <div class="d-flex align-items-center">
               <input type="checkbox" name="ubah_foto_ktp" id="twocheckbox">
               <label for="twocheckbox">Ubah Foto KTP</label>
            </div>
         </div>
      </div>

      <div class="form-floating mb-4">
         <input type="hidden" class="form-control" id="old_logo_toko" name="old_logo_toko" value="<?= $toko['logo_toko']; ?>">

         <input type="file" class="form-control" id="gambar" name="logo_toko" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);">
         <label for="logo_toko">Logo</label>

         <div class="checkbox_animated mt-2">
            <div class="d-flex align-items-center">
               <input type="checkbox" name="ubah_logo_toko" id="threecheckbox">
               <label for="threecheckbox">Ubah Logo</label>
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