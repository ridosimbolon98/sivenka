<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Rido
 */

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();

		if ($this->session->userdata('role') != "ADMIN") {
			echo "<script>alert('Silakan login terlebih dahulu!');</script>";
			echo "<script>location='".base_url()."auth';</script>";
		} else {
			$this->load->helper('url');
			$this->load->model('m_auth');
			$this->load->model('m_admin');
		}		
	}

	function index() {
		redirect(base_url('admin/dashboard'));
	}

	// menampilkan halaman dashboard admin
	function dashboard(){
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Dashboard";
		$tgl = date('Y-m');
		$periode_sblm = date('Y-m', strtotime($tgl. ' -1 months'));
		$periode_skrn = date('Y-m');

		// ambil data total pendapatan bulan lalu (pbl)
		$pbl = $this->m_admin->getPendapatan('invoice', $periode_sblm)->result();
		$data['pbl'] = $pbl[0]->pendapatan;
		// ambil data total pendapatan bulan berjalan (pbb)
		$pbb = $this->m_admin->getPendapatan('invoice', $periode_skrn)->result();
		$data['pbb'] = $pbb[0]->pendapatan;
		// hitung persentasi kenaikan
		if($data['pbl'] < 1) {
			$devide = 1;
		} else {
			$devide = $data['pbl'];
		}
		$data['prsp'] = (($data['pbb'] - $data['pbl']) / $devide) * 100;

		// ambil data jumlah penjualan
		$data['pjl_now'] = $this->m_admin->getPenjualan('transaksi', $periode_skrn)->result();
		$data['pjl_bfr'] = $this->m_admin->getPenjualan('transaksi', $periode_skrn)->result();
		// hitung persentasi kenaikan
		if($data['pjl_bfr'] < 1) {
			$devide_pj = 1;
		} else {
			$devide_pj = $data['pjl_bfr'][0]->jumlah;
		}
		$data['prspj'] = (($data['pjl_now'][0]->jumlah - $data['pjl_bfr'][0]->jumlah) / $devide_pj) * 100;

		// ambil data produk baru
		$data['prd_new'] = $this->m_admin->getProdukBaru()->num_rows();
		$prd_old =  $this->m_admin->getProdukLama()->num_rows();
		if ($prd_old > 0) {
			$data['prd_old'] = $prd_old;
		} else {
			$data['prd_old'] = 1;
		}
		
		// ambil data suplier baru
		$data['spl_new'] = $this->m_admin->getSuplierBaru()->num_rows();
		$spl_old = $this->m_admin->getSuplierLama()->num_rows();
		if ($spl_old > 0) {
			$data['spl_old'] = $spl_old;
		} else {
			$data['spl_old'] = 1;
		}

		// ambil data jumlah total pendapatan transaksi per bulan tahun berjalan
		$tahun = date('Y');
		$data['tahun'] = $tahun;
		$data['pendapatan_jan'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-01')->result();
		$data['pendapatan_feb'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-02')->result();
		$data['pendapatan_mar'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-03')->result();
		$data['pendapatan_apr'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-04')->result();
		$data['pendapatan_mei'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-05')->result();
		$data['pendapatan_jun'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-06')->result();
		$data['pendapatan_jul'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-07')->result();
		$data['pendapatan_agu'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-08')->result();
		$data['pendapatan_sep'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-09')->result();
		$data['pendapatan_okt'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-10')->result();
		$data['pendapatan_nov'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-11')->result();
		$data['pendapatan_des'] = $this->m_admin->getPendapatanTahunBerjalan($tahun.'-12')->result();

		// ambil data penjualan produk
		// $pjl_periode = $this->m_admin->getAll('periode')->result();
		$pjl_periode = date('Y-m');
		$data['pjl_bulanan'] = $this->m_admin->getPenjualanProdukPerBulan($pjl_periode)->result();

		$this->load->view('admin/dashboard', $data);
	}


	/** CRUD DATA MASTER PRODUK */
	// menampilkan halaman daftar produk beserta data-datanya
	function daftar_produk() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Produk";

		// ambil data kategori produk, merk produk, suplier produk, satuan
		$data['kategori'] = $this->m_admin->getAll('kategori_produk')->result();
		$data['merk']     = $this->m_admin->getAll('merk_produk')->result();
		$data['suplier']  = $this->m_admin->getAll('suplier')->result();
		$data['satuan']   = $this->m_admin->getAll('satuan_produk')->result();
		
		// ambil semua data produk dari database
		$data['produk'] = $this->m_admin->getDataProduk('produk', 'merk_produk', 'kategori_produk', 'stok_produk', 'suplier')->result();
		
		$this->load->view('admin/daftar_produk', $data);
	}

	// fungsi untuk menampilkan detail produk
	function detail_produk($kode_produk) {
		date_default_timezone_set("Asia/Jakarta");
		$data["title"]       = "Detail Produk Kode: $kode_produk";
		$data["kode_produk"] = $kode_produk;

		// ambil data kategori produk, merk produk, suplier produk, satuan
		$data['kategori'] = $this->m_admin->getAll('kategori_produk')->result();
		$data['merk']     = $this->m_admin->getAll('merk_produk')->result();
		$data['suplier']  = $this->m_admin->getAll('suplier')->result();
		$data['satuan']   = $this->m_admin->getAll('satuan_produk')->result();

		// ambil data produk by kode produk
		$where_kode     = array('kode_produk' => $kode_produk);
		$data['produk'] = $this->m_admin->getWhere('produk', $where_kode)->result(); 

		$this->load->view('admin/detail_produk', $data);
	}

	// input data produk baru
	function tambah_produk() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input POST
		$kode_produk     = time();
		$nama_produk     = htmlspecialchars(trim($this->input->post("nama_produk")));
		$merk_produk     = htmlspecialchars(trim($this->input->post("merk_produk")));
		$kategori_produk = htmlspecialchars(trim($this->input->post("kategori_produk")));
		$satuan_jual     = htmlspecialchars(trim($this->input->post("satuan_jual")));
		$harga_beli      = htmlspecialchars(trim($this->input->post("harga_beli")));
		$harga_jual      = htmlspecialchars(trim($this->input->post("harga_jual")));
		$suplier_produk  = htmlspecialchars(trim($this->input->post("suplier_produk")));
		$input_by        = $this->session->userdata('username');

		// cek apakah produk sudah ada atau belum
		$whereProduk = array(
			'nama_produk'     => $nama_produk,
			'merk'            => $merk_produk,
			'kategori_produk' => $kategori_produk
		);

		$isProduk = $this->m_admin->getWhere('produk', $whereProduk)->num_rows(); 
		if ($isProduk > 0){
			$this->session->set_flashdata('warning', "Produk dengan nama: $nama_produk, Merk: $merk, dan Kategori: $kategori_produk sudah ada di sistem!");
			redirect(base_url("admin/daftar_produk"));
			exit;
		}

		// data produk yang akan di insert ke tabel produk
		$produk_baru = array(
			'kode_produk'     => $kode_produk,
			'nama_produk'     => $nama_produk,
			'merk'            => $merk_produk,
			'kategori_produk' => $kategori_produk,
			'satuan_jual'     => $satuan_jual,
			'harga_beli'      => $harga_beli,
			'harga_jual'      => $harga_jual,
			'suplier'         => $suplier_produk,
			'input_by'        => $input_by,
			'tgl_input'       => date('Y-m-d H:m:s'),
			'tgl_update'      => date('Y-m-d H:m:s'),
			'status'          => true
		);

		// insert produk baru ke table produk
		$insert_produk  = $this->m_admin->insertData('produk', $produk_baru);
		if ($insert_produk) {
			$this->session->set_flashdata('success', "Berhasil tambah produk baru dengan Kode: $kode_produk");
			redirect(base_url("admin/daftar_produk"));
		} else {
			$this->session->set_flashdata('error', 'Gagal menambah produk baru. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_produk"));
		}
	}

	// fungsi untuk ubah data produk
	function ubah_produk() {
		date_default_timezone_set("Asia/Jakarta");
		
		// ambil data dari input post form ubah_data
		$kode_produk = $this->input->post("kode_produk");
		$nama_produk = $this->input->post("nama_produk");
		$merk        = $this->input->post("merk");
		$kategori    = $this->input->post("kategori");
		$satuan      = $this->input->post("satuan");
		$harga_beli  = $this->input->post("harga_beli");
		$harga_jual  = $this->input->post("harga_jual");
		$suplier     = $this->input->post("suplier");
		$input_by    = $this->session->userdata("username");
		$tgl_update  = date('Y-m-d H:m:s');

		$where_kode = array('kode_produk' => $kode_produk);

		$data_produk = array(
			'nama_produk'     => $nama_produk,
			'merk'            => $merk,
			'kategori_produk' => $kategori,
			'satuan_jual'     => $satuan,
			'harga_beli'      => $harga_beli,
			'harga_jual'      => $harga_jual,
			'suplier'         => $suplier,
			'tgl_update'      => $tgl_update
		);

		// update data produk
		$update_produk = $this->m_admin->updateData('produk', $data_produk, $where_kode);
		if ($update_produk) {
			// berhasil update data produk
			$this->session->set_flashdata("success", "Berhasil ubah data produk dengan kode: $kode_produk.");
			redirect(base_url("admin/detail_produk/$kode_produk"));
		} else {
			$this->session->set_flashdata("error", "Gagal ubah data produk dengan kode: $kode_produk.");
			redirect(base_url("admin/detail_produk/$kode_produk"));
		}
	}

	// fungsi untuk disabled status produk
	function status_produk($kode_produk) {
		date_default_timezone_set("Asia/Jakarta");

		$where_kode = array('kode_produk' => $kode_produk);
		// ambil data status produk
		$produk = $this->m_admin->getWhere('produk', $where_kode)->result();
		if (count($produk) <= 0) {
			// kode_produk tidak ada disistem
			$this->session->set_flashdata("warning", "Kode produk: $kode_produk, tidak ada pada sistem!");
			redirect(base_url("admin/daftar_produk"));
			exit;
		}

		$data_status = array('status' => !($produk[0]->status));
		// update status produk
		$update_status = $this->m_admin->updateData('produk', $data_status, $where_kode);
		if($update_status) {
			// jika berhasil update status
			$this->session->set_flashdata('success', "Berhasil update status produk.");
			redirect(base_url("admin/daftar_produk"));
		} else {
			// jika gagal update status
			$this->session->set_flashdata('error', "Gagal update status produk.");
			redirect(base_url("admin/daftar_produk"));
		}
	}

	// fungsi untuk menampilkan daftar kategori produk
	function daftar_kategori() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Kategori Produk";

		// ambil data suplier dari tabel suplier
		$data['kategori'] = $this->m_admin->getAll('kategori_produk')->result();

		$this->load->view('admin/daftar_kategori', $data);
	}

	// fungsi untuk tambah kategori produk
	function tambah_kategori(){
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input POST
		$id_kategori     = time();
		$desk_kategori   = htmlspecialchars(trim($this->input->post("kategori_produk")));
		$input_by        = $this->session->userdata('username');

		// cek apakah kategori produk sudah ada atau belum
		$whereKatProduk = array(
			'deskripsi' => $desk_kategori
		);

		$isKatProduk = $this->m_admin->getWhere('kategori_produk', $whereKatProduk)->num_rows(); 
		if ($isKatProduk > 0){
			$this->session->set_flashdata('warning', "Kategori Produk dengan deskripsi: $desk_kategori, sudah ada di sistem!");
			redirect(base_url("admin/daftar_kategori"));
			exit;
		}

		// data kategori produk baru yang akan di insert ke tabel kategori_produk
		$kat_produk_baru = array(
			'id_kategori'     => $id_kategori,
			'deskripsi'       => $desk_kategori,
			'status'          => true,
			'tgl_input'       => date('Y-m-d H:m:s'),
			'tgl_update'      => date('Y-m-d H:m:s'),
			'input_by'        => $input_by
		);

		// insert kategori produk baru ke table Kategori_produk
		$insert_kat_produk  = $this->m_admin->insertData('kategori_produk', $kat_produk_baru);
		if ($insert_kat_produk) {
			$this->session->set_flashdata('success', "Berhasil tambah kategori produk dengan Kode: $id_kategori");
			redirect(base_url("admin/daftar_kategori"));
		} else {
			$this->session->set_flashdata('error', 'Gagal menambah kategori produk baru. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_kategori"));
		}
	}

	// fungsi untuk update data kategori produk
	function ubah_kategori() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data input post ubah kategori
		$id_kat    = trim($this->input->post('id_kat'));
		$desk_kat  = strtoupper(trim($this->input->post('kategori_produk')));

		$where = array('id_kategori' => $id_kat);
		$data_kat = array(
			'deskripsi'  => strtoupper($desk_kat),
			'tgl_update' => date('Y-m-d H:m:s')
		);

		// update data
		$update_kat = $this->m_admin->updateData('kategori_produk', $data_kat, $where);
		if ($update_kat) {
			$this->session->set_flashdata('success', "Berhasil ubah data kategori produk dengan Kode: $id_kat");
			redirect(base_url("admin/daftar_kategori"));
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah kategori produk. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_kategori"));
		}
	}
	
	// fungsi untuk update status kategori produk
	function status_kategori($id_kat) {
		date_default_timezone_set("Asia/Jakarta");

		$where = array('id_kategori' => $id_kat);
		$kategori = $this->m_admin->getWhere('kategori_produk', $where)->result();
		if(count($kategori) <= 0) {
			// id_kateogri tidak tersedia di sistem
			$this->session->set_flashdata('warning', "Data kategori dengan ID: $id_kat, tidak ditemukan pada sistem!");
			redirect(base_url("admin/daftar_kategori"));
		}

		$data_kat = array(
			'status'     => !($kategori[0]->status),
			'tgl_update' => date('Y-m-d H:m:s')
		);

		// update data
		$update_skat = $this->m_admin->updateData('kategori_produk', $data_kat, $where);
		if ($update_skat) {
			$this->session->set_flashdata('success', "Berhasil ubah status kategori produk dengan Kode: $id_kat");
			redirect(base_url("admin/daftar_kategori"));
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah status kategori produk. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_kategori"));
		}
	}

	// fungsi untuk menampilkan daftar merk
	function daftar_merk() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Merk";

		// ambil data suplier dari tabel merk
		$data['merk'] = $this->m_admin->getAll('merk_produk')->result();

		$this->load->view('admin/daftar_merk', $data);
	}

	// fungsi untuk tambah merk produk
	function tambah_merk() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input POST
		$id_merk     = time();
		$deskripsi   = htmlspecialchars(trim($this->input->post("merk_produk")));
		$input_by    = $this->session->userdata('username');

		// cek apakah kategori produk sudah ada atau belum
		$whereMerkProduk = array(
			'deskripsi' => $deskripsi
		);

		$isMerkProduk = $this->m_admin->getWhere('kategori_produk', $whereMerkProduk)->num_rows(); 
		if ($isMerkProduk > 0){
			$this->session->set_flashdata('warning', "Merk Produk dengan deskripsi: $deskripsi, sudah ada di sistem!");
			redirect(base_url("admin/daftar_merk"));
			exit;
		}

		// data kategori produk baru yang akan di insert ke tabel kategori_produk
		$merk_produk_baru = array(
			'id_merk'       => $id_merk,
			'deskripsi'     => $deskripsi,
			'input_by'      => $input_by,
			'tgl_input'     => date('Y-m-d H:m:s'),
			'tgl_update'    => date('Y-m-d H:m:s')
		);

		// insert merk produk baru ke table Kategori_produk
		$insert_merk_produk  = $this->m_admin->insertData('merk_produk', $merk_produk_baru);
		if ($insert_merk_produk) {
			$this->session->set_flashdata('success', "Berhasil tambah merk produk baru dengan Kode: $id_kategori");
			redirect(base_url("admin/daftar_merk"));
		} else {
			$this->session->set_flashdata('error', 'Gagal menambah merk produk baru. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_merk"));
		}
	}

	// fungsi untuk update data merk
	function ubah_merk() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data input post ubah merk
		$id_merk   = $this->input->post('id_merk');
		$desk_merk = strtoupper(trim($this->input->post('desk_merk')));

		$where = array('id_merk' => $id_merk);
		$data_merk = array(
			'deskripsi'  => $desk_merk,
			'tgl_update' => date('Y-m-d H:m:s')
		);

		// update data
		$update_merk = $this->m_admin->updateData('merk_produk', $data_merk, $where);
		if ($update_merk) {
			$this->session->set_flashdata('success', "Berhasil ubah merk produk baru dengan Kode: $id_merk");
			redirect(base_url("admin/daftar_merk"));
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah merk produk. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_merk"));
		}
	}
	/** END CRUD DATA MASTER PRODUK */



	/** CRUD DATA MASTER SUPLIER */
	// fungsi untuk menampilkan daftar suplier
	function daftar_suplier() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Suplier";

		// ambil data suplier dari tabel suplier
		$data['suplier'] = $this->m_admin->getAll('suplier')->result();

		$this->load->view('admin/daftar_suplier', $data);
	}
	
	// fungsi untuk menampilkan detail suplier
	function detail_suplier($id_suplier) {
		date_default_timezone_set("Asia/Jakarta");
		$data['title']      = "Halaman Detail Suplier";
		$data['id_suplier'] = $id_suplier;

		// ambil data suplier by id suplier dari tabel suplier
		$where = array('id_suplier' => $id_suplier);
		$data['suplier'] = $this->m_admin->getWhere('suplier', $where)->result();

		$this->load->view('admin/detail_suplier', $data);
	}

	// fungsi untuk menambahkan data suplier baru
	function tambah_suplier() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input POST
		$id_suplier   = "SPL".time();
		$nama_suplier = htmlspecialchars(trim($this->input->post("nama_suplier")));
		$alamat       = htmlspecialchars(trim($this->input->post("alamat_suplier")));
		$no_telp      = htmlspecialchars(trim($this->input->post("no_telp")));
		$email        = htmlspecialchars(trim($this->input->post("email")));
		$no_hp        = htmlspecialchars(trim($this->input->post("no_hp")));
		$input_by     = $this->session->userdata('username');

		// data suplier baru yang akan di insert ke tabel suplier
		$suplier_baru = array(
			'id_suplier'    => $id_suplier,
			'nama_suplier'  => $nama_suplier,
			'alamat'        => $alamat,
			'no_telp'       => $no_telp,
			'email'         => $email,
			'no_hp'         => $no_hp,
			'input_by'      => $input_by,
			'tgl_input'     => date('Y-m-d H:m:s'),
			'tgl_update'    => date('Y-m-d H:m:s'),
			'status_suplier'=> true
		);

		// insert suplier baru ke table suplier
		$insert_suplier  = $this->m_admin->insertData('suplier', $suplier_baru);
		if ($insert_suplier) {
			$this->session->set_flashdata('success', "Berhasil tambah suplier baru dengan ID: $id_suplier");
			redirect(base_url("admin/daftar_suplier"));
		} else {
			$this->session->set_flashdata('error', 'Gagal menambah suplier baru. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_suplier"));
		}
	}

	// fungsi untuk mengubah data suplier
	function ubah_suplier() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input POST
		$id_suplier   = trim($this->input->post("kode_suplier"));
		$nama_suplier = htmlspecialchars(trim($this->input->post("nama_suplier")));
		$alamat       = htmlspecialchars(trim($this->input->post("alamat_suplier")));
		$no_telp      = htmlspecialchars(trim($this->input->post("no_telp")));
		$email        = htmlspecialchars(trim($this->input->post("email")));
		$no_hp        = htmlspecialchars(trim($this->input->post("no_hp")));
		$input_by     = $this->session->userdata('username');

		$where_sup = array('id_suplier' => $id_suplier);

		// data suplier yang akan di update ke tabel suplier
		$data_suplier = array(
			'nama_suplier'  => strtoupper($nama_suplier),
			'alamat'        => $alamat,
			'no_telp'       => $no_telp,
			'email'         => $email,
			'no_hp'         => $no_hp,
			'tgl_update'    => date('Y-m-d H:m:s')
		);

		// update suplier baru ke table suplier
		$update_suplier  = $this->m_admin->updateData('suplier', $data_suplier, $where_sup);
		if ($update_suplier) {
			$this->session->set_flashdata('success', "Berhasil ubah data suplier dengan ID: $id_suplier");
			redirect(base_url("admin/detail_suplier/$id_suplier"));
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah data suplier. Silakan ulangi lagi!');
			redirect(base_url("admin/detail_suplier/$id_suplier"));
		}
	}

	// fungsi untuk update status suplier produk
	function status_suplier($id_suplier) {
		date_default_timezone_set("Asia/Jakarta");

		$where   = array('id_suplier' => $id_suplier);
		$suplier = $this->m_admin->getWhere('suplier', $where)->result();
		if(count($suplier) <= 0) {
			// id_suplier tidak tersedia di sistem
			$this->session->set_flashdata('warning', "Data suplier dengan ID: $id_suplier, tidak ditemukan pada sistem!");
			redirect(base_url("admin/daftar_suplier"));
		}

		$data_suplier = array(
			'status_suplier' => !($suplier[0]->status_suplier),
			'tgl_update'     => date('Y-m-d H:m:s')
		);

		// update data
		$update_stsuplier = $this->m_admin->updateData('suplier', $data_suplier, $where);
		if ($update_stsuplier) {
			$this->session->set_flashdata('success', "Berhasil ubah status suplier dengan Kode: $id_suplier");
			redirect(base_url("admin/daftar_suplier"));
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah status suplier. Silakan ulangi lagi!');
			redirect(base_url("admin/daftar_suplier"));
		}
	}
	/** END CRUD DATA MASTER SUPLIER */



	/** DATA TRANSAKSI INVOICE */
	// fungsi untuk menampilkan daftar invoice
	function daftar_invoice() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Invoice";

		// ambil data invoice
		$data['invoice'] = $this->m_admin->getAll('invoice')->result();

		$this->load->view('admin/daftar_invoice', $data);
	}

	// fungsi untuk menampilkan detail invoice
	function detail_invoice($invoice) {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Invoice No: $invoice";

		$where             = array('invoice' => $invoice);
		$data['no_inv']    = $invoice;
		$data['data_pt']   = $this->m_admin->getAll('outlet')->result();
		$data['invoice']   = $this->m_admin->getWhere('invoice', $where)->result();
		$data['transaksi'] = $this->m_admin->getWhere('transaksi', $where)->result();

		$this->load->view('admin/detail_invoice', $data);
	}
	/** END DATA TRANSAKSI INVOICE */


	/** DATA TRANSAKSI STOK PRODUK */
	// fungsi untuk menampilkan halaman daftar stock produk
	function stok_produk() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Produk";

		// ambil data suplier, stok_produk, transaksi stock, produk
		$data['suplier']     = $this->m_admin->getAll('suplier')->result();
		$data['stok_produk'] = $this->m_admin->getStokProduk('stok_produk', 'produk')->result();
		$data['trans_stok']  = $this->m_admin->getAll('trans_stok')->result();
		$data['produk']      = $this->m_admin->getAll('produk')->result();

		$this->load->view('admin/stok_produk', $data);
	}

	// fungsi untuk tambah stock produk
	function tambah_stok_produk() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input POST
		$id_stok      = time();
		$id_trans     = "TS".time();
		$kode_produk  = htmlspecialchars(trim($this->input->post("kode_produk")));
		$jml_stok     = htmlspecialchars(trim($this->input->post("jml_stok")));
		$suplier      = htmlspecialchars(trim($this->input->post("suplier_produk")));
		$tipe_trans   = htmlspecialchars(trim($this->input->post("tipe_trans")));
		$no_faktur    = htmlspecialchars(trim($this->input->post("no_faktur")));
		$input_by     = $this->session->userdata('username');

		$data_stok_new = array(
			'id'           => $id_stok,
			'kode_produk'  => $kode_produk,
			'jml_stock'    => $jml_stok
		);

		$trans_stok = array(
			'id_ts'         => $id_trans,
			'kode_produk'   => $kode_produk,
			'suplier'       => $suplier,
			'jml_stok'      => $jml_stok,
			'tipe_trans'    => $tipe_trans,
			'no_faktur'     => $no_faktur,
			'input_by'      => $input_by,
			'tgl_input'     => date('Y-m-d H:m:s'),
			'tgl_update'    => date('Y-m-d H:m:s')
		);

		// cek apakah kode produk sudah ada di tabel stok_produk atau tidak, jika sudah ada tinggal diupdate jml stok nya
		$whereProduk = array('kode_produk' => $kode_produk);
		$isKodeProduk = $this->m_admin->getWhere('stok_produk', $whereProduk)->result();
		if (count($isKodeProduk) > 0) {
			$stok_lama = $isKodeProduk[0]->jml_stock;
			// data stok baru by kode_produk yg akan diinsert ke tabel stok_produk
			$data_stok = array(
				'jml_stock'    => $jml_stok + $stok_lama
			);
			$update_stok = $this->m_admin->updateData('stok_produk', $data_stok, $whereProduk);
			if ($update_stok) {
				$insert_trans_stok = $this->m_admin->insertData('trans_stok', $trans_stok);
				if ($insert_trans_stok) {
					$this->session->set_flashdata('success', "Berhasil tambah stok produk");
					redirect(base_url("admin/stok_produk"));
				} else {
					$this->session->set_flashdata('warning', "Berhasil tambah stok, namun gagal record trans stok!");
					redirect(base_url("admin/stok_produk"));
				}
			} else {
				$this->session->set_flashdata('error', 'Gagal menambah stok produk baru. Silakan ulangi lagi!');
				redirect(base_url("admin/stok_produk"));
			}
		} else {
			// insert stok produk baru ke table stok_produk
			$insert_stok = $this->m_admin->insertData('stok_produk', $data_stok_new);
			if ($insert_stok) {
				$insert_trans_stok = $this->m_admin->insertData('trans_stok', $trans_stok);
				if ($insert_trans_stok) {
					$this->session->set_flashdata('success', "Berhasil tambah stok produk baru dengan ID: $id_suplier");
					redirect(base_url("admin/stok_produk"));
				} else {
					$this->session->set_flashdata('warning', "Berhasil tambah stok baru, namun gagal record trans stok!");
					redirect(base_url("admin/stok_produk"));
				}
			} else {
				$this->session->set_flashdata('error', 'Gagal menambah stok produk baru. Silakan ulangi lagi!');
				redirect(base_url("admin/stok_produk"));
			}
		}
	}

	// fungsi untuk menampilkan detail transaksi stok produk
	function detail_trans_stok($kode_produk) {
		date_default_timezone_set("Asia/Jakarta");
		$whereProduk = array('kode_produk' => $kode_produk);
		$data['data_produk'] = $this->m_admin->getTransStockProduk('produk', 'trans_stok', $whereProduk)->result();

		// ambil data transaksi stok dari tabel trans_stok
		$data['title']       = "Halaman Transaksi Stok Produk";
		$data['kode_produk'] = $kode_produk;
		$data['trans_stok']  = $this->m_admin->getAll('trans_stok')->result();

		$this->load->view('admin/trans_stok', $data);
	}
	/** END DATA TRANSAKSI STOK PRODUK */


	/** CRUD DATA USER */
	// fungsi untuk menampilkan data user
	function user() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Data User";

		$data['user'] = $this->m_admin->getAll('user')->result();

		$this->load->view('admin/daftar_user', $data);
	}

	// fungsi untuk tambah user baru
	function tambah_user() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil input post dari form tambah user
		$username = strtoupper(htmlspecialchars(trim($this->input->post("username"))));
		$password = htmlspecialchars(trim($this->input->post("password")));
		$role     = trim($this->input->post("role"));
		$input_by = $this->session->userdata('username');

		// cek apakah username sudah ada di table user atau tidak
		$whereUsername = array('username' => $username);
		$isUsername = $this->m_admin->getWhere('user', $whereUsername)->num_rows();
		if ($isUsername > 0) {
			// username sudah ada di sistem
			$this->session->set_flashdata('error', "User tidak bisa ditambahkan. Username: $username, sudah ada di sistem!");
			redirect(base_url("admin/user"));
			exit;
		}

		$data_user_baru = array(
			'id'         => uniqid(),
			'username'   => $username,
			'password'   => md5($password),
			'role'       => $role,
			'status'     => true,
			'created_by' => $input_by,
			'created_at' => date('Y-m-d H:m:s'),
			'updated_at' => date('Y-m-d H:m:s')
		);

		// insert data_user_baru ke table user
		$insert_user = $this->m_admin->insertData('user', $data_user_baru);
		if ($insert_user) {
			$this->session->set_flashdata('success', "Berhasil tambah user baru dengan username: $username");
			redirect(base_url("admin/user"));
		} else {
			$this->session->set_flashdata('error', "Gagal tambah user baru!");
			redirect(base_url("admin/user"));
		}
	}
	/** END CRUD DATA USER */
	
	
	
	/** CRUD DATA INFO */
	// menampilkan data info perusahaan
	function info() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Info Outlet";

		// ambil data info perusahaan
		$data['info'] = $this->m_admin->getAll('outlet')->result();
		
		$this->load->view('admin/outlet', $data);
	}

	// fungsi untuk ubah data info outlet
	function ubah_info() {
		date_default_timezone_set("Asia/Jakarta");
		
		// ambil data input post pada form ubah_info
		$id      = $this->input->post("id");
		$nama    = $this->input->post("nama");
		$tentang = $this->input->post("tentang");
		$alamat  = $this->input->post("alamat");
		$email   = $this->input->post("email"); 
		$fax     = $this->input->post("fax");
		$no_telp = $this->input->post("no_telp");
		$no_hp   = $this->input->post("no_hp");
		$updt_by = $this->session->userdata("username");

		$where   = array('id' => $id);

		$data_outlet = array(
			'nama'       => $nama,
			'tentang'    => $tentang,
			'alamat'     => $alamat,
			'email'      => $email,
			'fax'        => $fax,
			'no_telp'    => $no_telp,
			'no_hp'      => $no_hp,
			'update_by'  => $updt_by,
			'tgl_update' => date('Y-m-d H:m:s')
		);
		
		// update info outlet 
		$update_outlet = $this->m_admin->updateData('outlet', $data_outlet, $where);
		if ($update_outlet) {
			// jika berhasil update
			$this->session->set_flashdata("success", "Berhasil update data info outlet.");
			redirect(base_url("admin/info"));
		} else {
			// jika gagal update
			$this->session->set_flashdata("error", "Gagal update data info outlet!");
			redirect(base_url("admin/info"));
		}
	}
	/** END CRUD DATA INFO */



	/** CRUD LAPORAN PENJUALAN PRODUK */
	// menampilkan halaman laporan penjualan produk
	function laporan(){
		date_default_timezone_set('Asia/Jakarta');
		$tahun = date('Y');
		$data['tahun'] = $tahun;
		$data['title'] = "Laporan Penjualan Tahun $tahun";

		$data['laporan'] = $this->m_admin->getLaporanPenjualanTahunan()->result();

		$this->load->view('admin/laporan_penjualan', $data);
	}
	/** END CRUD LAPORAN PENJUALAN PRODUK */
	 
	
}