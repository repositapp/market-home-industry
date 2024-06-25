<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
   // Data Admin
   public function data_admin()
   {
      $data['title'] = 'User';
      $data['menu'] = 'Data Admin';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'user/data_admin/';
      $data['data_admin'] = $this->m_user->getAllAdmin($this->session->userdata('id_user'));
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/user/admin');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $this->_addAkun();
         $this->_addBioAdmin();
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('user/data_admin');
      }
   }

   public function hapus_admin($id)
   {
      $admin = $this->db->get_where('admin', ['id_user' => $id])->row_array();

      $old_image = $admin['foto_admin'];
      if ($old_image != 'default.png') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $where = array('id_user' => $id);
      $this->m_user->deleteData('admin', $where);
      $this->m_user->deleteData('user', $where);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('user/data_admin');
   }

   // Page Settings Profil
   public function admin_profile()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'Data Profil Admin';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'user/admin_profil/';
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_home->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/settings/profil');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('ubah_data') == 'ubahBiodata') {
         $id_user = $this->input->post('id_user');

         $updateBioAdmin = [
            'nm_admin' => $this->input->post('nm_admin'),
            'jk_admin' => $this->input->post('jk_admin'),
            'telp_admin' => $this->input->post('telp_admin'),
            'email_admin' => $this->input->post('email_admin'),
            'alamat_admin' => $this->input->post('alamat_admin'),
            'change_admin' => $this->input->post('change_admin')
         ];

         $whereBioAdmin = array(
            "id_user" => $id_user
         );

         $this->m_user->insertData('admin', $updateBioAdmin, $whereBioAdmin);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('user/admin_profile');
      }

      if ($this->input->post('ubah_data') == 'ubahPassword') {
         $id_user = $this->input->post('id_user');
         $old_password = $this->input->post('old_password');

         $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

         if ($user) {
            if (password_verify($old_password, $user['password'])) {
               $updatePassAdmin = [
                  'password' =>  password_hash($this->input->post('new_password'), PASSWORD_DEFAULT),
                  'change_user' =>  $this->input->post('change_user')
               ];

               $wherePassAdmin = array(
                  "id_user" => $id_user
               );

               $this->m_user->insertData('user', $updatePassAdmin, $wherePassAdmin);
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Password telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
               redirect('user/admin_profile');
            } else {
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Gagal !",text: "Password salah..",position: "top-right",loaderBg: "#fff",icon: "error",hideAfter: 5000,stack: 1});});');
               redirect('user/admin_profile');
            }
         }
      }

      if ($this->input->post('ubah_data') == 'ubahGambar') {
         $id_user = $this->input->post('id_user');
         $old_image = $this->input->post('old_image');
         $foto_admin = $_FILES['foto_admin'];

         if ($old_image != 'default.png') {
            unlink(FCPATH . 'assets/upload/' . $old_image);
         }

         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto_admin')) {
            $foto_admin = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }

         $updateGbrAdmin = [
            'foto_admin' => $foto_admin,
            'change_admin' =>  $this->input->post('change_admin')
         ];

         $whereGbrAdmin = array(
            "id_user" => $id_user
         );

         $this->m_user->insertData('admin', $updateGbrAdmin, $whereGbrAdmin);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Foto telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('user/admin_profile');
      }
   }

   // Data Costumer
   public function data_costumer()
   {
      $data['title'] = 'User';
      $data['menu'] = 'Data Costumer';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'user/data_costumer/';
      $data['data_costumer'] = $this->m_user->getAllCostumer();
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/user/costumer');
      $this->load->view('adm/templates/footer', $data);
   }

   // Data Detail Costumer
   public function detail_costumer($id)
   {
      $data['title'] = 'User';
      $data['menu'] = 'Data Costumer';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Detail Costumer';
      $data['menu_link'] = 'user/data_costumer/';
      $data['costumer'] = $this->m_user->getViewCostumer($id);
      $data['data_transaksi'] = $this->m_transaksi->getShopCostumer($id);
      $data['data_alamat'] = $this->m_user->getLifeCostumer($id);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/user/detail_costumer');
      $this->load->view('adm/templates/footer', $data);
   }

   public function hapus_costumer($id)
   {
      $costumer = $this->db->get_where('costumer', ['id_user' => $id])->row_array();

      $old_image = $costumer['foto_costumer'];
      if ($old_image != 'default.png') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $this->m_user->deleteData('costumer', array('id_user' => $id));
      $this->m_user->deleteData('user', array('id_user' => $id));
      $this->m_user->deleteData('alamat_costumer', array('costumer' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('user/data_costumer');
   }

   // Data Reseler
   public function data_reseler()
   {
      $data['title'] = 'User';
      $data['menu'] = 'Data Reseler';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'user/data_reseler/';
      $data['data_reseler'] = $this->m_user->getAllReseler()->result_array();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/user/reseler');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('ubah_data') == 'ubahStatus') {
         $id_user = $this->input->post('id_user');

         $updateStsToko = [
            'status_toko' => $this->input->post('status_toko'),
            'change_toko' => $this->input->post('change_user')
         ];

         $whereStsToko = array(
            "reseler" => $id_user
         );

         $this->m_user->insertData('toko', $updateStsToko, $whereStsToko);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Status telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('user/data_reseler');
      }
   }

   // Data Detail Reseler
   public function detail_reseler($id)
   {
      $data['title'] = 'User';
      $data['menu'] = 'Data Reseler';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Detail Reseler';
      $data['menu_link'] = 'user/data_reseler/';
      $data['reseler'] = $this->m_user->getViewReseler($id);
      $data['data_produk'] = $this->m_produk->getProdukToko($id);
      $data['data_transaksi'] = $this->m_transaksi->getShopToko($id);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/user/detail_reseler');
      $this->load->view('adm/templates/footer', $data);
   }

   // Data Tambah Reseler
   public function tambah_reseler()
   {
      $data['title'] = 'User';
      $data['menu'] = 'Data Reseler';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Tambah Data';
      $data['menu_link'] = 'user/data_reseler/';
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/user/tambah_reseler');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $this->_addAkun();
         $this->_addBioReseler();
         $this->_addTokoReseler();
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('user/data_reseler');
      }
   }

   public function hapus_reseler($id)
   {
      $reseler = $this->db->get_where('reseler', ['id_user' => $id])->row_array();

      $old_image = $reseler['foto_reseler'];
      if ($old_image != 'default.png') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $this->m_user->deleteData('reseler', array('id_user' => $id));
      $this->m_user->deleteData('user', array('id_user' => $id));
      $this->m_user->deleteData('toko', array('reseler' => $id));
      $this->m_user->deleteData('produk', array('reseler' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('user/data_reseler');
   }

   public function data_kurir()
   {
      $data['title'] = 'User';
      $data['menu'] = 'Data Kurir';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'user/data_kurir/';
      $data['data_kurir'] = $this->m_user->getAllKurir();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_home->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/user/kurir');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $this->_addAkun();
         $this->_addBioKurir();
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('user/data_kurir');
      }
   }

   public function hapus_kurir($id)
   {
      $kurir = $this->db->get_where('kurir', ['id_user' => $id])->row_array();

      $old_image = $kurir['foto_kurir'];
      if ($old_image != 'default.png') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $this->m_user->deleteData('kurir', array('id_user' => $id));
      $this->m_user->deleteData('user', array('id_user' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('user/data_kurir');
   }

   // Data Pilihan Toko Untuk Costumer
   public function market()
   {
      $data['title'] = 'Market';
      $data['menu'] = 'None';
      $data['sub_nums'] = '0';
      $data['data_reseler'] = $this->m_user->getToko();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/market');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Detail Toko Costumer
   public function detail_market($id)
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggal = date("Y-m-d");

      $data['title'] = 'Market';
      $data['menu'] = 'None';
      $data['sub_nums'] = '2';
      $data['sub_menu'] = 'Toko';
      $data['menu_link'] = 'javascript:window.history.go(-1);';

      $data['reseler'] = $this->m_user->getViewReseler($id);
      $data['data_terlaris'] = $this->m_produk->getProdukTerlaris(null, array('produk.reseler' => $id));
      $data['data_diskon'] = $this->m_produk->getProdukDiskon($tanggal, null, array('produk.reseler' => $id));
      $data['data_produk'] = $this->m_produk->getProdukToko($id);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] =  $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/toko/detail_market');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Profil Costumer
   public function costumer_profile()
   {
      $data['title'] = 'Profil Costumer';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Profil';
      $data['menu_link'] = base_url('settings/costumer_settings/');
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/setting/profil');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_image = $this->input->post('old_image');
         $foto_costumer = $_FILES['foto_costumer'];

         if ($this->input->post('ubah_gambar')) {
            if ($old_image != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_image);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_costumer')) {
               $foto_costumer = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $foto_costumer = $old_image;
         }

         $updateBioCostumer = [
            'nm_costumer' => $this->input->post('nm_costumer'),
            'jk_costumer' => $this->input->post('jk_costumer'),
            'telp_costumer' => $this->input->post('telp_costumer'),
            'email_costumer' => $this->input->post('email_costumer'),
            'foto_costumer' => $foto_costumer
         ];

         $whereBioCostumer = array(
            "id_user" => $id_user
         );

         $this->m_user->insertData('costumer', $updateBioCostumer, $whereBioCostumer);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Biodata Terupdate",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
         redirect('user/costumer_profile');
      }
   }

   // Data Akun Costumer
   public function costumer_akun()
   {
      $data['title'] = 'Akun Costumer';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Akun';
      $data['menu_link'] = base_url('settings/costumer_settings/');
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/setting/akun');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_password = $this->input->post('old_password');

         $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

         if ($user) {
            if (password_verify($old_password, $user['password'])) {
               $updatePass = [
                  'password' =>  password_hash($this->input->post('new_password'), PASSWORD_DEFAULT)
               ];

               $wherePass = array(
                  "id_user" => $id_user
               );

               $this->m_user->insertData('user', $updatePass, $wherePass);
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Password Berubah",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
               redirect('user/costumer_akun');
            } else {
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Password Salah",position: "top-center",loaderBg: "#fff",icon: "error",hideAfter: 3000,stack: 1});});');
               redirect('user/costumer_akun');
            }
         }
      }
   }

   // Data Alamat Costumer
   public function costumer_alamat()
   {
      $data['title'] = 'Alamat Costumer';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Alamat';
      if ($this->uri->segment('3') == 0) {
         $data['menu_link'] = base_url('settings/costumer_settings/');
      } elseif ($this->uri->segment('3') == 1) {
         $data['menu_link'] = base_url('transaksi/checkout_delivery/');
      }
      $data['data_alamat'] = $this->m_user->getLifeCostumer($this->session->userdata('id_user'));
      $data['data_wilayah'] = $this->m_wilayah->getAllKelurahan();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/setting/alamat');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $cek = $this->m_user->getData('alamat_costumer', array('costumer' => $this->session->userdata('id_user')), 'id_alamat', null)->row_array();

         if ($cek['tipe_alamat'] == $this->input->post('tipe_alamat')) {
            $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Tipe Sudah Ada",position: "top-center",loaderBg: "#fff",icon: "error",hideAfter: 3000,stack: 1});});');
            redirect('user/costumer_alamat');
         } else {
            if ($this->input->post('status_alamat')) {
               $cek2 = $this->m_user->getData('alamat_costumer', array('costumer' => $this->session->userdata('id_user'), 'status_alamat' => 1), 'id_alamat', null)->row_array();

               $update = [
                  'status_alamat' => 0
               ];

               $where = array(
                  "id_alamat" => $cek2['id_alamat']
               );

               $this->m_produk->insertData('alamat_costumer', $update, $where);

               $status = 1;
            } else {
               $status = 0;
            }
            $insertAlamat = [
               'costumer' => $this->session->userdata('id_user'),
               'nama_alamat' => $this->input->post('nama_alamat'),
               'wilayah' => $this->input->post('wilayah'),
               'detail_alamat' => $this->input->post('detail_alamat'),
               'telp_alamat' => $this->input->post('telp_alamat'),
               'tipe_alamat' => $this->input->post('tipe_alamat'),
               'status_alamat' =>  $status
            ];

            $data = $this->m_user->insertData('alamat_costumer', $insertAlamat, null);
            $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Alamat Bertambah",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
            redirect('user/costumer_alamat/' . $this->uri->segment('3'));
         }
      }
   }

   public function costumer_ubah_alamat()
   {
      $id_alamat = $this->input->post('id_alamat');

      if ($this->input->post('status_alamat')) {
         $cek2 = $this->m_user->getData('alamat_costumer', array('costumer' => $this->session->userdata('id_user'), 'status_alamat' => 1), 'id_alamat', null)->row_array();

         $update = [
            'status_alamat' => 0
         ];

         $where = array(
            "id_alamat" => $cek2['id_alamat']
         );

         $this->m_produk->insertData('alamat_costumer', $update, $where);

         $status = 1;
      } else {
         $status = 0;
      }

      $updateAlamat = [
         'costumer' => $this->session->userdata('id_user'),
         'nama_alamat' => $this->input->post('nama_alamat'),
         'wilayah' => $this->input->post('wilayah'),
         'detail_alamat' => $this->input->post('detail_alamat'),
         'telp_alamat' => $this->input->post('telp_alamat'),
         'tipe_alamat' => $this->input->post('tipe_alamat'),
         'status_alamat' =>  $status
      ];

      $whereAlamat = array(
         "id_alamat" => $id_alamat
      );

      $this->m_user->insertData('alamat_costumer', $updateAlamat, $whereAlamat);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Alamat Telah Diubah",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
      redirect('user/costumer_alamat/' . $this->uri->segment('3'));
   }

   public function hapus_alamat()
   {
      $this->m_produk->deleteData('alamat_costumer', array('id_alamat' => $this->uri->segment('3')));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Alamat Telah Dihapus",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
      redirect('user/costumer_alamat/' . $this->uri->segment('4'));
   }

   // Data Profil Reseler
   public function reseler_profile()
   {
      $data['title'] = 'Profil Reseler';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Profil';
      $data['menu_link'] = base_url('settings/reseler_settings');
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/pengaturan/profil');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_image = $this->input->post('old_image');
         $foto_reseler = $_FILES['foto_reseler'];

         if ($this->input->post('ubah_gambar')) {
            if ($old_image != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_image);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_reseler')) {
               $foto_reseler = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $foto_reseler = $old_image;
         }

         $updateBioReseler = [
            'nik_reseler' => $this->input->post('nik_reseler'),
            'nm_reseler' => $this->input->post('nm_reseler'),
            'telp_reseler' => $this->input->post('telp_reseler'),
            'email_reseler' => $this->input->post('email_reseler'),
            'jk_reseler' => $this->input->post('jk_reseler'),
            'alamat_reseler' => $this->input->post('alamat_reseler'),
            'foto_reseler' => $foto_reseler,
            'change_reseler' => $data['tanggalwaktu']
         ];

         $whereBioReseler = array(
            "id_user" => $id_user
         );

         $this->m_user->insertData('reseler', $updateBioReseler, $whereBioReseler);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Biodata Terupdate",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
         redirect('user/reseler_profile');
      }
   }

   // Data Profil Toko Reseler
   public function reseler_profile_toko()
   {
      $data['title'] = 'Toko';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Profil Toko';
      $data['menu_link'] = base_url('settings/reseler_settings');
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['toko'] = $this->m_transaksi->getData('toko', array('reseler' => $this->session->userdata('id_user')), 'id_toko', null)->row_array();
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/pengaturan/toko');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_toko = $this->input->post('id_toko');

         $old_izin_usaha = $this->input->post('old_izin_usaha');
         $izin_usaha = $_FILES['izin_usaha'];

         if ($this->input->post('ubah_izin_usaha')) {
            if ($old_izin_usaha != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_izin_usaha);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('izin_usaha')) {
               $izin_usaha = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $izin_usaha = $old_izin_usaha;
         }

         $old_foto_ktp = $this->input->post('old_foto_ktp');
         $foto_ktp = $_FILES['foto_ktp'];

         if ($this->input->post('ubah_foto_ktp')) {
            if ($old_foto_ktp != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_foto_ktp);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_ktp')) {
               $foto_ktp = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $foto_ktp = $old_foto_ktp;
         }

         $old_logo_toko = $this->input->post('old_logo_toko');
         $logo_toko = $_FILES['logo_toko'];

         if ($this->input->post('ubah_logo_toko')) {
            if ($old_logo_toko != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_logo_toko);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo_toko')) {
               $logo_toko = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $logo_toko = $old_logo_toko;
         }

         $updateToko = [
            'nm_toko' => $this->input->post('nm_toko'),
            'alamat_toko' => $this->input->post('alamat_toko'),
            'email_toko' => $this->input->post('email_toko'),
            'telp_toko' => $this->input->post('telp_toko'),
            'izin_usaha' => $izin_usaha,
            'foto_ktp' => $foto_ktp,
            'logo_toko' => $logo_toko,
            'change_toko' => $data['tanggalwaktu']
         ];

         $whereToko = array(
            "id_toko" => $id_toko
         );

         $this->m_user->insertData('toko', $updateToko, $whereToko);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Biodata Terupdate",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
         redirect('user/reseler_profile_toko');
      }
   }

   // Data Toko Baru Reseler
   public function reseler_toko_baru($id)
   {
      $data['title'] = 'Toko';
      $data['menu'] = 'None';
      $data['sub_nums'] = '4';
      $data['sub_menu'] = 'Tambah Data Toko';
      $data['user'] = $this->m_user->getData('user', array('id_user' => $id), 'id_user', null)->row_array();

      $this->load->view('reseler/templates/header_regis', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/pengaturan/toko_baru');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         date_default_timezone_set('Asia/Makassar');
         $data['tanggalwaktu'] = date("Y-m-d H:i:s");

         $izin_usaha = $_FILES['izin_usaha'];
         if ($izin_usaha) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('izin_usaha')) {
               $izin_usaha = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $foto_ktp = $_FILES['foto_ktp'];
         if ($foto_ktp) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_ktp')) {
               $foto_ktp = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $logo_toko = $_FILES['logo_toko'];
         if ($logo_toko) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|ico';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo_toko')) {
               $logo_toko = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $insertTokoReseler = [
            'reseler' => $data['user']['id_user'],
            'nm_toko' => $this->input->post('nm_toko'),
            'alamat_toko' => $this->input->post('alamat_toko'),
            'email_toko' => $this->input->post('email_toko'),
            'telp_toko' => $this->input->post('telp_toko'),
            'izin_usaha' => $izin_usaha,
            'foto_ktp' => $foto_ktp,
            'logo_toko' => $logo_toko,
            'status_toko' => 1,
            'change_toko' => $data['tanggalwaktu']
         ];

         $this->m_user->insertData('toko', $insertTokoReseler, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Toko Ditambahkan",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
         redirect('auth/login_user');
      }
   }

   // Data Akun Reseler
   public function reseler_akun()
   {
      $data['title'] = 'Akun Reseler';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Akun';
      $data['menu_link'] = base_url('settings/reseler_settings');
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/pengaturan/akun');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_password = $this->input->post('old_password');

         $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

         if ($user) {
            if (password_verify($old_password, $user['password'])) {
               $updatePass = [
                  'password' =>  password_hash($this->input->post('new_password'), PASSWORD_DEFAULT)
               ];

               $wherePass = array(
                  "id_user" => $id_user
               );

               $this->m_user->insertData('user', $updatePass, $wherePass);
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Password Berubah",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
               redirect('user/reseler_akun');
            } else {
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Password Salah",position: "top-center",loaderBg: "#fff",icon: "error",hideAfter: 3000,stack: 1});});');
               redirect('user/reseler_akun');
            }
         }
      }
   }

   // Data Profil Kurir
   public function kurir_profile()
   {
      $data['title'] = 'Profil Kurir';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Profil';
      $data['menu_link'] = base_url('settings/kurir_settings');
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getKurir($this->session->userdata('id_user'));

      $this->load->view('kurir/templates/header', $data);
      $this->load->view('kurir/templates/topbar', $data);
      $this->load->view('kurir/templates/sidebar', $data);
      $this->load->view('kurir/profil');
      $this->load->view('kurir/templates/menu', $data);
      $this->load->view('kurir/templates/footer', $data);
      $this->load->view('kurir/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_image = $this->input->post('old_image');
         $foto_kurir = $_FILES['foto_kurir'];

         if ($this->input->post('ubah_gambar')) {
            if ($old_image != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_image);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_kurir')) {
               $foto_kurir = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $foto_kurir = $old_image;
         }

         $updateBioKurir = [
            'nm_kurir' => $this->input->post('nm_kurir'),
            'jk_kurir' => $this->input->post('jk_kurir'),
            'telp_kurir' => $this->input->post('telp_kurir'),
            'email_kurir' => $this->input->post('email_kurir'),
            'alamat_kurir' => $this->input->post('alamat_kurir'),
            'foto_kurir' => $foto_kurir,
            'change_kurir' => $data['tanggalwaktu']
         ];

         $whereBioKurir = array(
            "id_user" => $id_user
         );

         $this->m_user->insertData('kurir', $updateBioKurir, $whereBioKurir);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Biodata Terupdate",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
         redirect('user/kurir_profile');
      }
   }

   // Data Akun Kurir
   public function kurir_akun()
   {
      $data['title'] = 'Akun Kurir';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Akun';
      $data['menu_link'] = base_url('settings/kurir_settings');
      $data['user'] = $this->m_user->getKurir($this->session->userdata('id_user'));

      $this->load->view('kurir/templates/header', $data);
      $this->load->view('kurir/templates/topbar', $data);
      $this->load->view('kurir/templates/sidebar', $data);
      $this->load->view('kurir/akun');
      $this->load->view('kurir/templates/menu', $data);
      $this->load->view('kurir/templates/footer', $data);
      $this->load->view('kurir/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_user = $this->input->post('id_user');
         $old_password = $this->input->post('old_password');

         $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

         if ($user) {
            if (password_verify($old_password, $user['password'])) {
               $updatePass = [
                  'password' =>  password_hash($this->input->post('new_password'), PASSWORD_DEFAULT)
               ];

               $wherePass = array(
                  "id_user" => $id_user
               );

               $this->m_user->insertData('user', $updatePass, $wherePass);
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Password Berubah",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 3000,stack: 1});});');
               redirect('user/kurir_akun');
            } else {
               $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Password Salah",position: "top-center",loaderBg: "#fff",icon: "error",hideAfter: 3000,stack: 1});});');
               redirect('user/kurir_akun');
            }
         }
      }
   }

   // Block And Unblock Akun
   public function akun_status($id)
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");

      $user_cek = $this->db->get_where('user', ['id_user' => $id])->row_array();
      if ($user_cek['sts_akun'] == 1) {
         $status = 0;
      } elseif ($user_cek['sts_akun'] == 0) {
         $status = 1;
      }

      $update = [
         'sts_akun' => $status,
         'change_user' => $tanggalwaktu
      ];

      $where = array(
         "id_user" => $id
      );

      $this->m_user->insertData('user', $update, $where);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diupdate..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      if ($user_cek['akses'] == 1) {
         redirect('user/data_admin');
      } elseif ($user_cek['akses'] == 2) {
         redirect('user/data_reseler');
      } elseif ($user_cek['akses'] == 3) {
         redirect('user/data_costumer');
      } elseif ($user_cek['akses'] == 4) {
         redirect('user/data_kurir');
      }
   }

   // Add Akun
   private function _addAkun()
   {
      $insertAkun = [
         'username' => $this->input->post('username'),
         'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
         'akses' => $this->input->post('akses'),
         'sts_akun' => 1,
         'change_user' => $this->input->post('change_user')
      ];

      $this->m_user->insertData('user', $insertAkun, null);
   }

   private function _addBioAdmin()
   {
      $user = $this->m_user->getData('user', null, 'id_user', 1)->row_array();

      $foto_admin = $_FILES['foto_admin'];
      if ($foto_admin) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto_admin')) {
            $foto_admin = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      $insertBioAdmin = [
         'id_user' => $user['id_user'],
         'nm_admin' => $this->input->post('nm_admin'),
         'jk_admin' => $this->input->post('jk_admin'),
         'telp_admin' => $this->input->post('telp_admin'),
         'email_admin' => $this->input->post('email_admin'),
         'alamat_admin' => $this->input->post('alamat_admin'),
         'foto_admin' => $foto_admin,
         'change_admin' => $this->input->post('change_user')
      ];

      $this->m_user->insertData('admin', $insertBioAdmin, null);
   }

   private function _addBioReseler()
   {
      $user = $this->m_user->getData('user', null, 'id_user', 1)->row_array();

      $foto_reseler = $_FILES['foto_reseler'];
      if ($foto_reseler) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto_reseler')) {
            $foto_reseler = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      $insertBioReseler = [
         'id_user' => $user['id_user'],
         'nik_reseler' => $this->input->post('nik_reseler'),
         'nm_reseler' => $this->input->post('nm_reseler'),
         'telp_reseler' => $this->input->post('telp_reseler'),
         'email_reseler' => $this->input->post('email_reseler'),
         'jk_reseler' => $this->input->post('jk_reseler'),
         'alamat_reseler' => $this->input->post('alamat_reseler'),
         'foto_reseler' => $foto_reseler,
         'change_reseler' => $this->input->post('change_user')
      ];

      $this->m_user->insertData('reseler', $insertBioReseler, null);
   }

   private function _addTokoReseler()
   {
      $user = $this->m_user->getData('user', null, 'id_user', 1)->row_array();

      $izin_usaha = $_FILES['izin_usaha'];
      if ($izin_usaha) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('izin_usaha')) {
            $izin_usaha = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      $foto_ktp = $_FILES['foto_ktp'];
      if ($foto_ktp) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto_ktp')) {
            $foto_ktp = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      $logo_toko = $_FILES['logo_toko'];
      if ($logo_toko) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg|ico';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('logo_toko')) {
            $logo_toko = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      $insertTokoReseler = [
         'reseler' => $user['id_user'],
         'nm_toko' => $this->input->post('nm_toko'),
         'alamat_toko' => $this->input->post('alamat_toko'),
         'maps_toko' => $this->input->post('maps_toko'),
         'email_toko' => $this->input->post('email_toko'),
         'telp_toko' => $this->input->post('telp_toko'),
         'izin_usaha' => $izin_usaha,
         'foto_ktp' => $foto_ktp,
         'logo_toko' => $logo_toko,
         'status_toko' => 1,
         'change_toko' => $this->input->post('change_user')
      ];

      $this->m_user->insertData('toko', $insertTokoReseler, null);
   }

   private function _addBioKurir()
   {
      $user = $this->m_user->getData('user', null, 'id_user', 1)->row_array();

      $foto_kurir = $_FILES['foto_kurir'];
      if ($foto_kurir) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto_kurir')) {
            $foto_kurir = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      $insertBioKurir = [
         'id_user' => $user['id_user'],
         'nm_kurir' => $this->input->post('nm_kurir'),
         'jk_kurir' => $this->input->post('jk_kurir'),
         'telp_kurir' => $this->input->post('telp_kurir'),
         'email_kurir' => $this->input->post('email_kurir'),
         'alamat_kurir' => $this->input->post('alamat_kurir'),
         'foto_kurir' => $foto_kurir,
         'status_kurir' => 0,
         'change_kurir' => $this->input->post('change_user')
      ];

      $this->m_user->insertData('kurir', $insertBioKurir, null);
   }
}
