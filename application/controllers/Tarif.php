<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Tarif extends CI_Controller
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
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $data['judul'] = 'Data Tarif Daya';
        $data['sidebar'] = 'tarif';
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
 	    $this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/tarif/index', $data);
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
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $data['judul'] = 'Tambah Data Tarif Daya';
        $data['sidebar'] = 'tarif';
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/tarif/create', $data);
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
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $data['judul'] = 'Tambah Data Tarif Daya';
        $data['sidebar'] = 'tarif';

        $this->form_validation->set_rules(
            'daya',
            'Data Daya Listrik',
            'required|is_unique[tarif.daya]',
            [
                'required' => 'Data Daya Listrik Tidak Boleh Kosong!',
                'is_unique' => 'Data Daya Listrik Sudah Terdaftar!'
            ]
        );
        $this->form_validation->set_rules(
            'tarifperkwh',
            'Data Tarif PerKWH',
            'required',
            [
                'required' => 'Data Tarif PerKWH Tidak Boleh Kosong!',
            ]
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('template/master', $data);
            $this->load->view('template/layouts/navbar', $data);
            $this->load->view('template/layouts/sidebar', $data);
            $this->load->view('admin/tarif/create', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
            $data = [
                'daya' => $this->input->post('daya'),
                'tarifperkwh' => $this->input->post('tarifperkwh'),
            ];
            $this->TarifModel->createTarif($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan!'); // Buat session flashdata
            redirect('tarif');
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
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $data['judul'] = 'Edit Data Tarif Daya';
        $data['sidebar'] = 'tarif';
        $where = ['id_tarif' =>  $this->uri->segment(3)];
        $data['tarif'] = $this->TarifModel->tarifWhere($where)->row_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/tarif/edit', $data);
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
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $data['judul'] = 'Edit Data Tarif Daya';
        $data['sidebar'] = 'tarif';
        $where = ['id_tarif' =>  $this->uri->segment(3)];
        $data['tarif'] = $this->TarifModel->tarifWhere($where)->row_array();
        // echo "<prev>";
        // print_r($this->KategoriModel->kategoriWhere($where)->row_array());
        // die;
        if ($data['tarif']['daya'] == $this->input->post('daya')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tarif.daya]';
        }
        $this->form_validation->set_rules(
            'daya',
            'Data Nomor KWH',
            $rule_judul,
            [
                'required' => 'Data Daya Listrik Tidak Boleh Kosong!',
                'is_unique' => 'Data Daya Listrik Sudah Terdaftar!',
            ]
        );
        $this->form_validation->set_rules(
            'tarifperkwh',
            'Data Tarif PerKWH',
            'required',
            [
                'required' => 'Data Tarif PerKWH Tidak Boleh Kosong!',
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('template/master', $data);
            $this->load->view('template/layouts/navbar', $data);
            $this->load->view('template/layouts/sidebar', $data);
            $this->load->view('admin/tarif/edit', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
            $data = [
                'daya' => $this->input->post('daya'),
                'tarifperkwh' => $this->input->post('tarifperkwh'),
        ];
            $this->TarifModel->updateTarif(['id_tarif' => $this->input->post('id_tarif')], $data);
            $this->session->set_flashdata('message', 'Data Berhasil Diubah!'); // Buat session flashdata
            redirect('tarif');
        }
    }

    public function hapustarif()
    {
       $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

        // Kalau user tidak ditemukan atau tidak punya id_level → 404
        if (!$data['user'] || !isset($data['user']['id_level'])) {
            show_404();
        }

        // Kalau id_level tidak 1 atau 2 → 404 juga
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $where = ['id_tarif' => $this->uri->segment(3)];
        $this->TarifModel->hapusTarif($where);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus!'); // Buat session flashdata
        redirect('tarif');
    }
}
