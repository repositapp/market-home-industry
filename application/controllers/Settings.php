<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
   // Page Settings Website
   public function apk_profile()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'Profil Website';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'settings/web_profile/';
      $data['set_web'] = $this->m_settings->getData('set_web', null, 'id_web', 1)->row_array();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_home->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/settings/apk_profile');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_web = $this->input->post('id_web');
         $old_image = $this->input->post('old_image');
         $gambar_about = $_FILES['gambar_about'];
         $old_logo = $this->input->post('old_logo');
         $logo_web = $_FILES['logo_web'];

         if ($this->input->post('ubah_gambar')) {
            if ($old_image != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_image);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar_about')) {
               $gambar_about = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $gambar_about = $old_image;
         }

         if ($this->input->post('ubah_logo')) {
            if ($old_logo != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_logo);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|ico|gif';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo_web')) {
               $logo_web = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $logo_web = $old_logo;
         }

         $update = [
            'nama_web' => $this->input->post('nama_web'),
            'title_web' => $this->input->post('title_web'),
            'sidebar_title' => $this->input->post('sidebar_title'),
            'nm_instansi' => $this->input->post('nm_instansi'),
            'email_web' => $this->input->post('email_web'),
            'telepon_web' => $this->input->post('telepon_web'),
            'fax_web' => $this->input->post('fax_web'),
            'web_kantor' => $this->input->post('web_kantor'),
            'alamat_web' => $this->input->post('alamat_web'),
            'tentang_aplikasi' => $this->input->post('tentang_aplikasi'),
            'gambar_about' => $gambar_about,
            'logo_web' => $logo_web
         ];

         $where = array(
            "id_web" => $id_web
         );

         $this->m_settings->insertData('set_web', $update, $where);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('settings/apk_profile');
      }
   }

   // Page Settings Website
   public function kebijakan()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'Kebijakan';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'settings/kebijakan/';
      $data['kebijakan'] = $this->m_settings->getData('kebijakan', null, 'id_kebijakan', 1)->row_array();
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/settings/kebijakan');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_kebijakan = $this->input->post('id_kebijakan');

         $update = [
            'konten_kebijakan' => $this->input->post('konten_kebijakan'),
            'change_kebijakan' => $this->input->post('change_kebijakan')
         ];

         $where = array(
            "id_kebijakan" => $id_kebijakan
         );

         $this->m_settings->insertData('kebijakan', $update, $where);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('settings/kebijakan');
      }
   }

   // Data Settings Papan Informasi
   public function slider()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'Slider';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'settings/slider';
      $data['data_slider'] = $this->m_settings->getData('slider', null, 'id_slider', null);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/settings/slider');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $gbr_slider = $_FILES['gbr_slider'];
         if ($gbr_slider) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|mp4|avi|mkv|3gp|mgp|mpeg';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gbr_slider')) {
               $gbr_slider = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $insertSlider = [
            'gbr_slider' => $gbr_slider,
            'ket_slider' => $this->input->post('ket_slider')
         ];

         $this->m_user->insertData('slider', $insertSlider, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('settings/Slider');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_slider = $this->input->post('id_slider');
         $old_image = $this->input->post('old_image');
         $gbr_slider = $_FILES['gbr_slider'];

         if ($this->input->post('ubah_gambar')) {
            if ($old_image != 'default.png') {
               unlink(FCPATH . 'assets/upload/' . $old_image);
            }

            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|mp4|avi|mkv|3gp|mgp|mpeg';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gbr_slider')) {
               $gbr_slider = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         } else {
            $gbr_slider = $old_image;
         }

         $updateSlider = [
            'gbr_slider' => $gbr_slider,
            'ket_slider' => $this->input->post('ket_slider')
         ];

         $whereSlider = array(
            "id_slider" => $id_slider
         );

         $this->m_user->insertData('slider', $updateSlider, $whereSlider);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('settings/slider');
      }
   }

   public function hapus_slider($id)
   {
      $gbr = $this->db->get_where('slider', ['id_slider' => $id])->row_array();

      $old_image = $gbr['gbr_slider'];
      if ($old_image != 'default.png') {
         unlink(FCPATH . 'assets/upload/' . $old_image);
      }

      $this->m_settings->deleteData('slider', array('id_slider' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('settings/slider');
   }

   // Data Settings Costumer
   public function costumer_settings()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'None';
      $data['sub_nums'] = '3';
      $data['ordered'] = $this->m_transaksi->getNewTransaksi(array('transaksi.costumer' => $this->session->userdata('id_user')));
      $data['packing'] = $this->m_transaksi->getPacTransaksi(array('transaksi.costumer' => $this->session->userdata('id_user')));
      $data['trasit'] = $this->m_transaksi->getDelvTransaksi(array('transaksi.costumer' => $this->session->userdata('id_user')));
      $data['success'] = $this->m_transaksi->getSucTransaksi(array('transaksi.costumer' => $this->session->userdata('id_user')));
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/pengaturan');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Kebijakan Costumer
   public function kebijakan_aplikasi()
   {
      $data['title'] = 'Kabijakan Aplikasi';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Kabijakan Aplikasi';
      $data['menu_link'] = base_url('settings/costumer_settings/');
      $data['kebijakan'] = $this->m_settings->getData('kebijakan', null, 'id_kebijakan', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/setting/kebijakan');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Kontak Costumer
   public function kontak_aplikasi()
   {
      $data['title'] = 'Kontak Aplikasi';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Kontak Aplikasi';
      $data['menu_link'] = base_url('settings/costumer_settings/');
      $data['kontak'] = $this->m_settings->getData('set_web', null, 'id_web', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/setting/kontak');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data About Costumer
   public function about_aplikasi()
   {
      $data['title'] = 'About Us';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'About Us';
      $data['menu_link'] = base_url('settings/costumer_settings/');
      $data['about'] = $this->m_settings->getData('set_web', null, 'id_web', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/setting/about');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Settings Reseler
   public function reseler_settings()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'None';
      $data['sub_nums'] = '3';
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/pengaturan');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
   }

   // Data Settings Kurir
   public function kurir_settings()
   {
      $data['title'] = 'Settings';
      $data['menu'] = 'None';
      $data['sub_nums'] = '3';
      $data['user'] = $this->m_user->getKurir($this->session->userdata('id_user'));

      $this->load->view('kurir/templates/header', $data);
      $this->load->view('kurir/templates/topbar', $data);
      $this->load->view('kurir/templates/sidebar', $data);
      $this->load->view('kurir/pengaturan');
      $this->load->view('kurir/templates/menu', $data);
      $this->load->view('kurir/templates/footer', $data);
   }
}
