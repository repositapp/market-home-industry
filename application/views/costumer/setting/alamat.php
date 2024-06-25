<div class="toastr1"></div>
<!-- delivery option section start -->
<section class="top-space px-15 pt-0">
   <div class="delivery-option-section">
      <ul>
         <?php $no = 1;
         foreach ($data_alamat->result_array() as $alamat) : ?>
            <li>
               <div class="check-box">
                  <div class="form-check d-flex ps-0">
                     <div>
                        <h4 class="name"><?= $alamat['nama_alamat']; ?></h4>
                        <div class="addess">
                           <h4>Kota <?= $alamat['nm_kota']; ?>, </h4>
                           <h4>Kecamatan <?= $alamat['nm_kecamatan']; ?>,</h4>
                           <h4>Kelurahan <?= $alamat['nm_kelurahan']; ?>,</h4>
                           <h4><?= $alamat['detail_alamat']; ?></h4>
                        </div>
                        <h4>No. Telepon: <?= $alamat['telp_alamat']; ?></h4>
                        <?php if ($alamat['status_alamat'] == 1) { ?>
                           <h6 class="label">Utama</h6>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="buttons">
                  <a href="<?= base_url(); ?>user/hapus_alamat/<?= $alamat['id_alamat']; ?>/<?= $this->uri->segment('3') ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Remove</a>
                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ubahData<?= $alamat['id_alamat']; ?>">edit</a>
               </div>
            </li>

            <!-- Modal Ubah Data start  -->
            <form method="post" action="<?= base_url('user/costumer_ubah_alamat/' . $this->uri->segment('3')) ?>" enctype="multipart/form-data">
               <div class="modal filter-modal" id="ubahData<?= $alamat['id_alamat']; ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-fullscreen">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h2>Ubah Alamat</h2>
                           <a href="javascript:void(0)" data-bs-dismiss="modal"><img src="<?= base_url(); ?>assets/mobile/svg/x-dark.svg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="modal-body">
                           <input type="hidden" name="id_alamat" value="<?= $alamat['id_alamat']; ?>">

                           <div class="form-floating mb-4 mt-2">
                              <input type="text" class="form-control" id="nama_alamat" name="nama_alamat" value="<?= $alamat['nama_alamat']; ?>" placeholder="Nama Penerima">
                              <label for="nama_alamat">Nama Penerima</label>
                           </div>
                           <div class="form-floating mb-4">
                              <input type="number" class="form-control" id="telp_alamat" name="telp_alamat" value="<?= $alamat['telp_alamat']; ?>" placeholder="Kontak Penerima">
                              <label for="telp_alamat">Kontak Penerima</label>
                           </div>
                           <div class="form-floating mb-4">
                              <select class="form-select" id="wilayah" name="wilayah" aria-label="Floating label select example">
                                 <?php foreach ($data_wilayah as $wilayah) : ?>
                                    <option <?php if ($wilayah['id_kelurahan'] == $alamat['wilayah']) {
                                                echo 'selected';
                                             } ?> value="<?= $wilayah['id_kelurahan']; ?>">Kota <?= $wilayah['nm_kota']; ?>, Kec. <?= $wilayah['nm_kecamatan']; ?>, Kel. <?= $wilayah['nm_kelurahan']; ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <label for="wilayah">Pilih Wilayah</label>
                           </div>

                           <div class="form-floating mb-4">
                              <textarea id="detail_alamat" name="detail_alamat" class="form-control"><?= $alamat['detail_alamat']; ?></textarea>
                              <label for="detail_alamat">Nama Jalan, Gedung, No. Rumah</label>
                           </div>

                           <h2 class="page-title">Tipe Alamat</h2>
                           <div class="d-flex">
                              <div class="me-3 d-flex align-items-center mb-2">
                                 <input class="radio_animated" type="radio" name="tipe_alamat" id="rumah<?= $no; ?>" value="rumah" <?php if ($alamat['tipe_alamat'] == 'rumah') {
                                                                                                                                       echo 'checked';
                                                                                                                                    } ?>>
                                 <label for="rumah<?= $no; ?>">Rumah</label>
                              </div>
                              <div class="me-3 d-flex align-items-center mb-2">
                                 <input class="radio_animated" type="radio" name="tipe_alamat" id="kantor<?= $no; ?>" value="kantor" <?php if ($alamat['tipe_alamat'] == 'kantor') {
                                                                                                                                          echo 'checked';
                                                                                                                                       } ?>>
                                 <label for="kantor<?= $no; ?>">Kantor</label>
                              </div>
                              <div class="d-flex align-items-center mb-2">
                                 <input class="radio_animated" type="radio" name="tipe_alamat" id="lainnya<?= $no; ?>" value="lainnya" <?php if ($alamat['tipe_alamat'] == 'lainnya') {
                                                                                                                                          echo 'checked';
                                                                                                                                       } ?>>
                                 <label for="lainnya<?= $no; ?>">Lainnya</label>
                              </div>
                           </div>
                           <div class="checkbox_animated">
                              <div class="d-flex align-items-center mb-2">
                                 <input type="checkbox" name="status_alamat" id="status_alamat<?= $no; ?>" value="1" <?php if ($alamat['status_alamat'] == 1) {
                                                                                                                        echo 'checked';
                                                                                                                     } ?>>
                                 <label for="status_alamat<?= $no; ?>">atur sebagai alamat utama</label>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <a href="javascript:void(0)" class="reset-link" data-bs-dismiss="modal">Batal</a>
                           <button type="submit" class="btn btn-success">Ubah Alamat</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <!-- Modal Ubah Data end -->
         <?php $no++;
         endforeach; ?>
      </ul>
      <a href="javascript:void(0)" class="btn btn-outline text-capitalize w-100 mt-3" data-bs-toggle="modal" data-bs-target="#filterModal">Tambah Alamat Baru</a>
   </div>
</section>

<!-- Modal Tambah Data start  -->
<form method="post" action="<?= base_url('user/costumer_alamat/' . $this->uri->segment('3')) ?>" enctype="multipart/form-data">
   <div class="modal filter-modal" id="filterModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
         <div class="modal-content">
            <div class="modal-header">
               <h2>Tambah Alamat Baru</h2>
               <a href="javascript:void(0)" data-bs-dismiss="modal"><img src="<?= base_url(); ?>assets/mobile/svg/x-dark.svg" class="img-fluid" alt=""></a>
            </div>
            <div class="modal-body">
               <input type="hidden" name="tambah_data" value="tambah">

               <div class="form-floating mb-4 mt-2">
                  <input type="text" class="form-control" id="nama_alamat" name="nama_alamat" placeholder="Nama Penerima">
                  <label for="nama_alamat">Nama Penerima</label>
               </div>
               <div class="form-floating mb-4">
                  <input type="number" class="form-control" id="telp_alamat" name="telp_alamat" placeholder="Kontak Penerima">
                  <label for="telp_alamat">Kontak Penerima</label>
               </div>
               <div class="form-floating mb-4">
                  <select class="form-select" id="wilayah" name="wilayah" aria-label="Floating label select example">
                     <?php foreach ($data_wilayah as $wilayah) : ?>
                        <option value="<?= $wilayah['id_kelurahan']; ?>">Kota <?= $wilayah['nm_kota']; ?>, Kec. <?= $wilayah['nm_kecamatan']; ?>, Kel. <?= $wilayah['nm_kelurahan']; ?></option>
                     <?php endforeach; ?>
                  </select>
                  <label for="wilayah">Pilih Wilayah</label>
               </div>

               <div class="form-floating mb-4">
                  <textarea id="detail_alamat" name="detail_alamat" class="form-control"></textarea>
                  <label for="detail_alamat">Nama Jalan, Gedung, No. Rumah</label>
               </div>

               <h2 class="page-title">Tipe Alamat</h2>
               <div class="d-flex">
                  <div class="me-3 d-flex align-items-center mb-2">
                     <input class="radio_animated" type="radio" name="tipe_alamat" id="rumah" value="rumah">
                     <label for="rumah">Rumah</label>
                  </div>
                  <div class="me-3 d-flex align-items-center mb-2">
                     <input class="radio_animated" type="radio" name="tipe_alamat" id="kantor" value="kantor">
                     <label for="kantor">Kantor</label>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                     <input class="radio_animated" type="radio" name="tipe_alamat" id="lainnya" value="lainnya" checked>
                     <label for="lainnya">Lainnya</label>
                  </div>
               </div>
               <div class="checkbox_animated">
                  <div class="d-flex align-items-center mb-2">
                     <input type="checkbox" name="status_alamat" id="status_alamat" value="1">
                     <label for="status_alamat">atur sebagai alamat utama</label>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <a href="javascript:void(0)" class="reset-link" data-bs-dismiss="modal">Batal</a>
               <button type="submit" class="btn btn-solid">Simpan Alamat</button>
            </div>
         </div>
      </div>
   </div>
</form>
<!-- Modal Tambah Data end -->

<section class="panel-space"></section>