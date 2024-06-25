<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
   // Data Master Kategori Produk
   public function kategori_produk()
   {
      $data['title'] = 'Master Data';
      $data['menu'] = 'Data Kategori Produk';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'produk/kategori_produk';
      $data['data_kategori'] = $this->m_produk->getData('kategori_produk', null, 'id_kategori_produk', null);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/master/kategori_produk');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $gambar_kategori_produk = $_FILES['gambar_kategori_produk'];
         if ($gambar_kategori_produk) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar_kategori_produk')) {
               $gambar_kategori_produk = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $insertKp = [
            'nm_kategori_produk' => $this->input->post('nm_kategori_produk'),
            'gambar_kategori_produk' => $gambar_kategori_produk,
            'status_kategori_produk' => 1
         ];

         $this->m_produk->insertData('kategori_produk', $insertKp, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/kategori_produk');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_kategori_produk = $this->input->post('id_kategori_produk');
         $old_image = $this->input->post('old_image');
         $gambar_kategori_produk = $_FILES['gambar_kategori_produk'];

         if ($this->input->post('ubah_gambar')) {
            if ($old_image != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_image);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar_kategori_produk')) {
               $gambar_kategori_produk = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $gambar_kategori_produk = $old_image;
         }

         $updateKp = [
            'nm_kategori_produk' => $this->input->post('nm_kategori_produk'),
            'gambar_kategori_produk' => $gambar_kategori_produk,
            'status_kategori_produk' => $this->input->post('status_kategori_produk')
         ];

         $where = array(
            "id_kategori_produk" => $id_kategori_produk
         );

         $this->m_produk->insertData('kategori_produk', $updateKp, $where);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/kategori_produk');
      }
   }

   public function hapus_kategori_produk($id)
   {
      $gbr = $this->db->get_where('kategori_produk', ['id_kategori_produk' => $id])->row_array();

      $old_image = $gbr['gambar_kategori_produk'];
      if ($old_image != 'default.png') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $where = array('id_kategori_produk' => $id);
      $this->m_produk->deleteData('kategori_produk', $where);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('produk/kategori_produk');
   }

   // Data Master Produk
   public function data_produk()
   {
      $data['title'] = 'Master Data';
      $data['menu'] = 'Data Produk';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'produk/data_produk';
      $data['data_produk'] = $this->m_produk->getAllProduk(null);
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/master/produk/data_produk');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('ubah_data') == 'ubahStatus') {
         $id_produk = $this->input->post('id_produk');

         $updateStsProduk = [
            'status_produk' => $this->input->post('status_produk'),
            'change_produk' => $this->input->post('change_produk')
         ];

         $whereStsProduk = array(
            "id_produk" => $id_produk
         );

         $this->m_produk->insertData('produk', $updateStsProduk, $whereStsProduk);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Status telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/data_produk');
      }
   }

   public function tambah_produk()
   {
      $data['title'] = 'Master Data';
      $data['menu'] = 'Data Produk';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Tambah Data';
      $data['menu_link'] = 'produk/data_produk';
      $data['kode_produk'] = $this->m_produk->kodeProduk(10);
      $data['data_kategori'] = $this->m_produk->getData('kategori_produk', null, 'id_kategori_produk', null);
      $data['data_reseler'] = $this->m_produk->getData('reseler', null, 'id_reseler', null);
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/master/produk/add_produk');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {

         $insertProduk = [
            'reseler' => $this->input->post('reseler'),
            'kategori_produk' => $this->input->post('kategori_produk'),
            'kode_produk' => $this->input->post('kode_produk'),
            'nm_produk' => $this->input->post('nm_produk'),
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'harga_modal' => $this->input->post('harga_modal'),
            'stok' => $this->input->post('stok'),
            'ukuran_jual' => $this->input->post('ukuran_jual'),
            'satuan_jual' => $this->input->post('satuan_jual'),
            'berat' => $this->input->post('berat'),
            'status_produk' => 1,
            'change_produk' => $this->input->post('change_produk')
         ];

         $this->m_produk->insertData('produk', $insertProduk, null);
         $this->_postGambarProduk();
         if ($this->input->post('atribut_variasi')) {
            $this->_postVariasiProduk();
         }
         if ($this->input->post('atribut_lainnya')) {
            $this->_postAtributProduk();
         }
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/data_produk');
      }
   }

   private function _postGambarProduk()
   {
      $config['upload_path']   = './assets/upload/';
      $config['allowed_types'] = 'jpg|png|jpeg|mp4|avi|mkv|3gp|mgp|mpeg';
      $config['max_size']      = 15000;
      $config['encrypt_name']  = true;

      $this->load->library('upload', $config);
      $jumlah_berkas = count($_FILES['gambar_produk']['name']);

      for ($i = 0; $i < $jumlah_berkas; $i++) {
         if (!empty($_FILES['gambar_produk']['name'][$i])) {

            $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
            $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
            $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

            if ($this->upload->do_upload('file')) {

               $uploadData = $this->upload->data();

               $insertGbrProduk = [
                  'kode_produk' => $this->input->post('kode_produk'),
                  'gambar_produk' => $uploadData['file_name']
               ];

               $this->m_produk->insertData('gambar_produk', $insertGbrProduk, null);
            }
         }
      }
   }

   private function _postVariasiProduk()
   {
      $jumlah_stok = count($this->input->post('stok_variasi'));

      for ($i = 0; $i < $jumlah_stok; $i++) {
         if ($this->input->post('size')[$i] == "") {
            $size = 'none';
         } else {
            $size = $this->input->post('size')[$i];
         }

         if ($this->input->post('warna_rasa')[$i] == "") {
            $warna_rasa = 'none';
         } else {
            $warna_rasa = $this->input->post('warna_rasa')[$i];
         }

         $insertProdukVariasi = [
            'kode_produk' => $this->input->post('kode_produk'),
            'size' => $size,
            'warna_rasa' => $warna_rasa,
            'stok_variasi' => $this->input->post('stok_variasi')[$i]
         ];

         $this->m_produk->insertData('produk_variasi', $insertProdukVariasi, null);
      }
   }

   private function _postAtributProduk()
   {
      $jumlah_judul = count($this->input->post('judul_taribut'));

      for ($i = 0; $i < $jumlah_judul; $i++) {
         if ($this->input->post('judul_taribut')[$i] == "") {
            $judul_taribut = 'none';
         } else {
            $judul_taribut = $this->input->post('judul_taribut')[$i];
         }

         if ($this->input->post('isian_atribut')[$i] == "") {
            $isian_atribut = 'none';
         } else {
            $isian_atribut = $this->input->post('isian_atribut')[$i];
         }

         $insertProdukAtribut = [
            'kode_produk' => $this->input->post('kode_produk'),
            'judul_taribut' => $judul_taribut,
            'isian_atribut' => $isian_atribut
         ];

         $this->m_produk->insertData('produk_atribut', $insertProdukAtribut, null);
      }
   }

   public function detail_produk($kode)
   {
      $data['title'] = 'Master Data';
      $data['menu'] = 'Data Produk';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Detail Data';
      $data['menu_link'] = 'produk/data_produk';
      $data['produk'] = $this->m_produk->getDetailProduk($kode);
      $data['data_gambar'] = $this->m_produk->getData('gambar_produk', array('kode_produk' => $kode), 'id_gambar_produk', null);
      $data['data_variasi'] = $this->m_produk->getData('produk_variasi', array('kode_produk' => $kode), 'id_produk_variasi', null);
      $data['data_atribut'] = $this->m_produk->getData('produk_atribut', array('kode_produk' => $kode), 'id_produk_atribut', null);
      $data['data_kategori'] = $this->m_produk->getData('kategori_produk', null, 'id_kategori_produk', null);
      $data['data_reseler'] = $this->m_produk->getData('reseler', null, 'id_reseler', null);
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/master/produk/detail_produk');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('ubah_data') == 'ubahProduk') {
         $id_produk = $this->input->post('id_produk');

         $updateProduk = [
            'reseler' => $this->input->post('reseler'),
            'kategori_produk' => $this->input->post('kategori_produk'),
            'nm_produk' => $this->input->post('nm_produk'),
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'harga_modal' => $this->input->post('harga_modal'),
            'stok' => $this->input->post('stok'),
            'ukuran_jual' => $this->input->post('ukuran_jual'),
            'satuan_jual' => $this->input->post('satuan_jual'),
            'berat' => $this->input->post('berat'),
            'status_produk' => $this->input->post('status_produk'),
            'change_produk' => $this->input->post('change_produk')
         ];

         $whereProduk = array(
            "id_produk" => $id_produk
         );

         $this->m_produk->insertData('produk', $updateProduk, $whereProduk);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/detail_produk/' . $kode);
      }

      if ($this->input->post('tambah_data') == 'tambahGambar') {
         $gambar_produk = $_FILES['gambar_produk'];
         if ($gambar_produk) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|mp4|avi|mkv|3gp|mgp|mpeg';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar_produk')) {
               $gambar_produk = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $insertGbrProduk = [
            'kode_produk' => $this->input->post('kode_produk'),
            'gambar_produk' => $gambar_produk
         ];

         $this->m_produk->insertData('gambar_produk', $insertGbrProduk, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/detail_produk/' . $kode);
      }

      if ($this->input->post('ubah_data') == 'ubahGambar') {
         $id_gambar_produk = $this->input->post('id_gambar_produk');
         $old_image = $this->input->post('old_image');
         $gambar_produk = $_FILES['gambar_produk'];

         if ($old_image != 'default.png') {
            unlink(FCPATH . 'assets/upload/' . $old_image);
         }

         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'jpg|png|jpeg|mp4|avi|mkv|3gp|mgp|mpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('gambar_produk')) {
            $gambar_produk = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }

         $updateGbrProduk = [
            'gambar_produk' => $gambar_produk
         ];

         $whereGbrProduk = array(
            "id_gambar_produk" => $id_gambar_produk
         );

         $this->m_produk->insertData('gambar_produk', $updateGbrProduk, $whereGbrProduk);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Gambar telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/detail_produk/' . $kode);
      }

      if ($this->input->post('tambah_data') == 'tambahVarian') {
         if ($this->input->post('size') == "") {
            $size = 'none';
         } else {
            $size = $this->input->post('size');
         }

         if ($this->input->post('warna_rasa') == "") {
            $warna_rasa = 'none';
         } else {
            $warna_rasa = $this->input->post('warna_rasa');
         }

         $insertVariasiProduk = [
            'kode_produk' => $this->input->post('kode_produk'),
            'size' => $size,
            'warna_rasa' => $warna_rasa,
            'stok_variasi' => $this->input->post('stok_variasi')
         ];

         $this->m_produk->insertData('produk_variasi', $insertVariasiProduk, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/detail_produk/' . $kode);
      }

      if ($this->input->post('ubah_data') == 'ubahVarian') {
         $id_produk_variasi = $this->input->post('id_produk_variasi');

         $updateVarianProduk = [
            'size' => $this->input->post('size'),
            'warna_rasa' => $this->input->post('warna_rasa'),
            'stok_variasi' => $this->input->post('stok_variasi')
         ];

         $whereVarianProduk = array(
            "id_produk_variasi" => $id_produk_variasi
         );

         $this->m_produk->insertData('produk_variasi', $updateVarianProduk, $whereVarianProduk);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/detail_produk/' . $kode);
      }

      if ($this->input->post('tambah_data') == 'tambahAtribut') {
         $insertAtributProduk = [
            'kode_produk' => $this->input->post('kode_produk'),
            'judul_taribut' => $this->input->post('judul_taribut'),
            'isian_atribut' => $this->input->post('isian_atribut')
         ];

         $this->m_produk->insertData('produk_atribut', $insertAtributProduk, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/detail_produk/' . $kode);
      }

      if ($this->input->post('ubah_data') == 'ubahAtribut') {
         $id_produk_atribut = $this->input->post('id_produk_atribut');

         $updateAtributProduk = [
            'judul_taribut' => $this->input->post('judul_taribut'),
            'isian_atribut' => $this->input->post('isian_atribut')
         ];

         $whereAtributProduk = array(
            "id_produk_atribut" => $id_produk_atribut
         );

         $this->m_produk->insertData('produk_atribut', $updateAtributProduk, $whereAtributProduk);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/detail_produk/' . $kode);
      }
   }

   public function hapus_produk($kode)
   {
      $data_gbr = $this->db->get_where('gambar_produk', ['kode_produk' => $kode])->result_array();

      foreach ($data_gbr as $gbr) {
         $old_image = $gbr['gambar_produk'];
         if ($old_image != 'default.png') {
            unlink(FCPATH . 'assets/upload/' . $old_image);
         }
      }

      $this->m_produk->deleteData('produk', array('kode_produk' => $kode));
      $this->m_produk->deleteData('gambar_produk', array('kode_produk' => $kode));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('produk/data_produk');
   }

   public function hapus_gambar_produk()
   {
      $gbr = $this->db->get_where('gambar_produk', ['id_gambar_produk' => $this->uri->segment('4')])->row_array();

      $old_image = $gbr['gambar_produk'];
      if ($old_image != 'default.png') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $this->m_produk->deleteData('gambar_produk', array('id_gambar_produk' => $this->uri->segment('4')));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('produk/detail_produk/' . $this->uri->segment('3'));
   }

   public function hapus_variasi_produk()
   {
      $this->m_produk->deleteData('produk_variasi', array('id_produk_variasi' => $this->uri->segment('4')));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('produk/detail_produk/' . $this->uri->segment('3'));
   }

   public function hapus_atribut_produk()
   {
      $this->m_produk->deleteData('produk_atribut', array('id_produk_atribut' => $this->uri->segment('4')));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('produk/detail_produk/' . $this->uri->segment('3'));
   }

   // Data Diskon Costumer
   public function diskon_costumer()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggal = date("Y-m-d");
      $diskon = $this->m_produk->getProdukDiskon($tanggal, 3, null);

      $data['title'] = 'Diskon';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Produk Diskon';
      $data['sum_data'] = $diskon->num_rows() . ' Produk';
      $data['menu_link'] = 'javascript:window.history.go(-1);';

      $data['data_produk'] = $this->m_produk->getProdukDiskon($tanggal, null, null);
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/produk/diskon');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Produk Detail Costumer
   public function produk_detail($kode)
   {
      $data['title'] = 'Produk';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Detail Produk';
      $data['menu_link'] = 'javascript:window.history.go(-1);';

      $data['produk'] = $this->m_produk->getDetailProduk($kode);
      $data['data_gambar'] = $this->m_produk->getDataAsc('gambar_produk', array('kode_produk' => $kode), 'id_gambar_produk', null);
      $data['data_variasi'] = $this->m_produk->getData('produk_variasi', array('kode_produk' => $kode), 'id_produk_variasi', null);
      $data['data_atribut'] = $this->m_produk->getData('produk_atribut', array('kode_produk' => $kode), 'id_produk_atribut', null);
      $data['produk_toko'] = $this->m_produk->getData('produk', array('reseler' => $data['produk']['reseler']), 'id_produk', null);
      $data['diskon'] = $this->m_produk->getData('diskon', array('kode_produk' => $kode), 'id_diskon', null);
      $data['data_produk'] = $this->m_produk->getProdukKategori($data['produk']['kategori_produk'], array('kode_produk' => $kode), 7, null);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/produk/produk_detail');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Tambah Data Keranjang Costumer 
   public function addCostumerCart()
   {
      $kode = $this->input->post('kode_produk');
      $qty = $this->input->post('quantity');
      $harga_produk = $this->input->post('harga_produk');
      $variasi_produk = $this->input->post('variasi_produk');
      $output = array('error' => false);

      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");

      $produk = $this->m_produk->getDetailProduk($kode);
      $cek_cart = $this->db->get_where('keranjang', array('costumer' => $this->session->userdata('id_user'), 'kode_produk' => $kode, 'variasi_produk' => $variasi_produk));

      if ($cek_cart->num_rows() > 0) {
         $cart = $cek_cart->row_array();
         $id_keranjang = $cart['id_keranjang'];
         $total_qty    = $cart['qty'] + $qty;

         $updateCart = [
            'qty' => $total_qty,
            'change_keranjang' => $tanggalwaktu
         ];

         $whereCart = array(
            "id_keranjang" => $id_keranjang
         );

         $this->m_produk->insertData('keranjang', $updateCart, $whereCart);
         $output['pesan'] = 'Keranjang Terupdate';
      } elseif ($cek_cart->num_rows() == 0) {
         $insertKeranjang = [
            'costumer' => $this->session->userdata('id_user'),
            'reseler' => $produk['reseler'],
            'kode_produk' => $kode,
            'qty' => $qty,
            'nm_produk' => $produk['nm_produk'],
            'harga_produk' => $harga_produk,
            'variasi_produk' => $variasi_produk,
            'change_keranjang' =>  $tanggalwaktu
         ];

         $this->m_produk->insertData('keranjang', $insertKeranjang, null);
         $output['pesan'] = 'Keranjang Bertambah';
      } else {
         $output['error'] = true;
         $output['pesan'] = 'Cart Add Filed!!!';
      }
      echo json_encode($output);
   }

   // Data Pilihan Kategori Costumer
   public function kategori()
   {
      $data['title'] = 'Kategori';
      $data['menu'] = 'None';
      $data['sub_nums'] = '0';
      $data['data_kategori'] = $this->m_produk->getData('kategori_produk', array('status_kategori_produk' => '1'), 'id_kategori_produk', null);
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/kategori');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Produk Kategori Costumer
   public function detail_kategori($id)
   {
      $menu = $this->m_produk->getData('kategori_produk', array('id_kategori_produk' => $id), 'id_kategori_produk', null)->row_array();
      $jumlah = $this->m_produk->getData('produk', array('kategori_produk' => $id), 'id_produk', null);

      $data['title'] = 'Kategori';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = $menu['nm_kategori_produk'];
      $data['sum_data'] = $jumlah->num_rows() . ' Produk';
      $data['menu_link'] = 'javascript:window.history.go(-1);';
      $data['data_produk'] = $this->m_produk->getProdukKategori($id, null, null, null);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/produk/produk_kategori');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Keranjang Costumer
   public function keranjang()
   {
      $jumlah = $this->m_produk->getData('keranjang', array('costumer' => $this->session->userdata('id_user')), 'id_keranjang', null);

      $data['title'] = 'Keranjang';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Keranjang Saya';
      $data['sum_data'] = $jumlah->num_rows() . ' Produk';
      $data['cart'] = 'none';
      $data['menu_link'] = base_url('home/costumer');
      $data['data_produk'] = $this->m_produk->getRandProduk(10);
      $data['data_reseler'] = $this->m_produk->getCartReseler($this->session->userdata('id_user'));
      $data['cart_count'] = $this->m_produk->getCartCount($this->session->userdata('id_user'));
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/produk/keranjang');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubahQty') {
         $id_keranjang = $this->input->post('id_keranjang');

         $updateKeranjang = [
            'qty' => $this->input->post('quantity')
         ];

         $whereKeranjang = array(
            "id_keranjang" => $id_keranjang
         );

         $this->m_produk->insertData('keranjang', $updateKeranjang, $whereKeranjang);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Jumlah Berubah",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/keranjang');
      }

      if ($this->input->post('ubah_data') == 'ubahVarian') {
         $id_keranjang = $this->input->post('id_keranjang');

         $updateKeranjang = [
            'variasi_produk' => $this->input->post('variasi_produk')
         ];

         $whereKeranjang = array(
            "id_keranjang" => $id_keranjang
         );

         $this->m_produk->insertData('keranjang', $updateKeranjang, $whereKeranjang);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Pilihan Warna Berubah",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('produk/keranjang');
      }
   }

   public function hapus_keranjang($id)
   {
      $this->m_produk->deleteData('keranjang', array('id_keranjang' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Pesanan Dihapus",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('produk/keranjang');
   }

   // Data Jumlah Keranjang Costumer
   function cart_total($id)
   {
      $data = $this->m_produk->getCartTotal($id);
      echo json_encode($data);
   }

   // Data Produk Reseler
   public function reseler_produk()
   {
      $data['data_produk'] = $this->m_produk->getProdukReseler($this->session->userdata('id_user'), null);

      $data['title'] = 'Produk';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Data Produk';
      $data['sum_data'] = $data['data_produk']->num_rows() . ' Produk';
      $data['menu_link'] =  base_url('home/reseler');
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/produk/data_produk');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);
   }

   // Produk Detail Reseler
   public function reseler_produk_detail($kode)
   {
      $data['title'] = 'Produk';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Detail Produk';
      $data['menu_link'] = base_url('produk/reseler_produk');

      $data['produk'] = $this->m_produk->getDetailProduk($kode);
      $data['data_gambar'] = $this->m_produk->getDataAsc('gambar_produk', array('kode_produk' => $kode), 'id_gambar_produk', null);
      $data['data_variasi'] = $this->m_produk->getData('produk_variasi', array('kode_produk' => $kode), 'id_produk_variasi', null);
      $data['data_atribut'] = $this->m_produk->getData('produk_atribut', array('kode_produk' => $kode), 'id_produk_atribut', null);
      $data['produk_toko'] = $this->m_produk->getData('produk', array('reseler' => $data['produk']['reseler']), 'id_produk', null);
      $data['diskon'] = $this->m_produk->getData('diskon', array('kode_produk' => $kode), 'id_diskon', null);
      $data['data_produk'] = $this->m_produk->getProdukKategori($data['produk']['kategori_produk'], array('kode_produk' => $kode), 7, null);
      date_default_timezone_set('Asia/Makassar');
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/produk/produk_detail');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);
   }
}
