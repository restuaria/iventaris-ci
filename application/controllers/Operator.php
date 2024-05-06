<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Reader\Csv;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require 'vendor/autoload.php';
class Operator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_admin', 'm_admin');
        if ($this->session->userdata('user_level') != "operator") {
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $this->template_adm->load('operator/template_adm', 'operator/dashboard');
    }

    public function databarang()
    {
        $data['barang'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id 
		 and barang_lokasi=fakultas_id order by barang_id desc")->result();
        $this->template_adm->load('operator/template_adm', 'operator/v_barang', $data);
    }

    function filterbarang()
    {
        $fakultas = $this->input->post("fakultas");
        $data['barang'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id  
		and barang_lokasi=fakultas_id and barang_lokasi='$fakultas'  ORDER BY barang_kategori, barang_nama asc")->result();
        $this->template_adm->load('operator/template_adm', 'operator/v_barang', $data);
    }

    function barangpdf()
    {
        $data['data'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id 
		and barang_lokasi=fakultas_id  order by barang_kategori, barang_nama asc")->result();
        $this->load->view('operator/v_barang_pdf', $data);
    }

    function barangexcel()
    {
        $data['barang'] = $this->db->query("SELECT * FROM fakultas,barang,kategori where barang_kategori=kategori_id  
		and barang_lokasi=fakultas_id order by barang_kategori, barang_nama asc ")->result();
        $this->load->view('operator/v_barang_excel', $data);
    }

    function barangdetail($id)
    {
        $data['data'] = $this->m_admin->dbarang($id);
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_detail', $data);
    }

    function barang_tambah()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_tambah');
    }

    function prosestambah_barang()
    {
        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');
        $user = $this->input->post('user');
        $tahun = $this->input->post('tahun');
        $lokasi = $this->input->post('lokasi');
        $spesifikasi = $this->input->post('spesifikasi');
        $kondisi = $this->input->post('kondisi');
        $jumlah = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');
        $kategori = $this->input->post('kategori');
        $merk = $this->input->post('merk');
        $sumber = $this->input->post('sumber');
        $keterangan = $this->input->post('keterangan');
        $jenis = $this->input->post('jenis');

        if (isset($_FILES["foto"]["name"])) {
            //konfigurasi 
            $config["upload_path"]      = './file/barang/';
            $config["allowed_types"]    = 'jpg|jpeg|png|';
            //load library upload
            $this->load->library("upload", $config);
            // lakukan upload
            if (!$this->upload->do_upload("foto")) {
                $data1 = [
                    'barang_kode' => $kode,
                    'barang_nama' => $nama,
                    'barang_sumber' => $nama,
                    'barang_user' => $user,
                    'barang_tahun' => $tahun,
                    'barang_spesifikasi' => $spesifikasi,
                    'barang_kondisi' => $kondisi,
                    'barang_jumlah' => $jumlah,
                    'barang_lokasi' => $lokasi,
                    'barang_kategori' => $kategori,
                    'barang_satuan' => $satuan,
                    'barang_merk' => $merk,
                    'barang_sumber' => $sumber,
                    'barang_jenis' => $jenis,
                    'barang_keterangan' => $keterangan,
                ];
                // call method simpan gambar
                $this->db->insert('barang', $data1);

                //response ke ajax
                redirect("operator/databarang?alert=berhasiltanpafoto");
            } else {
                $data_gambar = $this->upload->data(); // simpan gambar
                // compress image start
                $config['image_library'] = 'gd2';
                $config['source_image']  = './file/barang/' . $data_gambar["file_name"];
                $config['create_thumb']  = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 709;
                $config['height']        = 472;
                // $config['new_image']     = './file/foto/' . $data_gambar["file_name"];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                // end compress setup
                // data dosen yg akan disimpan
                $data1 = [
                    'barang_kode' => $kode,
                    'barang_nama' => $nama,
                    'barang_sumber' => $nama,
                    'barang_user' => $user,
                    'barang_tahun' => $tahun,
                    'barang_spesifikasi' => $spesifikasi,
                    'barang_kondisi' => $kondisi,
                    'barang_jumlah' => $jumlah,
                    'barang_lokasi' => $lokasi,
                    'barang_kategori' => $kategori,
                    'barang_satuan' => $satuan,
                    'barang_merk' => $merk,
                    'barang_sumber' => $sumber,
                    'barang_jenis' => $jenis,
                    'barang_keterangan' => $keterangan,
                    'barang_foto' => $data_gambar["file_name"],
                ];
                // call method simpan gambar
                $this->db->insert('barang', $data1);

                //response ke ajax
                redirect("operator/databarang?alert=berhasil");
            }
        }
    }

    function barang_edit($id)
    {
        $data['data'] = $this->m_admin->dbarang($id);
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_edit', $data);
    }

    function prosesedit_barang($id)
    {
        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');
        $user = $this->input->post('user');
        $tahun = $this->input->post('tahun');
        $lokasi = $this->input->post('lokasi');
        $spesifikasi = $this->input->post('spesifikasi');
        $kondisi = $this->input->post('kondisi');
        $jumlah = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');
        $kategori = $this->input->post('kategori');
        $merk = $this->input->post('merk');
        $sumber = $this->input->post('sumber');
        $keterangan = $this->input->post('keterangan');
        $jenis = $this->input->post('jenis');

        if (isset($_FILES["foto"]["name"])) {
            //konfigurasi 
            $config["upload_path"]      = './file/barang/';
            $config["allowed_types"]    = 'jpg|jpeg|png|';
            //load library upload
            $this->load->library("upload", $config);
            // lakukan upload
            if (!$this->upload->do_upload("foto")) {
                $data1 = [
                    'barang_kode' => $kode,
                    'barang_nama' => $nama,
                    'barang_sumber' => $nama,
                    'barang_user' => $user,
                    'barang_tahun' => $tahun,
                    'barang_spesifikasi' => $spesifikasi,
                    'barang_kondisi' => $kondisi,
                    'barang_jumlah' => $jumlah,
                    'barang_lokasi' => $lokasi,
                    'barang_kategori' => $kategori,
                    'barang_satuan' => $satuan,
                    'barang_merk' => $merk,
                    'barang_sumber' => $sumber,
                    'barang_jenis' => $jenis,
                    'barang_keterangan' => $keterangan,

                ];
                // call method simpan gambar
                $this->db->where('barang_id', $id);
                $this->db->update('barang', $data1);

                //response ke ajax
                redirect("operator/databarang?alert=update");
            } else {
                $data_gambar = $this->upload->data(); // simpan gambar
                // compress image start
                $config['image_library'] = 'gd2';
                $config['source_image']  = './file/barang/' . $data_gambar["file_name"];
                $config['create_thumb']  = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 709;
                $config['height']        = 472;
                // $config['new_image']     = './file/foto/' . $data_gambar["file_name"];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                // end compress setup

                // data dosen yg akan disimpan
                $data1 = [
                    'barang_kode' => $kode,
                    'barang_nama' => $nama,
                    'barang_sumber' => $nama,
                    'barang_user' => $user,
                    'barang_tahun' => $tahun,
                    'barang_spesifikasi' => $spesifikasi,
                    'barang_kondisi' => $kondisi,
                    'barang_jumlah' => $jumlah,
                    'barang_lokasi' => $lokasi,
                    'barang_kategori' => $kategori,
                    'barang_satuan' => $satuan,
                    'barang_merk' => $merk,
                    'barang_sumber' => $sumber,
                    'barang_jenis' => $jenis,
                    'barang_keterangan' => $keterangan,
                    'barang_foto' => $data_gambar["file_name"],
                ];
                // call method simpan gambar
                $this->db->where('barang_id', $id);
                $this->db->update('barang', $data1);

                //response ke ajax
                redirect("operator/databarang?alert=update");
            }
        }
    }

    public function hapus_barang($id)
    {
        $where = array('barang_id' => $id);
        $this->m_admin->hapus($where, 'barang');
        redirect('operator/databarang?alert=hapus');
    }

    public function barangkeluar()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_keluar');
    }

    function barangkeluarpdf()
    {
        $this->load->view('operator/v_barang_keluar_pdf');
    }

    function barangkeluarexcel()
    {
        $this->load->view('operator/v_barang_keluar_excel');
    }

    function tambahbarangkeluar()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_keluar_tambah');
    }

    function prosestambahbk()
    {

        $barang = $this->input->post('barang');

        $tanggal = $this->input->post('tanggal');
        $jumlah = $this->input->post('jumlah');
        $penerima = $this->input->post('penerima');
        $lokasi2 = $this->input->post('lokasi2');
        $lokasi = $this->input->post('lokasi');
        $keterangan = $this->input->post('keterangan');
        $user = $this->input->post('user');

        $nm = $this->db->query("SELECT * FROM barang where barang_id = $barang")->result();
        foreach ($nm as $nabar);
        $nama_barang = $nabar->barang_nama;
        $jumlah_barang = $nabar->barang_jumlah;

        // cek jika jumlah yang diinput lebih besar dari jumlah barang yang ada

        if ($jumlah > $jumlah_barang) {
            redirect("operator/barangkeluar?alert=lebih");
        } else {
            $jumlah_baru = $jumlah_barang - $jumlah;

            $data = [
                'bk_id_barang' => $barang,
                'bk_nama_barang' => $nama_barang,
                'bk_tgl_keluar' => $tanggal,
                'bk_jumlah' => $jumlah,
                'bk_penerima' => $penerima,
                'bk_lokasi2' => $lokasi2,
                'bk_lokasi' => $lokasi,
                'bk_keterangan' => $keterangan,
                'bk_user' => $user
            ];
            $this->db->insert('barang_keluar', $data);

            $data1 = [
                'barang_jumlah' => $jumlah_baru,
            ];
            $this->db->where('barang_id', $barang);
            $this->db->update('barang', $data1);

            //response ke ajax
            redirect("operator/barangkeluar?alert=berhasil");
        }
    }

    function editbarangkeluar($id)
    {
        $data['data'] = $this->db->query('SELECT * FROM barang_keluar where bk_id =' . $id)->result();
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_keluar_edit', $data);
    }

    function proseseditbk()
    {
        $id = $this->input->post('id');
        $barang = $this->input->post('barang');
        $nm = $this->db->query("SELECT * FROM barang where barang_id = $barang");
        $nama_barang = $nm->barang_nama;
        $tanggal = $this->input->post('tanggal');
        $jumlah = $this->input->post('jumlah');
        $penerima = $this->input->post('penerima');
        $lokasi2 = $this->input->post('lokasi2');
        $lokasi = $this->input->post('lokasi');
        $keterangan = $this->input->post('keterangan');
        $user = $this->input->post('user');

        $data = [
            'bk_id_barang' => $barang,
            'bk_nama_barang' => $nama_barang,
            'bk_tgl_keluar' => $tanggal,
            'bk_jumlah' => $jumlah,
            'bk_penerima' => $penerima,
            'bk_lokasi2' => $lokasi2,
            'bk_lokasi' => $lokasi,
            'bk_keterangan' => $keterangan,
            'bk_user' => $user
        ];
        $this->db->where('bk_id', $id);
        $this->db->update('barang_keluar', $data);

        //response ke ajax
        redirect("operator/barangkeluar?alert=update");
    }

    function hapusbk($id)
    {
        $where = array('bk_id' => $id);
        $this->m_admin->hapus($where, 'barang_keluar');
        redirect('operator/barangkeluar?alert=hapus');
    }

    public function barangmasuk()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_masuk');
    }

    function barangmasukpdf()
    {
        $this->load->view('operator/v_barang_masuk_pdf');
    }

    function barangmasukexcel()
    {
        $this->load->view('operator/v_barang_masuk_excel');
    }

    function tambahbarangmasuk()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_masuk_tambah');
    }

    function editbarangmasuk($id)
    {
        $data['data'] = $this->db->query('SELECT * FROM barang_masuk where bm_id =' . $id)->result();
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_masuk_edit', $data);
    }
    function prosestambahbm()
    {
        $barang = $this->input->post('barang');
        $tanggal = $this->input->post('tanggal');
        $jumlah = $this->input->post('jumlah');
        $suplier = $this->input->post('suplier');
        $keterangan = $this->input->post('keterangan');
        $user = $this->session->userdata('user_id');

        $nm = $this->db->query("SELECT * FROM barang where barang_id = $barang")->result();
        foreach ($nm as $nama) {
            $nama_barang = $nama->barang_nama;
            $jumlah_barang = $nama->barang_jumlah;
            $nama_barang = $nama->barang_nama;
        }

        $s = $this->db->query("SELECT * FROM suplier where suplier_id = $suplier")->result();
        foreach ($s as $ss) {
            $nama_suplier = $ss->suplier_nama;
        }

        $ubah_jumlah_baru = $jumlah_barang + $jumlah;
        $upbar2 = [
            'barang_jumlah' => $ubah_jumlah_baru,
        ];
        $this->db->where('barang_id', $barang);
        $this->db->update('barang', $upbar2);

        //update ke barang_masuk
        $data = [
            'bm_id_barang' => $barang,
            'bm_nama_barang' => $nama_barang,
            'bm_tgl_masuk' => $tanggal,
            'bm_jumlah' => $jumlah,
            'bm_id_suplier' => $suplier,
            'bm_nama_suplier' => $nama_suplier,
            'bm_keterangan' => $keterangan,
            'bm_user' => $user
        ];
        $this->db->insert('barang_masuk', $data);
        //response ke ajax
        redirect("operator/barangmasuk?alert=update");
    }

    function proseseditbm()
    {
        $id = $this->input->post('id');
        $barang = $this->input->post('barang');
        $tanggal = $this->input->post('tanggal');
        $jumlah = $this->input->post('jumlah');
        $suplier = $this->input->post('suplier');
        $keterangan = $this->input->post('keterangan');
        $user = $this->input->post('user');

        $nm = $this->db->query("SELECT * FROM barang where barang_id = $barang")->result();
        foreach ($nm as $nama) {
            $nama_barang = $nama->barang_nama;
            $jumlah_barang = $nama->barang_jumlah;
            $nama_barang = $nama->barang_nama;
        }

        $s = $this->db->query("SELECT * FROM suplier where suplier_id = $suplier")->result();
        foreach ($s as $ss) {
            $nama_suplier = $ss->suplier_nama;
        }

        //update jumlah 
        $bm = $this->db->query("SELECT * from barang_masuk where bm_id='$id'")->result();
        foreach ($bm as $barma) {

            $jumlah_barang_masuk = $barma->bm_jumlah;
        }

        $ubah_jumlah = $jumlah_barang - $jumlah_barang_masuk;
        $upbar = [
            'barang_jumlah' => $ubah_jumlah,
        ];
        $this->db->where('barang_id', $barang);
        $this->db->update('barang', $upbar);

        $ubah_jumlah_baru = $ubah_jumlah + $jumlah;
        $upbar2 = [
            'barang_jumlah' => $ubah_jumlah_baru,
        ];
        $this->db->where('barang_id', $barang);
        $this->db->update('barang', $upbar2);

        //update ke barang_masuk
        $data = [
            'bm_id_barang' => $barang,
            'bm_nama_barang' => $nama_barang,
            'bm_tgl_masuk' => $tanggal,
            'bm_jumlah' => $jumlah,
            'bm_id_suplier' => $suplier,
            'bm_nama_suplier' => $nama_suplier,
            'bm_keterangan' => $keterangan,
            'bm_user' => $user
        ];
        $this->db->where('bm_id', $id);
        $this->db->update('barang_masuk', $data);


        //response ke ajax
        redirect("operator/barangmasuk?alert=update");
    }

    function hapusbm($id)
    {
        $where = array('bm_id' => $id);
        $this->m_admin->hapus($where, 'barang_masuk');
        redirect('operator/barangmasuk?alert=hapus');
    }

    function peminjaman()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_pinjam');
    }

    function peminjamanpdf()
    {

        $this->load->view('operator/v_barang_pinjam_pdf');
    }

    function peminjamanexcel()
    {
        $this->load->view('operator/v_barang_pinjam_excel');
    }

    function tambahpeminjaman()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_barang_pinjam_tambah');
    }

    function prosestambahpinjam()
    {
        $nama  = $this->input->post('nama');
        $barang = $this->input->post('barang');
        $jumlah = $this->input->post('jumlah');
        $tgl_pinjam = $this->input->post('tgl_pinjam');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $peminjam = $this->input->post('peminjam');
        $kode = $this->input->post('kode');
        $status = 'Sedang Dipinjam';
        $alasan = $this->input->post('alasan');
        $id_petugas = $this->session->userdata('user_id');

        $b = $this->db->query("SELECT * FROM barang WHERE barang_id='$barang'")->result();
        foreach ($b as $bb) {
            $jumlah_barang = $bb->barang_jumlah;
        }
        if ($jumlah > $jumlah_barang) {
            redirect('operator/peminjaman?alert=lebih');
        } else {
            $data = [
                'pinjam_nama' => $nama,
                'pinjam_jumlah' => $jumlah,
                'pinjam_barang' => $barang,
                'pinjam_tgl_pinjam' => $tgl_pinjam,
                'pinjam_tgl_kembali' => $tgl_kembali,
                'pinjam_peminjam' => $peminjam,
                'pinjam_kode' => $kode,
                'pinjam_status' => $status,
                'pinjam_alasan' => $alasan,
                'pinjam_user' => $id_petugas
            ];
            $this->db->insert('pinjam', $data);
            redirect('operator/peminjaman?alert=berhasil');
        }
    }

    function pinjamupdate($id)
    {
        $data2 = [
            'pinjam_status' => 'Sudah Dikembalikan',
        ];
        $this->db->where('pinjam_id', $id);
        $this->db->update('pinjam', $data2);
        redirect('operator/peminjaman?alert=berhasil');
    }

    function pinjamhapus($id)
    {
        $where = array('pinjam_id' => $id);
        $this->m_admin->hapus($where, 'pinjam');
        redirect('operator/peminjaman?alert=hapus');
    }

    public function laporan()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_laporan');
    }

    function laporan_pdf()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_laporan_pdf');
    }

    public function prasarana()
    {
        $data['data'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		order by barang_id desc")->result();

        $this->template_adm->load('operator/template_adm', 'operator/v_prasarana', $data);
    }

    public function filterprasarana()
    {
        $fakultas = $this->input->post("fakultas");
        $data['fa'] = $fakultas;
        $data['dada'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		and barang_lokasi='$fakultas'")->result();
        $this->template_adm->load('operator/template_adm', 'operator/v_prasarana_filter', $data);
    }

    function prasarana_pdf()
    {
        $this->load->view('operator/v_prasarana_pdf');
    }

    function prasarana_pdf_filter($id)
    {
        $data['data'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		and barang_lokasi='$id' order by barang_ruangan asc")->result();
        $this->load->view('operator/v_prasarana_pdf_filter', $data);
    }

    function prasarana_excel_filter($id)
    {
        $data['data'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		and barang_lokasi='$id' order by barang_ruangan asc")->result();
        $this->load->view('operator/v_prasarana_excel_filter', $data);
    }

    function prasaranadetail($id)
    {
        $data['data'] = $this->db->query("SELECT * from fakultas,barang_prasarana where barang_lokasi=fakultas_id 
		and barang_id='$id' ")->result();

        $this->template_adm->load('operator/template_adm', 'operator/v_prasarana_detail', $data);
    }

    function prasaranatambah()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_prasarana_tambah');
    }

    function prosesprasaranatambah()
    {
        $sumber_dana = $this->input->post('sumber_dana');
        $kode = $this->input->post('kode');
        $kondisi = $this->input->post('kondisi');
        $ruangan = $this->input->post('ruangan');
        $keterangan = $this->input->post('keterangan');
        $user = $this->session->userdata('user_id');
        $lokasi = $this->input->post('lokasi');
        $ukuran = $this->input->post('ukuran');
        $tahun = $this->input->post('tahun');
        $jenis = $this->input->post('jenis');
        $konstruksi = $this->input->post('konstruksi');
        $pemilik = $this->input->post('pemilik');
        $no_pemilik = $this->input->post('no_pemilik');

        if (isset($_FILES["foto"]["name"])) {
            //konfigurasi 
            $config["upload_path"]      = './file/barang/';
            $config["allowed_types"]    = 'jpg|jpeg|png|';
            //load library upload
            $this->load->library("upload", $config);
            // lakukan upload
            if (!$this->upload->do_upload("foto")) {
                $data1 = [
                    'barang_jenis' => $jenis,
                    'barang_ruangan' => $ruangan,
                    'barang_kode' => $kode,
                    'barang_ukuran' => $ukuran,
                    'barang_tahun' => $tahun,
                    'barang_sumber_dana' => $sumber_dana,
                    'barang_kondisi' => $kondisi,
                    'barang_keterangan' => $keterangan,
                    'barang_konstruksi' => $konstruksi,
                    'barang_pemilik' => $pemilik,
                    'barang_no_pemilik' => $no_pemilik,
                    'barang_lokasi' => $lokasi,
                    'barang_user' => $user,
                ];
                // call method simpan gambar
                $this->db->insert('barang_prasarana', $data1);

                //response ke ajax
                redirect("operator/prasarana?alert=berhasiltanpaimage");
            } else {
                $data_gambar = $this->upload->data(); // simpan gambar
                // compress image start
                $config['image_library'] = 'gd2';
                $config['source_image']  = './file/barang/' . $data_gambar["file_name"];
                $config['create_thumb']  = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 709;
                $config['height']        = 472;
                // $config['new_image']     = './file/foto/' . $data_gambar["file_name"];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                // end compress setup

                // data dosen yg akan disimpan
                $data1 = [
                    'barang_jenis' => $jenis,
                    'barang_ruangan' => $ruangan,
                    'barang_kode' => $kode,
                    'barang_ukuran' => $ukuran,
                    'barang_tahun' => $tahun,
                    'barang_sumber_dana' => $sumber_dana,
                    'barang_kondisi' => $kondisi,
                    'barang_keterangan' => $keterangan,
                    'barang_konstruksi' => $konstruksi,
                    'barang_pemilik' => $pemilik,
                    'barang_no_pemilik' => $no_pemilik,
                    'barang_lokasi' => $lokasi,
                    'barang_user' => $user,
                    'barang_foto' => $data_gambar["file_name"],
                ];
                // call method simpan gambar
                $this->db->insert('barang_prasarana', $data1);

                //response ke ajax
                redirect("operator/prasarana?alert=berhasil");
            }
        }
    }

    function prasaranaedit($id)
    {
        $data['data'] = $this->db->query("SELECT * from barang_prasarana where barang_id='$id'")->result();
        $this->template_adm->load('operator/template_adm', 'operator/v_prasarana_edit', $data);
    }

    function prasaranaedit_p($id)
    {
        $sumber_dana = $this->input->post('sumber_dana');
        $kode = $this->input->post('kode');
        $kondisi = $this->input->post('kondisi');
        $ruangan = $this->input->post('ruangan');
        $keterangan = $this->input->post('keterangan');
        $user = $this->input->post('user');
        $lokasi = $this->input->post('lokasi');
        $ukuran = $this->input->post('ukuran');
        $tahun = $this->input->post('tahun');
        $jenis = $this->input->post('jenis');
        $konstruksi = $this->input->post('konstruksi');
        $pemilik = $this->input->post('pemilik');
        $no_pemilik = $this->input->post('no_pemilik');
        if (isset($_FILES["foto"]["name"])) {
            //konfigurasi 
            $config["upload_path"]      = './file/barang/';
            $config["allowed_types"]    = 'jpg|jpeg|png|';
            //load library upload
            $this->load->library("upload", $config);
            // lakukan upload
            if (!$this->upload->do_upload("foto")) {
                $data1 = [
                    'barang_jenis' => $jenis,
                    'barang_ruangan' => $ruangan,
                    'barang_kode' => $kode,
                    'barang_ukuran' => $ukuran,
                    'barang_tahun' => $tahun,
                    'barang_sumber_dana' => $sumber_dana,
                    'barang_kondisi' => $kondisi,
                    'barang_keterangan' => $keterangan,
                    'barang_konstruksi' => $konstruksi,
                    'barang_pemilik' => $pemilik,
                    'barang_no_pemilik' => $no_pemilik,
                    'barang_lokasi' => $lokasi,
                    'barang_user' => $user,

                ];
                // call method simpan gambar
                $this->db->where('barang_id', $id);
                $this->db->update('barang_prasarana', $data1);

                //response ke ajax
                redirect("operator/prasarana?alert=update");
            } else {
                $data_gambar = $this->upload->data(); // simpan gambar
                // compress image start
                $config['image_library'] = 'gd2';
                $config['source_image']  = './file/barang/' . $data_gambar["file_name"];
                $config['create_thumb']  = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 709;
                $config['height']        = 472;
                // $config['new_image']     = './file/foto/' . $data_gambar["file_name"];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                // end compress setup

                // data dosen yg akan disimpan
                $data1 = [
                    'barang_jenis' => $jenis,
                    'barang_ruangan' => $ruangan,
                    'barang_kode' => $kode,
                    'barang_ukuran' => $ukuran,
                    'barang_tahun' => $tahun,
                    'barang_sumber_dana' => $sumber_dana,
                    'barang_kondisi' => $kondisi,
                    'barang_keterangan' => $keterangan,
                    'barang_konstruksi' => $konstruksi,
                    'barang_pemilik' => $pemilik,
                    'barang_no_pemilik' => $no_pemilik,
                    'barang_lokasi' => $lokasi,
                    'barang_user' => $user,
                    'barang_foto' => $data_gambar["file_name"],
                ];
                // call method simpan gambar
                $this->db->where('barang_id', $id);
                $this->db->update('barang_prasarana', $data1);

                //response ke ajax
                redirect("operator/prasarana?alert=update");
            }
        }
    }

    function hapusprasarana($id)
    {
        $where = array('barang_id' => $id);
        $this->m_admin->hapus($where, 'barang_prasarana');
        redirect('operator/prasarana?alert=hapus');
    }

    function lokasi_sebaran()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_lokasi_sebaran');
    }

    function lokasi_sarana_pdf()
    {
        $this->load->view('operator/v_lokasi_sarana_pdf');
    }

    function lokasi_prasarana_pdf()
    {
        $this->load->view('operator/v_lokasi_prasarana_pdf');
    }

    function lokasi()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_lokasi');
    }

    function lokasi_tambah()
    {
        $nama = $this->input->post('nama');
        $data = [
            'fakultas_nama' => $nama,
        ];
        $this->db->insert('fakultas', $data);
        redirect('operator/lokasi?alert=berhasil');
    }

    function lokasi_edit()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $data = [
            'fakultas_nama' => $nama,
        ];
        $this->db->where('fakultas_id', $id);
        $this->db->update('fakultas', $data);
        redirect('operator/lokasi?alert=update');
    }

    function lokasi_hapus($id)
    {
        $where = array('fakultas_id' => $id);
        $this->m_admin->hapus($where, 'fakultas');
        redirect('operator/lokasi?alert=hapus');
    }

    function gantipassword()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_ganti_password');
    }
    function prosesgantipas()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1);
        $id_user = $this->session->userdata("user_id");

        $user_password = $this->input->post('password');

        $data1 = array(
            'user_password' => md5($user_password)
        );

        $user_id = array(
            'user_id' => $id_user
        );

        $this->m_admin->update_data($user_id, $data1, 'user');
        redirect('operator/gantipassword/?' . 'alert=sukses');
    }

    function importexcel()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_import_excel');
    }

    function uploadDoc()
    {
        $uploadPath = 'file/import/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

    function import()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_status =  $this->uploadDoc();
            if ($upload_status != false) {
                $inputFileName = 'file/import/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $isFirstRow = true; // Tandai bahwa ini adalah baris pertama
                foreach ($sheet->getRowIterator() as $row) {
                    // Lewati baris pertama
                    if ($isFirstRow) {
                        $isFirstRow = false;
                        continue;
                    }
                    $barang_kode = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex());
                    $barang_nama = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex());
                    $barang_sumber = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex());
                    $barang_merk = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex());
                    $barang_kategori = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex());
                    $barang_tahun = $spreadsheet->getActiveSheet()->getCell('F' . $row->getRowIndex());
                    $barang_spesifikasi = $spreadsheet->getActiveSheet()->getCell('G' . $row->getRowIndex());
                    $barang_kondisi = $spreadsheet->getActiveSheet()->getCell('H' . $row->getRowIndex());
                    $barang_jumlah = $spreadsheet->getActiveSheet()->getCell('I' . $row->getRowIndex());
                    $barang_satuan = $spreadsheet->getActiveSheet()->getCell('J' . $row->getRowIndex());
                    $barang_keterangan = $spreadsheet->getActiveSheet()->getCell('K' . $row->getRowIndex());
                    $barang_jenis = $spreadsheet->getActiveSheet()->getCell('L' . $row->getRowIndex());
                    $barang_lokasi = $spreadsheet->getActiveSheet()->getCell('M' . $row->getRowIndex());
                    $barang_foto = $spreadsheet->getActiveSheet()->getCell('N' . $row->getRowIndex());
                    $user = $spreadsheet->getActiveSheet()->getCell('O' . $row->getRowIndex());

                    $barang_id_terakhir = $this->db->query("SELECT max(barang_id) as barangid FROM barang")->result();
                    foreach ($barang_id_terakhir as $bar_id) {
                        if (empty($bar_id->barangid)) {
                            $bar = 1;
                        } else {
                            $bar = $bar_id->barangid + 1;
                        }
                    }
                    $data = [
                        'barang_id' => $bar,
                        'barang_kode' => $barang_kode,
                        'barang_nama' => $barang_nama,
                        'barang_sumber' => $barang_sumber,
                        'barang_merk' => $barang_merk,
                        'barang_kategori' => $barang_kategori,
                        'barang_tahun' => $barang_tahun,
                        'barang_spesifikasi' => $barang_spesifikasi,
                        'barang_kondisi' => $barang_kondisi,
                        'barang_jumlah' => $barang_jumlah,
                        'barang_satuan' => $barang_satuan,
                        'barang_keterangan' => $barang_keterangan,
                        'barang_jenis' => $barang_jenis,
                        'barang_lokasi' => $barang_lokasi,
                        'barang_user' => $user,
                        'barang_foto' => $barang_foto,

                    ];
                    $this->db->insert('barang', $data);
                    $count_Rows++;
                }
                $this->session->set_flashdata('success', 'Successfulyy Data Imported');
                redirect(base_url('operator/importexcel?alert=berhasil'));
            } else {
                $this->session->set_flashdata('error', 'File is not uploaded');
                redirect(base_url('operator/importexcel?alert=gagal'));
            }
        } else {
            $this->load->view('welcome_message');
        }
    }

    function importexcelpra()
    {
        $this->template_adm->load('operator/template_adm', 'operator/v_import_excel_prasarana');
    }

    function uploadDocpra()
    {
        $uploadPath = 'file/import/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

    function importpra()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_status =  $this->uploadDocpra();
            if ($upload_status != false) {
                $inputFileName = 'file/import/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $isFirstRow = true; // Tandai bahwa ini adalah baris pertama
                foreach ($sheet->getRowIterator() as $row) {
                    // Lewati baris pertama
                    if ($isFirstRow) {
                        $isFirstRow = false;
                        continue;
                    }
                    $barang_jenis = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex());
                    $barang_ruangan = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex());
                    $barang_kode = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex());
                    $barang_ukuran = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex());
                    $barang_tahun = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex());
                    $barang_sumber_dana = $spreadsheet->getActiveSheet()->getCell('F' . $row->getRowIndex());
                    $barang_kondisi = $spreadsheet->getActiveSheet()->getCell('G' . $row->getRowIndex());
                    $barang_keterangan = $spreadsheet->getActiveSheet()->getCell('H' . $row->getRowIndex());
                    $barang_lokasi = $spreadsheet->getActiveSheet()->getCell('I' . $row->getRowIndex());
                    $barang_kontruksi = $spreadsheet->getActiveSheet()->getCell('J' . $row->getRowIndex());
                    $barang_pemilik = $spreadsheet->getActiveSheet()->getCell('K' . $row->getRowIndex());
                    $barang_no_pemilik = $spreadsheet->getActiveSheet()->getCell('L' . $row->getRowIndex());
                    $barang_user = $spreadsheet->getActiveSheet()->getCell('M' . $row->getRowIndex());


                    $barang_id_terakhir = $this->db->query("SELECT max(barang_id) as barangid FROM barang_prasarana")->result();
                    foreach ($barang_id_terakhir as $bar_id) {
                        if (empty($bar_id->barangid)) {
                            $bar = 1;
                        } else {
                            $bar = $bar_id->barangid + 1;
                        }
                    }
                    $data = [
                        'barang_id' => $bar,
                        'barang_jenis' => $barang_jenis,
                        'barang_ruangan' => $barang_ruangan,
                        'barang_kode' => $barang_kode,
                        'barang_ukuran' => $barang_ukuran,
                        'barang_tahun' => $barang_tahun,
                        'barang_kondisi' => $barang_kondisi,
                        'barang_keterangan' => $barang_keterangan,
                        'barang_lokasi' => $barang_lokasi,
                        'barang_konstruksi' => $barang_kontruksi,
                        'barang_pemilik' => $barang_pemilik,
                        'barang_no_pemilik' => $barang_no_pemilik,
                        'barang_user' => $barang_user,
                        'barang_sumber_dana' => $barang_sumber_dana
                    ];
                    $this->db->insert('barang_prasarana', $data);
                    $count_Rows++;
                }
                $this->session->set_flashdata('success', 'Successfulyy Data Imported');
                redirect(base_url('operator/importexcelpra?alert=berhasil'));
            } else {
                $this->session->set_flashdata('error', 'File is not uploaded');
                redirect(base_url('operator/importexcelpra?alert=gagal'));
            }
        } else {
            $this->load->view('welcome_message');
        }
    }
}
