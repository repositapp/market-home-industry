<div class="row">

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Form Tambah Data Reseler
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="<?= base_url(); ?><?= $menu_link; ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>

         <form method="post" action="<?= base_url('user/tambah_reseler'); ?>" enctype="multipart/form-data">
            <div class="card-body">
               <h5 class="font-500">Biodata Reseler</h5>
               <hr class="clearfix">

               <input type="hidden" name="tambah_data" value="tambah">
               <input type="hidden" id="akses" name="akses" value="2">
               <input type="hidden" id="change_user" name="change_user" value="<?= $tanggalwaktu; ?>">
               <input type="hidden" id="maps_toko" name="maps_toko" value="-5.483351611030401, 122.5781204183574">

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-10">
                     <input type="text" id="nik_reseler" name="nik_reseler" autocomplete="off" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Nama Reseler</label>
                  <div class="col-sm-10">
                     <input type="text" id="nm_reseler" name="nm_reseler" autocomplete="off" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Kontak Reseler</label>
                  <div class="col-sm-5">
                     <input type="number" id="telp_reseler" name="telp_reseler" class="form-control" placeholder="Nomor Telepon" autocomplete="off" required>
                  </div>
                  <div class="col-sm-5">
                     <input type="email" id="email_reseler" name="email_reseler" class="form-control" placeholder="Email" autocomplete="off" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                     <select id="jk_reseler" name="jk_reseler" class="form-control m-b" required>
                        <option selected="selected" disabled>-Pilih Jenis Kelamin-</option>
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Foto Reseler</label>
                  <div class="col-sm-10">
                     <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file ">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" id="gambar" name="foto_reseler" onchange="validate(this);" required>
                        </span>
                        <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Alamat Reseler</label>
                  <div class="col-sm-10">
                     <textarea id="alamat_reseler" name="alamat_reseler" class="form-control" required></textarea>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Akun Reseler</label>
                  <div class="col-sm-5">
                     <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
                  </div>
                  <div class="col-sm-5">
                     <input type="text" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
                  </div>
               </div>

               <h5 class="font-500">Toko/Lapak</h5>
               <hr class="clearfix">

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Nama Toko</label>
                  <div class="col-sm-10">
                     <input type="text" id="nm_toko" name="nm_toko" autocomplete="off" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Kontak Toko</label>
                  <div class="col-sm-5">
                     <input type="number" id="telp_toko" name="telp_toko" class="form-control" placeholder="Nomor Telepon" autocomplete="off" required>
                  </div>
                  <div class="col-sm-5">
                     <input type="email" id="email_toko" name="email_toko" class="form-control" placeholder="Email" autocomplete="off" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Izin Usaha</label>
                  <div class="col-sm-10">
                     <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file ">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" id="gambar" name="izin_usaha" onchange="validate(this);" required>
                        </span>
                        <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Foto KTP</label>
                  <div class="col-sm-10">
                     <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file ">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" id="gambar" name="foto_ktp" onchange="validate(this);" required>
                        </span>
                        <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Foto/Logo Toko</label>
                  <div class="col-sm-10">
                     <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file ">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" id="gambar" name="logo_toko" onchange="validatePictures(this);" required>
                        </span>
                        <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Alamat Toko</label>
                  <div class="col-sm-10">
                     <textarea id="alamat_toko" name="alamat_toko" class="form-control" required></textarea>
                  </div>
               </div>

            </div>
            <div class="card-footer card-default">
               <div class="float-right margin-b-10">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>