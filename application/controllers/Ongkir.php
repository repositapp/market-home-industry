<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends CI_Controller
{
   public function ongkir_wilayah()
   {
      $data['title'] = 'Master Data';
      $data['menu'] = 'Data Ongkos Kirim Per Wilayah';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'ongkir/ongkir_wilayah';
      $data['data_kelurahan'] = $this->m_wilayah->getAllKelurahan();
      $data['data_ongkir'] = $this->m_ongkir->getWilOngkir();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/master/ongkir_wilayah');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {

         $insertOngkir = [
            'wilayah' => $this->input->post('wilayah'),
            'harga_ongkir' => $this->input->post('harga_ongkir')
         ];

         $this->m_ongkir->insertData('ongkir', $insertOngkir, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('ongkir/ongkir_wilayah');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_ongkir = $this->input->post('id_ongkir');

         $updateOngkir = [
            'wilayah' => $this->input->post('wilayah'),
            'harga_ongkir' => $this->input->post('harga_ongkir')
         ];

         $whereOngkir = array(
            "id_ongkir" => $id_ongkir
         );

         $this->m_ongkir->insertData('ongkir', $updateOngkir, $whereOngkir);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('ongkir/ongkir_wilayah');
      }
   }

   public function hapus_ongkir_wilayah($id)
   {
      $this->m_ongkir->deleteData('ongkir', array('id_ongkir' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('ongkir/ongkir_wilayah');
   }

   public function ongkir_jasa()
   {
      $data['title'] = 'Master Data';
      $data['menu'] = 'Data Ongkos Kirim Per Jasa';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'ongkir/ongkir_jasa';
      $data['data_ongkir'] = $this->m_ongkir->getData('ongkir_jasa', null, 'id_ongkir_jasa', null);
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/master/ongkir_jasa');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $cek_ongkir = $this->db->get_where('ongkir_jasa', array('jasa_pengiriman' => $this->input->post('jasa_pengiriman')));;

         if ($cek_ongkir->num_rows() == 0) {
            $insertOngkir = [
               'jasa_pengiriman' => $this->input->post('jasa_pengiriman'),
               'harga_perkilo' => $this->input->post('harga_perkilo')
            ];

            $where = null;
         } else if ($cek_ongkir->num_rows() > 0) {
            $insertOngkir = [
               'harga_perkilo' => $this->input->post('harga_perkilo')
            ];

            $where = array(
               "jasa_pengiriman" =>  $this->input->post('jasa_pengiriman')
            );
         }

         $this->m_ongkir->insertData('ongkir_jasa', $insertOngkir, $where);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('ongkir/ongkir_jasa');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_ongkir_jasa = $this->input->post('id_ongkir_jasa');

         $updateOngkir = [
            'jasa_pengiriman' => $this->input->post('jasa_pengiriman'),
            'harga_perkilo' => $this->input->post('harga_perkilo')
         ];

         $whereOngkir = array(
            "id_ongkir_jasa" => $id_ongkir_jasa
         );

         $this->m_ongkir->insertData('ongkir_jasa', $updateOngkir, $whereOngkir);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('ongkir/ongkir_jasa');
      }
   }

   public function hapus_ongkir_jasa($id)
   {
      $this->m_ongkir->deleteData('ongkir_jasa', array('id_ongkir_jasa' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('ongkir/ongkir_jasa');
   }
}
