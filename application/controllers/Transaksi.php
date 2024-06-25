<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
   // Data Transaksi Baru
   public function transaksi_baru()
   {
      $data['title'] = 'Transaksi';
      $data['menu'] = 'Transaksi Baru';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'transaksi/transaksi_baru/';
      $data['data_transaksi'] = $this->m_transaksi->getNewTransaksi(null);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/transaksi/transaksi_baru');
      $this->load->view('adm/templates/footer', $data);

      if (!empty($this->uri->segment('3'))) {
         date_default_timezone_set('Asia/Makassar');
         $tanggalwaktu = date("Y-m-d H:i:s");
         $invoice = $this->uri->segment('3');

         $updateSts = [
            'status_transaksi' => $this->uri->segment('5')
         ];

         $whereSts = array(
            "invoice" => $invoice
         );

         if ($this->uri->segment('5') != '5') {
            $insertTO = [
               'costumer' => $this->uri->segment('4'),
               'invoice' => $invoice,
               'status_to' => $this->uri->segment('5'),
               'change_to' => $tanggalwaktu
            ];

            $this->m_transaksi->insertData('transaksi_to', $insertTO, null);
         }

         $this->m_transaksi->insertData('transaksi', $updateSts, $whereSts);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 10000,stack: 1});});');
         redirect('transaksi/transaksi_baru');
      }
   }

   // Data Transaksi Packing
   public function transaksi_packing()
   {
      $data['title'] = 'Transaksi';
      $data['menu'] = 'Transaksi Packing';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'transaksi/transaksi_packing/';
      $data['data_transaksi'] = $this->m_transaksi->getPacTransaksi(null);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/transaksi/transaksi_packing');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('ubah_data') == 'ubah') {
         if (!empty($this->input->post('invoice'))) {
            date_default_timezone_set('Asia/Makassar');
            $tanggalwaktu = date("Y-m-d H:i:s");

            $invoice = $this->input->post('invoice');

            $jumlah_data = count($this->input->post('invoice'));
            for ($i = 0; $i < $jumlah_data; $i++) {
               if ($this->input->post('jasa_pengiriman')[$i] != 1) {
                  $pengirim = 0;
               } else {
                  $kurir = $this->m_user->getCekKurirPengirim();
                  if ($kurir->num_rows() > 0) {
                     $pengirim = $kurir->row_array()['id_user'];
                  } else {
                     $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Gagal !",text: "Pesanan dengan jasa pengiriman kurir tidak dapat diproses, hal ini dikarenakan kurir sedang melakukan pengiriman lainnya.",position: "top-right",loaderBg: "#fff",icon: "error",hideAfter: 15000,stack: 1});});');
                     redirect('transaksi/transaksi_packing');
                  }
               }

               $updateSts = [
                  'status_transaksi' => 2,
                  'kurir' => $pengirim
               ];

               $whereSts = array(
                  "invoice" => $invoice[$i]
               );

               $insertTO = [
                  'costumer' => $this->input->post('costumer')[$i],
                  'invoice' => $this->input->post('invoice')[$i],
                  'status_to' => 2,
                  'change_to' => $tanggalwaktu
               ];

               $this->m_transaksi->insertData('transaksi_to', $insertTO, null);
               $this->m_transaksi->insertData('transaksi', $updateSts, $whereSts);
            }

            $get_trans = $this->m_transaksi->getData('transaksi', array('jasa_pengiriman' => 1, 'status_transaksi' => 2), 'id_transaksi')->row_array();
            $kurir_pengantar = $get_trans['kurir'];

            $updateKurir = [
               'status_kurir' => 1,
               'change_kurir' => $tanggalwaktu
            ];

            $whereKurir = array(
               "id_user" => $kurir_pengantar
            );

            $this->m_transaksi->insertData('kurir', $updateKurir, $whereKurir);

            $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Packing selesai, silahkan melakukan pengiriman.",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
            redirect('transaksi/transaksi_packing');
         } else {
            $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Gagal !",text: "Silahkan pilih pesanan yang akan dikirim!!!",position: "top-right",loaderBg: "#fff",icon: "error",hideAfter: 15000,stack: 1});});');
            redirect('transaksi/transaksi_packing');
         }
      }
   }

   // Data Transaksi Pengiriman
   public function transaksi_pengiriman()
   {
      $data['title'] = 'Transaksi';
      $data['menu'] = 'Transaksi Pengiriman';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'transaksi/transaksi_pengiriman/';
      $data['data_transaksi'] = $this->m_transaksi->getDelvTransaksi(null);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/transaksi/transaksi_pengiriman');
      $this->load->view('adm/templates/footer', $data);

      if (!empty($this->uri->segment('3'))) {
         date_default_timezone_set('Asia/Makassar');
         $tanggalwaktu = date("Y-m-d H:i:s");
         $invoice = $this->uri->segment('3');

         $updateSts = [
            'status_transaksi' => $this->uri->segment('5')
         ];

         $whereSts = array(
            "invoice" => $invoice
         );

         if ($this->uri->segment('5') != '5') {
            $insertOT = [
               'costumer' => $this->uri->segment('4'),
               'invoice' => $invoice,
               'status_to' => 3,
               'change_to' => $tanggalwaktu
            ];

            $insertTO = [
               'costumer' => $this->uri->segment('4'),
               'invoice' => $invoice,
               'status_to' => $this->uri->segment('5'),
               'change_to' => $tanggalwaktu
            ];

            $this->m_transaksi->insertData('transaksi_to', $insertOT, null);
            $this->m_transaksi->insertData('transaksi_to', $insertTO, null);
         }

         $this->m_transaksi->insertData('transaksi', $updateSts, $whereSts);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('transaksi/transaksi_pengiriman');
      }
   }

   // Data Transaksi Terima Pesanan
   public function transaksi_take_order()
   {
      $data['title'] = 'Transaksi';
      $data['menu'] = 'Transaksi Terima Pesanan';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'transaksi/transaksi_take_order/';
      $data['data_transaksi'] = $this->m_transaksi->getSucTransaksi(null);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/transaksi/transaksi_take');
      $this->load->view('adm/templates/footer', $data);

      if (!empty($this->uri->segment('3'))) {
         date_default_timezone_set('Asia/Makassar');
         $tanggalwaktu = date("Y-m-d H:i:s");
         $invoice = $this->uri->segment('3');

         $updateSts = [
            'status_transaksi' => $this->uri->segment('5')
         ];

         $whereSts = array(
            "invoice" => $invoice
         );

         $updateKurir = [
            'status_kurir' => 0
         ];

         $whereKurir = array(
            "id_user" => $this->uri->segment('6')
         );

         if ($this->uri->segment('5') != '5') {
            $insertTO = [
               'costumer' => $this->uri->segment('4'),
               'invoice' => $invoice,
               'status_to' => $this->uri->segment('5'),
               'change_to' => $tanggalwaktu
            ];

            $this->m_transaksi->insertData('transaksi_to', $insertTO, null);
         }

         $this->m_transaksi->insertData('transaksi', $updateSts, $whereSts);
         $this->m_transaksi->insertData('kurir', $updateKurir, $whereKurir);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('transaksi/transaksi_take_order');
      }
   }

   // Data Riwayat Transaksi
   public function riwayat_transaksi()
   {
      $data['title'] = 'Transaksi';
      $data['menu'] = 'Riwayat Transaksi';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'transaksi/riwayat_transaksi/';
      $data['data_transaksi'] = $this->m_transaksi->getRiwTransaksi(null);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/transaksi/transaksi_riwayat');
      $this->load->view('adm/templates/footer', $data);
   }

   // Cetak Transaksi
   public function cetak_transaksi($invoice)
   {
      $data['title'] = 'CETAK TRANSAKSI';
      $data['transaksi'] = $this->m_transaksi->getDetailTransaksi($invoice)->row_array();
      $data['costumer'] = $this->m_transaksi->getData('costumer', array('id_user' => $data['transaksi']['costumer']), 'id_costumer', null);
      $data['jasa'] = $this->m_produk->getData('ongkir_jasa', array('id_ongkir_jasa' => $data['transaksi']['jasa_pengiriman']), 'id_ongkir_jasa', null)->row_array();
      $data['data_pesanan'] = $this->m_transaksi->getPesanan($invoice);

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/transaksi/cetak_transaksi');
      $this->load->view('adm/templates/footer_cetak', $data);
   }

   // Data Riwayat Transaksi
   public function transaksi_batal()
   {
      $data['title'] = 'Transaksi';
      $data['menu'] = 'Transaksi Batal';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'transaksi/transaksi_batal/';
      $data['data_transaksi'] = $this->m_transaksi->getBatTransaksi(null);
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/transaksi/transaksi_batal');
      $this->load->view('adm/templates/footer', $data);
   }

   public function hapus_transaksi_batal($inv)
   {
      $this->m_transaksi->deleteData('transaksi', array('invoice' => $inv));
      $this->m_transaksi->deleteData('transaksi_pembayaran', array('invoice' => $inv));
      $this->m_transaksi->deleteData('transaksi_to', array('invoice' => $inv));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('transaksi/transaksi_batal');
   }

   // Data Transaksi Detail
   public function detail_transaksi($invoice)
   {
      $data['title'] = 'Transaksi';
      $data['menu'] = 'Data Transaksi';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Detail Transaksi';
      $data['menu_link'] = 'javascript:window.history.go(-1);';
      $data['bukti_bayar'] = $this->m_transaksi->getBuktiBayar($invoice)->row_array();
      $data['transaksi'] = $this->m_transaksi->getDetailTransaksi($invoice)->row_array();
      $data['jasa'] = $this->m_produk->getData('ongkir_jasa', array('id_ongkir_jasa' => $data['transaksi']['jasa_pengiriman']), 'id_ongkir_jasa', null)->row_array();
      $data['data_pesanan'] = $this->m_transaksi->getPesanan($invoice);
      $data['harga_pt'] = $this->m_transaksi->getOrderProdukSuccess($invoice);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/transaksi/transaksi_detail');
      $this->load->view('adm/templates/footer', $data);
   }

   // Data Rekening
   public function data_rekening()
   {
      $data['title'] = 'Master Data';
      $data['menu'] = 'Data Rekening';
      $data['sub_nums'] = '0';
      $data['menu_link'] = 'transaksi/data_rekening';
      $data['data_bank'] = $this->m_transaksi->getData('bank', null, 'id_bank', null);
      date_default_timezone_set('Asia/Makassar');
      $data['tanggalwaktu'] = date("Y-m-d H:i:s");
      $data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

      $this->load->view('adm/templates/header', $data);
      $this->load->view('adm/templates/topbar', $data);
      $this->load->view('adm/templates/sidebar', $data);
      $this->load->view('adm/templates/breadcrumb', $data);
      $this->load->view('adm/master/bank');
      $this->load->view('adm/templates/footer', $data);

      if ($this->input->post('tambah_data') == 'tambah') {

         $insertBank = [
            'nm_bank' => $this->input->post('nm_bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'pemilik' => $this->input->post('pemilik')
         ];

         $this->m_transaksi->insertData('bank', $insertBank, null);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah bertambah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('transaksi/data_rekening');
      }

      if ($this->input->post('ubah_data') == 'ubah') {
         $id_bank = $this->input->post('id_bank');

         $updateBank = [
            'nm_bank' => $this->input->post('nm_bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'pemilik' => $this->input->post('pemilik')
         ];

         $whereBank = array(
            "id_bank" => $id_bank
         );

         $this->m_transaksi->insertData('bank', $updateBank, $whereBank);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah diubah..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('transaksi/data_rekening');
      }
   }

   public function hapus_rekening($id)
   {
      $this->m_transaksi->deleteData('bank', array('id_bank' => $id));
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Berhasil !",text: "Data telah dihapus..",position: "top-right",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('transaksi/data_rekening');
   }

   // Data Checkout Delivery Costumer 
   public function checkout_delivery()
   {
      $data['title'] = 'Checkout';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Checkout Delivery';
      $data['sum_data'] = ' Step 1 of 2';
      $data['cart'] = 'none';
      $data['menu_link'] = base_url('produk/keranjang');

      $data['alamat'] = $this->m_transaksi->getLifeCostumer($this->session->userdata('id_user'));
      $data['data_reseler'] = $this->m_produk->getCartReseler($this->session->userdata('id_user'));
      $data['jumlah'] = $this->m_produk->getData('keranjang', array('costumer' => $this->session->userdata('id_user')), 'id_keranjang', null);
      $data['data_jasa'] = $this->m_produk->getData('ongkir_jasa', null, 'id_ongkir_jasa', null);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/transaksi/checkout_delivery');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $jasa = $this->input->post('jasa');
         redirect('transaksi/checkout_payment/' . $jasa);
      }
   }

   // Data Checkout Payment Costumer 
   public function checkout_payment($id)
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");

      $data['title'] = 'Checkout';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Checkout Payment';
      $data['sum_data'] = ' Step 2 of 2';
      $data['cart'] = 'none';
      $data['menu_link'] = 'javascript:window.history.go(-1);';

      $data['alamat'] = $this->m_transaksi->getLifeCostumer($this->session->userdata('id_user'));
      $data['cart_count'] = $this->m_produk->getCartCount($this->session->userdata('id_user'));
      $data['jasa'] = $this->m_produk->getData('ongkir_jasa', array('id_ongkir_jasa' => $id), 'id_ongkir_jasa', null);
      $data['jumlah'] = $this->m_produk->getData('keranjang', array('costumer' => $this->session->userdata('id_user')), 'id_keranjang', null);
      $data['biaya_pengiriman'] = $this->m_transaksi->biayaOngkir();
      $data['berat_beban'] = $this->m_transaksi->TotalBerat($this->session->userdata('id_user'));
      $data['data_keranjang'] = $this->m_transaksi->getCartCostumer($this->session->userdata('id_user'));
      $data['data_bank'] = $this->m_transaksi->getData('bank', null, 'id_bank', null);
      $data['ivc'] = $this->m_transaksi->invoice(18);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/transaksi/checkout_payment');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);

      if ($this->input->post('tambah_data') == 'tambah') {
         $jumlah_data = count($this->input->post('kode_produk'));
         for ($i = 0; $i < $jumlah_data; $i++) {
            $insertTransaksi = [
               'costumer' => $this->session->userdata('id_user'),
               'alamat_costumer' => $this->input->post('alamat_costumer'),
               'reseler' => $this->input->post('reseler')[$i],
               'invoice' => $this->input->post('invoice'),
               'kode_barang' => $this->input->post('kode_produk')[$i],
               'harga_barang' => $this->input->post('harga_barang')[$i],
               'nm_barang' => $this->input->post('nm_barang')[$i],
               'jumlah_beli' => $this->input->post('jumlah_beli')[$i],
               'variasi_produk' => $this->input->post('variasi_produk')[$i],
               'total_beban' => $this->input->post('total_beban'),
               'total_pengiriman' => $this->input->post('total_pengiriman'),
               'total_transaksi' => $this->input->post('total_transaksi'),
               'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
               'jasa_pengiriman' => $this->input->post('jasa_pengiriman'),
               'bukti_penyerahan' => 'none',
               'bukti_terima' => 'none',
               'change_transaksi' => $tanggalwaktu
            ];

            $this->m_transaksi->insertData('transaksi', $insertTransaksi, null);
         }

         if ($this->input->post('jenis_pembayaran') == 1) {
            $bank_transfer = 0;
         } elseif ($this->input->post('jenis_pembayaran') == 2) {
            $bank_transfer = $this->input->post('bank_transfer');
         }

         $insertPembayaran = [
            'costumer' => $this->session->userdata('id_user'),
            'invoice' => $this->input->post('invoice'),
            'bank_transfer' => $bank_transfer,
            'bukti_pembayaran' => 'none',
            'change_pembayaran' => $tanggalwaktu
         ];

         $insertTO = [
            'costumer' => $this->session->userdata('id_user'),
            'invoice' => $this->input->post('invoice'),
            'status_to' => 0,
            'change_to' => $tanggalwaktu
         ];

         $this->m_transaksi->insertData('transaksi_pembayaran', $insertPembayaran, null);
         $this->m_transaksi->insertData('transaksi_to', $insertTO, null);
         $this->m_produk->deleteData('keranjang', array('costumer' => $this->session->userdata('id_user')));

         redirect('transaksi/checkout_success/' . $this->input->post('invoice'));
      }
   }

   // Data Checkout Delivery Costumer 
   public function checkout_success($inv)
   {
      $data['title'] = 'Checkout';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      $data['sub_menu'] = 'Checkout Success';
      $data['cart'] = 'none';
      $data['menu_link'] = 'none';

      $data['alamat'] = $this->m_transaksi->getLifeCostumer($this->session->userdata('id_user'));
      $data['data_produk'] = $this->m_transaksi->getOrderSuccess($inv);
      $data['harga_pt'] = $this->m_transaksi->getOrderProdukSuccess($inv);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/transaksi/checkout_success');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Order Costumer 
   public function order($sts)
   {
      $data['title'] = 'Pesanan';
      $data['menu'] = 'None';
      $data['sub_nums'] = '1';
      if ($sts == 0) {
         $data['sub_menu'] = 'Pesanan Belum Bayar';
      } elseif ($sts == 1) {
         $data['sub_menu'] = 'Pesanan Dikemas';
      } elseif ($sts == 2) {
         $data['sub_menu'] = 'Dalam Pengiriman';
      } elseif ($sts == 3) {
         $data['sub_menu'] = 'Konfirmasi Penerima';
      } elseif ($sts == 4) {
         $data['sub_menu'] = 'Riwayat Pesanan';
      }
      $data['menu_link'] = base_url('settings/costumer_settings/');

      $data['data_transaksi'] = $this->m_transaksi->getTransaksi($sts, null, array('transaksi.costumer' => $this->session->userdata('id_user')));
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/transaksi/order');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);
   }

   // Data Order Detail Costumer 
   public function order_detail($inv)
   {
      $jumlah = $this->m_transaksi->getData('transaksi', array('invoice' => $inv), 'id_transaksi', null);

      $data['title'] = 'Pesanan';
      $data['menu'] = 'None';
      $data['sub_nums'] = '2';
      $data['sub_menu'] = 'Detail Pesanan';
      $data['sum_data'] = $jumlah->num_rows() . ' Produk';
      $data['menu_link'] = 'javascript:window.history.go(-1);';

      $data['ordered'] = $this->m_transaksi->getData('transaksi_to', array('costumer' => $this->session->userdata('id_user'), 'invoice' => $inv, 'status_to' => 0), 'id_transaksi_to', null);
      $data['packing'] = $this->m_transaksi->getData('transaksi_to', array('costumer' => $this->session->userdata('id_user'), 'invoice' => $inv, 'status_to' => 1), 'id_transaksi_to', null);
      $data['trasit'] = $this->m_transaksi->getData('transaksi_to', array('costumer' => $this->session->userdata('id_user'), 'invoice' => $inv, 'status_to' => 2), 'id_transaksi_to', null);
      $data['success'] = $this->m_transaksi->getData('transaksi_to', array('costumer' => $this->session->userdata('id_user'), 'invoice' => $inv, 'status_to' => 3), 'id_transaksi_to', null);
      $data['riwayat'] = $this->m_transaksi->getData('transaksi_to', array('costumer' => $this->session->userdata('id_user'), 'invoice' => $inv, 'status_to' => 4), 'id_transaksi_to', null);

      $data['transaksi'] = $this->m_transaksi->getDetailTransaksi($inv);
      $data['pembayaran'] = $this->m_transaksi->getOrderTF($inv);
      $data['jasa'] = $this->m_transaksi->getData('ongkir_jasa', array('id_ongkir_jasa' => $data['transaksi']->row_array()['jasa_pengiriman']), 'id_ongkir_jasa', null);
      $data['produk_transaksi'] = $this->m_transaksi->getData('transaksi', array('invoice' => $inv), 'id_transaksi', null);
      $data['harga_pt'] = $this->m_transaksi->getOrderProdukSuccess($inv);
      $data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
      $data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

      $this->load->view('costumer/templates/header', $data);
      $this->load->view('costumer/templates/topbar', $data);
      $this->load->view('costumer/templates/sidebar', $data);
      $this->load->view('costumer/transaksi/order_detail');
      $this->load->view('costumer/templates/menu', $data);
      $this->load->view('costumer/templates/footer', $data);
      $this->load->view('costumer/templates/crud', $data);

      if ($this->input->post('ubah_data') == 'ubahPembayaran') {
         $invoice = $this->input->post('invoice');
         $bukti_pembayaran = $_FILES['bukti_pembayaran'];

         if ($bukti_pembayaran) {
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bukti_pembayaran')) {
               $bukti_pembayaran = $this->upload->data('file_name');
            } else {
               echo "Upload Gagal!!";
               die();
            }
         }

         $updateBukti = [
            'bukti_pembayaran' => $bukti_pembayaran
         ];

         $whereBukti = array(
            "invoice" => $invoice
         );

         $this->m_transaksi->insertData('transaksi_pembayaran', $updateBukti, $whereBukti);
         $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Pembayaran Selesai",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
         redirect('transaksi/order_detail/' . $invoice);
      }
   }

   public function upload_bukti()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");
      $result = array('error' => false);
      $invoice = $this->input->post('invoice');
      $jasa_pengiriman = $this->input->post('jasa_pengiriman');
      $gambar = $_FILES['gambar'];

      if ($gambar) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'png|jpg|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      if ($jasa_pengiriman == 1) {
         $updateBukti = [
            'terima_barang' => 1,
            'bukti_terima' => $gambar
         ];
      } else {
         $insertTO = [
            'costumer' => $this->session->userdata('id_user'),
            'invoice' => $invoice,
            'status_to' => 3,
            'change_to' => $tanggalwaktu
         ];

         $this->m_transaksi->insertData('transaksi_to', $insertTO, null);

         $updateBukti = [
            'status_transaksi' => 3,
            'terima_barang' => 1,
            'penyerahan_barang' => 1,
            'bukti_penyerahan' => $gambar,
            'bukti_terima' => $gambar
         ];
      }

      $whereBukti = array(
         "invoice" => $invoice
      );

      $result = $this->m_transaksi->insertData('transaksi', $updateBukti, $whereBukti);

      echo json_decode($result);
   }

   public function cancel_order($invoice)
   {
      date_default_timezone_set('Asia/Makassar');

      $updateTransBatal = [
         'status_transaksi' => 5,
         'change_transaksi' => date("Y-m-d H:i:s")
      ];

      $whereTransBatal = array(
         "invoice" => $invoice
      );

      $this->m_transaksi->insertData('transaksi', $updateTransBatal, $whereTransBatal);
      $this->session->set_flashdata('msg', '$(".toastr1").show(function() {$.toast({heading: "Pesanan Dibatalkan",position: "top-center",loaderBg: "#fff",icon: "success",hideAfter: 5000,stack: 1});});');
      redirect('transaksi/order_detail/' . $invoice);
   }

   // Data Order Reseler 
   public function reseler_order()
   {
      $data['list_order'] = $this->m_transaksi->getTransaksiReseler($this->session->userdata('id_user'), null);

      $data['title'] = 'Pesanan';
      $data['menu'] = 'None';
      $data['sub_nums'] = '2';
      $data['sub_menu'] = 'Order Terbaru';
      $data['sum_data'] = $data['list_order']->num_rows() . ' Pesanan';
      $data['menu_link'] = base_url('home/reseler');

      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/transaksi/order');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);
   }

   // Data Riwayat Order Reseler 
   public function reseler_order_riwayat()
   {
      $data['title'] = 'Riwayat Transaksi';
      $data['menu'] = 'None';
      $data['sub_nums'] = '0';
      $data['list_order'] = $this->m_transaksi->getRiwayatTransaksiReseler($this->session->userdata('id_user'));
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/transaksi/order_riwayat');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);
   }

   // Data Order Detail Reseler 
   public function reseler_order_detail($id)
   {
      $data['title'] = 'Pesanan';
      $data['menu'] = 'None';
      $data['sub_nums'] = '2';
      $data['sub_menu'] = 'Detail Pesanan';
      $data['menu_link'] = 'javascript:window.history.go(-1);';

      $data['transaksi'] = $this->m_transaksi->getDetailTransaksiReseler($id);
      $data['jasa'] = $this->m_transaksi->getData('ongkir_jasa', array('id_ongkir_jasa' => $data['transaksi']->row_array()['jasa_pengiriman']), 'id_ongkir_jasa', null);
      $data['gbr_produk'] = $this->m_produk->getData('gambar_produk', array('kode_produk' => $data['transaksi']->row_array()['kode_barang']), 'id_gambar_produk', null);
      $data['hg_diskon'] = $this->m_produk->getData('diskon', array('kode_produk' => $data['transaksi']->row_array()['kode_barang']), 'id_diskon', null);
      $data['varian'] = $this->m_produk->getData('produk_variasi', array('id_produk_variasi' => $data['transaksi']->row_array()['variasi_produk']), 'id_produk_variasi', null);
      $data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

      $this->load->view('reseler/templates/header', $data);
      $this->load->view('reseler/templates/topbar', $data);
      $this->load->view('reseler/templates/sidebar', $data);
      $this->load->view('reseler/transaksi/order_detail');
      $this->load->view('reseler/templates/menu', $data);
      $this->load->view('reseler/templates/footer', $data);
      $this->load->view('reseler/templates/crud', $data);
   }

   // Konfirmasi Packing Reseler
   public function konfirmasi_packing()
   {
      $result = array('error' => false);
      $id_transaksi = $this->input->post('id_transaksi');

      $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row_array();
      $id_variasi = $transaksi['variasi_produk'];
      $kode_produk = $transaksi['kode_barang'];
      $jumlah_beli = $transaksi['jumlah_beli'];

      $variasi = $this->db->get_where('produk_variasi', ['id_produk_variasi' => $id_variasi])->row_array();
      $produk = $this->db->get_where('produk', ['kode_produk' => $kode_produk])->row_array();
      $stok1 = $variasi['stok_variasi'];
      $stok2 = $produk['stok'];

      $sisa_stok1 = $stok1 - $jumlah_beli;
      $sisa_stok2 = $stok2 - $jumlah_beli;

      // Update Stok Dalam Variasi Produk
      $updateStokVariasi = [
         'stok_variasi' => $sisa_stok1
      ];
      $whereStokVariasi = array(
         "id_produk_variasi" => $id_variasi
      );
      $this->m_transaksi->insertData('produk_variasi', $updateStokVariasi, $whereStokVariasi);

      // Update Stok Dalam Data Produk
      $updateStokProduk = [
         'stok' => $sisa_stok2
      ];
      $whereStokProduk = array(
         "kode_produk" => $kode_produk
      );
      $this->m_transaksi->insertData('produk', $updateStokProduk, $whereStokProduk);

      // Update Status Transaksi
      $updateTransaksi = [
         'status_pengemasan' => 1
      ];

      $whereTransaksi = array(
         "id_transaksi" => $id_transaksi
      );

      $result = $this->m_transaksi->insertData('transaksi', $updateTransaksi, $whereTransaksi);

      echo json_decode($result);
   }

   // Data Detail Delivery Kurir 
   public function delivery_detail($inv)
   {
      $jumlah = $this->m_transaksi->getData('transaksi', array('invoice' => $inv), 'id_transaksi', null);

      $data['title'] = 'Pesanan';
      $data['menu'] = 'None';
      $data['sub_nums'] = '2';
      $data['sub_menu'] = 'Detail Pesanan';
      $data['sum_data'] = $jumlah->num_rows() . ' Produk';
      $data['menu_link'] = 'javascript:window.history.go(-1);';

      $data['transaksi'] = $this->m_transaksi->getDetailTransaksi($inv);
      $data['produk_transaksi'] = $this->m_transaksi->getProdukTransaksi($inv);
      $data['costumer'] = $this->m_transaksi->getData('costumer', array('id_user' => $data['transaksi']->row_array()['costumer']), 'id_costumer', null);
      $data['user'] = $this->m_user->getKurir($this->session->userdata('id_user'));

      $this->load->view('kurir/templates/header', $data);
      $this->load->view('kurir/templates/topbar', $data);
      $this->load->view('kurir/templates/sidebar', $data);
      $this->load->view('kurir/order_detail');
      $this->load->view('kurir/templates/menu', $data);
      $this->load->view('kurir/templates/footer', $data);
      $this->load->view('kurir/templates/crud', $data);
   }

   public function upload_bukti_penyerahan()
   {
      date_default_timezone_set('Asia/Makassar');
      $tanggalwaktu = date("Y-m-d H:i:s");
      $result = array('error' => false);
      $invoice = $this->input->post('invoice');

      $insertTO = [
         'costumer' => $this->input->post('costumer'),
         'invoice' => $invoice,
         'status_to' => 3,
         'change_to' => $tanggalwaktu
      ];

      $this->m_transaksi->insertData('transaksi_to', $insertTO, null);

      $gambar = $_FILES['gambar'];

      if ($gambar) {
         $config['upload_path'] = './assets/upload/';
         $config['allowed_types'] = 'png|jpg|jpeg';
         $config['encrypt_name']  = true;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data('file_name');
         } else {
            echo "Upload Gagal!!";
            die();
         }
      }

      $updateBukti = [
         'status_transaksi' => 3,
         'penyerahan_barang' => 1,
         'bukti_penyerahan' => $gambar
      ];

      $whereBukti = array(
         "invoice" => $invoice
      );

      $result = $this->m_transaksi->insertData('transaksi', $updateBukti, $whereBukti);

      echo json_decode($result);
   }

   // Data Riwayat Delivery Kurir
   public function delivery_history()
   {
      $data['title'] = 'Riwayat Pengiriman';
      $data['menu'] = 'None';
      $data['sub_nums'] = '0';
      $data['list_order'] = $this->m_transaksi->getHistDelivery($this->session->userdata('id_user'));
      $data['user'] = $this->m_user->getKurir($this->session->userdata('id_user'));

      $this->load->view('kurir/templates/header', $data);
      $this->load->view('kurir/templates/topbar', $data);
      $this->load->view('kurir/templates/sidebar', $data);
      $this->load->view('kurir/order_riwayat');
      $this->load->view('kurir/templates/menu', $data);
      $this->load->view('kurir/templates/footer', $data);
      $this->load->view('kurir/templates/crud', $data);
   }
}
