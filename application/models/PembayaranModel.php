<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PembayaranModel extends CI_Model
{
    public function getPembayaran()
    {
        $this->db->order_by('id_pembayaran', 'DESC');
        return $this->db->get('pembayaran',);
    }
public function getPembayaranssss()
{
    $this->db->select('pembayaran.*, tagihan.status');
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
    $this->db->where('tagihan.status', 1);
    $this->db->order_by('pembayaran.id_pembayaran', 'DESC'); // Urutkan DESC
    return $this->db->get();
}
public function getPembayaranBehasil()
{
    $this->db->select('pembayaran.*, tagihan.*');
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
    $this->db->where('tagihan.status', 2);
    $this->db->order_by('pembayaran.id_pembayaran', 'DESC'); // Urutkan DESC
    return $this->db->get();
}

public function getPembayaranLunasByPelanggan($id_pelanggan)
{
    $this->db->select('pembayaran.*, tagihan.*');
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
    $this->db->where('tagihan.status', 2);
    $this->db->where('pembayaran.id_pelanggan', $id_pelanggan);
    $this->db->order_by('pembayaran.id_pembayaran', 'DESC');
    return $this->db->get();
}

// Ambil pembayaran per ID + join tagihan & pelanggan
public function getPembayaranById($id_pembayaran)
{
    $this->db->select('
        pembayaran.*,
        tagihan.*,
        pelanggan.nama_pelanggan,
        pelanggan.alamat
    ');
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
    $this->db->join('pelanggan', 'pembayaran.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->where('pembayaran.id_pembayaran', $id_pembayaran);
    return $this->db->get()->row(); // 1 baris saja
}
    public function getPembayarans($limit, $start)
    {
        $this->db->order_by('id_pembayaran', 'DESC');
        return $this->db->get('pembayaran',$limit,$start);
    }
    public function pembayaranWhere($where)
    {
        return $this->db->get_where('pembayaran', $where);
    }
    public function createPembayaran($data = null)
    {
        $this->db->insert('pembayaran', $data);
    }
    public function updatePembayaran($where = null, $data = null)
    {
        $this->db->update('pembayaran', $data, $where);
    }
    public function getBayars($where)
    {
        return $this->db->get_where('pembayaran', $where);
    }

    public function hapusPembayaran($where)
    {
        $this->db->where($where);
        $this->db->delete('pembayaran');
    }
}
