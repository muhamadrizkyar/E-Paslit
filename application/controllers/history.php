<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
 	public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan();
    }
	public function index()
	{
		// Ambil user by session
		$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

		// Cek session kosong atau user tidak ditemukan
		if (!$data['pelanggan']) {
			redirect('autentifikasi'); 
			// atau show_404();
		}
        $data['judul'] = 'History Pembayaran';
        $data['sidebar'] = 'history';
        $data['history'] = $this->PembayaranModel->getPembayaranBehasil()->result_array();
		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/_navbar', $data);
		$this->load->view('template/layouts/_sidebar', $data);
		$this->load->view('pelanggan/history_pembayaran/index', $data);
		$this->load->view('template/layouts/_footer', $data);
	}

    public function cetak_semua()
    {
	// Ambil user by session
		$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

		// Cek session kosong atau user tidak ditemukan
		if (!$data['pelanggan']) {
			redirect('autentifikasi'); 
			// atau show_404();
		}
    $id_pelanggan = $data['pelanggan']['id_pelanggan'];
	$data['history'] = $this->PembayaranModel->getPembayaranLunasByPelanggan($id_pelanggan)->result_array();
    $data['pelanggan'] = $this->PelangganModel->getById($id_pelanggan);

	$this->load->library('pdf');
	$this->pdf->load_view('pelanggan/history_pembayaran/cetak_semua', $data);
    }

    public function cetak($id_pembayaran)
{
    // Cek login dulu
    $pelanggan = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();
    if (!$pelanggan) {
        redirect('autentifikasi');
    }

    // Ambil detail pembayaran per ID
    $data['pembayaran'] = $this->PembayaranModel->getPembayaranById($id_pembayaran);

    if (!$data['pembayaran']) {
        show_404();
    }

    $this->load->library('pdf');
    $this->pdf->load_view('pelanggan/history_pembayaran/struk', $data);
}

}