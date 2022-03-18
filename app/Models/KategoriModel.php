<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data kategori
    public function insertData(){
        $kode_kategori = $_POST['kode_kategori'];
        $nama_kategori = $_POST['nama_kategori'];
        $hasil = $this->db->query("INSERT INTO kategori SET kode_kategori = ?, nama_kategori = ?", array($kode_kategori, $nama_kategori));
        return $hasil;
    }

    //untuk mendapatkan data kategori sesuai dengan kode_kategori untuk diedit
    public function editData($kode_kategori){
        $dbResult = $this->db->query("SELECT * FROM kategori WHERE kode_kategori = ?", array($kode_kategori));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data kategori sesuai dengan kode_kategori untuk diedit
    public function updateData(){
        $kode_kategori = $_POST['kode_kategori'];
        $nama_kategori = $_POST['nama_kategori'];
        $hasil = $this->db->query("UPDATE kategori SET nama_kategori = ? WHERE kode_kategori =? ", array($nama_kategori, $kode_kategori));
        return $hasil;
    }

    //untuk menghapus data kategori sesuai kode_kategori yang dipilih
    public function deleteData($kode_kategori){
        $hasil = $this->db->query("DELETE FROM kategori WHERE kode_kategori =? ", array($kode_kategori));
        return $hasil;
    }
}