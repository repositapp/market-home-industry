<?php

class M_ongkir extends CI_Model
{
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

   // Data Ongkir Wilayah
   public function getWilOngkir()
   {
      $this->db->select('*');
      $this->db->from('ongkir');
      $this->db->join('kelurahan', 'kelurahan.id_kelurahan=ongkir.wilayah');
      $this->db->join('kecamatan', 'kecamatan.id_kecamatan=kelurahan.id_kecamatan');
      $this->db->join('kota', 'kota.id_kota=kecamatan.id_kota');
      $this->db->order_by('id_ongkir', 'DESC');
      return $this->db->get()->result_array();
   }
}
