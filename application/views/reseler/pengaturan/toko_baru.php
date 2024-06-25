<div class="toastr1"></div>
<form method="post" action="<?= base_url('user/reseler_toko_baru/' . $user['id_user']) ?>" enctype="multipart/form-data">
   <input type="hidden" name="tambah_data" value="tambah">

   <section class="detail-form-section px-15 top-space pt-3">
      <div class="form-floating mb-4">
         <input type="text" class="form-control" id="nm_toko" name="nm_toko" placeholder="Nama Toko" autocomplete="off" autofocus required>
         <label for="nm_toko">Nama Toko</label>
      </div>

      <div class="form-floating mb-4">
         <textarea name="alamat_toko" id="alamat_toko" class="form-control" required></textarea>
         <label for="alamat_toko">Alamat</label>
      </div>

      <div class="form-floating mb-4">
         <input type="email" class="form-control" id="email_toko" name="email_toko" placeholder="Email Anda" autocomplete="off" required>
         <label for="email_toko">Email</label>
      </div>

      <div class="form-floating mb-4">
         <input type="number" class="form-control" id="telp_toko" name="telp_toko" placeholder="Nomor Telepon" autocomplete="off" required>
         <label for="telp_toko">Nomor Telepon</label>
      </div>

      <div class="form-floating mb-4">
         <input type="file" class="form-control" id="gambar" name="izin_usaha" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);" required>
         <label for="izin_usaha">Izin Usaha</label>
      </div>

      <div class="form-floating mb-4">
         <input type="file" class="form-control" id="gambar" name="foto_ktp" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);" required>
         <label for="foto_ktp">Foto KTP</label>
      </div>

      <div class="form-floating mb-4">
         <input type="file" class="form-control" id="gambar" name="logo_toko" style="padding: 20px 20px !important; height: 59px !important;" onchange="validate(this);">
         <label for="logo_toko">Logo</label>
      </div>
   </section>

   <div class="cart-bottom row m-0">
      <div>
         <button type="submit" class="btn btn-solid w-100">Simpan</button>
      </div>
   </div>
</form>
<section class="panel-space"></section>