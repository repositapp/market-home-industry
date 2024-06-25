<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
   }

   public function login_admin()
   {
      $data['title'] = 'Authentication';
      $data['title_header'] = 'Login Admin';

      $this->load->view('adm/auth', $data);
   }

   public function auth_admin()
   {
      $output = array('error' => false);

      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $data = $this->db->get_where('user', ['username' => $username])->row_array();

      if ($data) {
         if (password_verify($password, $data['password'])) {
            if ($data['sts_akun'] == 1) {
               $data = [
                  'LOGGED_IN' => 'true',
                  'id_user'   => $data['id_user'],
                  'akses'     => $data['akses']
               ];
               $this->session->set_userdata($data);
               $output['message'] = '<strong>Logging in</strong>. Please wait...';
            } else {
               $output['error'] = true;
               $output['message'] = '<strong>Incorrect Login</strong>. User not active';
            }
         } else {
            $output['error'] = true;
            $output['message'] = '<strong>Incorrect Login</strong>. Password is incorrect';
         }
      } else {
         $output['error'] = true;
         $output['message'] = '<strong>Incorrect Login</strong>. User not found';
      }

      echo json_encode($output);
   }

   public function logout_admin()
   {
      $this->session->sess_destroy();
      redirect('auth/login_admin');
   }

   public function login_user()
   {
      $data['title'] = 'Authentication';
      $data['title_header'] = 'Login Sekarang';

      $this->load->view('login', $data);
   }

   public function auth_user()
   {
      $output = array('error' => false);

      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $data = $this->db->get_where('user', ['username' => $username])->row_array();

      if ($data) {
         if ($data['akses'] == "2") {
            if (password_verify($password, $data['password'])) {
               if ($data['sts_akun'] == 1) {
                  $data = [
                     'LOGGED_IN' => 'true',
                     'id_user'   => $data['id_user'],
                     'akses'     => $data['akses']
                  ];
                  $this->session->set_userdata($data);
                  $output['message'] = '<strong>Logging in</strong>. Please wait...';
                  $output['link'] = 'home/reseler';
               } else {
                  $output['error'] = true;
                  $output['message'] = '<strong>Incorrect Login</strong>. User not active';
               }
            } else {
               $output['error'] = true;
               $output['message'] = '<strong>Incorrect Login</strong>. Password is incorrect';
            }
         } elseif ($data['akses'] == "3") {
            if (password_verify($password, $data['password'])) {
               if ($data['sts_akun'] == 1) {
                  $data = [
                     'LOGGED_IN' => 'true',
                     'id_user'   => $data['id_user'],
                     'akses'     => $data['akses']
                  ];
                  $this->session->set_userdata($data);
                  $output['message'] = '<strong>Logging in</strong>. Please wait...';
                  $output['link'] = 'home/costumer';
               } else {
                  $output['error'] = true;
                  $output['message'] = '<strong>Incorrect Login</strong>. User not active';
               }
            } else {
               $output['error'] = true;
               $output['message'] = '<strong>Incorrect Login</strong>. Password is incorrect';
            }
         } elseif ($data['akses'] == "4") {
            if (password_verify($password, $data['password'])) {
               if ($data['sts_akun'] == 1) {
                  $data = [
                     'LOGGED_IN' => 'true',
                     'id_user'   => $data['id_user'],
                     'akses'     => $data['akses']
                  ];
                  $this->session->set_userdata($data);
                  $output['message'] = '<strong>Logging in</strong>. Please wait...';
                  $output['link'] = 'home/kurir';
               } else {
                  $output['error'] = true;
                  $output['message'] = '<strong>Incorrect Login</strong>. User not active';
               }
            } else {
               $output['error'] = true;
               $output['message'] = '<strong>Incorrect Login</strong>. Password is incorrect';
            }
         }
      } else {
         $output['error'] = true;
         $output['message'] = '<strong>Incorrect Login</strong>. User not found';
      }

      echo json_encode($output);
   }

   public function register_user()
   {
      $data['title'] = 'Authentication';
      $data['title_header'] = 'Registrasi Akun';

      $this->load->view('register', $data);
   }

   public function regis()
   {
      $output = array('error' => false);

      $username = $this->input->post('username');

      $data = $this->db->get_where('user', ['username' => $username])->row_array();

      if ($data) {
         $output['error'] = true;
         $output['message'] = '<strong>Username sudah terdaftar!!!</strong>';
      } else {
         $this->_addAkun();
         if ($this->input->post('akses') == 2) {
            $this->_addBioReseler();
            $user = $this->m_user->getData('user', null, 'id_user', 1)->row_array();
            $output['reseler'] = $user['id_user'];
         } elseif ($this->input->post('akses') == 3) {
            $this->_addBioCostumer();
         }
         $output['message'] = '<strong>Registrasi Success</strong>. Please wait...';
      }

      echo json_encode($output);
   }

   private function _addAkun()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");

      $insertAkun = [
         'username' => $this->input->post('username'),
         'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
         'akses' => $this->input->post('akses'),
         'sts_akun' => 1,
         'change_user' => $tanggalwaktu
      ];

      $this->m_user->insertData('user', $insertAkun, null);
   }

   private function _addBioReseler()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");
      $user = $this->m_user->getData('user', null, 'id_user', 1)->row_array();

      $insertBioReseler = [
         'id_user' => $user['id_user'],
         'nm_reseler' => $this->input->post('nama'),
         'telp_reseler' => $this->input->post('telepon'),
         'email_reseler' => $this->input->post('email'),
         'jk_reseler' => $this->input->post('jk'),
         'foto_reseler' => 'default.png',
         'change_reseler' => $tanggalwaktu
      ];

      $this->m_user->insertData('reseler', $insertBioReseler, null);
   }

   private function _addBioCostumer()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");
      $user = $this->m_user->getData('user', null, 'id_user', 1)->row_array();

      $insertBioCostumer = [
         'id_user' => $user['id_user'],
         'nm_costumer' => $this->input->post('nama'),
         'jk_costumer' => $this->input->post('jk'),
         'telp_costumer' => $this->input->post('telepon'),
         'email_costumer' => $this->input->post('email'),
         'foto_costumer' => 'default.png',
         'change_costumer' => $tanggalwaktu
      ];

      $this->m_user->insertData('costumer', $insertBioCostumer, null);
   }

   public function logout_user()
   {
      $this->session->sess_destroy();

      redirect('auth/login_user');
   }
}
