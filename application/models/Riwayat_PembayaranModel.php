<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Riwayat_PembayaranModel extends CI_Model
{
    public function getPembayaran()
    {
        $this->db->order_by('tanggal_pembayaran', 'DESC');
        return $this->db->get('pembayaran',);
    }

    public function GetPemBerhasil()
    {
        $this->db->select('pembayaran.*, tagihan.*');
        $this->db->from('pembayaran');
        $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
        $this->db->where('tagihan.status', 2);
        $this->db->order_by('pembayaran.tanggal_pembayaran', 'DESC'); // Urutkan DESC
        return $this->db->get();
    }

    // Ambil pembayaran per ID + join tagihan & pelanggan
    public function getPembayaranByIdd($id_pembayaran)
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

}
