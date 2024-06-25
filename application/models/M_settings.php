<?php

class M_settings extends CI_Model
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
}
