<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Penggunaan extends CI_Controller {
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
        $data['judul'] = 'Data penggunaan';
        $data['sidebar'] = 'penggunaan';
        $data['penggunaan'] = $this->PenggunaanModel->getPenggunaanWithPelanggan()->result_array();
    
   	    $this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/data_penggunaan/index', $data);
		$this->load->view('template/layouts/footer', $data);
    }

    public function create()
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
        $data['judul'] = 'Tambah Data Penggunaan';
        $data['sidebar'] = 'penggunaan';
        $data['penggunaan'] = $this->PenggunaanModel->getPenggunaanWithPelanggan()->result_array();
        $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();
        
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_penggunaan/create', $data);
        $this->load->view('template/layouts/footer', $data);
    }

    public function save()
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
      
        $data['judul'] = 'Tambah Data Penggunaan';
        $data['sidebar'] = 'penggunaan';
        $data['penggunaan'] = $this->PenggunaanModel->getPenggunaanWithPelanggan()->result_array();
        $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();

        // Form validation rules tetap sama
        $this->form_validation->set_rules('id_pelanggan', 'Nama Pelanggan', 'required', ['required' => 'Silahkan Pilih Nama Pelanggan!']);
        $this->form_validation->set_rules('bulan', 'Data Bulan', 'required', ['required' => 'Data Bulan Tidak Boleh Kosong!']);
        $this->form_validation->set_rules('tahun', 'Data Tahun', 'required', ['required' => 'Data Tahun Tidak Boleh Kosong!']);
        $this->form_validation->set_rules('meter_awal', 'Data Meter Awal', 'required', ['required' => 'Data Meter Awal Tidak Boleh Kosong!']);
        $this->form_validation->set_rules('meter_akhir', 'Data Meter Akhir', 'required', ['required' => 'Data Meter Akhir Tidak Boleh Kosong!']);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/master', $data);
            $this->load->view('template/layouts/navbar', $data);
            $this->load->view('template/layouts/sidebar', $data);
            $this->load->view('admin/data_penggunaan/create', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
             $data = [
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'bulan' => $this->input->post('bulan'),
                'tahun' => $this->input->post('tahun'),
                'meter_awal' => $this->input->post('meter_awal'),
                'meter_akhir' => $this->input->post('meter_akhir'),
            ];
            $this->PenggunaanModel->createPenggunaan($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan!'); // Buat session flashdata
            redirect('data_penggunaan');
        }
    }

    public function Edit()
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
      
        $data['judul'] = 'Tambah Data Penggunaan';
        $data['sidebar'] = 'penggunaan';
        $where = ['id_penggunaan' =>  $this->uri->segment(3)];
        $data['penggunaan'] = $this->PenggunaanModel->penggunaanWhere($where)->row_array();
        $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_penggunaan/edit', $data);
        $this->load->view('template/layouts/footer', $data);
    }

  public function update()
{
    $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

    if (!$data['user'] || !isset($data['user']['id_level'])) {
        show_404();
    }
    if ($data['user']['id_level'] != 1 && $data['user']['id_level'] != 2) {
        show_404();
    }

    $data['judul'] = 'Edit Data Penggunaan';
    $data['sidebar'] = 'penggunaan';
    $where = ['id_penggunaan' => $this->uri->segment(3)];
    $data['penggunaan'] = $this->PenggunaanModel->penggunaanWhere($where)->row_array();
    $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();

    $this->form_validation->set_rules('id_pelanggan', 'Nama Pelanggan', 'required', ['required' => 'Silahkan Pilih Nama Pelanggan!']);
    $this->form_validation->set_rules('bulan', 'Bulan', 'required', ['required' => 'Bulan Tidak Boleh Kosong!']);
    $this->form_validation->set_rules('tahun', 'Tahun', 'required', ['required' => 'Tahun Tidak Boleh Kosong!']);
    $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'required', ['required' => 'Meter Awal Tidak Boleh Kosong!']);
    $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'required', ['required' => 'Meter Akhir Tidak Boleh Kosong!']);

    if ($this->form_validation->run() == false) {
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_penggunaan/edit', $data);
        $this->load->view('template/layouts/footer', $data);
    } else {
        $id_penggunaan = $this->input->post('id_penggunaan', true);
        $id_pelanggan = $this->input->post('id_pelanggan', true);
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);
        $meter_awal = $this->input->post('meter_awal', true);
        $meter_akhir = $this->input->post('meter_akhir', true);

        $data_penggunaan = [
            'id_pelanggan' => $id_pelanggan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'meter_awal' => $meter_awal,
            'meter_akhir' => $meter_akhir
        ];

        // Hitung jumlah meter
        $jumlah_meter = $meter_akhir - $meter_awal;

        // Update tabel penggunaan
        $this->db->where('id_penggunaan', $id_penggunaan);
        $this->db->update('penggunaan', $data_penggunaan);

        // Update tabel tagihan
        $this->db->where('id_penggunaan', $id_penggunaan);
        $this->db->update('tagihan', [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jumlah_meter' => $jumlah_meter
        ]);

        $this->session->set_flashdata('message', 'Data Berhasil Diubah!');
        redirect('data_penggunaan');
    }
}


    public function hapus()
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
        $id_penggunaan = $this->uri->segment(3);
        $this->PenggunaanModel->hapusPenggunaanTagihan($id_penggunaan);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus!'); // Buat session flashdata
        redirect('data_penggunaan');
    }
}
