<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Gilang
 * Date: 5/8/13
 * Time: 9:16 AM
 * To change this template use File | Settings | File Templates.
 */

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    //  ================= AUTOMATIC CODE ==================

    //    KODE PENJUALAN
    public function getKodePenjualan()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_penjualan,3)) as kd_max from tbl_penjualan_header");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = "001";
        }
        return "O-".$kd;
    }

    //    KODE BARANG
    function getKodeBarang(){
        $q = $this->db->query("select MAX(RIGHT(kd_barang,3)) as kd_max from tbl_barang");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "B-".$kd;
    }

    //    KODE PELANGGAN
    public function getKodePelanggan(){
        $q = $this->db->query("select MAX(RIGHT(kd_pelanggan,3)) as kd_max from tbl_pelanggan");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "P-".$kd;
    }

    //    KODE PEGAWAI
    public function getKodePegawai(){
        $q = $this->db->query("select MAX(RIGHT(kd_pegawai,3)) as kd_max from tbl_pegawai");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "K-".$kd;
    }

    public function getTambahStok($kd_barang,$tambah)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok + $tambah;
        }
        return $stok;
    }
    public function getKurangStok($kd_barang,$kurangi)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok - $kurangi;
        }
        return $stok;
    }
    public function getKembalikanStok($kd_barang)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok;
        }
        return $stok;
    }

    public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }
    function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }
    function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }
    function manualQuery($q)
    {
        return $this->db->query($q);
    }

    function getBarangJual(){
        return $this->db->query ("SELECT * from tbl_barang where stok > 0")->result();
    }

    function getAllDataPenjualan(){
        return $this->db->query("SELECT
                a.kd_penjualan,
                a.tanggal_penjualan,
                a.total_harga,
			    (select count(kd_penjualan) as jum from tbl_penjualan_detail where kd_penjualan=a.kd_penjualan) as jumlah
			    from tbl_penjualan_header a
			    ORDER BY a.kd_penjualan DESC
		")->result();
    }

    function getDataPenjualan($id){
        return $this->db->query("SELECT * from tbl_penjualan_header a
                left join tbl_pelanggan b on a.kd_pelanggan=b.kd_pelanggan
                left join tbl_pegawai c on a.kd_pegawai=c.kd_pegawai
                where a.kd_penjualan = '$id'")->result();
    }

    function getBarangPenjualan($id){
        return $this->db->query("
                select a.kd_barang,a.qty,b.nm_barang,b.harga
                from tbl_penjualan_detail a
                left join tbl_barang b on a.kd_barang=b.kd_barang
                where a.kd_penjualan = '$id'")->result();
    }

    function getLapPenjualan($tgl_awal,$tgl_akhir){
        return $this->db->query("SELECT *,sum(a.total_harga) as total_all from tbl_penjualan_header a
                left join tbl_pelanggan b on a.kd_pelanggan=b.kd_pelanggan
                left join tbl_pegawai c on a.kd_pegawai=c.kd_pegawai
                where a.tanggal_penjualan between '$tgl_awal' and '$tgl_akhir'
                ")->result();
    }

    function login($username, $password) {
        //create query to connect user login database
        $this->db->select('*');
        $this->db->from('tbl_pegawai');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }

}