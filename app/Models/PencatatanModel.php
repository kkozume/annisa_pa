<?php

namespace App\Models;

use CodeIgniter\Model;

class PencatatanModel extends Model
{
    protected $table = 'pencatatan_harian';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data pencatatan harian
    public function insertData(){
        $kode_barang = $_POST['kode_barang'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $jumlah = $_POST['jumlah'];
        $posisi_db_kd = $_POST['posisi_db_kd'];
        $saldo = $_POST['saldo'];
        $hasil = $this->db->query("INSERT INTO pencatatan_harian SET kode_barang = ?, tanggal =?, keterangan =?, jumlah =?, posisi_db_kd =?, saldo =?", 
        array($kode_barang, $tanggal, $keterangan, $jumlah, $posisi_db_kd, $saldo));
        return $hasil;
    }

    //untuk mendapatkan data pencatatan harian sesuai dengan kode_barang untuk diedit
    public function editData($kode_barang){
        $dbResult = $this->db->query("SELECT * FROM pencatatan_harian WHERE kode_barang = ?", array($kode_barang));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data pencatatan harian sesuai dengan kode_barang untuk diedit
    public function updateData(){
        $kode_barang = $_POST['kode_barang'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $jumlah = $_POST['jumlah'];
        $posisi_db_kd = $_POST['posisi_db_kd'];
        $saldo = $_POST['saldo'];
        $hasil = $this->db->query("UPDATE pencatatan_harian SET tanggal = ?, keterangan =?, jumlah =?, posisi_db_kd =?, saldo =? WHERE kode_barang =? ", array($tanggal, $keterangan, $jumlah, $posisi_db_kd, $saldo, $kode_barang));
        return $hasil;
    }

    //untuk menghapus data pencatatan harian sesuai kode_barang yang dipilih
    public function deleteData($kode_barang){
        $hasil = $this->db->query("DELETE FROM pencatatan_harian WHERE kode_barang =? ", array($kode_barang));
        return $hasil;
    }
}