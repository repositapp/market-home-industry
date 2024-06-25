<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-12 align-self-center">
                  Data Transaksi Batal
               </div>
            </div>
         </div>

         <div class="card-body">
            <table id="datatable" class="table table-striped table-hover">
               <thead>
                  <tr>
                     <th width="40">No.</th>
                     <th class="text-center">Invoice</th>
                     <th>Costumer</th>
                     <th class="text-center" width="110">Pembelian</th>
                     <th class="text-center" width="110">Pembayaran</th>
                     <th class="text-center">Waktu</th>
                     <th class="text-center" width="40"><i class="fa fa-sort"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_transaksi->result_array() as $transaksi) :
                     $cek = $this->m_user->getData('costumer', array('id_user' => $transaksi['costumer']), 'id_user', 1);
                     $costumer = $cek->row_array();
                  ?>
                     <tr>
                        <td class="text-center"><?= $no; ?>.</td>
                        <td class="text-center">
                           <a href="<?= base_url(); ?>transaksi/detail_transaksi/<?= $transaksi['invoice']; ?>" class="text-yellow">
                              <?= $transaksi['invoice']; ?>
                           </a>
                        </td>
                        <td>
                           <?php if ($cek->num_rows() > 0) { ?>
                              <?= $costumer['nm_costumer']; ?>
                           <?php } elseif ($cek->num_rows() == 0) { ?>
                              Not Found
                           <?php } ?>
                        </td>
                        <td class="text-center">
                           Rp. <?= number_format($transaksi['total_transaksi'], 0, ".", "."); ?> <br>
                           (<?= $transaksi['jumlah_belanja']; ?> Items)
                        </td>
                        <td class="text-center">
                           <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
                              <span class="badge badge-pill badge-info">COD</span>
                           <?php } elseif ($transaksi['jenis_pembayaran'] == 2) { ?>
                              <span class="badge badge-pill badge-info">Transfer Bank</span>
                           <?php } ?>
                        </td>
                        <td class="text-center"><?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></td>
                        <td class="text-center">
                           <ul class="list-inline">
                              <li id="aksi" class="dropdown">
                                 <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-ellipsis-v"></i>
                                 </a>
                                 <ul class="dropdown-menu top-dropdown">
                                    <li>
                                       <a class="dropdown-item text-danger" href="<?= base_url(); ?>transaksi/hapus_transaksi_batal/<?= $transaksi['invoice']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </td>
                     </tr>
                  <?php $no++;
                  endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>