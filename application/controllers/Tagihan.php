<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {
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
        $data['judul'] = 'Tagihan Listrik';
        $data['sidebar'] = 'tagihan';
        $data['tagihan'] = $this->TagihanModel->getTagihan()->result_array();
		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/_navbar', $data);
		$this->load->view('template/layouts/_sidebar', $data);
		$this->load->view('pelanggan/tagihan/index', $data);
		$this->load->view('template/layouts/_footer', $data);
	}

    public function detail_pembayaran()
    {
	$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

	if (!$data['pelanggan']) {
		redirect('autentifikasi');
	}
        $data['judul'] = 'Detail Pembayaran Listrik';
        $data['sidebar'] = 'tagihan';
        $id_tagihan = $this->uri->segment(3); // AMBIL ANGKA BUKAN ARRAY
        $data['tagihan'] = $this->TagihanModel->getTagihanById($id_tagihan);
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/_navbar', $data);
        $this->load->view('template/layouts/_sidebar', $data);
        $this->load->view('pelanggan/tagihan/detail', $data);
        $this->load->view('template/layouts/_footer', $data);
    }
    public function pembayaran()
    {
	$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

	if (!$data['pelanggan']) {
		redirect('autentifikasi');
	}
        $data['judul'] = 'Pembayaran Listrik';
        $data['sidebar'] = 'tagihan';
        $id_tagihan = $this->uri->segment(3); // AMBIL ANGKA BUKAN ARRAY
        $data['tagihan'] = $this->TagihanModel->getTagihanById($id_tagihan);
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/_navbar', $data);
        $this->load->view('template/layouts/_sidebar', $data);
        $this->load->view('pelanggan/tagihan/pembayaran', $data);
        $this->load->view('template/layouts/_footer', $data);
    }
    
    public function validate_image() {
        $check = TRUE;
            if ((!isset($_FILES['image'])) || $_FILES['image']['size'] == 0) {
                $this->form_validation->set_message('validate_image', 'Image Tidak Boleh Kosong');
                $check = FALSE;
        }
        return $check;
    }

    public function save()
    {
        $data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

        if (!$data['pelanggan']) {
            redirect('autentifikasi');
        }
        $data['judul'] = 'Pembayaran Listrik';
        $data['sidebar'] = 'tagihan';
        $id_tagihan = $this->uri->segment(3); // AMBIL ANGKA BUKAN ARRAY
        $data['tagihan'] = $this->TagihanModel->getTagihanById($id_tagihan);
        // echo "<prev>";
        // print_r($data['tagihan']);
        // die;
        $this->form_validation->set_rules(
            'image',
            'image',
            'callback_validate_image',
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('template/master', $data);
            $this->load->view('template/layouts/_navbar', $data);
            $this->load->view('template/layouts/_sidebar', $data);
            $this->load->view('pelanggan/tagihan/pembayaran', $data);
            $this->load->view('template/layouts/_footer', $data);
        } else {
          $config['upload_path'] = './assets/bukti-pembayaran/';
        $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG|webp|gif';
        $config['max_size'] = '3000';
        $config['file_name'] = 'bukti_' . time();
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect('tagihan/pembayaran/' . $id_tagihan);
        } else {
            $image = $this->upload->data();
            $gambar = $image['file_name'];

            $total = ($data['tagihan']['jumlah_meter'] * $data['tagihan']['tarifperkwh']) + 2500;

            // 1. Buat array insert pembayaran
                $insert_data = [
                'id_tagihan' => $data['tagihan']['id_tagihan'],
                'id_pelanggan' => $data['tagihan']['id_pelanggan'],
                'tanggal_pembayaran' => date('Y-m-d'),
                'bulan_bayar' => $data['tagihan']['bulan'],
                'biaya_admin' => 2500,
                'total_bayar' => $total,
                'id_user' => $this->session->userdata('id_user'),
                'image' => $gambar,
                ];

                // 2. Insert ke tabel pembayaran
                $this->PembayaranModel->createPembayaran($insert_data);

                // 3. Update status tagihan jadi lunas
                $update_data = [
                'status' => 1
                ];
                $this->TagihanModel->updateTagihan(['id_tagihan' => $id_tagihan], $update_data);

                // 4. Flash message & redirect
                $this->session->set_flashdata('message', 'Pembayaran berhasil dikirim!');
                redirect('tagihan');
        }
        }
    }

    public function edit_pembayaran()
    {
    $data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

	if (!$data['pelanggan']) {
		redirect('autentifikasi');
	}
        $data['judul'] = 'Pembayaran Listrik';
        $data['sidebar'] = 'tagihan';
        $id_tagihan = $this->uri->segment(3); // AMBIL ANGKA BUKAN ARRAY
        $data['tagihan'] = $this->TagihanModel->getTagihanById($id_tagihan);
        // Tambahkan ambil data pembayaran
        $data['pembayaran'] = $this->TagihanModel->getPembayaranByTagihanId($id_tagihan);
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/_navbar', $data);
        $this->load->view('template/layouts/_sidebar', $data);
        $this->load->view('pelanggan/tagihan/edit_pembayaran', $data);
        $this->load->view('template/layouts/_footer', $data);
    }

   public function updatepembayaran()
{
    $data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

    if (!$data['pelanggan']) {
        redirect('autentifikasi');
    }

    $id_tagihan = $this->uri->segment(3);
    $data['tagihan'] = $this->TagihanModel->getTagihanById($id_tagihan);
    $data['pembayaran'] = $this->TagihanModel->getPembayaranByTagihanId($id_tagihan);

    $upload_image = $_FILES['image']['name'];

    if ($upload_image) {
        $config['upload_path'] = './assets/bukti-pembayaran/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp|gif';
        $config['max_size'] = '3000';
        $config['file_name'] = 'bukti_' . time();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $gambar_lama = './assets/bukti-pembayaran/' . $data['pembayaran']['image'];
            if (file_exists($gambar_lama) && $data['pembayaran']['image'] != '') {
                unlink($gambar_lama);
            }

            $gambar_baru = $this->upload->data('file_name');
            $this->db->set('image', $gambar_baru);
            $this->db->where('id_pembayaran', $data['pembayaran']['id_pembayaran']);
            $this->db->update('pembayaran');

            $this->session->set_flashdata('message', 'Bukti pembayaran berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('gagal', $this->upload->display_errors());
            redirect('tagihan/edit_pembayaran/' . $id_tagihan);
        }
    } else {
        // TIDAK ADA UPLOAD BARU → tetap redirect dengan pesan info
        $this->session->set_flashdata('message', 'Tidak ada perubahan pada bukti pembayaran.');
    }

    redirect('tagihan');
}


}