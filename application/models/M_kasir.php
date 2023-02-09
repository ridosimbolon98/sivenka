<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {
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

    // fungsi untuk ambil data AKA pelanggan per periode
    function queryTest($table) {
        $sql = "SELECT * from $table";
        return $this->db->query($sql);
    }

}
