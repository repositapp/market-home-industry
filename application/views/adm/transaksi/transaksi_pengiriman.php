<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-12 align-self-center">
                  Data Transaksi Pengiriman
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
                     <th class="text-center">waktu</th>
                     <th class="text-center">Kurir</th>
                     <th class="text-center">Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  foreach ($data_transaksi->result_array() as $transaksi) :
                     $cek = $this->m_user->getData('costumer', array('id_user' => $transaksi['costumer']), 'id_user', 1);
                     $jasa = $this->m_user->getData('ongkir_jasa', array('id_ongkir_jasa' => $transaksi['jasa_pengiriman']), 'id_ongkir_jasa', 1)->row_array();
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
                           (<?= $transaksi['jumlah_item']; ?> Items)
                        </td>
                        <td class="text-center"><?= date('d M, Y', strtotime($transaksi['change_transaksi'])); ?></td>
                        <td class="text-center">
                           <?php if ($transaksi['jasa_pengiriman'] == 1) {
                              $kurir = $this->m_user->getData('kurir', array('id_user' => $transaksi['kurir']), 'id_kurir', 1)->row_array();
                           ?>
                              <span class="badge badge-pill badge-info"><?= $jasa['jasa_pengiriman']; ?></span> <br>
                              <a href="#"><span class="badge badge-pill badge-success"><i class="fa fa-user ml-1"></i> <?= $kurir['nm_kurir']; ?></span></a>
                           <?php } else { ?>
                              <span class="badge badge-pill badge-info"><?= $jasa['jasa_pengiriman']; ?></span>
                           <?php } ?>
                        </td>
                        <td class="text-center">
                           <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
                              <span class="badge badge-pill badge-danger">In Delivery</span>
                           <?php } else { ?>
                              <?php if ($transaksi['terima_barang'] == 0) { ?>
                                 <span class="badge badge-pill badge-danger">In Delivery</span>
                              <?php } elseif ($transaksi['terima_barang'] == 1) { ?>
                                 <a href="<?= base_url(); ?>transaksi/transaksi_pengiriman/<?= $transaksi['invoice']; ?>/<?= $transaksi['costumer']; ?>/4" onclick="return confirm('Silahkan klik OK untuk mengakhiri transaksi?');"><span class="badge badge-pill badge-info">Order Take</span></a>
                              <?php } ?>
                           <?php } ?>
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