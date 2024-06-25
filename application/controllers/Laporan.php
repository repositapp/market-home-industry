<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
   // Daftar Laporan Admin
   public function index()
   {
      $data['title'] = 'Laporan';
      $data['menu'] = 'None';
      $data['sub_nums'] = '0';
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/laporan/daftar_laporan');
      $this->load->view('adm/templates/footer', $data);
   }

   // Data Pendapatan Reseler
   public function pendapatan_reseler()
   {
      $data['title'] = 'Laporan';
      $data['menu'] = 'Laporan';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Pendapatan Reseler';
      $data['menu_link'] = 'laporan';
      $data['data_reseler'] = $this->m_user->getAllReseler();
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/laporan/pendapatan_reseler');
      $this->load->view('adm/templates/footer', $data);
   }

   public function cari_pend_reseler()
   {
      date_default_timezone_set('Asia/Makassar');
      $hari = date("Y-m-d H:i:s");
      $bulan = date('m', strtotime($hari));
      $tahun = date('Y', strtotime($hari));
      // $output = array('error' => false);
      $output['pend_reseler'] = '';
      $output['total_keseluruhan'] = '';
      $penjualan = 0;
      $pengeluaran = 0;
      $hasil_keuntungan = 0;

      $reseler = $this->input->post('reseler');
      $date_start = date('Y-m-d H:i:s', strtotime($this->input->post('date_start')));
      $date_end = date('Y-m-d H:i:s', strtotime($this->input->post('date_end')));
      $tgl_lainnya = $this->input->post('tgl_lainnya');

      if ($reseler == 'all') {
         if ($tgl_lainnya == 0) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('transaksi.change_transaksi >=' => $date_start, 'transaksi.change_transaksi <=' => $date_end));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = date('d M Y', strtotime($date_start)) . ' s/d ' . date('d M Y', strtotime($date_end));
         } elseif ($tgl_lainnya == 1) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('transaksi.change_transaksi' => $hari));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = date('d M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 2) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('MONTH(transaksi.change_transaksi)' => $bulan));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = date('M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 3) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('YEAR(transaksi.change_transaksi)' => $tahun));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = 'Tahun ' . date('Y', strtotime($hari));
         }
      } else {
         if ($tgl_lainnya == 0) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('transaksi.reseler' => $reseler, 'transaksi.change_transaksi >=' => $date_start, 'transaksi.change_transaksi <=' => $date_end));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = date('d M Y', strtotime($date_start)) . ' s/d ' . date('d M Y', strtotime($date_end));
         } elseif ($tgl_lainnya == 1) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('transaksi.reseler' => $reseler, 'transaksi.change_transaksi' => $hari));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = date('d M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 2) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('transaksi.reseler' => $reseler, 'MONTH(transaksi.change_transaksi)' => $bulan));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = date('M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 3) {
            $data_pendapatan = $this->m_laporan->getPendResler(array('transaksi.reseler' => $reseler, 'YEAR(transaksi.change_transaksi)' => $tahun));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $list_keuntungan = $pendapatan['penjualan'] - $pendapatan['pengeluaran'];
               $output['pend_reseler'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['nm_toko'] . '</td>
                           <td>' . $pendapatan['nm_barang'] . '<br>' . $pendapatan['jumlah_belanja'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['penjualan'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($pendapatan['pengeluaran'], 0, ".", ".") . '</td>
                           <td>Rp. ' . number_format($list_keuntungan, 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $penjualan += $pendapatan['penjualan'];
               $pengeluaran += $pendapatan['pengeluaran'];
               $hasil_keuntungan += $list_keuntungan;
            }

            $output['tglPendRes'] = 'Tahun ' . date('Y', strtotime($hari));
         }
      }

      $output['total_keseluruhan'] = '<tr><th colspan="4">Total</th><th>Rp. ' . number_format($penjualan, 0, ".", ".") . '</th><th>Rp. ' . number_format($pengeluaran, 0, ".", ".") . '</th><th>Rp. ' . number_format($hasil_keuntungan, 0, ".", ".") . '</th></tr>';
      $output['jumPendRes'] = $data_pendapatan->num_rows();

      echo json_encode($output);
   }

   // Data Pendapatan Perusahaan
   public function pendapatan_perusahaan()
   {
      $data['title'] = 'Laporan';
      $data['menu'] = 'Laporan';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Pendapatan Perusahaan';
      $data['menu_link'] = 'laporan';
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/laporan/pendapatan_perusahaan');
      $this->load->view('adm/templates/footer', $data);
   }

   public function cari_pend_perusahaan()
   {
      date_default_timezone_set('Asia/Makassar');
      $hari = date("Y-m-d H:i:s");
      $bulan = date('m', strtotime($hari));
      $tahun = date('Y', strtotime($hari));
      // $output = array('error' => false);
      $output['pend_perusahaan'] = '';
      $output['total_keseluruhan'] = '';
      $jumlah = 0;
      $total_transaksi = 0;
      $hasil_keuntungan = 0;

      $biaya_jp = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();

      $date_start = date('Y-m-d H:i:s', strtotime($this->input->post('date_start')));
      $date_end = date('Y-m-d H:i:s', strtotime($this->input->post('date_end')));
      $tgl_lainnya = $this->input->post('tgl_lainnya');

      if ($tgl_lainnya == 0) {
         $data_pendapatan = $this->m_laporan->getPendPerusahaan(array('transaksi.change_transaksi >=' => $date_start, 'transaksi.change_transaksi <=' => $date_end));
         $no = 1;
         foreach ($data_pendapatan->result_array() as $pendapatan) {
            $keuntungan = $pendapatan['grand_total'] * ($biaya_jp['persen_jasa'] / 100);
            $output['pend_perusahaan'] .= '
                     <tr>
                        <td>' . $no . '</td>
                        <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                        <td>' . $pendapatan['invoice'] . '</td>
                        <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                        <td>Rp. ' . number_format($pendapatan['total_transaksi'], 0, ".", ".") . '</td>
                        <td>' . $biaya_jp['pajak_jasa'] . '%</td>
                        <td>Rp. ' . number_format($keuntungan, 0, ".", ".") . '</td>
                     </tr>
                     ';

            $no++;
            $jumlah += $pendapatan['jumlah_items'];
            $total_transaksi += $pendapatan['total_transaksi'];
            $hasil_keuntungan += $keuntungan;
         }

         $output['tglPend'] = date('d M Y', strtotime($date_start)) . ' s/d ' . date('d M Y', strtotime($date_end));
      } elseif ($tgl_lainnya == 1) {
         $data_pendapatan = $this->m_laporan->getPendPerusahaan(array('transaksi.change_transaksi' => $hari));
         $no = 1;
         foreach ($data_pendapatan->result_array() as $pendapatan) {
            $keuntungan = $pendapatan['grand_total'] * ($biaya_jp['persen_jasa'] / 100);
            $output['pend_perusahaan'] .= '
                     <tr>
                        <td>' . $no . '</td>
                        <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                        <td>' . $pendapatan['invoice'] . '</td>
                        <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                        <td>Rp. ' . number_format($pendapatan['total_transaksi'], 0, ".", ".") . '</td>
                        <td>' . $biaya_jp['pajak_jasa'] . '%</td>
                        <td>Rp. ' . number_format($keuntungan, 0, ".", ".") . '</td>
                     </tr>
                     ';

            $no++;
            $jumlah += $pendapatan['jumlah_items'];
            $total_transaksi += $pendapatan['total_transaksi'];
            $hasil_keuntungan += $keuntungan;
         }

         $output['tglPend'] = date('d M Y', strtotime($hari));
      } elseif ($tgl_lainnya == 2) {
         $data_pendapatan = $this->m_laporan->getPendPerusahaan(array('MONTH(transaksi.change_transaksi)' => $bulan));
         $no = 1;
         foreach ($data_pendapatan->result_array() as $pendapatan) {
            $keuntungan = $pendapatan['grand_total'] * ($biaya_jp['persen_jasa'] / 100);
            $output['pend_perusahaan'] .= '
                     <tr>
                        <td>' . $no . '</td>
                        <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                        <td>' . $pendapatan['invoice'] . '</td>
                        <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                        <td>Rp. ' . number_format($pendapatan['total_transaksi'], 0, ".", ".") . '</td>
                        <td>' . $biaya_jp['pajak_jasa'] . '%</td>
                        <td>Rp. ' . number_format($keuntungan, 0, ".", ".") . '</td>
                     </tr>
                     ';

            $no++;
            $jumlah += $pendapatan['jumlah_items'];
            $total_transaksi += $pendapatan['total_transaksi'];
            $hasil_keuntungan += $keuntungan;
         }

         $output['tglPend'] = date('M Y', strtotime($hari));
      } elseif ($tgl_lainnya == 3) {
         $data_pendapatan = $this->m_laporan->getPendPerusahaan(array('YEAR(transaksi.change_transaksi)' => $tahun));
         $no = 1;
         foreach ($data_pendapatan->result_array() as $pendapatan) {
            $keuntungan = $pendapatan['grand_total'] * ($biaya_jp['persen_jasa'] / 100);
            $output['pend_perusahaan'] .= '
                     <tr>
                        <td>' . $no . '</td>
                        <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                        <td>' . $pendapatan['invoice'] . '</td>
                        <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                        <td>Rp. ' . number_format($pendapatan['total_transaksi'], 0, ".", ".") . '</td>
                        <td>' . $biaya_jp['pajak_jasa'] . '%</td>
                        <td>Rp. ' . number_format($keuntungan, 0, ".", ".") . '</td>
                     </tr>
                     ';

            $no++;
            $jumlah += $pendapatan['jumlah_items'];
            $total_transaksi += $pendapatan['total_transaksi'];
            $hasil_keuntungan += $keuntungan;
         }

         $output['tglPend'] = 'Tahun ' . date('Y', strtotime($hari));
      }

      $output['total_keseluruhan'] = '<tr><th colspan="3">Total</th><th>' . $jumlah . ' Items</th><th>Rp. ' . number_format($total_transaksi, 0, ".", ".") . '</th><th>' . $biaya_jp['pajak_jasa'] . '%</th><th>Rp. ' . number_format($hasil_keuntungan, 0, ".", ".") . '</th></tr>';
      $output['jumPend'] = $data_pendapatan->num_rows();

      echo json_encode($output);
   }

   // Data Pendapatan Kurir
   public function pendapatan_kurir()
   {
      $data['title'] = 'Laporan';
      $data['menu'] = 'Laporan';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Pendapatan Kurir';
      $data['menu_link'] = 'laporan';
      $data['data_kurir'] = $this->m_user->getAllKurir();
      date_default_timezone_set('Asia/Makassar');
      $hari = date("Y-m-d H:i:s");
      $tahun = date('Y', strtotime($hari));

      $date_start = date('Y-m-d H:i:s', strtotime('06/01/2022'));
      $date_end = date('Y-m-d H:i:s', strtotime('07/04/2022'));
      $data['data_pendapatan'] = $this->m_laporan->getPendKurir(array('transaksi.change_transaksi >=' => $date_start, 'transaksi.change_transaksi <=' => $date_end));
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/laporan/pendapatan_kurir');
      $this->load->view('adm/templates/footer', $data);
   }

   public function cari_pend_kurir()
   {
      date_default_timezone_set('Asia/Makassar');
      $hari = date("Y-m-d H:i:s");
      $bulan = date('m', strtotime($hari));
      $tahun = date('Y', strtotime($hari));
      // $output = array('error' => false);
      $output['pend_kurir'] = '';
      $output['total_keseluruhan'] = '';
      $total_pendapatan = 0;
      $jumlah = 0;

      $kurir = $this->input->post('kurir');
      $date_start = date('Y-m-d H:i:s', strtotime($this->input->post('date_start')));
      $date_end = date('Y-m-d H:i:s', strtotime($this->input->post('date_end')));
      $tgl_lainnya = $this->input->post('tgl_lainnya');

      if ($kurir == 'all') {
         if ($tgl_lainnya == 0) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('transaksi.change_transaksi >=' => $date_start, 'transaksi.change_transaksi <=' => $date_end));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = date('d M Y', strtotime($date_start)) . ' s/d ' . date('d M Y', strtotime($date_end));
         } elseif ($tgl_lainnya == 1) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('transaksi.change_transaksi' => $hari));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = date('d M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 2) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('MONTH(transaksi.change_transaksi)' => $bulan));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = date('M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 3) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('YEAR(transaksi.change_transaksi)' => $tahun));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = 'Tahun ' . date('Y', strtotime($hari));
         }
      } else {
         if ($tgl_lainnya == 0) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('transaksi.kurir' => $kurir, 'transaksi.change_transaksi >=' => $date_start, 'transaksi.change_transaksi <=' => $date_end));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = date('d M Y', strtotime($date_start)) . ' s/d ' . date('d M Y', strtotime($date_end));
         } elseif ($tgl_lainnya == 1) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('transaksi.kurir' => $kurir, 'transaksi.change_transaksi' => $hari));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = date('d M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 2) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('transaksi.kurir' => $kurir, 'MONTH(transaksi.change_transaksi)' => $bulan));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = date('M Y', strtotime($hari));
         } elseif ($tgl_lainnya == 3) {
            $data_pendapatan = $this->m_laporan->getPendKurir(array('transaksi.kurir' => $kurir, 'YEAR(transaksi.change_transaksi)' => $tahun));
            $no = 1;
            foreach ($data_pendapatan->result_array() as $pendapatan) {
               $output['pend_kurir'] .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . date('d M Y, H:i', strtotime($pendapatan['change_transaksi'])) . '</td>
                           <td>' . $pendapatan['invoice'] . '</td>
                           <td>' . $pendapatan['nm_kurir'] . '</td>
                           <td>' . $pendapatan['detail_alamat'] . ', Kel. ' . $pendapatan['nm_kelurahan'] . ', Kec. ' . $pendapatan['nm_kecamatan'] . ', Kota/Kab. ' . $pendapatan['nm_kota'] . '</td>
                           <td>' . $pendapatan['jumlah_items'] . ' Items</td>
                           <td>Rp. ' . number_format($pendapatan['pendapatan'], 0, ".", ".") . '</td>
                        </tr>
                        ';

               $no++;
               $total_pendapatan += $pendapatan['pendapatan'];
               $jumlah += $pendapatan['jumlah_items'];
            }

            $output['tglPend'] = 'Tahun ' . date('Y', strtotime($hari));
         }
      }

      $output['total_keseluruhan'] = '<tr><th colspan="5">Total</th><th>' . $jumlah . ' Items</th><th>Rp. ' . number_format($total_pendapatan, 0, ".", ".") . '</th></tr>';
      $output['jumPend'] = $data_pendapatan->num_rows();

      echo json_encode($output);
   }
}
