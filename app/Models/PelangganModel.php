<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data pelanggan harian
    public function insertData($ktp){
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        
        //jangan lupa jika memakai masking maka dihilangkan dulu nilai maskingnya agar yang masuk ke db adalah murni numeriknya
        $no_telp = preg_replace( '/[^0-9 ]/i', '', $no_telp);
        
        $hasil = $this->db->query("INSERT INTO pelanggan SET nama_pelanggan = ?, jenis_kelamin =?, alamat =?, no_telp =?, ktp =?", 
        array($nama_pelanggan, $alamat, $no_telp, $ktp));
        return $hasil;
    }

    //untuk mendapatkan data pelanggan harian sesuai dengan id_pelanggan untuk diedit
    public function editData($id_pelanggan){
        $dbResult = $this->db->query("SELECT * FROM pelanggan WHERE id_pelanggan = ?", array($id_pelanggan));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data pelanggan sesuai dengan id_pelanggan untuk diedit
    public function updateData($ktp){
        $id_pelanggan = $_POST['id_pelanggan'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $jenis_kelamin = $_POST['jenis_kelamin'];        
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $hasil = $this->db->query("UPDATE pelanggan SET  nama_pelanggan = ?, jenis_kelamin =?, alamat =?, no_telp =?, ktp =? WHERE id_pelanggan =? ", array($nama_pelanggan, $jenis_kelamin, $alamat, $no_telp, $ktp, $id_pelanggan));
        return $hasil;
    }

    //untuk menghapus data pelanggan sesuai id_pelanggan yang dipilih
    public function deleteData($id_pelanggan){
        $hasil = $this->db->query("DELETE FROM pelanggan WHERE id_pelanggan =? ", array($id_pelanggan));
        return $hasil;
        foreach ($hasil as $row)
        {
            $nama_file_ktp = $row->ktp;
        }
        if(is_file(FCPATH.'dokumen/upload/'.$nama_file_ktp)){
            unlink(FCPATH.'dokumen/upload/'.$nama_file_ktp); //delete file ktp
        }

    }
}