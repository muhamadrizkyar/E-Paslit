<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentifikasi extends CI_Controller {

public function index()
{
	 //jika statusnya sudah login, maka tidak bisa mengakses
        //halaman login alias dikembalikan ke tampilan user
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }

        // Set method Validation untuk form
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim',
            [
                'required' => 'Username Tidak Boleh Kosong!',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            [
                'required' => 'Password Tidak Boleh Kosong!'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $this->load->view('template/master_auth', $data);
			$this->load->view('autentifikasi/login_pelanggan', $data);
			$this->load->view('template/layouts/footer_auth', $data);
        } else {
            $this->_login_pelanggan();
        }
}

private Function _login_pelanggan()
{
        $username = htmlspecialchars($this->input->post('username', true));
        $password = $this->input->post('password', true);
        $pelanggan = $this->PelangganModel->cekData(['username' => $username])->row_array();

        // Jika usernya ada (exist)
        if ($pelanggan) {
            // Cek password
            if (password_verify($password, $pelanggan['password'])) {
                $data = [
                    'username' => $pelanggan['username']
                ];
                $this->session->set_userdata($data);

                $this->session->set_flashdata('message', 'Login Berhasil!');
                redirect('dashboard'); // Langsung ke dashboard

            } else {
                $this->session->set_flashdata('message', 'Password Salah! Silakan Masukkan Kembali.');
                redirect('autentifikasi');
            }
        } else {
            $this->session->set_flashdata('message', 'Akun Tidak Ditemukan atau Belum Terdaftar!');
            redirect('autentifikasi');
        }

}

public function daftar()
{
	$data['judul'] = 'Daftar';
    $this->load->view('template/master_auth', $data);
	$this->load->view('autentifikasi/daftar_pelanggan', $data);
	$this->load->view('template/layouts/footer_auth', $data);
}

  public function DaftarProses()
    {
        $data['judul'] = 'Daftar';

        $this->form_validation->set_rules(
            'nama_pelanggan',
            'Nama Lengkap',
            'required',
            [
                'required' => 'Nama Lengkap Tidak Boleh Kosong!'
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
            'nomor_kwh',
            'Nomor KWH',
            'required|min_length[7]',
            [
                'required' => 'Nomor KWH Tidak Boleh Kosong!',
                'min_length' => 'Minimal Nomor KWH 7 Karakter!'
            ]
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim|is_unique[user.username]',
            [
                'required' => 'Username Tidak Boleh Kosong!',
                'is_unique' => 'Username Sudah Terdaftar!'
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
            $this->load->view('template/master_auth', $data);
            $this->load->view('autentifikasi/daftar_pelanggan', $data);
            $this->load->view('template/layouts/footer_auth', $data);
        } else {
    $nomor_kwh = $this->input->post('nomor_kwh', true);

    $cekKwh = $this->PelangganModel->cekNoKwh($nomor_kwh);

    if (!$cekKwh) {
        $this->session->set_flashdata('gagal', 'Nomor KWH tidak terdaftar di sistem!');
        redirect('autentifikasi/daftar');
    }

    // Ambil id_tarif dari tabel data_nokwh
    $id_tarif = $cekKwh->id_tarif;

     //konfigurasi sebelum gambar diupload
            $config['upload_path'] = './assets/image-pelanggan/';
            $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG|webp|gif';
            // $config['allowed_types'] = '*';
            // $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG|webp|gif';
            // $config['max_size'] = '3000';
            // $config['max_width'] = '3000';
            // $config['max_height'] = '3000';
            $config['file_name'] = 'avt' . time();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = 'default.jpg';
            }
    $data = [
        'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
        'alamat' => htmlspecialchars($this->input->post('alamat', true)),
        'nomor_kwh' => $nomor_kwh,
        'id_tarif' => $id_tarif,
        'username' => $this->input->post('username'),
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'image' => $gambar
    ];

    $this->PelangganModel->simpanData($data);
    $this->session->set_flashdata('daftar', 'Data Berhasil Ditambahkan!');
    redirect('autentifikasi');
}
    }
    public function logout_pelanggan()
    {
        $item = array('username');
        $this->session->unset_userdata($item);
        redirect('autentifikasi');
    }

public function index_admin()
    {
        //jika statusnya sudah login, maka tidak bisa mengakses
        //halaman login alias dikembalikan ke tampilan user
        if ($this->session->userdata('username')) {
            redirect('dashboard-admin');
        }

        // Set method Validation untuk form
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim',
            [
                'required' => 'Username Tidak Boleh Kosong!',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            [
                'required' => 'Password Tidak Boleh Kosong!'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $this->load->view('template/master_auth', $data);
			$this->load->view('autentifikasi/login_admin', $data);
			$this->load->view('template/layouts/footer_auth', $data);
        } else {
            $this->_login_admin();
        }
    }
	   private function _login_admin()
    {
        $username = htmlspecialchars($this->input->post('username', true));
        $password = $this->input->post('password', true);
        $user = $this->UserModel->cekData(['username' => $username])->row_array();

        //jika usernya ada (exist)
        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'id_level' => $user['id_level']
                ];
                $this->session->set_userdata($data);

                if ($user['id_level'] == 1) {
                    $this->session->set_flashdata('message', 'Login Berhasil!'); // Buat session flashdata
                    redirect('dashboard-admin');
                } else {
                    $this->session->set_flashdata('message', 'Login Berhasil!'); // Buat session flashdata
                    redirect('dashboard-admin');
                }
            } else {
                $this->session->set_flashdata('message', 'Password Salah Silahkan Masukkan Kembali!'); // Buat session flashdata
                redirect('login-admin');
            }
        } else {
            $this->session->set_flashdata('message', 'Akun Tidak Ditemukan Atau Belum Terdaftar!'); // Buat session flashdata
            redirect('login-admin');
        }
    }
	public function logout_admin()
    {
        $item = array('username', 'id_level');
        $this->session->unset_userdata($item);
        redirect('login-admin');
    }
	public function login_register()
	{
		$this->load->view('template/master_auth');
		$this->load->view('autentifikasi/login_register');
		$this->load->view('template/layouts/footer_auth');
	}

}
