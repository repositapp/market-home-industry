<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function helper_log($tipe = "", $str = "")
{
   $CI = &get_instance();

   // mac
   $mac = 'UNKNOWN';
   foreach (explode("\n", str_replace(' ', '', trim(`getmac`, "\n"))) as $i)
      if (strpos($i, 'Tcpip') > -1) {
         $mac = substr($i, 0, 17);
         break;
      }

   // time
   date_default_timezone_set('Asia/Makassar');
   $time = date("Y-m-d H:i:s");

   // tipe
   if (strtolower($tipe) == "login") {
      $log_tipe   = 0;
   } elseif (strtolower($tipe) == "logout") {
      $log_tipe   = 1;
   } elseif (strtolower($tipe) == "registrasi") {
      $log_tipe   = 2;
   } elseif (strtolower($tipe) == "add") {
      $log_tipe   = 3;
   } elseif (strtolower($tipe) == "edit") {
      $log_tipe  = 4;
   } elseif (strtolower($tipe) == "view") {
      $log_tipe  = 5;
   } else {
      $log_tipe  = 6;
   }

   // paramter
   $param['log_user']      = $CI->session->userdata('id_user');
   $param['log_mac']       = $mac;
   $param['log_time']      = $time;
   $param['log_tipe']      = $log_tipe;
   $param['log_desc']      = $str;

   //load model log
   $CI->load->model('m_log');

   //save to database
   $CI->m_log->save_log($param);
}
