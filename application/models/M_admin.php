<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    //Login
    public function __construct()
    {
        parent::__construct();
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $dataaa, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $dataaa);
    }
    public function dbarang($id)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('fakultas', 'fakultas.fakultas_id = barang.barang_lokasi');
        $this->db->join('kategori', 'kategori.kategori_id = barang.barang_kategori');
        $this->db->where('barang.barang_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function hapus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
