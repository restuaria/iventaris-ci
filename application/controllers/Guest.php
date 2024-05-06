<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_admin', 'm_admin');
    }
    public function index()
    {
        $this->template_adm->load('guest/template_adm', 'guest/dashboard');
    }
    public function databarang()
    {
        $data['barang'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id 
		 and barang_lokasi=fakultas_id  order by barang_kategori, barang_nama asc")->result();
        $this->template_adm->load('guest/template_adm', 'guest/v_barang', $data);
    }
    function filterbarang()
    {
        $fakultas = $this->input->post("fakultas");
        $data['barang'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id  
		and barang_lokasi=fakultas_id and barang_lokasi='$fakultas'  ORDER BY barang_kategori, barang_nama asc")->result();
        $this->template_adm->load('guest/template_adm', 'guest/v_barang', $data);
    }
    public function barangkeluar()
    {
        $this->template_adm->load('guest/template_adm', 'guest/v_barang_keluar');
    }
    public function barangmasuk()
    {
        $this->template_adm->load('guest/template_adm', 'guest/v_barang_masuk');
    }
    function peminjaman()
    {
        $this->template_adm->load('guest/template_adm', 'guest/v_barang_pinjam');
    }
    function suplier()
    {
        $this->template_adm->load('guest/template_adm', 'guest/v_suplier');
    }
    public function prasarana()
    {
        $data['data'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		order by barang_ruangan asc")->result();

        $this->template_adm->load('guest/template_adm', 'guest/v_prasarana', $data);
    }
    function kategori()
    {
        $this->template_adm->load('guest/template_adm', 'guest/v_kategori');
    }
    function lokasi()
    {
        $this->template_adm->load('guest/template_adm', 'guest/v_lokasi');
    }
    function lokasi_sebaran()
    {
        $this->template_adm->load('guest/template_adm', 'guest/v_lokasi_sebaran');
    }
}
