<?php

class M_transaksi extends CI_Model
{
   // Data Invoice 
   public function invoice($panjang_angka)
   {
      $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789' . time();
      $string = '';
      for ($i = 0; $i < $panjang_angka; $i++) {
         $pos = rand(0, strlen($code) - 1);
         $string .= $code[$pos];
      }

      $kodetampil = $string;
      return $kodetampil;
   }

   // Get, Insert, Update, Deleted Data All
   public function getData($tabel, $where, $id)
   {
      if (isset($where)) {
         $this->db->where($where);
      }
      $this->db->order_by($id, 'DESC');
      return $this->db->get($tabel);
   }

   public function insertData($tabel, $data, $where)
   {
      if (isset($where)) {
         $this->db->where($where);
         $this->db->update($tabel, $data);
      } else {
         $this->db->insert($tabel, $data);
      }
   }

   public function deleteData($tabel, $where)
   {
      $this->db->where($where);
      $this->db->delete($tabel);
   }

   // Data Transaksi
   public function getTransaksi($sts, $where, $user)
   {
      $this->db->select('transaksi.invoice, transaksi.costumer, transaksi.kode_barang, transaksi.total_transaksi, transaksi.alamat_costumer, transaksi.change_transaksi, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, kelurahan.nm_kelurahan, SUM(transaksi.jumlah_beli) as jumlah_belanja');
      $this->db->from('transaksi');
      $this->db->join('alamat_costumer', 'alamat_costumer.id_alamat=transaksi.alamat_costumer');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=alamat_costumer.wilayah');
      $this->db->where('transaksi.status_transaksi', $sts);
      if (isset($where)) {
         $this->db->where($where);
      }
      if (isset($user)) {
         $this->db->where($user);
      }
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Detail Transaksi
   public function getDetailTransaksi($invoice)
   {
      $this->db->select('transaksi.invoice, transaksi.costumer, transaksi.kode_barang, transaksi.jumlah_beli, transaksi.harga_barang, transaksi.total_beban, transaksi.total_pengiriman, transaksi.total_transaksi, transaksi.alamat_costumer, transaksi.change_transaksi, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, transaksi.kurir, transaksi.terima_barang, transaksi.penyerahan_barang, transaksi.bukti_penyerahan, transaksi.bukti_terima, alamat_costumer.detail_alamat, alamat_costumer.telp_alamat, kelurahan.nm_kelurahan, kecamatan.nm_kecamatan, kota.nm_kota, SUM(transaksi.jumlah_beli) as jumlah_belanja');
      $this->db->from('transaksi');
      $this->db->join('alamat_costumer', 'alamat_costumer.id_alamat=transaksi.alamat_costumer');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=alamat_costumer.wilayah');
      $this->db->join('kecamatan', 'kecamatan.id_kecamatan=kelurahan.id_kecamatan');
      $this->db->join('kota', 'kota.id_kota=kecamatan.id_kota');
      $this->db->where('transaksi.invoice', $invoice);
      $this->db->group_by('transaksi.invoice');
      return $this->db->get();
   }

   // Data Detail Transaksi Reseler
   public function getDetailTransaksiReseler($id)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      $this->db->join('costumer', 'costumer.id_user=transaksi.costumer');
      $this->db->join('alamat_costumer', 'alamat_costumer.id_alamat=transaksi.alamat_costumer');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=alamat_costumer.wilayah');
      $this->db->join('kecamatan', 'kecamatan.id_kecamatan=kelurahan.id_kecamatan');
      $this->db->join('kota', 'kota.id_kota=kecamatan.id_kota');
      $this->db->where('transaksi.id_transaksi', $id);
      return $this->db->get();
   }

   // Data Transaksi Transfer
   public function getOrderTF($inv)
   {
      $this->db->select('*');
      $this->db->from('transaksi_pembayaran');
      $this->db->join('bank', 'bank.id_bank=transaksi_pembayaran.bank_transfer');
      $this->db->where('transaksi_pembayaran.invoice', $inv);
      return $this->db->get();
   }

   // Data Transaksi Baru
   public function getNewTransaksi($user)
   {
      $this->db->select('transaksi.invoice, transaksi.change_transaksi, transaksi.total_transaksi, transaksi.costumer, transaksi.status_transaksi, transaksi.jenis_pembayaran, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as total_harga, SUM(transaksi.jumlah_beli) as jumlah_belanja, count(transaksi.jumlah_beli) as jumlah_item');
      $this->db->from('transaksi');
      $this->db->where('transaksi.status_transaksi', 0);
      if (isset($user)) {
         $this->db->where($user);
      }
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Transaksi Packing
   public function getPacTransaksi($user)
   {
      $this->db->select('transaksi.invoice, transaksi.change_transaksi, transaksi.costumer, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, transaksi.total_transaksi, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as total_harga, SUM(transaksi.jumlah_beli) as jumlah_belanja, count(transaksi.jumlah_beli) as jumlah_item');
      $this->db->from('transaksi');
      $this->db->where('transaksi.status_transaksi', 1);
      if (isset($user)) {
         $this->db->where($user);
      }
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Transaksi Delivery
   public function getDelvTransaksi($user)
   {
      $this->db->select('transaksi.invoice, transaksi.change_transaksi, transaksi.costumer, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, transaksi.total_transaksi, transaksi.kurir, transaksi.terima_barang, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as total_harga, SUM(transaksi.jumlah_beli) as jumlah_belanja, count(transaksi.jumlah_beli) as jumlah_item');
      $this->db->from('transaksi');
      $this->db->where('transaksi.status_transaksi', 2);
      if (isset($user)) {
         $this->db->where($user);
      }
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Transaksi Diterima
   public function getSucTransaksi($user)
   {
      $this->db->select('transaksi.invoice, transaksi.change_transaksi, transaksi.costumer, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, transaksi.total_transaksi, transaksi.kurir, transaksi.terima_barang, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as total_harga, SUM(transaksi.jumlah_beli) as jumlah_belanja, count(transaksi.jumlah_beli) as jumlah_item');
      $this->db->from('transaksi');
      $this->db->where('transaksi.status_transaksi', 3);
      if (isset($user)) {
         $this->db->where($user);
      }
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Riwayat
   public function getRiwTransaksi($user)
   {
      $this->db->select('transaksi.invoice, transaksi.change_transaksi, transaksi.costumer, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, transaksi.total_transaksi, transaksi.kurir, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as total_harga, SUM(transaksi.jumlah_beli) as jumlah_belanja, count(transaksi.jumlah_beli) as jumlah_item');
      $this->db->from('transaksi');
      $this->db->where('transaksi.status_transaksi', 4);
      if (isset($user)) {
         $this->db->where($user);
      }
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Transaksi Batal
   public function getBatTransaksi($user)
   {
      $this->db->select('transaksi.invoice, transaksi.change_transaksi, transaksi.costumer, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, transaksi.total_transaksi, transaksi.kurir, ongkir_jasa.id_ongkir_jasa, ongkir_jasa.jasa_pengiriman, ongkir_jasa.logo_jasa, SUM(transaksi.jumlah_beli*transaksi.harga_barang) as total_harga, SUM(transaksi.jumlah_beli) as jumlah_belanja, count(transaksi.jumlah_beli) as jumlah_item');
      $this->db->from('transaksi');
      $this->db->join('ongkir_jasa', 'ongkir_jasa.id_ongkir_jasa=transaksi.jasa_pengiriman');
      $this->db->where('transaksi.status_transaksi', 5);
      if (isset($user)) {
         $this->db->where($user);
      }
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Detail Pembelian Per Barang
   public function cekPembelianBarang($kode)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->join('toko', 'toko.reseler=reseler.id_user');
      $this->db->where('transaksi.kode_barang', $kode);
      return $this->db->get();
   }

   // Data Pesanan Per Invoice
   public function getPesanan($invoice)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->join('toko', 'toko.reseler=reseler.id_user');
      $this->db->where('transaksi.invoice', $invoice);
      return $this->db->get()->result_array();
   }

   // Bukti Pembayaran
   public function getBuktiBayar($invoice)
   {
      $this->db->select('*');
      $this->db->from('transaksi_pembayaran');
      $this->db->join('bank', 'bank.id_bank=transaksi_pembayaran.bank_transfer');
      $this->db->where('transaksi_pembayaran.invoice', $invoice);
      return $this->db->get();
   }

   // Data Riwayat Pembelian Costumer
   public function getShopCostumer($id)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      $this->db->where('transaksi.costumer', $id);
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get()->result_array();
   }

   // Data Detail Transaksi
   public function getShopToko($id)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->where('reseler.id_user', $id);
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get()->result_array();
   }

   // Perhitungan Biaya Pengiriman Costumer
   // Data Keranjang Costumer
   public function getCartCostumer($costumer)
   {
      $this->db->select('*');
      $this->db->from('keranjang');
      $this->db->join('produk', 'produk.kode_produk=keranjang.kode_produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->where('keranjang.costumer', $costumer);
      return $this->db->get();
   }

   // Data Alamat Costumer
   public function getLifeCostumer($id)
   {
      $this->db->select('*');
      $this->db->from('alamat_costumer');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=alamat_costumer.wilayah');
      $this->db->join('kecamatan', 'kecamatan.id_kecamatan=kelurahan.id_kecamatan');
      $this->db->join('kota', 'kota.id_kota=kecamatan.id_kota');
      $this->db->where('alamat_costumer.costumer', $id);
      $this->db->where('alamat_costumer.status_alamat', '1');
      return $this->db->get();
   }

   // Data Total Berat Beban
   public function TotalBerat($costumer)
   {
      $this->db->select('keranjang.qty, produk.kode_produk, produk.nm_produk, produk.harga_produk, SUM(produk.berat) as total_berat');
      $this->db->from('keranjang');
      $this->db->join('produk', 'produk.kode_produk=keranjang.kode_produk');
      $this->db->where('keranjang.costumer', $costumer);
      return $this->db->get();
   }

   // Data Transaksi Cek Biaya Pengiriman Per Reseler
   public function getOngkir($wilayah)
   {
      $this->db->select('*');
      $this->db->from('ongkir');
      $this->db->where('wilayah', $wilayah);
      return $this->db->get();
   }

   // Data Transaksi Harga Pengiriman
   public function biayaOngkir()
   {
      // $alamat = $this->m_transaksi->getLifeCostumer($this->session->userdata('id_user'));
      // $data_reseler = $this->m_produk->getCartReseler($this->session->userdata('id_user'));
      // $harga_ongkir = 0;
      // foreach ($data_reseler->result_array() as $reseler) :
      //    $ongkir = $this->m_transaksi->getOngkir($alamat->row_array()['wilayah'], $reseler['id_user']);
      //    $harga_ongkir += $ongkir->row_array()['harga_ongkir'];
      // endforeach;

      $alamat = $this->m_transaksi->getLifeCostumer($this->session->userdata('id_user'));
      $ongkir = $this->m_transaksi->getOngkir($alamat->row_array()['wilayah']);
      $harga_ongkir = $ongkir->row_array()['harga_ongkir'];

      return $harga_ongkir;
   }

   // Data Berhasil
   public function getOrderSuccess($inv)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->join('produk', 'produk.kode_produk=transaksi.kode_barang');
      $this->db->where('transaksi.invoice', $inv);
      $this->db->where('transaksi.status_transaksi', 0);
      return $this->db->get();
   }

   // Data Berhasil2
   public function getOrderProdukSuccess($inv)
   {
      $this->db->select('SUM(transaksi.jumlah_beli*transaksi.harga_barang) as total_hp');
      $this->db->from('transaksi');
      $this->db->where('transaksi.invoice', $inv);
      $this->db->where('transaksi.status_transaksi', 0);
      $this->db->or_where('transaksi.status_transaksi', 5);
      $this->db->group_by('transaksi.invoice');
      return $this->db->get();
   }
   // Akhir Perhitungan Biaya Pengiriman Costumer

   // Data Transaksi Reseler
   public function getTransaksiReseler($reseler, $limit)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->where('transaksi.status_transaksi', 1);
      $this->db->where('transaksi.reseler', $reseler);
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      if (isset($limit)) {
         $this->db->limit($limit);
      }
      return $this->db->get();
   }

   // Data Riwayat Transaksi Reseler
   public function getRiwayatTransaksiReseler($reseler)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->where('transaksi.status_transaksi >=', 2);
      $this->db->where('transaksi.status_transaksi <=', 4);
      $this->db->where('transaksi.reseler', $reseler);
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Pengiriman Kurir
   public function getOrderKurir($kurir)
   {
      $this->db->select('transaksi.invoice, transaksi.costumer, transaksi.kode_barang, transaksi.jumlah_beli, transaksi.harga_barang, transaksi.total_beban, transaksi.total_pengiriman, transaksi.total_transaksi, transaksi.alamat_costumer, transaksi.change_transaksi, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, kelurahan.nm_kelurahan, SUM(transaksi.jumlah_beli) as jumlah_belanja');
      $this->db->from('transaksi');
      $this->db->join('alamat_costumer', 'alamat_costumer.id_alamat=transaksi.alamat_costumer');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=alamat_costumer.wilayah');
      $this->db->where('transaksi.status_transaksi', 2);
      $this->db->where('transaksi.kurir', $kurir);
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data Riwayat Pengiriman
   public function getHistDelivery($kurir)
   {
      $this->db->select('transaksi.invoice, transaksi.costumer, transaksi.kode_barang, transaksi.jumlah_beli, transaksi.harga_barang, transaksi.total_beban, transaksi.total_pengiriman, transaksi.total_transaksi, transaksi.alamat_costumer, transaksi.change_transaksi, transaksi.status_transaksi, transaksi.jenis_pembayaran, transaksi.jasa_pengiriman, kelurahan.nm_kelurahan, SUM(transaksi.jumlah_beli) as jumlah_belanja');
      $this->db->from('transaksi');
      $this->db->join('alamat_costumer', 'alamat_costumer.id_alamat=transaksi.alamat_costumer');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=alamat_costumer.wilayah');
      $this->db->where('transaksi.status_transaksi >=', 3);
      $this->db->where('transaksi.status_transaksi <=', 4);
      $this->db->where('transaksi.kurir', $kurir);
      $this->db->group_by('transaksi.invoice');
      $this->db->order_by('transaksi.id_transaksi', 'DESC');
      return $this->db->get();
   }

   // Data produk Transaksi
   public function getProdukTransaksi($invoice)
   {
      $this->db->select('*');
      $this->db->from('transaksi');
      $this->db->join('produk_variasi', 'produk_variasi.id_produk_variasi=transaksi.variasi_produk');
      $this->db->where('transaksi.invoice', $invoice);
      return $this->db->get();
   }
}
