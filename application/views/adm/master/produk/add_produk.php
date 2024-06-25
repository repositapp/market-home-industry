<div class="row">

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-4 align-self-center">
                  Form Tambah Data Produk
               </div>
               <div class="col-md-4">
                  <div class="float-right">
                     <a href="<?= base_url(); ?><?= $menu_link; ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>
         <form method="post" action="<?= base_url('produk/tambah_produk'); ?>" enctype="multipart/form-data">
            <div class="card-body">
               <input type="hidden" name="tambah_data" value="tambah">

               <input type="hidden" id="change_produk" name="change_produk" value="<?= $tanggalwaktu; ?>">
               <input type="hidden" id="kode_produk" name="kode_produk" value="<?= $kode_produk; ?>">

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Reseler</label>
                  <div class="col-sm-10">
                     <select id="reseler" name="reseler" class="form-control m-b" required>
                        <option selected="selected" disabled>-Pilih Reseler-</option>
                        <?php foreach ($data_reseler->result_array() as $reseler) : ?>
                           <option value="<?= $reseler['id_user']; ?>"><?= $reseler['nm_reseler']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Kategori Produk</label>
                  <div class="col-sm-10">
                     <select id="kategori_produk" name="kategori_produk" class="form-control m-b" required>
                        <option selected="selected" disabled>-Pilih Kategori Produk-</option>
                        <?php foreach ($data_kategori->result_array() as $kategori) : ?>
                           <option value="<?= $kategori['id_kategori_produk']; ?>"><?= $kategori['nm_kategori_produk']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Nama Produk</label>
                  <div class="col-sm-10">
                     <textarea id="nm_produk" name="nm_produk" class="form-control" required></textarea>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Harga Produk</label>
                  <div class="col-sm-10">
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon">Rp.</span>
                           <input type="text" id="harga_produk" name="harga_produk" autocomplete="off" required>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Modal</label>
                  <div class="col-sm-10">
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon">Rp.</span>
                           <input type="text" id="harga_modal" name="harga_modal" autocomplete="off" required>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Stok</label>
                  <div class="col-sm-10">
                     <input type="text" id="stok" name="stok" class="form-control" placeholder="Total keseluruhan stok produk" autocomplete="off" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Berat</label>
                  <div class="col-sm-10">
                     <div class="form-group">
                        <div class="input-group">
                           <input type="number" id="berat" name="berat" class="form-control" placeholder="0" autocomplete="off" required>
                           <span class="input-group-addon">g</span>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Satuan Penjualan</label>
                  <div class="col-sm-8">
                     <div class="form-group">
                        <input type="text" id="ukuran_jual" name="ukuran_jual" placeholder="Silahkan isi" autocomplete="off" required>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <select id="satuan_jual" name="satuan_jual" class="form-control" required>
                        <option selected="selected" disabled>-Pilih Satuan-</option>
                        <option>ML</option>
                        <option>L</option>
                        <option>MG</option>
                        <option>G/GR</option>
                        <option>KG</option>
                        <option>CM</option>
                        <option>M</option>
                        <option>Dozen</option>
                        <option>Piece</option>
                        <option>Pack</option>
                        <option>Set</option>
                        <option>Box</option>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                  <div class="col-sm-10">
                     <textarea id="deskripsi_produk" name="deskripsi_produk" class="summernote2" required></textarea>
                  </div>
               </div>

               <div class="form-group row tambGambar">
                  <label for="label" class="col-sm-2 col-form-label">Gambar/Video</label>
                  <div class="col-sm-10">
                     <div class="row">
                        <div class="col-sm-11">
                           <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                              <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                              <span class="input-group-addon btn btn-primary btn-file ">
                                 <span class="fileinput-new">Select</span>
                                 <span class="fileinput-exists">Change</span>
                                 <input type="file" name="gambar_produk[]" onchange="validate(this);" required>
                              </span>
                              <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                           </div>
                        </div>
                        <div class="col-sm-1">
                           <a href="javascript:void(0)" class="btn btn-success btn-sm addMoreGambar"><i class="fa fa-plus"></i></a>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-12">
                     <label for="atribut" style="font-weight: 600;"> Atribut Tambahan </label><br>
                     <small class="text-muted">Silahkan mengisi atribut tambahan sesuai dengan produk yang ingin anda jual.</small>
                  </div>
               </div>

               <div class="form-group row tambVariasi">
                  <div class="col-sm-12">
                     <input id="atribut_variasi" type="checkbox" name="atribut_variasi">
                     <label for="atribut_variasi">Variasi</label><br>
                     <small class="text-muted">Silahkan dicentang checkbox diatas jika ingin menambah variasi.</small>
                  </div>
                  <div class="col-sm-12">
                     <div class="row">
                        <div class="col-sm-4">
                           <input type="text" id="size" name="size[]" class="form-control" autocomplete="off" placeholder="Size">
                           <small class="text-muted">Kosongkan jika tidak ada.</small>
                        </div>
                        <div class="col-sm-4">
                           <input type="text" id="warna_rasa" name="warna_rasa[]" class="form-control" autocomplete="off" placeholder="Warna Produk atau Rasa Masakan">
                           <small class="text-muted">Kosongkan jika tidak ada.</small>
                        </div>
                        <div class="col-sm-3">
                           <input type="number" id="stok_variasi" name="stok_variasi[]" class="form-control" autocomplete="off" placeholder="Stok per variasi">
                        </div>
                        <div class="col-sm-1">
                           <a href="javascript:void(0)" class="btn btn-success btn-sm addMoreVariasi"><i class="fa fa-plus"></i></a>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row tambAtribut">
                  <div class="col-sm-12">
                     <input id="atribut_lainnya" type="checkbox" name="atribut_lainnya">
                     <label for="atribut_lainnya">Atribut Tambahan Lainnya</label><br>
                     <small class="text-muted">Silahkan dicentang checkbox diatas jika ingin menambah variasi. Atribut lainnya dapat berupa jenis masakan, gaya memasak, bahan, motif, gaya, panjang produk, lebar produk, dll.</small>
                  </div>
                  <div class="col-sm-12">
                     <div class="row">
                        <div class="col-sm-4">
                           <input type="text" id="judul_taribut" name="judul_taribut[]" class="form-control" autocomplete="off" placeholder="Judul atribut">
                        </div>
                        <div class="col-sm-7">
                           <input type="text" id="isian_atribut" name="isian_atribut[]" class="form-control" autocomplete="off" placeholder="Isian atribut">
                        </div>
                        <div class="col-sm-1">
                           <a href="javascript:void(0)" class="btn btn-success btn-sm addMoreAtribut"><i class="fa fa-plus"></i></a>
                        </div>
                     </div>
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

   <div style="display: none;">
      <div class="form-group row tambGambarCopy">
         <label for="label" class="col-sm-2 col-form-label">Gambar/Video</label>
         <div class="col-sm-10">
            <div class="row">
               <div class="col-sm-11">
                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                     <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                     <span class="input-group-addon btn btn-primary btn-file ">
                        <span class="fileinput-new">Select</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="gambar_produk[]" onchange="validate(this);" required>
                     </span>
                     <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                  </div>
               </div>
               <div class="col-sm-1">
                  <a href="javascript:void(0)" class="btn btn-danger btn-sm removeGambar"><i class="fa fa-trash"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div style="display: none;">
      <div class="form-group row tambVariasiCopy">
         <div class="col-sm-12">
            <div class="row">
               <div class="col-sm-4">
                  <input type="text" id="size_jenis" name="size_jenis[]" class="form-control" autocomplete="off" placeholder="Size atau sejenisnya">
                  <small class="text-muted">Kosongkan jika tidak ada.</small>
               </div>
               <div class="col-sm-4">
                  <input type="text" id="warna_rasa" name="warna_rasa[]" class="form-control" autocomplete="off" placeholder="Warna Produk atau Rasa Masakan">
                  <small class="text-muted">Kosongkan jika tidak ada.</small>
               </div>
               <div class="col-sm-3">
                  <input type="number" id="stok_variasi" name="stok_variasi[]" class="form-control" autocomplete="off" placeholder="Stok per variasi">
               </div>
               <div class="col-sm-1">
                  <a href="javascript:void(0)" class="btn btn-danger btn-sm removeVariasi"><i class="fa fa-trash"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div style="display: none;">
      <div class="form-group row tambAtributCopy">
         <div class="col-sm-12">
            <div class="row">
               <div class="col-sm-4">
                  <input type="text" id="judul_taribut" name="judul_taribut[]" class="form-control" autocomplete="off" placeholder="Judul atribut">
               </div>
               <div class="col-sm-7">
                  <input type="text" id="isian_atribut" name="isian_atribut[]" class="form-control" autocomplete="off" placeholder="Isian atribut">
               </div>
               <div class="col-sm-1">
                  <a href="javascript:void(0)" class="btn btn-danger btn-sm removeAtribut"><i class="fa fa-trash"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>