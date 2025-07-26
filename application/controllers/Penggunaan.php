<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggunaan extends CI_Controller {
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
        $data['judul'] = 'Penggunaan Listrik';
        $data['sidebar'] = 'penggunaan';
        // $data['penggunaan'] = $this->PenggunaanModel->getPenggunaan()->result_array();
        $data['penggunaan'] = $this->PenggunaanModel->getPenggunaanWithStatus($data['pelanggan']['id_pelanggan'])->result_array();
		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/_navbar', $data);
		$this->load->view('template/layouts/_sidebar', $data);
		$this->load->view('pelanggan/penggunaan/index', $data);
		$this->load->view('template/layouts/_footer', $data);
	}

   public function create()
{
	$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

	if (!$data['pelanggan']) {
		redirect('autentifikasi'); 
	}

	$data['judul'] = 'Tambah Data Penggunaan Listrik';
	$data['sidebar'] = 'penggunaan';
	$data['penggunaan'] = $this->PenggunaanModel->getPenggunaan()->result_array();

	$id_pelanggan = $data['pelanggan']['id_pelanggan'];
	$bulan = date('n'); // Bulan sekarang
	$tahun = date('Y');

	$bulan_sebelumnya = $bulan - 1;
	if ($bulan_sebelumnya < 1) {
		$bulan_sebelumnya = 12;
		$tahun -= 1;
	}

	$this->db->where('id_pelanggan', $id_pelanggan);
	$this->db->where("(tahun < $tahun OR (tahun = $tahun AND bulan < $bulan))");
	$this->db->order_by('tahun', 'DESC');
	$this->db->order_by('bulan', 'DESC');
	$this->db->limit(1);
	$query = $this->db->get('penggunaan');


	$sebelumnya = $query->row();

	if ($sebelumnya && isset($sebelumnya->meter_akhir)) {
		$data['meter_awal'] = (int)$sebelumnya->meter_akhir;
	} else {
		$data['meter_awal'] = 0;
	}

	$this->load->view('template/master', $data);
	$this->load->view('template/layouts/_navbar', $data);
	$this->load->view('template/layouts/_sidebar', $data);
	$this->load->view('pelanggan/penggunaan/create', $data);
	$this->load->view('template/layouts/_footer', $data);
}


   public function save()
{
	// Ambil user by session
	$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

	if (!$data['pelanggan']) {
		redirect('autentifikasi');
	}

	$data['judul'] = 'Tambah Data Penggunaan Listrik';
	$data['sidebar'] = 'penggunaan';

	$id_pelanggan = $data['pelanggan']['id_pelanggan']; // pastikan ini benar
	$bulan = $this->input->post('bulan');
    $bulan = $bulan ? (int)$bulan : date('n'); 
	$tahun = $this->input->post('tahun') ?? date('Y');

	// Cek bulan sebelumnya
	$bulan_sebelumnya = $bulan - 1;

	// Query meter_akhir bulan sebelumnya
	$this->db->where('id_pelanggan', $id_pelanggan);
	$this->db->where('bulan', $bulan_sebelumnya);
	$this->db->where('tahun', $tahun);
	$query = $this->db->get('penggunaan'); // ganti sesuai nama tabel

	$sebelumnya = $query->row();

	if ($sebelumnya) {
		$data['meter_awal'] = $sebelumnya->meter_akhir;
	} else {
		$data['meter_awal'] = 0;
	}

	// Form validation rules tetap sama
	$this->form_validation->set_rules('bulan', 'Data Bulan', 'required', ['required' => 'Data Bulan Tidak Boleh Kosong!']);
	$this->form_validation->set_rules('tahun', 'Data Tahun', 'required', ['required' => 'Data Tahun Tidak Boleh Kosong!']);
	$this->form_validation->set_rules('meter_akhir', 'Data Meter Akhir', 'required', ['required' => 'Data Meter Akhir Tidak Boleh Kosong!']);

	if ($this->form_validation->run() == false) {
		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/_navbar', $data);
		$this->load->view('template/layouts/_sidebar', $data);
		$this->load->view('pelanggan/penggunaan/create', $data);
		$this->load->view('template/layouts/_footer', $data);
	} else {
		$data_input = [
			'id_pelanggan' => $id_pelanggan,
			'bulan' => $this->input->post('bulan'),
			'tahun' => $this->input->post('tahun'),
			'meter_awal' => $data['meter_awal'], // PAKAI hasil query!
			'meter_akhir' => $this->input->post('meter_akhir'),
		];

		$this->PenggunaanModel->createPenggunaan($data_input);
		$this->session->set_flashdata('message', 'Data Berhasil Ditambahkan!');
		redirect('penggunaan');
	}
}

public function edit()
    {
       // Ambil user by session
	$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

	if (!$data['pelanggan']) {
		redirect('autentifikasi');
	}
        $data['judul'] = 'Edit Data Penggunaan Listrik';
        $data['sidebar'] = 'penggunaan';
        $where = ['id_penggunaan' =>  $this->uri->segment(3)];
        $data['penggunaan'] = $this->PenggunaanModel->penggunaanWhere($where)->row_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/_navbar', $data);
        $this->load->view('template/layouts/_sidebar', $data);
        $this->load->view('pelanggan/penggunaan/edit', $data);
        $this->load->view('template/layouts/_footer', $data);
    }

	 public function update()
{
    // Ambil user by session
    $data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

    if (!$data['pelanggan']) {
        redirect('autentifikasi');
    }

    $data['judul'] = 'Edit Data Penggunaan Listrik';
    $data['sidebar'] = 'penggunaan';

    $where = ['id_penggunaan' => $this->uri->segment(3)];
    $data['penggunaan'] = $this->PenggunaanModel->penggunaanWhere($where)->row_array();

    $this->form_validation->set_rules('bulan', 'Data Bulan', 'required', ['required' => 'Data Bulan Tidak Boleh Kosong!']);
    $this->form_validation->set_rules('tahun', 'Data Tahun', 'required', ['required' => 'Data Tahun Tidak Boleh Kosong!']);
    $this->form_validation->set_rules('meter_akhir', 'Data Meter Akhir', 'required', ['required' => 'Data Meter Akhir Tidak Boleh Kosong!']);

    if ($this->form_validation->run() == false) {
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/_navbar', $data);
        $this->load->view('template/layouts/_sidebar', $data);
        $this->load->view('pelanggan/penggunaan/edit', $data);
        $this->load->view('template/layouts/_footer', $data);
    } else {
        $id_penggunaan = $this->input->post('id_penggunaan');
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $meter_akhir = $this->input->post('meter_akhir');

        // Ambil meter_awal lama dari DB, karena field-nya di form tidak bisa diubah user
        $meter_awal = $data['penggunaan']['meter_awal'];

        // Cek duplikat bulan+tahun
        $this->db->where([
            'id_pelanggan' => $id_pelanggan,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
        $this->db->where('id_penggunaan !=', $id_penggunaan);

        $cek = $this->db->get('penggunaan')->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata('message', 'Gagal! Data untuk bulan & tahun ini sudah ada.');
            redirect('penggunaan/update/' . $id_penggunaan);
        } else {
            // Update penggunaan
            $data_update = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'meter_akhir' => $meter_akhir
                // meter_awal tidak diubah
            ];
            $this->PenggunaanModel->updatePenggunaan(['id_penggunaan' => $id_penggunaan], $data_update);

            // Hitung ulang jumlah meter
            $jumlah_meter = $meter_akhir - $meter_awal;

            // Update tagihan
            $this->db->where('id_penggunaan', $id_penggunaan);
            $this->db->update('tagihan', ['jumlah_meter' => $jumlah_meter]);

            $this->session->set_flashdata('message', 'Data Berhasil Diubah!');
            redirect('penggunaan');
        }
    }
}
}
