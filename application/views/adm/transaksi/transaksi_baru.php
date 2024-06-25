<div class="row">

   <div class="toastr1"></div>

   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-default border-bottom">
            <div class="row justify-content-between">
               <div class="col-md-12 align-self-center">
                  Data Transaksi Baru
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
                           (<?= $transaksi['jumlah_item']; ?> Items)
                        </td>
                        <td class="text-center">
                           <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
                              <span class="badge badge-pill badge-info">COD</span>
                           <?php } elseif ($transaksi['jenis_pembayaran'] == 2) {
                              $pay = $this->m_transaksi->getData('transaksi_pembayaran', array('invoice' => $transaksi['invoice']), 'id_pembayaran', null)->row_array();
                           ?>
                              <span class="badge badge-pill badge-info">Transfer Bank</span>
                              <?php if ($pay['bukti_pembayaran'] == 'none') { ?>
                                 <span class="badge badge-pill badge-danger">Menunggu Pembayaran</span>
                              <?php } else { ?>
                                 <a href="#" data-toggle="modal" data-target="#lihatData<?= $no; ?>">
                                    <span class="badge badge-pill badge-success">Sudah Membayar</span>
                                 </a>
                              <?php } ?>
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
                                    <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
                                       <li>
                                          <a class="dropdown-item text-success" href="<?= base_url(); ?>transaksi/transaksi_baru/<?= $transaksi['invoice']; ?>/<?= $transaksi['costumer']; ?>/1" onclick="return confirm('Silahkan klik OK untuk mengkonfirmasi pesanan baru?');"><i class="fa fa-check"></i> Konfirmasi</a>
                                       </li>
                                       <li>
                                          <a class="dropdown-item text-danger" href="<?= base_url(); ?>transaksi/transaksi_baru/<?= $transaksi['invoice']; ?>/<?= $transaksi['costumer']; ?>/5" onclick="return confirm('Anda yakin ingin membatalkan transaksi ini secara sepihak ini?');"><i class="fa fa-trash"></i> Batalkan</a>
                                       </li>
                                    <?php } elseif ($transaksi['jenis_pembayaran'] == 2) {
                                       $pay = $this->m_transaksi->getData('transaksi_pembayaran', array('invoice' => $transaksi['invoice']), 'id_pembayaran', null)->row_array();
                                    ?>
                                       <?php if ($pay['bukti_pembayaran'] == 'none') { ?>
                                          <li>
                                             <a class="dropdown-item text-success" href="#" onclick="return confirm('Belum dapat melakukan konfirmasi dikarenakan costumer belum membayar?');"><i class="fa fa-check"></i> Konfirmasi</a>
                                          </li>
                                          <li>
                                             <a class="dropdown-item text-danger" href="<?= base_url(); ?>transaksi/transaksi_baru/<?= $transaksi['invoice']; ?>/<?= $transaksi['costumer']; ?>/5" onclick="return confirm('Anda yakin ingin membatalkan transaksi ini secara sepihak ini?');"><i class="fa fa-trash"></i> Batalkan</a>
                                          </li>
                                       <?php } else { ?>
                                          <li>
                                             <a class="dropdown-item text-success" href="<?= base_url(); ?>transaksi/transaksi_baru/<?= $transaksi['invoice']; ?>/<?= $transaksi['costumer']; ?>/1" onclick="return confirm('Silahkan klik OK untuk mengkonfirmasi pesanan baru?');"><i class="fa fa-check"></i> Konfirmasi</a>
                                          </li>
                                       <?php } ?>
                                    <?php } ?>
                                 </ul>
                              </li>
                           </ul>
                        </td>
                     </tr>

                     <!-- Modal Lihat Data -->
                     <div id="lihatData<?= $no; ?>" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                                 <h5 class="modal-title" id="myDefaultModalLabel">Bukti Transfer</h5>
                              </div>
                              <div class="modal-body">
                                 <?php $bukti = $this->db->get_where('transaksi_pembayaran', ['invoice' => $transaksi['invoice']])->row_array(); ?>

                                 <div class="text-center">
                                    <img class="img-fluid" src="<?= base_url() ?>assets/upload/<?= $bukti['bukti_pembayaran']; ?>" style="width: 250px; height:350px">
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php $no++;
                  endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>