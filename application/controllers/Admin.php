<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_admin', 'm_admin');
		if ($this->session->userdata('user_level') != "admin") {
			$this->session->sess_destroy();
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$this->template_adm->load('admin/template_adm', 'admin/dashboard');
	}

	public function databarang()
	{
		$data['barang'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id 
		 and barang_lokasi=fakultas_id  order by barang_kategori, barang_nama asc")->result();
		$this->template_adm->load('admin/template_adm', 'admin/v_barang', $data);
	}

	function filterbarang()
	{
		$fakultas = $this->input->post("fakultas");
		$data['barang'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id  
		and barang_lokasi=fakultas_id and barang_lokasi='$fakultas'  ORDER BY barang_kategori, barang_nama asc")->result();
		$this->template_adm->load('admin/template_adm', 'admin/v_barang', $data);
	}

	function barangpdf()
	{
		$data['data'] = $this->db->query("SELECT * FROM barang,fakultas, kategori where barang_kategori=kategori_id 
		and barang_lokasi=fakultas_id  order by barang_kategori, barang_nama asc")->result();
		$this->load->view('admin/v_barang_pdf', $data);
	}

	function barangexcel()
	{
		$data['barang'] = $this->db->query("SELECT * FROM fakultas,barang,kategori where barang_kategori=kategori_id  
		and barang_lokasi=fakultas_id order by barang_kategori, barang_nama asc ")->result();
		$this->load->view('admin/v_barang_excel', $data);
	}

	function barangdetail($id)
	{
		$data['data'] = $this->m_admin->dbarang($id);
		$this->template_adm->load('admin/template_adm', 'admin/v_barang_detail', $data);
	}

	function barang_edit($id)
	{
		$data['data'] = $this->m_admin->dbarang($id);
		$this->template_adm->load('admin/template_adm', 'admin/v_barang_edit', $data);
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
				redirect("admin/databarang?alert=update");
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
				redirect("admin/databarang?alert=update");
			}
		}
	}

	public function hapus_barang($id)
	{
		$where = array('barang_id' => $id);
		$this->m_admin->hapus($where, 'barang');
		redirect('admin/databarang?alert=hapus');
	}

	public function barangkeluar()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_barang_keluar');
	}

	function barangkeluarpdf()
	{
		$this->load->view('admin/v_barang_keluar_pdf');
	}
	function barangkeluarexcel()
	{
		$this->load->view('admin/v_barang_keluar_excel');
	}

	function editbarangkeluar($id)
	{
		// $data['data'] = $this->m_admin->dbarangkeluar($id);
		$data['data'] = $this->db->query('SELECT * FROM barang_keluar where bk_id =' . $id)->result();
		$this->template_adm->load('admin/template_adm', 'admin/v_barang_keluar_edit', $data);
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
		redirect("admin/barangkeluar?alert=update");
	}
	function hapusbk($id)
	{
		$where = array('bk_id' => $id);
		$this->m_admin->hapus($where, 'barang_keluar');
		redirect('admin/barangkeluar?alert=hapus');
	}

	public function barangmasuk()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_barang_masuk');
	}

	function barangmasukpdf()
	{
		$this->load->view('admin/v_barang_masuk_pdf');
	}

	function barangmasukexcel()
	{
		$this->load->view('admin/v_barang_masuk_excel');
	}

	function editbarangmasuk($id)
	{
		$data['data'] = $this->db->query('SELECT * FROM barang_masuk where bm_id =' . $id)->result();
		$this->template_adm->load('admin/template_adm', 'admin/v_barang_masuk_edit', $data);
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
		redirect("admin/barangmasuk?alert=update");
	}

	function hapusbm($id)
	{
		$where = array('bm_id' => $id);
		$this->m_admin->hapus($where, 'barang_masuk');
		redirect('admin/barangmasuk?alert=hapus');
	}

	function peminjaman()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_barang_pinjam');
	}

	function peminjamanpdf()
	{

		$this->load->view('admin/v_barang_pinjam_pdf');
	}

	function peminjamanexcel()
	{
		$this->load->view('admin/v_barang_pinjam_excel');
	}

	function pinjamupdate($id)
	{
		$data2 = [
			'pinjam_status' => 'Sudah Dikembalikan',
		];
		$this->db->where('pinjam_id', $id);
		$this->db->update('pinjam', $data2);
		redirect('admin/peminjaman?alert=berhasil');
	}

	function pinjamhapus($id)
	{
		$where = array('pinjam_id' => $id);
		$this->m_admin->hapus($where, 'pinjam');
		redirect('admin/peminjaman?alert=hapus');
	}

	function suplier()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_suplier');
	}

	function tambahsuplier()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telepon = $this->input->post('telepon');
		$user = $this->session->userdata('user_id');
		$data = [
			'suplier_nama' => $nama,
			'suplier_alamat' => $alamat,
			'suplier_telepon' => $telepon,
			'suplier_user' => $user,
		];
		$this->db->insert('suplier', $data);

		redirect('admin/suplier?alert=berhasil');
	}
	function suplieredit($id)
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telepon = $this->input->post('telepon');
		$user = $this->session->userdata('user_id');
		$data = [
			'suplier_nama' => $nama,
			'suplier_alamat' => $alamat,
			'suplier_telepon' => $telepon,
			'suplier_user' => $user,
		];
		$this->db->where('suplier_id', $id);
		$this->db->update('suplier', $data);

		redirect('admin/suplier?alert=update');
	}

	function hapussuplier($id)
	{
		$where = array('suplier_id' => $id);
		$this->m_admin->hapus($where, 'suplier');
		redirect('admin/suplier?alert=hapus');
	}

	public function laporan()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_laporan');
	}

	function laporan_pdf()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_laporan_pdf');
	}

	public function prasarana()
	{
		$data['data'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		order by barang_ruangan asc")->result();

		$this->template_adm->load('admin/template_adm', 'admin/v_prasarana', $data);
	}

	public function filterprasarana()
	{
		$fakultas = $this->input->post("fakultas");
		$data['fa'] = $fakultas;
		$data['dada'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		and barang_lokasi='$fakultas'")->result();
		$this->template_adm->load('admin/template_adm', 'admin/v_prasarana_filter', $data);
	}

	function prasarana_pdf()
	{
		$this->load->view('admin/v_prasarana_pdf');
	}
	function prasarana_pdf_filter($id)
	{
		$data['data'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		and barang_lokasi='$id' order by barang_ruangan asc")->result();
		$this->load->view('admin/v_prasarana_pdf_filter', $data);
	}
	function prasarana_excel_filter($id)
	{
		$data['data'] = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id 
		and barang_lokasi='$id' order by barang_ruangan asc")->result();
		$this->load->view('admin/v_prasarana_excel_filter', $data);
	}
	function prasaranadetail($id)
	{
		$data['data'] = $this->db->query("SELECT * from fakultas,barang_prasarana where barang_lokasi=fakultas_id 
		and barang_id='$id' ")->result();

		$this->template_adm->load('admin/template_adm', 'admin/v_prasarana_detail', $data);
	}
	function prasaranaedit($id)
	{
		$data['data'] = $this->db->query("SELECT * from barang_prasarana where barang_id='$id'")->result();
		$this->template_adm->load('admin/template_adm', 'admin/v_prasarana_edit', $data);
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
				redirect("admin/prasarana?alert=update");
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
				redirect("admin/prasarana?alert=update");
			}
		}
	}
	function hapusprasarana($id)
	{
		$where = array('barang_id' => $id);
		$this->m_admin->hapus($where, 'barang_prasarana');
		redirect('admin/prasarana?alert=hapus');
	}
	function lokasi_sebaran()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_lokasi_sebaran');
	}
	function lokasi_sarana_pdf()
	{
		$this->load->view('admin/v_lokasi_sarana_pdf');
	}
	function lokasi_prasarana_pdf()
	{
		$this->load->view('admin/v_lokasi_prasarana_pdf');
	}
	function kategori()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_kategori');
	}
	function kategori_tambah()
	{
		$nama = $this->input->post('nama');
		$data = [
			'kategori_nama' => $nama,
		];
		$this->db->insert('kategori', $data);
		redirect('admin/kategori?alert=berhasil');
	}
	function kategori_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$data = [
			'kategori_nama' => $nama,
		];
		$this->db->where('kategori_id', $id);
		$this->db->update('kategori', $data);
		redirect('admin/kategori?alert=update');
	}
	function kategori_hapus($id)
	{
		$where = array('kategori_id' => $id);
		$this->m_admin->hapus($where, 'kategori');
		redirect('admin/kategori?alert=hapus');
	}

	function lokasi()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_lokasi');
	}
	function lokasi_tambah()
	{
		$nama = $this->input->post('nama');
		$data = [
			'fakultas_nama' => $nama,
		];
		$this->db->insert('fakultas', $data);
		redirect('admin/lokasi?alert=berhasil');
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
		redirect('admin/lokasi?alert=update');
	}
	function lokasi_hapus($id)
	{
		$where = array('fakultas_id' => $id);
		$this->m_admin->hapus($where, 'fakultas');
		redirect('admin/lokasi?alert=hapus');
	}
	function user()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_user');
	}
	function user_hapus($id)
	{
		$where = array('user_id' => $id);
		$this->m_admin->hapus($where, 'user');
		redirect('admin/user?alert=hapus');
	}
	function user_tambah()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_user_tambah');
	}
	function user_proses_t()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');

		$config['upload_path']          = './file/user';
		$config['allowed_types']        = 'png|jpg|jpeg';
		$config['max_size']             = 2500;
		$config['encrypt_name']         = false;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$data = [
				'user_nama' => $nama,
				'user_username' => $username,
				'user_password' => md5($password),
				'user_level' => $level,
				'user_foto' => 'df.png'
			];
			$this->db->insert('user', $data);
			redirect("admin/user?alert=berhasil");
		} else {
			$data_gambar = $this->upload->data();
			$data = [
				'user_nama' => $nama,
				'user_username' => $username,
				'user_password' => md5($password),
				'user_level' => $level,
				'user_foto' => $data_gambar["file_name"]
			];
			$this->db->insert('user', $data);
			redirect("admin/user?alert=berhasil");
		}
	}
	function user_edit($id)
	{
		$data['user'] = $this->db->query("SELECT * FROM user where user_id = $id")->result();
		$this->template_adm->load('admin/template_adm', 'admin/v_user_edit', $data);
	}
	function user_proses_e()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$config['upload_path']          = './file/user';
		$config['allowed_types']        = 'png|jpg|jpeg';
		$config['max_size']             = 2500;
		$config['encrypt_name']         = false;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			if (empty($password)) {
				$data = [
					'user_nama' => $nama,
					'user_username' => $username,
					// 'user_password' => md5($password),
					'user_level' => $level,
					'user_foto' => 'df.png'
				];
				$this->db->where('user_id', $id);
				$this->db->update('user', $data);
				redirect("admin/user?alert=berhasil");
			} else {
				$data = [
					'user_nama' => $nama,
					'user_username' => $username,
					'user_password' => md5($password),
					'user_level' => $level,
					'user_foto' => 'df.png'
				];
				$this->db->where('user_id', $id);
				$this->db->update('user', $data);
				redirect("admin/user?alert=berhasil");
			}
		} else {
			$data_gambar = $this->upload->data();
			if (empty($password)) {
				$data = [
					'user_nama' => $nama,
					'user_username' => $username,
					// 'user_password' => md5($password),
					'user_level' => $level,
					'user_foto' => $data_gambar["file_name"]
				];
				$this->db->where('user_id', $id);
				$this->db->update('user', $data);
				redirect("admin/user?alert=berhasil");
			} else {
				$data = [
					'user_nama' => $nama,
					'user_username' => $username,
					'user_password' => md5($password),
					'user_level' => $level,
					'user_foto' => $data_gambar["file_name"]
				];
				$this->db->where('user_id', $id);
				$this->db->update('user', $data);
				redirect("admin/user?alert=berhasil");;
			}
		}
	}

	function gantipassword()
	{
		$this->template_adm->load('admin/template_adm', 'admin/v_ganti_password');
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
		redirect('admin/gantipassword/?' . 'alert=sukses');
	}
}
