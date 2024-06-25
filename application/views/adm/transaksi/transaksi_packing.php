<div class="row">

   <div class="toastr1"></div>
   <div class="col-md-12">
      <form method="post" action="<?= base_url('transaksi/transaksi_packing'); ?>" enctype="multipart/form-data">
         <input type="hidden" name="ubah_data" value="ubah">
         <div class="card">
            <div class="card-header card-default border-bottom">
               <div class="row justify-content-between">
                  <div class="col-md-8 align-self-center">
                     Data Transaksi Packing
                  </div>
                  <div class="col-md-4">
                     <div class="float-right">
                        <button type="submit" class="btn btn-primary btn-rounded box-shadow btn-icon"><i class="fa fa-truck"></i> Make Delivery</button>
                     </div>
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
                        <th class="text-center" width="110">Packing</th>
                        <th class="text-center">Waktu</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_transaksi->result_array() as $transaksi) :
                        $cek = $this->m_user->getData('costumer', array('id_user' => $transaksi['costumer']), 'id_user', 1);
                        $costumer = $cek->row_array();
                        $cek_packing = $this->m_user->getData('transaksi', array('invoice' => $transaksi['invoice'], 'status_pengemasan' => 1), 'id_transaksi', null);
                     ?>
                        <tr>
                           <td class="text-center">
                              <input type="hidden" name="jasa_pengiriman[]" value="<?= $transaksi['jasa_pengiriman']; ?>">
                              <input type="hidden" name="costumer[]" value="<?= $transaksi['costumer']; ?>">
                              <?php if ($cek_packing->num_rows() == $transaksi['jumlah_item']) { ?>
                                 <input type="checkbox" name="invoice[]" value="<?= $transaksi['invoice']; ?>">
                              <?php } else { ?>
                                 <input type="checkbox" name="invoice[]" value="<?= $transaksi['invoice']; ?>" disabled>
                              <?php } ?>
                              <?= $no; ?>.
                           </td>
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
                           <td class="text-center">
                              <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
                                 <span class="badge badge-pill badge-info">COD</span>
                              <?php } elseif ($transaksi['jenis_pembayaran'] == 2) { ?>
                                 <span class="badge badge-pill badge-info">Transfer Bank</span>
                              <?php } ?>
                           </td>
                           <td class="text-center">
                              <?php if ($cek_packing->num_rows() == $transaksi['jumlah_item']) { ?>
                                 <span class="badge badge-pill badge-success">Sudah</span>
                              <?php } else { ?>
                                 <span class="badge badge-pill badge-danger">Belum</span>
                              <?php } ?>
                           </td>
                           <td class="text-center"><?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></td>
                        </tr>
                     <?php $no++;
                     endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </form>
   </div>
</div>