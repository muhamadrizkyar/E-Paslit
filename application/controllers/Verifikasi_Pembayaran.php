<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_Pembayaran extends CI_Controller {
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
        $data['judul'] = 'Verifikasi Pembayaran';
        $data['sidebar'] = 'varifikasi';
        $data['verifikasi'] = $this->PembayaranModel->getPembayaranssss()->result_array();
        $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();
        $data['tagihan'] = $this->TagihanModel->getTagihan()->result_array();

		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/verifikasi_pembayaran/index', $data);
		$this->load->view('template/layouts/footer', $data);
	}

    public function getDetailPembayaran()
    {
    $id = $this->input->post('id_pembayaran');

    $this->db->select('pembayaran.*, pelanggan.nama_pelanggan');
    $this->db->from('pembayaran');
    $this->db->join('pelanggan', 'pembayaran.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->where('id_pembayaran', $id);

    $query = $this->db->get()->row_array();
    echo json_encode($query);
    }

public function terimapembayaran($id_pembayaran)
{
    $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

    // Validasi user
    if (!$data['user'] || !isset($data['user']['id_level'])) {
        show_404();
    }

    if ($data['user']['id_level'] != 1 && $data['user']['id_level'] != 2) {
        show_404();
    }

    // 1. Cari data pembayaran
    $pembayaran = $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row_array();

    if ($pembayaran) {
        $id_tagihan = $pembayaran['id_tagihan'];

        // 2. Update status tagihan
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->update('tagihan', ['status' => 2]);

        // 3. Update pembayaran → simpan id_user (admin yang acc)
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->update('pembayaran', [
            'id_user' => $data['user']['id_user'] // <-- pastikan kolomnya ada di tabel!
        ]);

        // 4. Flash message
        $this->session->set_flashdata('message', 'Pembayaran diterima!');
    }

    redirect('verifikasi_pembayaran');
}


   public function tolakpembayaran($id_pembayaran)
{
    $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

    if (!$data['user'] || !isset($data['user']['id_level'])) {
        show_404();
    }

    if ($data['user']['id_level'] != 1 && $data['user']['id_level'] != 2) {
        show_404();
    }

    $pembayaran = $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row_array();

    if ($pembayaran) {
        $id_tagihan = $pembayaran['id_tagihan'];

        // Hapus file bukti pembayaran jika ada
        if (!empty($pembayaran['image'])) {
            $path = FCPATH . 'assets/bukti-pembayaran/' . $pembayaran['image'];
            if (file_exists($path)) {
                unlink($path); // Hapus file
            }
        }

        // Update status tagihan jadi 3 (ditolak)
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->update('tagihan', ['status' => 3]);

        // Hapus data pembayaran
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->delete('pembayaran');

        $this->session->set_flashdata('message', 'Pembayaran ditolak, file bukti dihapus!');
    }

    redirect('verifikasi_pembayaran');
}

}
