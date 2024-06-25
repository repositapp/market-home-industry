<?php

class M_wilayah extends CI_Model
{
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

   // Data Kecamatan
   public function getAllKecamatan()
   {
      $this->db->select('*');
      $this->db->from('kecamatan');
      $this->db->join('kota', 'kota.id_kota=kecamatan.id_kota');
      $this->db->order_by('id_kecamatan', 'DESC');
      return $this->db->get()->result_array();
   }

   // Data Kelurahan
   public function getAllKelurahan()
   {
      $this->db->select('*');
      $this->db->from('kelurahan');
      $this->db->join('kecamatan', 'kecamatan.id_kecamatan=kelurahan.id_kecamatan');
      $this->db->join('kota', 'kota.id_kota=kecamatan.id_kota');
      $this->db->order_by('id_kelurahan', 'DESC');
      return $this->db->get()->result_array();
   }
}
