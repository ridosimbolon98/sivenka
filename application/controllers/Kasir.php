<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Rido
 */

class Kasir extends CI_Controller {
	function __construct(){
		parent::__construct();

		if ($this->session->userdata('role') != "KASIR") {
			echo "<script>alert('Silakan login terlebih dahulu!');</script>";
			echo "<script>location='".base_url()."auth';</script>";
		} else {
			$this->load->helper('url');
			$this->load->model('m_auth');
			$this->load->model('m_kasir');
		}		
	}

	// menampilkan halaman dashboard admin
	function index(){
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Dashboard";

		$this->load->view('kasir/dashboard', $data);
	}


	/** DATA MASTER PRODUK */
	// menampilkan halaman daftar produk beserta data-datanya
	function daftar_produk() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Produk";

		// ambil data kategori produk, merk produk, suplier produk, satuan
		$data['kategori'] = $this->m_kasir->getAll('kategori_produk')->result();
		$data['merk']     = $this->m_kasir->getAll('merk_produk')->result();
		$data['suplier']  = $this->m_kasir->getAll('suplier')->result();
		$data['satuan']   = $this->m_kasir->getAll('satuan_produk')->result();
		
		// ambil semua data produk dari database
		$data['produk'] = $this->m_kasir->getDataProduk('produk', 'merk_produk', 'kategori_produk', 'stok_produk', 'suplier')->result();
		
		$this->load->view('kasir/daftar_produk', $data);
	}

	/** END DATA MASTER SUPLIER */


	/** DATA TRANSAKSI */
	// fungsi untuk menampilkan daftar invoice
	function transaksi() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Transaksi";
		$input_by      = $this->session->userdata('username');

		// hitung sub_total, ppn dan total tagihan belanja
		

		// ambil data produk, data keranjang belanja
		$whereAdmin        = array('input_by' => $input_by, 'selesai' => false); 
		$data['produk']    = $this->m_kasir->getAll('produk')->result();
		$data['keranjang'] = $this->m_kasir->getWhere('keranjang', $whereAdmin)->result();

		$this->load->view('kasir/transaksi', $data);
	}
	
	// ambil data produk by kode produk
	function get_data_produk($kode_produk) {
		date_default_timezone_set("Asia/Jakarta");
		$whereProduk = array('produk.kode_produk' => $kode_produk);
		$data_produk = $this->m_kasir->getDataProdukByKode('produk', 'merk_produk', 'kategori_produk', 'stok_produk', $whereProduk)->result();

		echo json_encode($data_produk);
	}

	// fungsi untuk tambah transaksi produk ke keranjang
	function tambah_keranjang() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input post
		$id_keranjang= "KJ".time();
		$kd_produk   = trim($this->input->post("produk"));
		$nama_produk = trim($this->input->post("nama_produk"));
		$harga_modal = trim($this->input->post("harga_modal"));
		$harga_jual  = trim($this->input->post("harga_jual"));
		$stok_saat_ini = trim($this->input->post("stock"));
		$jumlah      = trim($this->input->post("jumlah_order"));
		$subtotal    = trim($this->input->post("sub_total"));
		$tgl_input   = date('Y-m-d H:m:s');
		$input_by    = $this->session->userdata('username');

		// cek apakah sudah ada kode_produk yg sama di keranjang atau tidak
		$where       = array('kode_produk' => $kd_produk);
		$whereProduk = array('kd_produk' => $kd_produk, 'input_by' => $input_by, 'selesai' => false);
		$adaProduk   = $this->m_kasir->getWhere('keranjang', $whereProduk)->result();
		if (count($adaProduk) > 0) {
			$jml_sebelum      = $adaProduk[0]->jumlah;
			$subtotal_sebelum = $adaProduk[0]->subtotal;
			$update_produk = array(
				'jumlah'    => ($jml_sebelum + $jumlah),
				'subtotal'  => ($subtotal_sebelum + $subtotal),
				'tgl_input' => $tgl_input
			);

			// update keranjang
			$update_keranjang = $this->m_kasir->updateData('keranjang', $update_produk, $whereProduk);
			if ($update_keranjang) {

				// jika masuk keranjang, kurangi stok produk
				$jlh_stok = ($stok_saat_ini - $jumlah);
				$update_stok = array('jml_stock' => $jlh_stok);
				$this->m_kasir->updateData('stok_produk', $update_stok, $where);

				$this->session->set_flashdata('success', "Berhasil tambah produk: $kd_produk, ke dalam keranjang belanja.");
				redirect(base_url("kasir/transaksi"));
			} else {
				$this->session->set_flashdata('error', "Gagal tambah produk: $kd_produk, ke dalam keranjang belanja!");
				redirect(base_url("kasir/transaksi"));
			}
		} else {
			$insert_produk = array(
				'id_keranjang' => $id_keranjang,
				'kd_produk'    => $kd_produk,
				'nama_produk'  => $nama_produk,
				'harga_modal'  => $harga_modal,
				'harga_jual'   => $harga_jual,
				'jumlah'       => $jumlah,
				'subtotal'     => $subtotal,
				'input_by'     => $input_by,
				'tgl_input'    => $tgl_input
			);

			// insert ke keranjang
			$insert_keranjang = $this->m_kasir->insertData('keranjang', $insert_produk);
			if ($insert_keranjang) {

				// jika masuk keranjang, kurangi stok produk
				$jlh_stok = ($stok_saat_ini - $jumlah);
				$update_stok = array('jml_stock' => $jlh_stok);
				$this->m_kasir->updateData('stok_produk', $update_stok, $where);

				$this->session->set_flashdata('success', "Berhasil tambah produk: $kd_produk, ke dalam keranjang belanja.");
				redirect(base_url("kasir/transaksi"));
			} else {
				$this->session->set_flashdata('error', "Gagal tambah produk: $kd_produk, ke dalam keranjang belanja!");
				redirect(base_url("kasir/transaksi"));
			}
		}
	}

	// fungsi untuk transaksi pembayaran atau checkout produk di keranjang belanja
	function pembayaran() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil data dari form input
		$id_trans      = "TRX".time();
		$no_invoice    = "INV".time();
		$jml_cash      = trim($this->input->post("jml_cash"));
		$jml_kembalian = trim($this->input->post("jml_kembalian"));
		$tgl_input     = date('Y-m-d H:m:s');
		$input_by      = $this->session->userdata('username');

		$whereKasir = array('input_by' => $input_by, 'selesai' => false);		
		// ambil data keranjang by whereKasir
		$data_belanja = $this->m_kasir->getWhere('keranjang', $whereKasir)->result();
		if (count($data_belanja) > 0){
			// insert data keranjang ke tabel transaksi
			$jml_bayar = 0;
			$iter = 0;
			foreach ($data_belanja as $row) {
				// lakukan hitung jml bayar dan kembalain
				$jml_bayar += $row->subtotal; 

				$data_trans = array(
					'id_trans'     => $id_trans.$iter,
					'invoice'      => $no_invoice,
					'kd_produk'    => $row->kd_produk,
					'nama_produk'  => $row->nama_produk,
					'harga_modal'  => $row->harga_modal,
					'harga_jual'   => $row->harga_jual,
					'jumlah'       => $row->jumlah,
					'subtotal'     => $row->subtotal,
					'periode_trans'=> date('Y-m'),
					'input_by'     => $row->input_by,
					'tgl_input'    => $row->tgl_input
				);

				$iter++;

				$insert_trans = $this->m_kasir->insertData('transaksi', $data_trans);
				if ($insert_trans) {
					// setelah insert, lakukan delete data dari keranjang
					$whereIdKeranjang = array('id_keranjang' => $row->id_keranjang);
					$this->m_kasir->delete('keranjang', $whereIdKeranjang);
				} else {
					continue;
				}
			}

			$data_invoice = array(
				'id_invoice'    => time(),
				'invoice'       => $no_invoice,
				'jml_bayar'     => $jml_bayar,
				'jml_kembalian' => $jml_kembalian,
				'id_kasir'      => $input_by,
				'status'        => 'LUNAS',
				'status'        => date('Y-m'),
				'tgl_input'     => $tgl_input
			);

			// insert ke tabel invoice
			$insert_inv = $this->m_kasir->insertData('invoice', $data_invoice);
			if ($insert_inv) {
				$this->session->set_flashdata('success', "Berhasil proses pembayaran dengan nomor invoice: $no_invoice.");
				redirect(base_url("kasir/daftar_invoice"));
			} else {
				$this->session->set_flashdata('error', "Gagal proses pembayaran!");
				redirect(base_url("kasir/transaksi"));
			}
		}
	}

	// fungsi untuk hapus produk dari keranjang
	function hapus_produk_keranjang($id_keranjang) {
		date_default_timezone_set("Asia/Jakarta");
		$whereKeranjang = array('id_keranjang' => $id_keranjang);

		// ambil data produk by id_keranjang
		$produk = $this->m_kasir->getWhere('keranjang', $whereKeranjang)->result();
		if (count($produk) > 0) {
			$kd_produk = trim($produk[0]->kd_produk);
			$jumlah    = $produk[0]->jumlah;
			$where     = array('kode_produk' => $kd_produk);

			// ambil stock produk terakhir
			$stok_produk = $this->m_kasir->getWhere('stok_produk', $where)->result();
			if (count($stok_produk) <= 0) {
				$this->session->set_flashdata('error', "Produk: $kd_produk, ini tidak memiliki stok di sistem!");
				redirect(base_url("kasir/transaksi"));
				exit;
			}

			// jika ada stok, maka jumlah produk di keranjang yg batal ditambahkan ke stok_produk
			$jlh_stok = ($stok_produk[0]->jml_stock + $jumlah);
			$update_stok = array('jml_stock' => $jlh_stok);
			$this->m_kasir->updateData('stok_produk', $update_stok, $where);
		}

		// hapus produk
		$deleteProduk = $this->m_kasir->delete('keranjang', $whereKeranjang);
		if ($deleteProduk) {
			$this->session->set_flashdata('success', "Berhasil hapus produk dari keranjang belanja.");
			redirect(base_url("kasir/transaksi"));
		} else {
			$this->session->set_flashdata('error', "Gagal hapus produk dari keranjang belanja!");
			redirect(base_url("kasir/transaksi"));
		}
	}
	/** END DATA TRANSAKSI */


	/** DATA TRANSAKSI INVOICE */
	// fungsi untuk menampilkan daftar invoice
	function daftar_invoice() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Invoice";

		// ambil data invoice
		$data['invoice'] = $this->m_kasir->getAll('invoice')->result();

		$this->load->view('kasir/daftar_invoice', $data);
	}

	// fungsi untuk menampilkan detail invoice
	function detail_invoice($invoice) {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Invoice No: $invoice";

		$where             = array('invoice' => $invoice);
		$data['no_inv']    = $invoice;
		$data['data_pt']   = $this->m_kasir->getAll('perusahaan')->result();
		$data['invoice']   = $this->m_kasir->getWhere('invoice', $where)->result();
		$data['transaksi'] = $this->m_kasir->getWhere('transaksi', $where)->result();

		$this->load->view('kasir/detail_invoice', $data);
	}
	/** END DATA TRANSAKSI INVOICE */


	/** DATA TRANSAKSI STOK PRODUK */
	// fungsi untuk menampilkan halaman daftar stock produk
	function stok_produk() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Produk";

		// ambil data suplier, stok_produk, transaksi stock, produk
		$data['suplier']     = $this->m_kasir->getAll('suplier')->result();
		$data['stok_produk'] = $this->m_kasir->getStokProduk('stok_produk', 'produk')->result();
		$data['trans_stok']  = $this->m_kasir->getAll('trans_stok')->result();
		$data['produk']      = $this->m_kasir->getAll('produk')->result();

		$this->load->view('kasir/stok_produk', $data);
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
		$isKodeProduk = $this->m_kasir->getWhere('stok_produk', $whereProduk)->result();
		if (count($isKodeProduk) > 0) {
			$stok_lama = $isKodeProduk[0]->jml_stock;
			// data stok baru by kode_produk yg akan diinsert ke tabel stok_produk
			$data_stok = array(
				'jml_stock'    => $jml_stok + $stok_lama
			);
			$update_stok = $this->m_kasir->updateData('stok_produk', $data_stok, $whereProduk);
			if ($update_stok) {
				$insert_trans_stok = $this->m_kasir->insertData('trans_stok', $trans_stok);
				if ($insert_trans_stok) {
					$this->session->set_flashdata('success', "Berhasil tambah stok produk");
					redirect(base_url("kasir/stok_produk"));
				} else {
					$this->session->set_flashdata('warning', "Berhasil tambah stok, namun gagal record trans stok!");
					redirect(base_url("kasir/stok_produk"));
				}
			} else {
				$this->session->set_flashdata('error', 'Gagal menambah stok produk baru. Silakan ulangi lagi!');
				redirect(base_url("kasir/stok_produk"));
			}
		} else {
			// insert stok produk baru ke table stok_produk
			$insert_stok = $this->m_kasir->insertData('stok_produk', $data_stok_new);
			if ($insert_stok) {
				$insert_trans_stok = $this->m_kasir->insertData('trans_stok', $trans_stok);
				if ($insert_trans_stok) {
					$this->session->set_flashdata('success', "Berhasil tambah stok produk baru dengan ID: $id_suplier");
					redirect(base_url("kasir/stok_produk"));
				} else {
					$this->session->set_flashdata('warning', "Berhasil tambah stok baru, namun gagal record trans stok!");
					redirect(base_url("kasi/stok_produk"));
				}
			} else {
				$this->session->set_flashdata('error', 'Gagal menambah stok produk baru. Silakan ulangi lagi!');
				redirect(base_url("kasir/stok_produk"));
			}
		}
	}

	// fungsi untuk menampilkan detail transaksi stok produk
	function detail_trans_stok($kode_produk) {
		date_default_timezone_set("Asia/Jakarta");
		$whereProduk = array('kode_produk' => $kode_produk);
		$data['data_produk'] = $this->m_kasir->getTransStockProduk('produk', 'trans_stok', $whereProduk)->result();

		// ambil data transaksi stok dari tabel trans_stok
		$data['title']       = "Halaman Transaksi Stok Produk";
		$data['kode_produk'] = $kode_produk;
		$data['trans_stok']  = $this->m_kasir->getAll('trans_stok')->result();

		$this->load->view('kasir/trans_stok', $data);
	}
	/** END DATA TRANSAKSI STOK PRODUK */

	// MERK
	// fungsi untuk menampilkan daftar merk
	function daftar_merk() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Merk";

		// ambil data suplier dari tabel merk
		$data['merk'] = $this->m_kasir->getAll('merk_produk')->result();

		$this->load->view('kasir/daftar_merk', $data);
	}
	 
	// fungsi untuk menampilkan daftar kategori produk
	function daftar_kategori() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Daftar Kategori Produk";

		// ambil data suplier dari tabel suplier
		$data['kategori'] = $this->m_kasir->getAll('kategori_produk')->result();

		$this->load->view('kasir/daftar_kategori', $data);
	}
	
}