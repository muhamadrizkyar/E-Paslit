<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
        $data['judul'] = 'Data Petugas';
        $data['sidebar'] = 'petugas';
        $data['userget'] = $this->UserModel->getUser()->result_array();
        $data['level'] = $this->UserModel->getLevel()->result_array();
   	    $this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/data_admin/index', $data);
		$this->load->view('template/layouts/footer', $data);
    }

    public function detail()
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
        $data['judul'] = 'Detail Data Petugas';
        $data['sidebar'] = 'petugas';
        $where = ['id' => $this->uri->segment(3)];
        $data['users'] = $this->UserModel->getUserWhere(['id_user' => $this->uri->segment(3)])->row_array();
        $data['level'] = $this->UserModel->getLevel()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_admin/detail', $data);
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
        $data['judul'] = 'Tambah Data Petugas';
        $data['sidebar'] = 'petugas';
        $where = ['id_user' => $this->uri->segment(3)];
        $data['userget'] = $this->UserModel->getUserWhere(['id_user' => $this->uri->segment(3)])->row_array();
        $data['level'] = $this->UserModel->getLevel()->result_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_admin/create', $data);
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
        $data['judul'] = 'Tambah Data Petugas';
        $data['sidebar'] = 'petugas';
        $data['userget'] = $this->UserModel->getUser()->result_array();
        $data['level'] = $this->UserModel->getLevel()->result_array();

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
            'nama_admin',
            'Nama Lengkap',
            'required',
            [
                'required' => 'Nama Lengkap Tidak Boleh Kosong!'
            ]
        );

        $this->form_validation->set_rules(
            'id_level',
            'Role',
            'required',
            [
                'required' => 'Silahkan Pilih Role!',
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
            $this->load->view('admin/data_admin/create', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
            //konfigurasi sebelum gambar diupload
            $config['upload_path'] = './assets/image-petugas/';
            $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG|webp|gif';
            $config['max_size'] = '3000';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';
            $config['file_name'] = 'adm' . time();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = 'default.jpg';
            }

            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'nama_admin' => $this->input->post('nama_admin', true),
                'id_level' => $this->input->post('id_level'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => $gambar
            ];
            $this->UserModel->simpanData($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan!'); // Buat session flashdata
            redirect('admin');
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
        $data['judul'] = 'Edit Data Petugas';
        $data['sidebar'] = 'petugas';
        $data['level'] = $this->UserModel->getLevel()->result_array();
        $data['getUserWhere'] = $this->UserModel->getUserWhere(['id_user' => $this->uri->segment(3)])->row_array();
        $this->load->view('template/master', $data);
        $this->load->view('template/layouts/navbar', $data);
        $this->load->view('template/layouts/sidebar', $data);
        $this->load->view('admin/data_admin/edit', $data);
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
        $data['judul'] = 'Edit Data Petugas';
        $data['sidebar'] = 'petugas';
        $data['userget'] = $this->UserModel->getUser()->result_array();
        $data['getUserWhere'] = $this->UserModel->getUserWhere(['id_user' => $this->uri->segment(3)])->row_array();
        $data['level'] = $this->UserModel->getLevel()->result_array();

        if ($data['getUserWhere']['username'] == $this->input->post('username')) {
            $username = 'required';
        } else {
            $username = 'required|is_unique[user.username]';
        }

        $this->form_validation->set_rules(
            'username',
            'Username',
            $username,
            [
                'required' => 'Username Tidak Boleh Kosong!',
                'is_unique' => 'Username Sudah Digunakan!'
            ]
        );
    
        $this->form_validation->set_rules(
            'nama_admin',
            'Nama Lengkap',
            'required',
            [
                'required' => 'Nama Lengkap Tidak Boleh Kosong!'
            ]
        );

        $this->form_validation->set_rules(
            'id_level',
            'Role',
            'required',
            [
                'required' => 'Silahkan Pilih Role!',
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
        $this->load->view('admin/data_admin/edit', $data);
        $this->load->view('template/layouts/footer', $data);
        } else {
            $id_user = $this->input->post('id_user', true);
            $nama_admin = $this->input->post('nama_admin', true);
            $username = $this->input->post('username', true);
            $id_level = $this->input->post('id_level');
            if ($this->input->post('password1')) {
                $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $this->db->set('password', $password);
            }

            //jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            //Cek kalau image exist
            if ($upload_image) {
                //Eksekusi script
                $config['upload_path'] = './assets/image-petugas/';
                $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG|webp|gif';
                $config['max_size'] = '3000';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $config['file_name'] = 'adm' . time();
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $data["userss"] = $this->UserModel->getById($id_user);
                    // echo "<prev>";
                    // print_r($data["userss"]);
                    // die;
                    if ($data["userss"]->image != 'default.jpg') {
                        unlink(FCPATH . 'assets/image-petugas/' . $data["userss"]->image);
                    }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                }
            }

            $data = array(
                'id_user' => $id_user,
                'nama_admin' => $nama_admin,
                'username' => $username,
                'id_level' => $id_level,
            );

            $where = array(
                'id_user' => $id_user
            );

            $this->UserModel->update_data(
                $where,
                $data,
                'user'
            );
            $this->session->set_flashdata('message', 'Data Berhasil Diubah!'); // Buat session flashdata
            redirect('admin');
        }
    }

	public function ubah_profile()
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
        $data['judul'] = 'Ubah Profile';
        $data['sidebar'] = 'ubahprofile';
        $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('admin/data_admin/ubah_profile', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('template/layouts/footer', $data);
	}

     public function updateprofile()
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
        $data['judul'] = 'Ubah Profile';
        $data['sidebar'] = 'ubahprofile';
        $data['user'] = $this->UserModel->cekData(['username' => $this->session->userdata('username')])->row_array();
        $data['getUserWhere'] = $this->UserModel->getUserWhere(['id_user' => $this->uri->segment(3)])->row_array();

       $this->form_validation->set_rules(
            'nama_admin',
            'Nama Lengkap',
            'required',
            [
                'required' => 'Nama Lengkap Tidak Boleh Kosong!'
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
            $this->load->view('admin/data_admin/ubah_profile', $data);
            $this->load->view('template/layouts/sidebar', $data);
            $this->load->view('template/layouts/footer', $data);
        } else {
            $id = $this->input->post('id_user', true);
            $nama_admin = $this->input->post('nama_admin', true);
            if ($this->input->post('password1')) {
                $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $this->db->set('password', $password);
            }

            //jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            //Cek kalau image exist
            if ($upload_image) {
                //Eksekusi script
                $config['upload_path'] = './assets/image-petugas/';
                $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG|webp|gif';
                $config['max_size'] = '3000';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $config['file_name'] = 'adm' . time();
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];
                    // echo "<prev>";
                    // print_r($gambar_lama);
                    // die;
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/image-petugas/' . $gambar_lama);
                    }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                }
            }
            $data = array(
                'id_user' => $id,
                'nama_admin' => $nama_admin,
            );

            $where = array(
                'id_user' => $id
            );

            $this->UserModel->update_data(
                $where,
                $data,
                'user'
            );
            $this->session->set_flashdata('ubah-profile', 'Data Profile Berhasil Diubah!'); // Buat session flashdata
            redirect('dashboard-admin');
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
        $where = ['id_user' => $this->uri->segment(3)];
        $data['users'] = $this->UserModel->getUserWhere(['id_user' => $this->uri->segment(3)])->row_array();
        $gambar_lama = $data['users']['image'];
        if ($gambar_lama != 'default.jpg') {
            unlink(FCPATH . 'assets/image-petugas/' . $gambar_lama);
        }
        $this->UserModel->hapusUser($where);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus!'); // Buat session flashdata
        redirect('admin');
    }
}
