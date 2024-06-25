<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	// Admin Home
	public function admin()
	{
		$data['title'] = 'Dashboard';
		$data['menu'] = 'None';
		$data['sub_nums'] = '0';
		$data['user'] = $this->m_user->getAdmin($this->session->userdata('id_user'));

		$data['transaksi_baru'] = $this->m_home->getData('transaksi', array('status_transaksi' => '0'), 'id_transaksi', null);
		$data['transaksi_proses'] = $this->m_home->getData('transaksi', array('status_transaksi' => '2'), 'id_transaksi', null);
		$data['transaksi_pengiriman'] = $this->m_home->getData('transaksi', array('status_transaksi' => '3'), 'id_transaksi', null);
		$data['transaksi'] = $this->m_home->getData('transaksi', array('status_transaksi' => '4'), 'id_transaksi', null);
		$data['produk'] = $this->m_home->getData('produk', null, 'id_produk', null);
		$data['admin'] = $this->m_home->getData('admin', null, 'id_admin', null);
		$data['kurir'] = $this->m_home->getData('kurir', null, 'id_kurir', null);
		$data['costumer'] = $this->m_home->getData('costumer', null, 'id_costumer', null);

		$this->load->view('adm/templates/header', $data);
		$this->load->view('adm/templates/topbar', $data);
		$this->load->view('adm/templates/sidebar', $data);
		$this->load->view('adm/templates/breadcrumb', $data);
		$this->load->view('adm/index');
		$this->load->view('adm/templates/footer', $data);
	}

	public function show_notif()
	{
		$data = $this->m_home->getNotif($_POST['status']);
		echo json_encode($data);
	}

	// Costumer Home
	public function costumer()
	{
		date_default_timezone_set('Asia/Makassar');
		$tanggal = date("Y-m-d");

		$data['title'] = 'Beranda';
		$data['menu'] = 'None';
		$data['sub_nums'] = '0';
		$data['data_kategori'] = $this->m_produk->getData('kategori_produk', array('status_kategori_produk' => '1'), 'id_kategori_produk', null);
		$data['data_diskon'] = $this->m_produk->getProdukDiskon($tanggal, 3, null);
		$data['data_terlaris'] = $this->m_produk->getProdukTerlaris(10, null);
		$data['data_produk'] = $this->m_produk->getAllProduk(20);
		$data['data_slider'] = $this->m_settings->getData('slider', null, 'id_slider', null);
		$data['biaya_jp'] = $this->m_settings->getData('jasa_pelayanan', array('status' => 1), 'id_jasa_pelayanan', 1)->row_array();
		$data['user'] = $this->m_user->getCostumer($this->session->userdata('id_user'));

		$this->load->view('costumer/templates/header', $data);
		$this->load->view('costumer/templates/topbar', $data);
		$this->load->view('costumer/templates/sidebar', $data);
		$this->load->view('costumer/index');
		$this->load->view('costumer/templates/menu', $data);
		$this->load->view('costumer/templates/footer', $data);
		$this->load->view('costumer/templates/crud', $data);
	}

	// Reseler Home
	public function reseler()
	{
		$data['title'] = 'Beranda';
		$data['menu'] = 'None';
		$data['sub_nums'] = '0';
		$data['list_order'] = $this->m_transaksi->getTransaksiReseler($this->session->userdata('id_user'), 3);
		$data['data_produk'] = $this->m_produk->getProdukReseler($this->session->userdata('id_user'), 20);
		$data['user'] = $this->m_user->getReseler($this->session->userdata('id_user'));

		$this->load->view('reseler/templates/header', $data);
		$this->load->view('reseler/templates/topbar', $data);
		$this->load->view('reseler/templates/sidebar', $data);
		$this->load->view('reseler/index');
		$this->load->view('reseler/templates/menu', $data);
		$this->load->view('reseler/templates/footer', $data);
		$this->load->view('reseler/templates/crud', $data);
	}

	// Kurir Home
	public function kurir()
	{
		$data['title'] = 'Beranda';
		$data['menu'] = 'None';
		$data['sub_nums'] = '0';
		$data['list_order'] = $this->m_transaksi->getOrderKurir($this->session->userdata('id_user'));
		$data['user'] = $this->m_user->getKurir($this->session->userdata('id_user'));

		$this->load->view('kurir/templates/header', $data);
		$this->load->view('kurir/templates/topbar', $data);
		$this->load->view('kurir/templates/sidebar', $data);
		$this->load->view('kurir/index');
		$this->load->view('kurir/templates/menu', $data);
		$this->load->view('kurir/templates/footer', $data);
		$this->load->view('kurir/templates/crud', $data);
	}
}
