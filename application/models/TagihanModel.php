<?php
defined('BASEPATH') or exit('No direct script access allowed');
class TagihanModel extends CI_Model
{
   public function getTagihan()
{
    $this->db->select('
        tagihan.*,
        pelanggan.id_tarif,
        tarif.tarifperkwh
    ');
    $this->db->from('tagihan');
    $this->db->join('pelanggan', 'tagihan.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->join('tarif', 'pelanggan.id_tarif = tarif.id_tarif');
    $this->db->order_by('tagihan.id_tagihan', 'DESC');

    return $this->db->get();
}
public function getTagihanById($id_tagihan)
{
    $this->db->select('
        tagihan.*,
        pelanggan.nama_pelanggan,
        pelanggan.nomor_kwh,
        tarif.tarifperkwh
    ');
    $this->db->from('tagihan');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    $this->db->where('tagihan.id_tagihan', $id_tagihan);
    return $this->db->get()->row_array();
}
    public function getTagihans($limit, $start)
    {
        $this->db->order_by('id_tagihan', 'DESC');
        return $this->db->get('tagihan',$limit,$start);
    }
    public function tagihanWhere($where)
    {
        return $this->db->get_where('tagihan', $where);
    }
    public function createTagihan($data = null)
    {
        $this->db->insert('tagihan', $data);
    }
    public function updateTagihan($where = null, $data = null)
    {
        $this->db->update('tagihan', $data, $where);
    }
   public function getPembayaranByTagihanId($id_tagihan)
    {
        return $this->db->get_where('pembayaran', ['id_tagihan' => $id_tagihan])->row_array();
    }
}
