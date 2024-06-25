<?php

class M_produk extends CI_Model
{
   // Kode Produk
   public function kodeProduk($panjang_angka)
   {
      $code = '1234567890' . time();
      $string = '';
      for ($i = 0; $i < $panjang_angka; $i++) {
         $pos = rand(0, strlen($code) - 1);
         $string .= $code[$pos];
      }

      $this->db->select('RIGHT(produk.kode_produk,3) as kode_produk', FALSE);
      $this->db->order_by('kode_produk', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get('produk');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->kode_produk) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
      $kodetampil = "KRP-" . $string . '-' . $batas;
      return $kodetampil;
   }

   // Data Jumlah Keranjang
   public function getCartTotal($id)
   {
      $this->db->select('costumer, COUNT(costumer) as total');
      $this->db->from('keranjang');
      $this->db->where('costumer', $id);
      return $this->db->get()->row_array();
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

   public function getDataAsc($tabel, $where, $id)
   {
      if (isset($where)) {
         $this->db->where($where);
      }
      $this->db->order_by($id, 'ASC');
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

   // Data Produk
   public function getAllProduk($limit)
   {
      $this->db->select('*');
      $this->db->from('produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->order_by('id_produk', 'DESC');
      if (isset($limit)) {
         $this->db->limit($limit);
      }
      return $this->db->get();
   }

   // Data Produk
   public function getProdukReseler($reseler, $limit)
   {
      $this->db->select('*');
      $this->db->from('produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->where('produk.reseler', $reseler);
      $this->db->order_by('id_produk', 'DESC');
      if (isset($limit)) {
         $this->db->limit($limit);
      }
      return $this->db->get();
   }

   // Data Detail Produk
   public function getDetailProduk($kode)
   {
      $this->db->select('*');
      $this->db->from('produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->join('toko', 'toko.reseler=reseler.id_user');
      $this->db->where('kode_produk', $kode);
      return $this->db->get()->row_array();
   }

   // Data Produk Per Reseler
   public function getProdukToko($id)
   {
      $this->db->select('*');
      $this->db->from('produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->where('produk.reseler', $id);
      $this->db->order_by('id_produk', 'DESC');
      return $this->db->get();
   }

   // Data Produk Diskon
   public function getProdukDiskon($tanggal, $limit, $lapak)
   {
      $this->db->select('*');
      $this->db->from('diskon');
      $this->db->join('produk', 'produk.kode_produk=diskon.kode_produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->where('diskon.awal_diskon <=', $tanggal);
      $this->db->where('diskon.akhir_diskon >=', $tanggal);
      $this->db->order_by('diskon.id_diskon', 'DESC');
      if (isset($lapak)) {
         $this->db->where($lapak);
      }
      if (isset($limit)) {
         $this->db->limit($limit);
      }
      return $this->db->get();
   }

   // Data Produk Terlaris
   public function getProdukTerlaris($limit, $where)
   {
      $this->db->select('produk.kode_produk, produk.nm_produk, produk.harga_produk, kategori_produk.nm_kategori_produk, SUM(transaksi.jumlah_beli) as jumlah_belanja');
      $this->db->from('produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->join('reseler', 'reseler.id_user=produk.reseler');
      $this->db->join('transaksi', 'transaksi.kode_barang=produk.kode_produk');
      if (isset($where)) {
         $this->db->where($where);
      }
      $this->db->where('transaksi.status_transaksi', 4);
      $this->db->group_by('transaksi.kode_barang');
      $this->db->order_by('jumlah_belanja', 'DESC');
      if (isset($limit)) {
         $this->db->limit($limit);
      }
      return $this->db->get();
   }

   // Data Produk Per Kategori
   public function getProdukKategori($id, $not_like, $limit, $lapak)
   {
      $this->db->select('*');
      $this->db->from('produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->where('produk.kategori_produk', $id);
      if (isset($lapak)) {
         $this->db->where($lapak);
      }
      if (isset($not_like)) {
         $this->db->not_like($not_like);
      }
      if (isset($limit)) {
         $this->db->limit($limit);
      }
      $this->db->order_by('id_produk', 'DESC');
      return $this->db->get();
   }

   // Data Keranjang
   public function getKeranjang($costumer, $reseler)
   {
      $this->db->select('*');
      $this->db->from('keranjang');
      $this->db->join('produk', 'produk.kode_produk=keranjang.kode_produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->where('keranjang.costumer', $costumer);
      $this->db->where('keranjang.reseler', $reseler);
      return $this->db->get();
   }

   // Data Reseler Dalam Keranjang
   public function getCartReseler($id)
   {
      $this->db->select('*');
      $this->db->from('keranjang');
      $this->db->join('reseler', 'reseler.id_user=keranjang.reseler');
      $this->db->join('toko', 'toko.reseler=reseler.id_user');
      $this->db->where('keranjang.costumer', $id);
      $this->db->group_by('keranjang.reseler');
      return $this->db->get();
   }

   // Data Total Harga Keranjang
   public function getCartCount($id)
   {
      $this->db->select('SUM(keranjang.qty*keranjang.harga_produk) as total_harga');
      $this->db->from('keranjang');
      $this->db->where('costumer', $id);
      return $this->db->get();
   }

   // Data Rand Produk
   public function getRandProduk($limit)
   {
      $this->db->select('*');
      $this->db->from('produk');
      $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.kategori_produk');
      $this->db->order_by('rand()');
      if (isset($limit)) {
         $this->db->limit($limit);
      }
      return $this->db->get();
   }
}
