<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 	public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan();
    }
	public function index()
{
    $data['pelanggan'] = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();

    if (!$data['pelanggan']) {
        redirect('autentifikasi');
    }

    $pelanggan_id = $data['pelanggan']['id_pelanggan'];

    $data['total_penggunaan'] = $this->DashboardModel->totalPenggunaan($pelanggan_id);
    $data['total_tagihan_listrik'] = $this->DashboardModel->totalTagihanListrik($pelanggan_id);
    $data['total_verifikasi_tagihan'] = $this->DashboardModel->totalVerifikasiTagihan($pelanggan_id);
    $data['total_pembayaran_berhasil'] = $this->DashboardModel->totalPembayaranBerhasil($pelanggan_id);

    $data['judul'] = 'Dashboard';
    $data['sidebar'] = 'dashboard';

    $this->load->view('template/master', $data);
    $this->load->view('template/layouts/_navbar', $data);
    $this->load->view('template/layouts/_sidebar', $data);
    $this->load->view('pelanggan/dashboard/index', $data);
    $this->load->view('template/layouts/_footer', $data);
}

public function getTagihanChartData()
{
    $tahun = $this->input->get('tahun'); // ambil dari AJAX
    if (!$tahun) {
        $tahun = date('Y'); // default kalau kosong
    }

    $pelanggan = $this->PelangganModel->cekData(['username' => $this->session->userdata('username')])->row_array();
    $pelanggan_id = $pelanggan['id_pelanggan'];

    $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    $tagihanData = $this->DashboardModel->getDataTagihanByStatusAndMonth($pelanggan_id, [0, 3], $tahun);
    $lunasData = $this->DashboardModel->getDataTagihanByStatusAndMonth($pelanggan_id, [2], $tahun);
    $prosesData = $this->DashboardModel->getDataTagihanByStatusAndMonth($pelanggan_id, [1], $tahun); // ambil status 1 (proses)

    $data = [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Tagihan Belum Lunas',
                'data' => $tagihanData,
                'backgroundColor' => 'rgba(255, 99, 132, 0.3)',
                'borderColor' => 'rgb(255, 0, 0)',
                'borderWidth' => 2
            ],
            [
                'label' => 'Tagihan Proses',
                'data' => $prosesData,
                'backgroundColor' => 'rgba(255, 206, 86, 0.3)', // kuning transparan
                'borderColor' => 'rgb(255, 206, 86)', // kuning
                'borderWidth' => 2
            ],
             [
                'label' => 'Tagihan Lunas',
                'data' => $lunasData,
                'backgroundColor' => 'rgba(75, 192, 75, 0.3)',
                'borderColor' => 'rgb(0, 128, 0)',
                'borderWidth' => 2
            ],
        ]
    ];

    echo json_encode($data);
}




}
