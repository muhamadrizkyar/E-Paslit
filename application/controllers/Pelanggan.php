<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan();
    }
	public function ubah_profile()
	{
	    // Ambil user by session
		$data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

		// Cek session kosong atau user tidak ditemukan
		if (!$data['pelanggan']) {
			redirect('autentifikasi'); 
			// atau show_404();
		}
        $data['judul'] = 'Ubah Profile';
        $data['sidebar'] = 'ubahprofile';
        $data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/_navbar', $data);
		$this->load->view('pelanggan/data_pelanggan/ubah_profile', $data);
		$this->load->view('template/layouts/_sidebar', $data);
		$this->load->view('template/layouts/_footer', $data);
	}

      public function updateprofile()
    {
        $data['judul'] = 'Ubah Profile';
        $data['sidebar'] = 'ubahprofile';
        $data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();
        $data['getPelangganWhere'] = $this->PelangganModel->getPelangganWhere(['id_pelanggan' => $this->uri->segment(3)])->row_array();

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
            $this->load->view('template/layouts/_navbar', $data);
            $this->load->view('pelanggan/data_pelanggan/ubah_profile', $data);
            $this->load->view('template/layouts/_sidebar', $data);
            $this->load->view('template/layouts/_footer', $data);
        } else {
            $id = $this->input->post('id_pelanggan', true);
            $nama_pelanggan = $this->input->post('nama_pelanggan', true);
            $alamat = $this->input->post('alamat', true);
            if ($this->input->post('password1')) {
                $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $this->db->set('password', $password);
            }

            //jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            //Cek kalau image exist
            if ($upload_image) {
                //Eksekusi script
                $config['upload_path'] = './assets/image-pelanggan/';
                $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG|webp|gif';
                $config['max_size'] = '3000';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $config['file_name'] = 'avt' . time();
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['pelanggan']['image'];
                    // echo "<prev>";
                    // print_r($gambar_lama);
                    // die;
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/image-pelanggan/' . $gambar_lama);
                    }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                }
            }
            $data = array(
                'id_pelanggan' => $id,
                'nama_pelanggan' => $nama_pelanggan,
                'alamat' => $alamat,
            );

            $where = array(
                'id_pelanggan' => $id
            );

            $this->PelangganModel->update_data(
                $where,
                $data,
                'pelanggan'
            );
            $this->session->set_flashdata('ubah-profile', 'Data Profile Berhasil Diubah!'); // Buat session flashdata
            redirect('dashboard');
        }
    }

}
