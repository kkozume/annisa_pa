<?php

namespace App\Models;

use CodeIgniter\Model;

class produkModel extends Model
{
    protected $table = 'produk';

    public function getAll(){
        return $this->findAll();
    }

    //method untuk input data
    //dokumen dan gambar menjadi paramter inputan karena namanya sudah diganti
    public function insertData($gbr){
        $kode_produk          = $_POST['kode_produk'];
        $nama_produk          = $_POST['nama_produk'];
        $stok                 = $_POST['stok'];
        $harga_jual_produk    = $_POST['harga_jual_produk'];
        $kode_kategori  = $_POST['kode_kategori'];

        // //jangan lupa jika memakai masking maka dihilangkan dulu nilai maskingnya agar yang masuk ke db adalah murni numeriknya
        // $harga_jual_produk = preg_replace( '/[^0-9 ]/i', '', $harga_jual_produk);

        $hasil = $this->db->query("INSERT INTO produk SET kode_produk= ?, nama_produk= ?, stok= ?, harga_jual_produk= ?, gambar= ?, kode_kategori= ?", 
                            array($kode_produk, $nama_produk, $stok, $harga_jual_produk, $gbr, $kode_kategori));
        return $hasil;
    }
    //untuk mendapatkan data produk harian sesuai dengan id untuk diedit
    public function editData($id){
        $dbResult = $this->db->query("SELECT * FROM produk WHERE id = ?", array($id));
        return $dbResult->getResult();
    }
    //untuk mendapatkan data produk sesuai dengan id untuk diedit
    public function updateData($gbr){
        $id             = $_POST['id'];
        $kode_produk    = $_POST['kode_produk'];
        $nama_produk    = $_POST['nama_produk'];
        $stok           = $_POST['stok'];
        $harga_jual_produk   = $_POST['harga_jual_produk'];
        $kode_kategori  = $_POST['kode_kategori'];
        $hasil = $this->db->query("UPDATE produk SET kode_produk= ?, nama_produk= ?, stok= ?, harga_jual_produk= ?, gambar= ?, kode_kategori= ? 
                                   WHERE id =? ", array($kode_produk, $nama_produk, $stok, $harga_jual_produk, $gbr, $kode_kategori, $id));
        return $hasil;
    }
    //untuk menghapus data produk sesuai id yang dipilih
    public function deleteData($id){
        $hasil = $this->db->query("DELETE FROM produk WHERE id =? ", array($id));
        return $hasil;
         foreach ($hasil as $row)
        {
            $nama_file_gambar = $row->gambar;
        }
        if(is_file(FCPATH.'dokumen/upload/'.$nama_file_gambar)){
            unlink(FCPATH.'dokumen/upload/'.$nama_file_gambar); //delete file gambar
        }
    }
}