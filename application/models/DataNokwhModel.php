<?php
defined('BASEPATH') or exit('No direct script access allowed');
class DataNokwhModel extends CI_Model
{
    public function getDatanokwh()
    {
        $this->db->order_by('id_nokwh', 'DESC');
        return $this->db->get('data_nokwh',);
    }
    public function getDatanokwhs($limit, $start)
    {
        $this->db->order_by('id_nokwh', 'DESC');
        return $this->db->get('data_nokwh',$limit,$start);
    }
    public function DatanokwhWhere($where)
    {
        return $this->db->get_where('data_nokwh', $where);
    }
    public function createDatanokwh($data = null)
    {
        $this->db->insert('data_nokwh', $data);
    }
    public function updateDatanokwh($where = null, $data = null)
    {
        $this->db->update('data_nokwh', $data, $where);
    }
    public function hapusDatanokwh($where = null)
    {
        $this->db->delete('data_nokwh', $where);
    }
}
