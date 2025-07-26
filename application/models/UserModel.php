<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserModel extends CI_Model
{
    private $table = "user";
    public function getUser($id = null)
    {
        // return $this->db->get('kategori');
        $this->db->order_by('id_user', 'DESC');
        $this->db->from('user');
        return $this->db->get();
    }
    public function getLevel($id = null)
    {
        // return $this->db->get('kategori');
        $this->db->order_by('id_level', 'DESC');
        $this->db->from('level');
        return $this->db->get();
    }
    public function simpanData($data = null)
    {
        $this->db->insert('user', $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_user" => $id])->row();
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
        return $this->db->get_where('user', $where);
    }
    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }
    public function hapusUser($where = null)
    {
        $this->db->delete('user', $where);
    }
}
