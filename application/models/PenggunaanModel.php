<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PenggunaanModel extends CI_Model
{
    public function getPenggunaanWithPelanggan()
{
    $this->db->select('penggunaan.*, pelanggan.*'); // Pilih kolom yg mau ditampilkan
    $this->db->from('penggunaan');
    $this->db->join('pelanggan', 'penggunaan.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->order_by('penggunaan.id_penggunaan', 'DESC');
    return $this->db->get();
}
public function getPenggunaanWithStatus($id_pelanggan)
{
    $this->db->select('penggunaan.*, tagihan.status');
    $this->db->from('penggunaan');
    $this->db->join('tagihan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
    $this->db->where('penggunaan.id_pelanggan', $id_pelanggan); // Tambahkan ini
    $this->db->order_by('penggunaan.id_penggunaan', 'DESC');
    return $this->db->get();
}

    public function getPenggunaan()
    {
        $this->db->order_by('id_penggunaan', 'DESC');
        return $this->db->get('penggunaan',);
    }
    public function getPenggunaans($limit, $start)
    {
        $this->db->order_by('id_penggunaan', 'DESC');
        return $this->db->get('penggunaan',$limit,$start);
    }
    public function penggunaanWhere($where)
    {
        return $this->db->get_where('penggunaan', $where);
    }
    public function createPenggunaan($data = null)
    {
        $this->db->insert('penggunaan', $data);
    }
    public function updatePenggunaan($where = null, $data = null)
    {
        $this->db->update('penggunaan', $data, $where);
    }
    public function hapusPenggunaan($where = null)
    {
        $this->db->delete('penggunaan', $where);
    }

    public function hapusPenggunaanTagihan($id_penggunaan)
    {
        $this->db->where('id_penggunaan', $id_penggunaan);
        $this->db->delete('tagihan');

        $this->db->where('id_penggunaan', $id_penggunaan);
        $this->db->delete('penggunaan');
    }
}
