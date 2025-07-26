<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Catatnokwh extends CI_Controller
{
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
        $data['judul'] = 'Data Nomor KWH';
        $data['sidebar'] = 'catatnokwh';
        $data['catatnokwh'] = $this->DataNokwhModel->getDatanokwh()->result_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
 	    $this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/catatnokwh/index', $data);
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
        $data['judul'] = 'Tambah Data Nomor KWH';
        $data['sidebar'] = 'catatnokwh';
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/catatnokwh/create', $data);
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
        $data['judul'] = 'Tambah Data Nomor KWH';
        $data['sidebar'] = 'catatnokwh';
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();

        $this->form_validation->set_rules(
            'nomor_kwh',
            'Data Nomor KWH',
            'required|min_length[7]|is_unique[data_nokwh.nomor_kwh]',
            [
                'required' => 'Data Nomor KWH Tidak Boleh Kosong!',
                'min_length' => 'Minimal Nomor KWH 7 Karakter!',
                'is_unique' => 'Data Nomor KWH Sudah Terdaftar!'
            ]
        );
        $this->form_validation->set_rules(
            'id_tarif',
            'Data Tarif Daya Listrik',
            'required',
            [
                'required' => 'Data Tarif Daya Listrik Tidak Boleh Kosong!',
            ]
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('template/master', $data);
            $this->load->view('template/layouts/navbar', $data);
            $this->load->view('template/layouts/sidebar', $data);
            $this->load->view('admin/catatnokwh/create', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
            $data = [
                'nomor_kwh' => $this->input->post('nomor_kwh'),
                'id_tarif' => $this->input->post('id_tarif'),
            ];
            $this->DataNokwhModel->createDatanokwh($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan!'); // Buat session flashdata
            redirect('catatnokwh');
        }
    }

    public function edit()
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
        $data['judul'] = 'Edit Data Nomor KWH';
        $data['sidebar'] = 'catatnokwh';
        $where = ['id_nokwh' =>  $this->uri->segment(3)];
        $data['catatnokwh'] = $this->DataNokwhModel->DatanokwhWhere($where)->row_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/catatnokwh/edit', $data);
        $this->load->view('template/layouts/footer', $data);
    }
    public function update()
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
        $data['judul'] = 'Edit Data Nomor KWH';
        $data['sidebar'] = 'catatnokwh';
        $where = ['id_nokwh' =>  $this->uri->segment(3)];
        $data['catatnokwh'] = $this->DataNokwhModel->DatanokwhWhere($where)->row_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        // print_r($data['catatnokwh']['nomor_kwh'] == $this->input->post('nomor_kwh'));
         if ($data['catatnokwh']['nomor_kwh'] == $this->input->post('nomor_kwh')) {
            $rule_judul = 'required|min_length[7]';
        } else {
            $rule_judul = 'required|is_unique[data_nokwh.nomor_kwh]|min_length[7]';
        }
        $this->form_validation->set_rules(
            'nomor_kwh',
            'Data Nomor KWH',
            $rule_judul,
            [
                'required' => 'Data Nomor KWH Tidak Boleh Kosong!',
                'min_length' => 'Minimal Nomor KWH 7 Karakter!',
                'is_unique' => 'Data Nomor KWH Sudah Terdaftar!'
            ]
        );
        $this->form_validation->set_rules(
            'id_tarif',
            'Data Tarif Daya Listrik',
            'required',
            [
                'required' => 'Data Tarif Daya Listrik Tidak Boleh Kosong!',
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('template/master', $data);
            $this->load->view('template/layouts/navbar', $data);
            $this->load->view('template/layouts/sidebar', $data);
            $this->load->view('admin/catatnokwh/edit', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
           $data = [
                'nomor_kwh' => $this->input->post('nomor_kwh'),
                'id_tarif' => $this->input->post('id_tarif'),
            ];
            $this->DataNokwhModel->updateDatanokwh(['id_nokwh' => $this->input->post('id_nokwh')], $data);
            $this->session->set_flashdata('message', 'Data Berhasil Diubah!'); // Buat session flashdata
            redirect('catatnokwh');
        }
    }

    public function hapusnokwh()
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
        $where = ['id_nokwh' => $this->uri->segment(3)];
        $this->DataNokwhModel->hapusDatanokwh($where);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus!'); // Buat session flashdata
        redirect('catatnokwh');
    }
}
