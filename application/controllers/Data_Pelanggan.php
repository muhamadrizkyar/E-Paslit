<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Pelanggan extends CI_Controller {
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

    // Kalau id_level tidak 1 → 404 juga
    if ($data['user']['id_level'] != 1) {
        show_404();
    }
        $data['judul'] = 'Data pelanggan';
        $data['sidebar'] = 'pelanggan';
        $data['pelanggan'] = $this->PelangganModel->getPelanggan()->result_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $data['datanokwh'] = $this->DataNokwhModel->getDatanokwh()->result_array();
   	    $this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/data_pelanggan/index', $data);
		$this->load->view('template/layouts/footer', $data);
    }

    public function detail()
    {
    $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();

        // Kalau user tidak ditemukan atau tidak punya id_level → 404
        if (!$data['user'] || !isset($data['user']['id_level'])) {
            show_404();
        }

        // Kalau id_level tidak 1 → 404 juga
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $data['judul'] = 'Detail Data Pelanggan';
        $data['sidebar'] = 'pelanggan';
        $data['pelanggan'] = $this->PelangganModel->getPelangganWhere(['id_pelanggan' => $this->uri->segment(3)])->row_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $data['datanokwh'] = $this->DataNokwhModel->getDatanokwh()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_pelanggan/detail', $data);
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
        $data['judul'] = 'Tambah Data Pelangan';
        $data['sidebar'] = 'pelanggan';
        $data['pelanggan'] = $this->PelangganModel->getPelangganWhere(['id_pelanggan' => $this->uri->segment(3)])->row_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $data['datanokwh'] = $this->DataNokwhModel->getDatanokwh()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_pelanggan/create', $data);
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
        $data['judul'] = 'Tambah Data Pelanggan';
        $data['sidebar'] = 'pelanggan';
        $data['pelangganget'] = $this->PelangganModel->getPelanggan()->result_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $data['datanokwh'] = $this->DataNokwhModel->getDatanokwh()->result_array();

        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|is_unique[user.username]',
            [
                'required' => 'Username Tidak Boleh Kosong!',
                'is_unique' => 'Username Sudah Digunakan!'
            ]
        );
        $this->form_validation->set_rules(
            'nama_pelanggan',
            'Nama Pelanggan',
            'required',
            [
                'required' => 'Nama Pelanggan Tidak Boleh Kosong!'
            ]
        );

       $this->form_validation->set_rules(
            'nomor_kwh',
            'Nomor KWH',
            'required|min_length[7]',
            [
                'required' => 'Nomor KWH Tidak Boleh Kosong!',
                'min_length' => 'Minimal Nomor KWH 7 Karakter!'
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required',
            [
                'required' => 'Alamat Tidak Boleh Kosong!'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[8]|matches[password2]',
            [
                'matches' => 'Password Tidak Sama!',
                'required' => 'Password Harus Diisi!',
                'min_length' => 'Password Terlalu Pendek!'
            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'RepeatPassword',
            'required|trim|matches[password1]',
            [
                'matches' => 'Password Tidak Sama!',
                'required' => 'Password Harus Diisi!',
                'min_length' => 'Password Terlalu Pendek!'
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('template/master', $data);
            $this->load->view('template/layouts/navbar', $data);
            $this->load->view('template/layouts/sidebar', $data);
            $this->load->view('admin/data_pelanggan/create', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
            $nomor_kwh = $this->input->post('nomor_kwh', true);

            $cekKwh = $this->PelangganModel->cekNoKwh($nomor_kwh);

            if (!$cekKwh) {
                $this->session->set_flashdata('gagal', 'Nomor KWH tidak terdaftar di sistem!');
                redirect('data_pelanggan/create');
            }

            // Ambil id_tarif dari tabel data_nokwh
            $id_tarif = $cekKwh->id_tarif;

            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
                'nomor_kwh' => $nomor_kwh,
                'id_tarif' => $id_tarif,
                'alamat' => $this->input->post('alamat'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => 'default.jpg'
            ];
            $this->PelangganModel->simpanData($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan!'); // Buat session flashdata
            redirect('data_pelanggan');
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
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $data['judul'] = 'Edit Data Pelanggan';
        $data['sidebar'] = 'pelanggan';
        $data['pelanggan'] = $this->PelangganModel->getPelangganWhere(['id_pelanggan' => $this->uri->segment(3)])->row_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $data['datanokwh'] = $this->DataNokwhModel->getDatanokwh()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_pelanggan/edit', $data);
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
        $data['judul'] = 'Edit Data Pelanggan';
        $data['sidebar'] = 'pelanggan';
        $data['pelanggan'] = $this->PelangganModel->getPelangganWhere(['id_pelanggan' => $this->uri->segment(3)])->row_array();
        $data['tarif'] = $this->TarifModel->getTarif()->result_array();
        $data['datanokwh'] = $this->DataNokwhModel->getDatanokwh()->result_array();

        if ($data['pelanggan']['username'] == $this->input->post('username')) {
            $username = 'required';
        } else {
            $username = 'required|is_unique[pelanggan.username]';
        }

        $this->form_validation->set_rules(
            'username',
            'Nama Lengkap',
            $username,
            [
                'required' => 'Username Tidak Boleh Kosong!',
                'is_unique' => 'Username Sudah Digunakan!'
            ]
        );
    
        $this->form_validation->set_rules(
            'nama_pelanggan',
            'Nama Pelanggan',
            'required',
            [
                'required' => 'Nama Pelanggan Tidak Boleh Kosong!'
            ]
        );

       $this->form_validation->set_rules(
            'nomor_kwh',
            'Nomor KWH',
            'required|min_length[7]',
            [
                'required' => 'Nomor KWH Tidak Boleh Kosong!',
                'min_length' => 'Minimal Nomor KWH 7 Karakter!'
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required',
            [
                'required' => 'Alamat Tidak Boleh Kosong!'
            ]
        );
    
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'min_length[8]|matches[password2]',
            [
                'matches' => 'Password Tidak Sama!',
                'required' => 'Password Harus Diisi!',
                'min_length' => 'Password Terlalu Pendek!'
            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'RepeatPassword',
            'matches[password1]',
            [
                'matches' => 'Password Tidak Sama!',
                'required' => 'Password Harus Diisi!',
                'min_length' => 'Password Terlalu Pendek!'
            ]
        );
        if ($this->form_validation->run() == false) {
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_pelanggan/edit', $data);
        $this->load->view('template/layouts/footer', $data);
        } else {
            $nomor_kwh = $this->input->post('nomor_kwh', true);

            $cekKwh = $this->PelangganModel->cekNoKwh($nomor_kwh);
            if (!$cekKwh) {
                $this->session->set_flashdata('gagal', 'Nomor KWH tidak terdaftar di sistem!');
                redirect($_SERVER['HTTP_REFERER']);
                exit; 
            } else {
                 // Ambil id_tarif dari tabel data_nokwh
            $id_tarif = $cekKwh->id_tarif;
            $id_pelanggan = $this->input->post('id_pelanggan', true);
            $nama_pelanggan = $this->input->post('nama_pelanggan', true);
            $username = $this->input->post('username', true);
            $alamat = $this->input->post('alamat');
            if ($this->input->post('password1')) {
                $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $this->db->set('password', $password);
            }
            }

            $data = array(
                'id_pelanggan' => $id_pelanggan,
                'nama_pelanggan' => $nama_pelanggan,
                'username' => $username,
                'alamat' => $alamat,
                'nomor_kwh' => $nomor_kwh,
                'id_tarif' => $id_tarif,
            );

            $where = array(
                'id_pelanggan' => $id_pelanggan
            );

            $this->UserModel->update_data(
                $where,
                $data,
                'pelanggan'
            );
            $this->session->set_flashdata('message', 'Data Berhasil Diubah!'); // Buat session flashdata
            redirect('data_pelanggan');
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
        if ($data['user']['id_level'] != 1) {
            show_404();
        }
        $where = ['id_pelanggan' => $this->uri->segment(3)];
        $this->PelangganModel->hapusPelanggan($where);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus!'); // Buat session flashdata
        redirect('data_pelanggan');
    }
}
