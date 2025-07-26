<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_Pembayaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

	public function index()
	{
	$data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

    // Kalau user tidak ditemukan atau tidak punya id_level → 404
    if (!$data['user'] || !isset($data['user']['id_level'])) {
        show_404();
    }

    // Kalau id_level tidak 1 atau 2 → 404 juga
    if ($data['user']['id_level'] != 1 && $data['user']['id_level'] != 2) {
        show_404();
    }
        $data['judul'] = 'Riwayat Pembayaran';
        $data['sidebar'] = 'riwayat';
        $data['riwayat'] = $this->Riwayat_PembayaranModel->GetPemBerhasil()->result_array();
        $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();
		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/riwayat_pembayaran/index', $data);
		$this->load->view('template/layouts/footer', $data);
	}

        public function cetak($id_pembayaran)
        {
            $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

            // Kalau user tidak ditemukan atau tidak punya id_level → 404
            if (!$data['user'] || !isset($data['user']['id_level'])) {
                show_404();
            }

            // Kalau id_level tidak 1 atau 2 → 404 juga
            if ($data['user']['id_level'] != 1 && $data['user']['id_level'] != 2) {
                show_404();
            }

            // Ambil detail pembayaran per ID
            $data['pembayaran'] = $this->Riwayat_PembayaranModel->getPembayaranByIdd($id_pembayaran);

            if (!$data['pembayaran']) {
                show_404();
            }

            $this->load->library('pdf');
            $this->pdf->load_view('admin/riwayat_pembayaran/struk', $data);
        }

    public function cetak_semua()
    {
        $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

        // Validasi user & level
        if (!$data['user'] || !isset($data['user']['id_level'])) {
            show_404();
        }

        if ($data['user']['id_level'] != 1 && $data['user']['id_level'] != 2) {
            show_404();
        }

        // Ambil data pembayaran lunas
        $data['riwayat'] = $this->Riwayat_PembayaranModel->GetPemBerhasil()->result_array();
        $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();

        // Load PDF
        $this->load->library('pdf');
        $this->pdf->load_view('admin/riwayat_pembayaran/riwayat_pembayaran', $data);
    }
}
