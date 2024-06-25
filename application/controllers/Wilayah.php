<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
   public function kota()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'Wilayah';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Kota';
      $data['menu_link'] = 'wilayah/kota';
      $data['data_kota'] = $this->m_wilayah->getData('kota', null, 'id_kota', null);
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/settings/kota');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {

         $insertKota = [
            'nm_kota' => $this->input->post('nm_kota')
         ];

         $this->m_wilayah->insertData('kota', $insertKota, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('wilayah/kota');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_kota = $this->input->post('id_kota');

         $updateKota = [
            'nm_kota' => $this->input->post('nm_kota')
         ];

         $whereKota = array(
            "id_kota" => $id_kota
         );

         $this->m_wilayah->insertData('kota', $updateKota, $whereKota);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('wilayah/kota');
      }
   }

   public function hapus_kota($id)
   {
      $this->m_wilayah->deleteData('kota', array('id_kota' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('wilayah/kota');
   }

   public function kecamatan()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'Wilayah';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Kecamatan';
      $data['menu_link'] = 'wilayah/kecamatan';
      $data['data_kota'] = $this->m_wilayah->getData('kota', null, 'id_kota', null);
      $data['data_kecamatan'] = $this->m_wilayah->getAllKecamatan();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/settings/kecamatan');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {

         $insertKecamatan = [
            'id_kota' => $this->input->post('id_kota'),
            'nm_kecamatan' => $this->input->post('nm_kecamatan')
         ];

         $this->m_wilayah->insertData('kecamatan', $insertKecamatan, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('wilayah/kecamatan');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_kecamatan = $this->input->post('id_kecamatan');

         $updateKecamatan = [
            'id_kota' => $this->input->post('id_kota'),
            'nm_kecamatan' => $this->input->post('nm_kecamatan')
         ];

         $whereKecamatan = array(
            "id_kecamatan" => $id_kecamatan
         );

         $this->m_wilayah->insertData('kecamatan', $updateKecamatan, $whereKecamatan);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('wilayah/kecamatan');
      }
   }

   public function hapus_kecamatan($id)
   {
      $this->m_wilayah->deleteData('kecamatan', array('id_kecamatan' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('wilayah/kecamatan');
   }

   public function kelurahan()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'Wilayah';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Kelurahan';
      $data['menu_link'] = 'wilayah/kelurahan';
      $data['data_kecamatan'] = $this->m_wilayah->getAllKecamatan();
      $data['data_kelurahan'] = $this->m_wilayah->getAllKelurahan();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/settings/kelurahan');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {

         $insertKelurahan = [
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'nm_kelurahan' => $this->input->post('nm_kelurahan')
         ];

         $this->m_wilayah->insertData('kelurahan', $insertKelurahan, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('wilayah/kelurahan');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_kelurahan = $this->input->post('id_kelurahan');

         $updateKelurahan = [
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'nm_kelurahan' => $this->input->post('nm_kelurahan')
         ];

         $whereKelurahan = array(
            "id_kelurahan" => $id_kelurahan
         );

         $this->m_wilayah->insertData('kelurahan', $updateKelurahan, $whereKelurahan);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('wilayah/kelurahan');
      }
   }

   public function hapus_kelurahan($id)
   {
      $this->m_wilayah->deleteData('kelurahan', array('id_kelurahan' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('wilayah/kelurahan');
   }
}
