<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }


    // Fungsi untuk insert data ke database
    function insertData($table,$data) {
		return $this->db->insert($table,$data);
	}

    // Fungsi untuk ambil data dari database
    function getAll($table){
        return $this->db->get($table);
    }

    // fungsi untuk hapus data 
    function delete($table,$where){
        $this->db->where($where);
        return $this->db->delete($table);
    }
    
    // fungsi untuk update data ke tabel
    function updateData($table,$data,$where){
        $this->db->where($where);
		return $this->db->update($table,$data);
    }

    // Fungsi untuk ambil data berdasarkan ketentuan tertentu dari database
    function getWhere($table,$where){
        return $this->db->get_where($table, $where);
    }

    // fungsi untuk ambil data produk dari databse
    // join 5 tabel 'produk', 'merk_produk', 'kategori_produk', 'stok_produk', 'suplier'
    function getDataProduk($table,$table2,$table3,$table4,$table5) {
        $this->db->select("$table.*, $table2.deskripsi as merk_produk, $table3.deskripsi as kategori_produk, $table4.*");
		$this->db->from($table);
		$this->db->join($table2, $table.'.merk='.$table2.'.id_merk', 'left');
		$this->db->join($table3, $table.'.kategori_produk='.$table3.'.id_kategori', 'left');
		$this->db->join($table4, $table.'.kode_produk='.$table4.'.kode_produk', 'left');
		$this->db->join($table5, $table.'.suplier='.$table5.'.id_suplier', 'left');
		$this->db->order_by("$table.nama_produk", 'ASC');
        return $this->db->get();
    }

    // join tabel 'produk', 'merk_produk', 'kategori_produk', 'stok_produk' filter kode_produk
    function getDataProdukByKode($table,$table2,$table3,$table4,$where) {
        $this->db->select("$table.*, $table2.deskripsi as merk_produk, $table3.deskripsi as kategori_produk, $table4.*");
		$this->db->from($table);
		$this->db->join($table2, $table.'.merk='.$table2.'.id_merk', 'left');
		$this->db->join($table3, $table.'.kategori_produk='.$table3.'.id_kategori', 'left');
		$this->db->join($table4, $table.'.kode_produk='.$table4.'.kode_produk', 'left');
        $this->db->where($where);
		$this->db->order_by("$table.nama_produk", 'ASC');
        return $this->db->get();
    }
    
    // fungsi untuk ambil data stock_produk dari databse
    // join 2 tabel 'stok_produk', 'produk'
    function getStokProduk($table,$table2) {
        $this->db->select("*");
		$this->db->from($table);
		$this->db->join($table2, $table.'.kode_produk='.$table2.'.kode_produk', 'left');
		$this->db->order_by("$table2.nama_produk", 'ASC');
        return $this->db->get();
    }
    
    // fungsi untuk ambil data produk join trans_stok dari databse
    // join 2 tabel 'produk', 'trans_stok'
    function getTransStockProduk($table,$table2) {
        $this->db->select("*");
		$this->db->from($table);
		$this->db->join($table2, $table.'.kode_produk='.$table2.'.kode_produk', 'left');
		$this->db->order_by("$table.nama_produk", 'ASC');
        return $this->db->get();
    }

    // fungsi untuk ambil data pendapatan total per periode berjalan
    function getPendapatan($table, $periode) {
        $sql = "SELECT sum(jml_bayar) AS pendapatan FROM $table WHERE periode='$periode'";
        return $this->db->query($sql);
    }

    // fungsi untuk ambil data penjualan per periode berjalan
    function getPenjualan($table, $periode) {
        $sql = "SELECT sum(jumlah) AS jumlah FROM $table WHERE periode_trans='$periode'";
        return $this->db->query($sql);
    }

    // ambil data produk baru
    function getProdukBaru() {
        $sql = "SELECT * FROM `produk` WHERE date_format(tgl_input, '%Y-%m') = date_format(now(), '%Y-%m');";
        return $this->db->query($sql);
    }

    // ambil data produk lama
    function getProdukLama() {
        $sql = "SELECT * FROM `produk` WHERE date_format(tgl_input, '%Y-%m') <> date_format(now(), '%Y-%m');";
        return $this->db->query($sql);
    }
    
    // ambil data suplier baru
    function getSuplierBaru() {
        $sql = "SELECT * FROM `suplier` WHERE date_format(tgl_input, '%Y-%m') = date_format(now(), '%Y-%m');";
        return $this->db->query($sql);
    }

    // ambil data suplier lama
    function getSuplierLama() {
        $sql = "SELECT * FROM `suplier` WHERE date_format(tgl_input, '%Y-%m') <> date_format(now(), '%Y-%m');";
        return $this->db->query($sql);
    }

    // fungsi data pendapatan tahun berjalan per bulan
    function getPendapatanTahunBerjalan($periode) {
        $sql = "SELECT sum(jml_bayar) as pendapatan FROM `invoice` WHERE periode='$periode'";
        return $this->db->query($sql);
    }
    
    // fungsi data pendapatan tahun berjalan per bulan
    function getPenjualanProdukPerBulan($periode) {
        $sql = "SELECT SUM(a.jumlah) as terjual, a.kd_produk, a.nama_produk, b.jml_stock, a.periode_trans, a.tgl_input FROM `transaksi` a JOIN `stok_produk` b ON a.kd_produk=b.kode_produk WHERE periode_trans='$periode' GROUP BY a.kd_produk LIMIT 5;";
        return $this->db->query($sql);
    }
    
    // fungsi data laporan penjualan tahun berjalan
    function getLaporanPenjualanTahunan() {
        $sql = "SELECT a.id_trans, a.invoice, a.kd_produk, a.nama_produk, b.jml_stock, c.satuan_jual, a.harga_modal, a.jumlah, a.subtotal, (a.subtotal*0.11) AS pajak, a.periode_trans, a.tgl_input FROM `transaksi` a JOIN `stok_produk` b ON a.kd_produk=b.kode_produk JOIN `produk` c ON a.kd_produk=c.kode_produk WHERE date_format(a.tgl_input, '%Y') = date_format(now(), '%Y');";
        return $this->db->query($sql);
    }

}
