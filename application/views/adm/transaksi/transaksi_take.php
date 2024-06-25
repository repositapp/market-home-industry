<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-12 align-self-center">
                  Data Transaksi Terima Barang Costumer
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
                     <th class="text-center">Waktu Terima</th>
                     <th class="text-center">Kurir</th>
                     <th class="text-center" width="100">Status</th>
                     <th class="text-center" width="40"><i class="fa fa-sort"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_transaksi->result_array() as $transaksi) :
                     $cek = $this->m_user->getData('costumer', array('id_user' => $transaksi['costumer']), 'id_user', 1);
                     $costumer = $cek->row_array();
                     $jasa = $this->m_user->getData('ongkir_jasa', array('id_ongkir_jasa' => $transaksi['jasa_pengiriman']), 'id_ongkir_jasa', 1)->row_array();
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
                           Rp. <?= number_format($transaksi['total_harga'], 0, ".", "."); ?> <br>
                           (<?= $transaksi['jumlah_belanja']; ?> Items)
                        </td>
                        <td class="text-center"><?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></td>
                        <td class="text-center">
                           <?php if ($transaksi['jasa_pengiriman'] == 1) {
                              $kurir = $this->m_user->getData('kurir', array('id_user' => $transaksi['kurir']), 'id_kurir', 1)->row_array();
                           ?>
                              <span class="badge badge-pill badge-info"><?= $jasa['jasa_pengiriman']; ?></span>
                              <span class="badge badge-pill badge-success"><i class="fa fa-user ml-1"></i> <?= $kurir['nm_kurir']; ?></span>
                           <?php } else { ?>
                              <span class="badge badge-pill badge-info"><?= $jasa['jasa_pengiriman']; ?></span>
                           <?php } ?>
                        </td>
                        <td class="text-center">
                           <?php if ($transaksi['terima_barang'] == 0) { ?>
                              <span class="badge badge-pill badge-danger">Barang Belum Diterima</span>
                           <?php } elseif ($transaksi['terima_barang'] == 1) { ?>
                              <span class="badge badge-pill badge-success">Barang Telah Diterima</span>
                           <?php } ?>
                        </td>
                        <td class="text-center">
                           <ul class="list-inline">
                              <li id="aksi" class="dropdown">
                                 <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-ellipsis-v"></i>
                                 </a>
                                 <ul class="dropdown-menu top-dropdown">
                                    <li>
                                       <a class="dropdown-item text-success" href="<?= base_url(); ?>transaksi/transaksi_take_order/<?= $transaksi['invoice']; ?>/<?= $transaksi['costumer']; ?>/4/<?= $transaksi['kurir']; ?>" onclick="return confirm('Silahkan klik OK untuk menyelesaikan transaksi?');"><i class="fa fa-check"></i> Konfirmasi</a>
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