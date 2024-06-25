<?php

class M_home extends CI_Model
{
   // Data User
   public function getAdmin($id)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('admin', 'admin.id_user=user.id_user');
      $this->db->where('user.id_user', $id);
      return $this->db->get()->row_array();
   }

   public function getData($tabel, $where)
   {
      if (isset($where)) {
         $this->db->where($where);
      }
      return $this->db->get($tabel);
   }

   // Data Order Detail
   public function getNotif($sts)
   {
      $this->db->select('invoice, COUNT(invoice) as total');
      $this->db->from('transaksi');
      $this->db->where('status_transaksi', $sts);
      // $this->db->group_by('invoice');
      return $this->db->get()->row_array();
   }
}
