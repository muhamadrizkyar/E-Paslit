<?php
defined('BASEPATH') or exit('No direct script access allowed');
class TarifModel extends CI_Model
{
    public function getTarif()
    {
        $this->db->order_by('id_tarif', 'DESC');
        return $this->db->get('tarif',);
    }
    public function getTarifs($limit, $start)
    {
        $this->db->order_by('id_tarif', 'DESC');
        return $this->db->get('tarif',$limit,$start);
    }
    public function tarifWhere($where)
    {
        return $this->db->get_where('tarif', $where);
    }
    public function createTarif($data = null)
    {
        $this->db->insert('tarif', $data);
    }
    public function updateTarif($where = null, $data = null)
    {
        $this->db->update('tarif', $data, $where);
    }
    public function hapusTarif($where = null)
    {
        $this->db->delete('tarif', $where);
    }
}
