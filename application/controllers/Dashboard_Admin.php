<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Admin extends CI_Controller {
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
        $data['judul'] = 'Dashboard';
        $data['sidebar'] = 'dashboard';
        $data['sum_user'] = $this->DashboardAdminModel->TotalUser();
        $data['tarif'] = $this->DashboardAdminModel->TotalTarif();
        $data['pelanggan'] = $this->DashboardAdminModel->TotalPelanggan();
        $data['datanokwh'] = $this->DashboardAdminModel->TotalDatanokwh();
        $data['penggunaan'] = $this->DashboardAdminModel->TotalPenggunaan();
        $data['verifikasi'] = $this->DashboardAdminModel->TotalVerifikasiTagihan();
        $data['tagihan_lunas'] = $this->DashboardAdminModel->TotalTagihanLunas();

		$this->load->view('template/master', $data);
		$this->load->view('template/layouts/navbar', $data);
		$this->load->view('template/layouts/sidebar', $data);
		$this->load->view('admin/dashboard/index', $data);
		$this->load->view('template/layouts/footer', $data);
	}

    public function getTagihanChartData()
{
    $tahun = $this->input->get('tahun');
    if (!$tahun) {
        $tahun = date('Y');
    }

    $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
               "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    $tagihanData = $this->DashboardAdminModel->getDataTagihanByStatusAndMonth([0, 3], $tahun);
    $lunasData = $this->DashboardAdminModel->getDataTagihanByStatusAndMonth([2], $tahun);
    $prosesData = $this->DashboardAdminModel->getDataTagihanByStatusAndMonth([1], $tahun);

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
                'backgroundColor' => 'rgba(255, 206, 86, 0.3)',
                'borderColor' => 'rgb(255, 206, 86)',
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
