<?php

class M_laporan extends CI_Model
{
   // Data Pendapatan Reseler
   public function getPendResler($where)
   {
      $this->db->select('transaksi.invoice, transaksi.reseler, transaksi.kode_barang, transaksi.nm_barang, transaksi.harga_barang, transaksi.jumlah_beli, transaksi.total_transaksi, transaksi.status_transaksi, transaksi.change_transaksi, produk.kode_produk, produk.harga_modal, reseler.id_user, reseler.nm_reseler, toko.reseler, toko.nm_toko, SUM(transaksi.jumlah_beli) as jumlah_belanja, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as penjualan, SUM(transaksi.jumlah_beli*produk.harga_modal) as pengeluaran');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      $this->db->join('reseler', 'reseler.id_user=transaksi.reseler');
      $this->db->join('toko', 'toko.reseler=transaksi.reseler');
      if (isset($where)) {
         $this->db->where($where);
      }
      $this->db->where('transaksi.status_transaksi', 4);
      $this->db->group_by('transaksi.kode_barang');
      $this->db->order_by('transaksi.reseler', 'DESC');
      return $this->db->get();
   }

   // Data Pendapatan Perusahaan
   public function getPendPerusahaan($where)
   {
      $this->db->select('transaksi.invoice, transaksi.reseler, transaksi.kode_barang, transaksi.nm_barang, transaksi.harga_barang, transaksi.jumlah_beli, transaksi.total_transaksi, transaksi.status_transaksi, transaksi.change_transaksi, produk.kode_produk, produk.harga_modal, COUNT(transaksi.kode_barang) as jumlah_items, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as grand_total');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      if (isset($where)) {
         $this->db->where($where);
      }
      $this->db->where('transaksi.status_transaksi', 4);
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Pendapatan Kurir
   public function getPendKurir($where)
   {
      $this->db->select('transaksi.invoice, transaksi.costumer, transaksi.kode_barang, transaksi.nm_barang, transaksi.harga_barang, transaksi.jumlah_beli, transaksi.total_transaksi, transaksi.jasa_pengiriman, transaksi.kurir, transaksi.status_transaksi, transaksi.change_transaksi, kurir.nm_kurir, alamat_costumer.detail_alamat, kelurahan.nm_kelurahan, kecamatan.nm_kecamatan, kota.nm_kota, COUNT(transaksi.kode_barang) as jumlah_items, SUM(transaksi.total_pengiriman) as pendapatan');
      $this->db->from('transaksi');
      $this->db->join('kurir', 'kurir.id_user=transaksi.kurir');
      $this->db->join('alamat_costumer', 'alamat_costumer.id_alamat=transaksi.alamat_costumer');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=alamat_costumer.wilayah');
      $this->db->join('kecamatan', 'kecamatan.id_kecamatan=kelurahan.id_kecamatan');
      $this->db->join('kota', 'kota.id_kota=kecamatan.id_kota');
      if (isset($where)) {
         $this->db->where($where);
      }
      $this->db->where('transaksi.jasa_pengiriman', 1);
      $this->db->where('transaksi.status_transaksi', 4);
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }
}
