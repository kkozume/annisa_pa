<?php

namespace App\Models;

use CodeIgniter\Model;

class TeleponModel extends Model
{
    protected $table = 'telepon';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data telepon
    public function insertData(){
        $id_karyawan = $_POST['id_karyawan'];
        $no_telepon = $_POST['no_telepon'];
        $hasil = $this->db->query("INSERT INTO telepon SET id_karyawan = ?, no_telepon = ?", array($id_karyawan, $no_telepon));
        return $hasil;
    }

    //untuk mendapatkan data telepon sesuai dengan id_karyawan untuk diedit
    public function editData($id_karyawan){
        $dbResult = $this->db->query("SELECT * FROM telepon WHERE id_karyawan = ?", array($id_karyawan));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data telepon sesuai dengan id_karyawan untuk diedit
    public function updateData(){
        $id_karyawan = $_POST['id_karyawan'];
        $no_telepon = $_POST['no_telepon'];
        $hasil = $this->db->query("UPDATE telepon SET no_telepon = ? WHERE id_karyawan =? ", array($no_telepon, $id_karyawan));
        return $hasil;
    }

    //untuk menghapus data telepon sesuai id_karyawan yang dipilih
    public function deleteData($id_karyawan){
        $hasil = $this->db->query("DELETE FROM telepon WHERE id_karyawan =? ", array($id_karyawan));
        return $hasil;
    }
}