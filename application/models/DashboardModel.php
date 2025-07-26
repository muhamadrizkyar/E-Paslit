<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{
    public function totalPenggunaan($pelanggan_id)
    {
        return $this->db->where('id_pelanggan', $pelanggan_id)->count_all_results('penggunaan');
    }

        public function totalTagihanListrik($pelanggan_id)
        {
        return $this->db->where('id_pelanggan', $pelanggan_id)
                        ->where_in('status', [0, 3]) // status 0 & 3 = Tagihan
                        ->count_all_results('tagihan');
        }


    public function totalVerifikasiTagihan($pelanggan_id)
    {
        return $this->db->where('id_pelanggan', $pelanggan_id)
                        ->where('status', 1) // contoh: status 1 = menunggu verifikasi
                        ->count_all_results('tagihan');
    }

    public function totalPembayaranBerhasil($pelanggan_id)
    {
        return $this->db->where('id_pelanggan', $pelanggan_id)
                        ->where('status', 2) // contoh: status 2 = lunas
                        ->count_all_results('tagihan');
    }

    public function getStatusTagihan($pelanggan_id)
    {
        $this->db->select('status, COUNT(*) as total');
        $this->db->from('tagihan');
        $this->db->where('id_pelanggan', $pelanggan_id);
        $this->db->group_by('status');
        return $this->db->get()->result_array();
    }

public function getDataTagihanByStatusAndMonth($pelanggan_id, $statusList, $tahun)
{
    $data = [];
    $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
               "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    foreach ($labels as $index => $month) {
        $this->db->select('COUNT(*) as count');
        $this->db->from('tagihan');
        $this->db->where('id_pelanggan', $pelanggan_id);
        $this->db->where_in('status', $statusList);
        $this->db->where('bulan', $index + 1);
        $this->db->where('tahun', $tahun); 

        $result = $this->db->get()->row_array();
        $data[] = isset($result['count']) ? (int)$result['count'] : 0;
    }

    return $data;
}



}
