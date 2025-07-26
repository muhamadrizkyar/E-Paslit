<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdminModel extends CI_Model
{
     public function TotalUser()
    {
      return $this->db->count_all("user");
    }

    public function TotalTarif()
    {
      return $this->db->count_all("tarif");
    }
    public function TotalPelanggan()
    {
      return $this->db->count_all("pelanggan");
    }
    public function TotalDatanokwh()
    {
      return $this->db->count_all("data_nokwh");
    }
    public function TotalPenggunaan()
    {
      return $this->db->count_all("penggunaan");
    }
    public function TotalVerifikasiTagihan()
    {
    $this->db->where('status', 1);
    return $this->db->count_all_results('tagihan');
    }
    public function TotalTagihanLunas()
    {
    $this->db->where('status', 2);
    return $this->db->count_all_results('tagihan');
    }

    public function getDataTagihanByStatusAndMonth($statusList, $tahun)
    {
        $data = [];
        $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        foreach ($labels as $index => $month) {
            $this->db->select('COUNT(*) as count');
            $this->db->from('tagihan');
            $this->db->where_in('status', $statusList);
            $this->db->where('bulan', $index + 1);
            $this->db->where('tahun', $tahun);

            $result = $this->db->get()->row_array();
            $data[] = isset($result['count']) ? (int)$result['count'] : 0;
        }

        return $data;
    }


}