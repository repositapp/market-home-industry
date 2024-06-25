<?php

class M_user extends CI_Model
{
   // Bio Admin Aktif
   public function getAdmin($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('admin', 'admin.id_user=user.id_user');
      $this->db->where('user.id_user', $id);
      return $this->db->get()->row_array();
   }

   // Get, Insert, Update, Deleted Data All
   public function getData($tabel, $where, $id, $limit)
   {
      if (isset($where)) {
         $this->db->where($where);
      }
      if (isset($limit)) {
         $this->db->limit($limit);
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

   // Data Admin
   public function getAllAdmin($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('admin', 'admin.id_user=user.id_user');
      $this->db->not_like('user.id_user', $id);
      $this->db->order_by('user.id_user', 'DESC');
      return $this->db->get()->result_array();
   }

   // Data Costumer
   public function getAllCostumer()
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('costumer', 'costumer.id_user=user.id_user');
      $this->db->where('user.akses', 3);
      $this->db->order_by('user.id_user', 'DESC');
      return $this->db->get()->result_array();
   }

   // Data Detail Costumer
   public function getViewCostumer($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('costumer', 'costumer.id_user=user.id_user');
      $this->db->where('user.id_user', $id);
      return $this->db->get()->row_array();
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
      return $this->db->get();
   }

   // Data Reseler
   public function getAllReseler()
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('reseler', 'reseler.id_user=user.id_user');
      $this->db->join('toko', 'toko.reseler=user.id_user');
      $this->db->where('user.akses', 2);
      $this->db->order_by('user.id_user', 'DESC');
      return $this->db->get();
   }

   // Data Detail Reseler
   public function getViewReseler($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('reseler', 'reseler.id_user=user.id_user');
      $this->db->join('toko', 'toko.reseler=user.id_user');
      $this->db->where('user.id_user', $id);
      return $this->db->get()->row_array();
   }

   // Data Toko Reseler
   public function getToko()
   {
      $this->db->select('*');
      $this->db->from('toko');
      $this->db->where('status_toko', 1);
      $this->db->order_by('id_toko', 'DESC');
      return $this->db->get();
   }

   // Data Kurir
   public function getAllKurir()
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('kurir', 'kurir.id_user=user.id_user');
      $this->db->order_by('user.id_user', 'DESC');
      return $this->db->get()->result_array();
   }

   // Bio Costumer Aktif
   public function getCostumer($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('costumer', 'costumer.id_user=user.id_user');
      $this->db->where('user.id_user', $id);
      return $this->db->get()->row_array();
   }

   // Bio Reseler Aktif
   public function getReseler($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('reseler', 'reseler.id_user=user.id_user');
      $this->db->join('toko', 'toko.reseler=user.id_user');
      $this->db->where('user.id_user', $id);
      return $this->db->get()->row_array();
   }

   // Bio Kurir Aktif
   public function getKurir($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('kurir', 'kurir.id_user=user.id_user');
      $this->db->where('user.id_user', $id);
      return $this->db->get()->row_array();
   }

   // Cek Kurir Pengirim
   public function getCekKurirPengirim()
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('kurir', 'kurir.id_user=user.id_user');
      $this->db->where('kurir.status_kurir', 0);
      $this->db->where('user.sts_akun', 1);
      return $this->db->get();
   }
}
