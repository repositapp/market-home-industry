<table style="width: 100%;">
   <tbody>
      <tr>
         <th colspan="4" style="font-size: 16px;">Invoice. <?= $transaksi['invoice']; ?></th>
      </tr>
      <tr>
         <td style="font-size: 12px;">Costumer</td>
         <td style="font-size: 12px;" width="400">: <?= $costumer->row_array()['nm_costumer']; ?></td>
         <td style="font-size: 12px;">Jumlah Pesanan</td>
         <td style="font-size: 12px;">: <?= $transaksi['jumlah_belanja']; ?> Items</td>
      </tr>
      <tr>
         <td style="font-size: 12px;">Jasa Pengiriman</td>
         <td style="font-size: 12px;">:
            <?php if ($transaksi['jasa_pengiriman'] == 1) {
               $kurir = $this->m_user->getData('kurir', array('id_user' => $transaksi['kurir']), 'id_kurir', 1)->row_array();
            ?>
               <?= $jasa['jasa_pengiriman']; ?>
               (<?= $kurir['nm_kurir']; ?>)
            <?php } else { ?>
               <?= $jasa['jasa_pengiriman']; ?>
            <?php } ?>
         </td>
         <td style="font-size: 12px;">Metode Pembayaran</td>
         <td style="font-size: 12px;">:
            <?php if ($transaksi['jenis_pembayaran'] == 1) { ?>
               COD
            <?php } elseif ($transaksi['jenis_pembayaran'] == 2) { ?>
               Transfer Bank
            <?php } ?>
         </td>
      </tr>
      <tr style="border-bottom: 1px solid #e9ecef;">
         <td style="font-size: 12px;">Tanggal Pesanan</td>
         <td colspan="3" style="font-size: 12px;">: <?= date('d M Y, H:i', strtotime($transaksi['change_transaksi'])); ?></td>
      </tr>
   </tbody>
</table>

<table class="table mt-20" style="font-size: 12px;">
   <thead>
      <tr>
         <th width="10">No.</th>
         <th>Menu</th>
         <th class="text-center" width="150">Jumlah Pesanan</th>
         <th class="text-center" width="150">Harga</th>
         <th class="text-center" width="150">Sub Total</th>
      </tr>
   </thead>
   <tbody>
      <?php $no = 1;
      foreach ($data_pesanan as $pesanan) : ?>
         <tr>
            <td><?= $no; ?></td>
            <td><?= $pesanan['nm_barang']; ?></td>
            <td class="text-center"><?= $pesanan['jumlah_beli']; ?> Items</td>
            <td class="text-center">Rp. <?= number_format($pesanan['harga_barang'], 0, ".", "."); ?></td>
            <td class="text-center">Rp. <?= number_format($pesanan['jumlah_beli'] * $pesanan['harga_barang'], 0, ".", "."); ?></td>
         </tr>
      <?php $no++;
      endforeach; ?>
      <tr>
         <td colspan="4" style="font-weight: 700;">Total</td>
         <td style="font-weight: 700;" class="text-center"> Rp. <?= number_format($transaksi['total_transaksi'], 0, ".", "."); ?></td>
      </tr>
   </tbody>
</table>