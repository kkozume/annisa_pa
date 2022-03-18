<?php

namespace App\Models;

use CodeIgniter\Model;

class supplierModel extends Model
{
    protected $table = 'supplier';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data karyawan harian
    public function insertData($ktp){
        $tanggal = $_POST['tanggal'];
        $nama_suplier = $_POST['nama_suplier'];
        $nama_cv = $_POST['nama_cv'];
        $alamat_supplier = $_POST['alamat_supplier'];
        $no_telp_supplier = $_POST['no_telp_supplier'];

        //jangan lupa jika memakai masking maka dihilangkan dulu nilai maskingnya agar yang masuk ke db adalah murni numeriknya
        $no_telp_supplier = preg_replace( '/[^0-9 ]/i', '', $no_telp_supplier);
        // $ktp = $_POST['ktp'];
        $hasil = $this->db->query("INSERT INTO supplier SET tanggal=?, nama_suplier = ?, nama_cv = ?, alamat_supplier = ?, no_telp_supplier = ?, ktp=?", 
        array($tanggal,$nama_suplier, $nama_cv,$alamat_supplier,$no_telp_supplier,$ktp));
        return $hasil;
    }

    //  //mendapatkan data
    //  public function getData(){
    //     $dbResult = $this->db->query($sql);
    //     return $dbResult->getResult();
    // }

    // //mendapatkan data daftarkaryawan berdasarkan id_karyawan untuk proses edit data
    // public function getDataById($id_supplier){
    //     $sql = "SELECT * FROM supplier WHERE id_supplier = ?";
    //     $dbResult = $this->db->query($sql, array($id_supplier));
    //     return $dbResult->getResult();
    // }

    //untuk mendapatkan data karyawan harian sesuai dengan id_karyawan untuk diedit
    public function editData($id_supplier){
        $dbResult = $this->db->query("SELECT * FROM supplier WHERE id_supplier = ?", array($id_supplier));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data karyawan sesuai dengan id_karyawan untuk diedit
    public function updateData($ktp){
        $id_supplier= $_POST['id_supplier'];
        $tanggal = $_POST['tanggal'];
        $nama_suplier = $_POST['nama_suplier'];
        $nama_cv = $_POST['nama_cv'];
        $alamat_supplier = $_POST['alamat_supplier'];
        $no_telp_supplier = $_POST['no_telp_supplier'];
        // $ktp = $_POST['ktp'];
        $hasil = $this->db->query("UPDATE supplier SET  tanggal=?,nama_suplier=?,nama_cv=?,alamat_supplier=?,no_telp_supplier=?,ktp=? 
        WHERE id_supplier =? ", array($tanggal,$nama_suplier,$nama_cv,$alamat_supplier,$no_telp_supplier,$ktp, $id_supplier));
        return $hasil;
    }

    //untuk menghapus data karyawan sesuai id_karyawan yang dipilih
    public function deleteData($id_supplier){
        $hasil = $this->db->query("DELETE FROM supplier WHERE id_supplier =? ", array($id_supplier));
        return $hasil;

        foreach ($hasil as $row)
        {
            $nama_file_gambar = $row->ktp;
        }
        if(is_file(FCPATH.'dokumen/upload/'.$nama_file_gambar)){
            unlink(FCPATH.'dokumen/upload/'.$nama_file_gambar); //delete file ktp
        }
    


    }
}