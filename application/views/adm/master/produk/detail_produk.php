<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-4">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header card-default border-bottom">
                  <div class="row justify-content-between">
                     <div class="col-md-8 align-self-center">
                        Gambar/Video Produk
                     </div>
                     <div class="col-md-4">
                        <div class="float-right">
                           <a href="#" data-toggle="modal" data-target="#tambahGambar">
                              <span class="badge badge-pill badge-primary">Add</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="card-body">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                     <!-- Indicators -->
                     <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < $data_gambar->num_rows(); $i++) { ?>
                           <li data-target="#myCarousel" data-slide-to="<?= $i; ?>" <?= $i === 0 ? "class='active'" : "" ?>></li>
                        <?php } ?>
                     </ol>

                     <!-- Wrapper for slides -->
                     <div class="carousel-inner" role="listbox">
                        <?php $no = 1;
                        foreach ($data_gambar->result_array() as $gambar) :
                           $exp = explode(".", $gambar['gambar_produk']);
                        ?>
                           <div class="carousel-item <?= $no === 1 ? "active" : "" ?>">
                              <?php if ($exp[1] == 'mp4' || $exp[1] == 'avi' || $exp[1] == 'mkv' || $exp[1] == '3gp' || $exp[1] == 'mgp' || $exp[1] == 'mpeg') { ?>
                                 <video controls playsinline style="width:100%;height: 206px !important;">
                                    <source src="<?= base_url(); ?>assets/upload/<?= $gambar['gambar_produk']; ?>">
                                 </video>
                              <?php } else { ?>
                                 <img src="<?= base_url(); ?>assets/upload/<?= $gambar['gambar_produk']; ?>" alt="" class="img-fluid rounded" style="width:100%;height: 206px !important;">
                              <?php } ?>

                              <div class="row">
                                 <div class="col-md-6">
                                    <a href="#" class="btn btn-success btn-xs btn-block mt-2" data-toggle="modal" data-target="#ubahGambar<?= $no; ?>">Ubah Data</a>
                                 </div>
                                 <div class="col-md-6">
                                    <a href="<?= base_url(); ?>produk/hapus_gambar_produk/<?= $produk['kode_produk']; ?>/<?= $gambar['id_gambar_produk']; ?>" class="btn btn-danger btn-xs btn-block mt-2" onclick="return confirm('Anda yakin ingin menghapus gambar ini?');">Hapus Data</a>
                                 </div>
                              </div>
                           </div>

                           <!-- Modal Ubah Gambar -->
                           <form method="post" action="<?= base_url('produk/detail_produk/'); ?><?= $produk['kode_produk']; ?>" enctype="multipart/form-data">
                              <div id="ubahGambar<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                          <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
                                       </div>
                                       <div class="modal-body">
                                          <input type="hidden" name="ubah_data" value="ubahGambar">
                                          <input type="hidden" id="id_gambar_produk" name="id_gambar_produk" value="<?= $gambar['id_gambar_produk']; ?>">
                                          <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $gambar['gambar_produk']; ?>">

                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Gambar/Video</label>
                                             <div class="col-sm-9">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                   <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                                                   <span class="input-group-addon btn btn-primary btn-file ">
                                                      <span class="fileinput-new">Select</span>
                                                      <span class="fileinput-exists">Change</span>
                                                      <input type="file" name="gambar_produk" onchange="validate(this);" required>
                                                   </span>
                                                   <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                             </div>
                                             <div class="col-sm-9 offset-md-3">
                                                <img alt="" src="<?= base_url(); ?>assets/upload/<?= $gambar['gambar_produk']; ?>" class="img-fluid rounded" style="width: 100%;">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Simpan Data</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        <?php $no++;
                        endforeach; ?>
                     </div>

                     <!-- Left and right controls -->
                     <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="icon-arrow-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="icon-arrow-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="widget white-bg">
               <div class="padding-20 text-center">
                  <img alt="Profile Picture" width="140" height="140" class="rounded-circle mar-btm margin-b-10 circle-border" src="<?= base_url(); ?>assets/upload/<?= $produk['foto_reseler']; ?>">
                  <a href="<?= base_url(); ?>user/detail_reseler/<?= $produk['reseler']; ?>">
                     <p class="lead font-500 margin-b-0"><?= $produk['nm_toko']; ?></p>
                     <p class="text-muted"><?= $produk['nm_reseler']; ?></p>
                  </a>
                  <hr>
                  <ul class="list-unstyled margin-b-0 text-center row">
                     <li class="col-6">
                        <span class="font-600">Telepon</span>
                        <p class="text-muted text-sm margin-b-0"><?= $produk['telp_reseler']; ?></p>
                     </li>
                     <li class="col-6">
                        <span class="font-600">Email</span>
                        <p class="text-muted text-sm margin-b-0"><?= $produk['email_reseler']; ?></p>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-8">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-6 align-self-center">
                  Detail Produk
               </div>
               <div class="col-md-6">
                  <div class="float-right">
                     <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData"><i class="fa fa-edit"></i> Ubah Detail Produk</a>
                     <a href="<?= base_url(); ?><?= $menu_link; ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-body">
            <table class="table bordered">
               <tbody>
                  <tr>
                     <td width="250">Kategori Produk</td>
                     <td>: <?= $produk['nm_kategori_produk']; ?></td>
                  </tr>
                  <tr>
                     <td>Nama Produk</td>
                     <td>: <?= $produk['nm_produk']; ?></td>
                  </tr>
                  <tr>
                     <td>Harga</td>
                     <td>: Rp. <?= number_format($produk['harga_produk'], 0, ".", "."); ?></td>
                  </tr>
                  <tr>
                     <td>Modal</td>
                     <td>: Rp. <?= number_format($produk['harga_modal'], 0, ".", "."); ?></td>
                  </tr>
                  <tr>
                     <td>Stok Total</td>
                     <td>: <?= $produk['stok']; ?></td>
                  </tr>
                  <tr>
                     <td>Berat</td>
                     <td>: <?= $produk['berat']; ?>g</td>
                  </tr>
                  <tr>
                     <td>Satuan Jual</td>
                     <td>: <?= $produk['ukuran_jual']; ?>/<?= $produk['satuan_jual']; ?></td>
                  </tr>
                  <tr>
                     <td>Deskripsi Produk</td>
                     <td>
                        <?= $produk['deskripsi_produk']; ?>
                     </td>
                  </tr>
                  <tr>
                     <td>Status Produk</td>
                     <td>:
                        <?php if ($produk['status_produk'] == '0') { ?>
                           <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                        <?php } elseif ($produk['status_produk'] == '1') { ?>
                           <span class="badge badge-pill badge-info">Aktif</span>
                        <?php } ?>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <div class="col-md-12">
      <div class="row">
         <div class="col-sm-6">
            <div class="card">
               <div class="card-header card-default border-bottom">
                  <div class="row justify-content-between">
                     <div class="col-md-8 align-self-center">
                        Atribut Lainnya
                     </div>
                     <div class="col-md-4">
                        <div class="float-right">
                           <a href="#" data-toggle="modal" data-target="#tambahAtribut">
                              <span class="badge badge-pill badge-primary">Add</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <table class="table bordered">
                     <tbody>
                        <?php foreach ($data_atribut->result_array() as $atribut_produk) : ?>
                           <tr>
                              <td width="150"><?= $atribut_produk['judul_taribut']; ?></td>
                              <td>: <?= $atribut_produk['isian_atribut']; ?></td>
                              <td width="10">
                                 <ul class="list-inline">
                                    <li id="aksi" class="dropdown">
                                       <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-ellipsis-v"></i>
                                       </a>
                                       <ul class="dropdown-menu top-dropdown">
                                          <li>
                                             <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#ubahAtribut<?= $no; ?>"><i class="fa fa-edit"></i> Ubah Data</a>
                                          </li>
                                          <li>
                                             <a class="dropdown-item text-danger" href="<?= base_url(); ?>produk/hapus_atribut_produk/<?= $produk['kode_produk']; ?>/<?= $atribut_produk['id_produk_atribut']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
                                          </li>
                                       </ul>
                                    </li>
                                 </ul>
                              </td>
                           </tr>

                           <!-- Modal Ubah Atribut -->
                           <form method="post" action="<?= base_url('produk/detail_produk/'); ?><?= $produk['kode_produk']; ?>" enctype="multipart/form-data">
                              <div id="ubahAtribut<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                          <h5 class="modal-title" id="myDefaultModalLabel">Ubah Atribut</h5>
                                       </div>
                                       <div class="modal-body">
                                          <input type="hidden" name="ubah_data" value="ubahAtribut">
                                          <input type="hidden" id="id_produk_atribut" name="id_produk_atribut" value="<?= $atribut_produk['id_produk_atribut']; ?>">

                                          <div class="form-group row">
                                             <div class="col-sm-4">
                                                <input type="text" id="judul_taribut" name="judul_taribut" class="form-control" placeholder="Judul atribut" value="<?= $atribut_produk['judul_taribut']; ?>" autocomplete="off" required>
                                             </div>
                                             <div class="col-sm-8">
                                                <input type="text" id="isian_atribut" name="isian_atribut" class="form-control" placeholder="Isian atribut" value="<?= $atribut_produk['isian_atribut']; ?>" autocomplete="off" required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Simpan Data</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="card">
               <div class="card-header card-default border-bottom">
                  <div class="row justify-content-between">
                     <div class="col-md-8 align-self-center">
                        Varian Produk
                     </div>
                     <div class="col-md-4">
                        <div class="float-right">
                           <a href="#" data-toggle="modal" data-target="#tambahVarian">
                              <span class="badge badge-pill badge-primary">Add Varian</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Size</th>
                           <th>Warna/Rasa</th>
                           <th>Stok Per Varian</th>
                           <th class="text-center">_</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1;
                        foreach ($data_variasi->result_array() as $variasi_produk) : ?>
                           <tr>
                              <td><?= $variasi_produk['size']; ?></td>
                              <td><?= $variasi_produk['warna_rasa']; ?></td>
                              <td><?= $variasi_produk['stok_variasi']; ?></td>
                              <td class="text-center">
                                 <ul class="list-inline">
                                    <li id="aksi" class="dropdown">
                                       <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-ellipsis-v"></i>
                                       </a>
                                       <ul class="dropdown-menu top-dropdown">
                                          <li>
                                             <a class="dropdown-item text-success" href="#" data-toggle="modal" data-target="#ubahVarian<?= $no; ?>"><i class="fa fa-edit"></i> Ubah Data</a>
                                          </li>
                                          <li>
                                             <a class="dropdown-item text-danger" href="<?= base_url(); ?>produk/hapus_variasi_produk/<?= $produk['kode_produk']; ?>/<?= $variasi_produk['id_produk_variasi']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
                                          </li>
                                       </ul>
                                    </li>
                                 </ul>
                              </td>
                           </tr>

                           <!-- Modal Ubah Varian -->
                           <form method="post" action="<?= base_url('produk/detail_produk/'); ?><?= $produk['kode_produk']; ?>" enctype="multipart/form-data">
                              <div id="ubahVarian<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                          <h5 class="modal-title" id="myDefaultModalLabel">Ubah Varian Produk</h5>
                                       </div>
                                       <div class="modal-body">
                                          <input type="hidden" name="ubah_data" value="ubahVarian">
                                          <input type="hidden" id="id_produk_variasi" name="id_produk_variasi" value="<?= $variasi_produk['id_produk_variasi']; ?>">

                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Size</label>
                                             <div class="col-sm-9">
                                                <input type="text" id="size" name="size" class="form-control" placeholder="Total keseluruhan stok produk" value="<?= $variasi_produk['size']; ?>" autocomplete="off" required>
                                             </div>
                                          </div>

                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Warna/Rasa</label>
                                             <div class="col-sm-9">
                                                <input type="text" id="warna_rasa" name="warna_rasa" class="form-control" autocomplete="off" placeholder="Stok Produk" value="<?= $variasi_produk['warna_rasa'] ?>" required>
                                             </div>
                                          </div>

                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Stok</label>
                                             <div class="col-sm-9">
                                                <input type="number" id="stok_variasi" name="stok_variasi" class="form-control" autocomplete="off" placeholder="Stok Per Varian" value="<?= $variasi_produk['stok_variasi'] ?>" required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Simpan Data</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        <?php $no++;
                        endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>

<!-- Modal Ubah Data -->
<form method="post" action="<?= base_url('produk/detail_produk/'); ?><?= $produk['kode_produk']; ?>" enctype="multipart/form-data">
   <div id="ubahData" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="ubah_data" value="ubahProduk">
               <input type="hidden" id="id_produk" name="id_produk" value="<?= $produk['id_produk']; ?>">
               <input type="hidden" id="change_produk" name="change_produk" value="<?= $tanggalwaktu; ?>">

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Reseler</label>
                  <div class="col-sm-9">
                     <select id="reseler" name="reseler" class="form-control m-b" required>
                        <option selected="selected" disabled>-Pilih Reseler-</option>
                        <?php foreach ($data_reseler->result_array() as $reseler) : ?>
                           <option <?= $reseler['id_user'] === $produk['reseler'] ? "selected" : "" ?> value="<?= $reseler['id_user']; ?>"><?= $reseler['nm_reseler']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Kategori Produk</label>
                  <div class="col-sm-9">
                     <select id="kategori_produk" name="kategori_produk" class="form-control m-b" required>
                        <option selected="selected" disabled>-Pilih Kategori Produk-</option>
                        <?php foreach ($data_kategori->result_array() as $kategori) : ?>
                           <option <?= $kategori['id_kategori_produk'] === $produk['kategori_produk'] ? "selected" : "" ?> value="<?= $kategori['id_kategori_produk']; ?>"><?= $kategori['nm_kategori_produk']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Nama Produk</label>
                  <div class="col-sm-9">
                     <textarea id="nm_produk" name="nm_produk" class="form-control" required><?= $produk['nm_produk']; ?></textarea>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Harga Produk</label>
                  <div class="col-sm-9">
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon">Rp.</span>
                           <input type="text" id="harga_produk" name="harga_produk" value="<?= $produk['harga_produk']; ?>" autocomplete="off" required>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Modal</label>
                  <div class="col-sm-9">
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon">Rp.</span>
                           <input type="text" id="harga_modal" name="harga_modal" value="<?= $produk['harga_modal']; ?>" autocomplete="off" required>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Stok</label>
                  <div class="col-sm-9">
                     <input type="text" id="stok" name="stok" class="form-control" placeholder="Total keseluruhan stok produk" autocomplete="off" value="<?= $produk['stok']; ?>" required>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Berat</label>
                  <div class="col-sm-9">
                     <div class="form-group">
                        <div class="input-group">
                           <input type="number" id="berat" name="berat" class="form-control" value="<?= $produk['berat']; ?>" placeholder="0" autocomplete="off" required>
                           <span class="input-group-addon">g</span>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Satuan Penjualan</label>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <input type="text" id="ukuran_jual" name="ukuran_jual" value="<?= $produk['ukuran_jual']; ?>" placeholder="Silahkan isi" autocomplete="off" required>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <select id="satuan_jual" name="satuan_jual" class="form-control" required>
                        <option selected="selected" disabled>-Pilih Satuan-</option>
                        <option <?= $produk['satuan_jual'] === 'ML' ? "selected" : "" ?>>ML</option>
                        <option <?= $produk['satuan_jual'] === 'L' ? "selected" : "" ?>>L</option>
                        <option <?= $produk['satuan_jual'] === 'MG' ? "selected" : "" ?>>MG</option>
                        <option <?= $produk['satuan_jual'] === 'G/GR' ? "selected" : "" ?>>G/GR</option>
                        <option <?= $produk['satuan_jual'] === 'KG' ? "selected" : "" ?>>KG</option>
                        <option <?= $produk['satuan_jual'] === 'CM' ? "selected" : "" ?>>CM</option>
                        <option <?= $produk['satuan_jual'] === 'M' ? "selected" : "" ?>>M</option>
                        <option <?= $produk['satuan_jual'] === 'Dozen' ? "selected" : "" ?>>Dozen</option>
                        <option <?= $produk['satuan_jual'] === 'Piece' ? "selected" : "" ?>>Piece</option>
                        <option <?= $produk['satuan_jual'] === 'Pack' ? "selected" : "" ?>>Pack</option>
                        <option <?= $produk['satuan_jual'] === 'Set' ? "selected" : "" ?>>Set</option>
                        <option <?= $produk['satuan_jual'] === 'Box' ? "selected" : "" ?>>Box</option>
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Berat</label>
                  <div class="col-sm-9">
                     <div class="form-group">
                        <div class="input-group">
                           <input type="number" id="berat" name="berat" class="form-control" value="<?= $produk['berat']; ?>" placeholder="0" autocomplete="off" required>
                           <span class="input-group-addon">g</span>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                  <div class="col-sm-9">
                     <textarea id="deskripsi_produk" name="deskripsi_produk" class="summernote2" required><?= $produk['deskripsi_produk']; ?></textarea>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                     <select id="status_produk" name="status_produk" class="form-control m-b" required>
                        <option selected="selected" disabled>-Pilih Status-</option>
                        <option <?= $produk['status_produk'] === '1' ? "selected" : "" ?> value="1">Aktif</option>
                        <option <?= $produk['status_produk'] === '0' ? "selected" : "" ?> value="0">Tidak Aktif</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
         </div>
      </div>
   </div>
</form>

<!-- Modal Tambah Gambar -->
<form method="post" action="<?= base_url('produk/detail_produk/'); ?><?= $produk['kode_produk']; ?>" enctype="multipart/form-data">
   <div id="tambahGambar" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Tambah Gambar/Video</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="tambah_data" value="tambahGambar">

               <input type="hidden" id="kode_produk" name="kode_produk" value="<?= $produk['kode_produk']; ?>">

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Gambar/Video</label>
                  <div class="col-sm-9">
                     <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-primary btn-file ">
                           <span class="fileinput-new">Select</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="gambar_produk" onchange="validate(this);" required>
                        </span>
                        <a href="#" class="input-group-addon btn btn-danger hover fileinput-exists" data-dismiss="fileinput">Remove</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
         </div>
      </div>
   </div>
</form>

<!-- Modal Tambah Varian -->
<form method="post" action="<?= base_url('produk/detail_produk/'); ?><?= $produk['kode_produk']; ?>" enctype="multipart/form-data">
   <div id="tambahVarian" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Tambah Varian Produk</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="tambah_data" value="tambahVarian">

               <input type="hidden" id="kode_produk" name="kode_produk" value="<?= $produk['kode_produk']; ?>">

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Size</label>
                  <div class="col-sm-9">
                     <input type="text" id="size" name="size" class="form-control" autocomplete="off">
                     <small class="text-muted">Kosongkan jika tidak ada.</small>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Warna/Rasa</label>
                  <div class="col-sm-9">
                     <input type="text" id="warna_rasa" name="warna_rasa" class="form-control" autocomplete="off">
                     <small class="text-muted">Kosongkan jika tidak ada.</small>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="label" class="col-sm-3 col-form-label">Stok</label>
                  <div class="col-sm-9">
                     <input type="number" id="stok_variasi" name="stok_variasi" class="form-control" autocomplete="off" placeholder="Stok per varian" required>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
         </div>
      </div>
   </div>
</form>

<!-- Modal Tambah Atribut -->
<form method="post" action="<?= base_url('produk/detail_produk/'); ?><?= $produk['kode_produk']; ?>" enctype="multipart/form-data">
   <div id="tambahAtribut" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
               <h5 class="modal-title" id="myDefaultModalLabel">Tambah Atribut</h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="tambah_data" value="tambahAtribut">

               <input type="hidden" id="kode_produk" name="kode_produk" value="<?= $produk['kode_produk']; ?>">

               <div class="form-group row">
                  <div class="col-sm-6">
                     <input type="text" id="judul_taribut" name="judul_taribut" class="form-control" placeholder="Judul atribut" autocomplete="off" required>
                  </div>
                  <div class="col-sm-6">
                     <input type="text" id="isian_atribut" name="isian_atribut" class="form-control" placeholder="Isian atribut" autocomplete="off" required>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
         </div>
      </div>
   </div>
</form>