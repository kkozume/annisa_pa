<?php

namespace App\Models;

use CodeIgniter\Model;

class ChanelModel extends Model
{
    protected $table = 'chanel_penjualan';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data chanel_penjualan
    public function insertData(){
        $nama_chanel = $_POST['nama_chanel'];
        $hasil = $this->db->query("INSERT INTO chanel_penjualan SET nama_chanel = ?", array($nama_chanel));
        return $hasil;
    }

    //untuk mendapatkan data chanel_penjualan sesuai dengan id_chanel untuk diedit
    public function editData($id_chanel){
        $dbResult = $this->db->query("SELECT * FROM chanel_penjualan WHERE id_chanel = ?", array($id_chanel));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data chanel_penjualan sesuai dengan id_chanel untuk diedit
    public function updateData(){
        $id_chanel = $_POST['id_chanel'];
        $nama_chanel = $_POST['nama_chanel'];
        $hasil = $this->db->query("UPDATE chanel_penjualan SET nama_chanel = ? WHERE id_chanel =? ", array($nama_chanel, $id_chanel));
        return $hasil;
    }

    //untuk menghapus data chanel_penjualan sesuai id_chanel yang dipilih
    public function deleteData($id_chanel){
        $hasil = $this->db->query("DELETE FROM chanel_penjualan WHERE id_chanel =? ", array($id_chanel));
        return $hasil;
    }
}