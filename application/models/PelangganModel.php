<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PelangganModel extends CI_Model
{
    private $table = "pelanggan";
    public function getPelanggan($id = null)
    {
        // return $this->db->get('kategori');
        $this->db->order_by('id_pelanggan', 'DESC');
        $this->db->from('pelanggan');
        return $this->db->get();
    }
    public function cekNoKwh($no_kwh)
    {
        return $this->db->get_where('data_nokwh', ['nomor_kwh' => $no_kwh])->row();
    }
    public function simpanData($data = null)
    {
        $this->db->insert('pelanggan', $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_pelanggan" => $id])->row();
        //query diatas seperti halnya query pada mysql 
        //select * from mahasiswa where IdMhsw='$id'
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function cekData($where = null)
    {
        return $this->db->get_where('pelanggan', $where);
    }
    public function getPelangganWhere($where = null)
    {
        return $this->db->get_where('pelanggan', $where);
    }
    public function hapusPelanggan($where = null)
    {
        $this->db->delete('pelanggan', $where);
    }
}
