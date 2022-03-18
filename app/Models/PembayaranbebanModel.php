<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranbebanModel extends Model
{
    protected $table = 'pembayaran_beban';

    //untuk menginputkan pembayaranbeban dan penjurnalan
    public function inputBeban(){
        $kodebeban = $_POST['kodebeban'];
        $nama = $_POST['nama'];
        $biaya = $_POST['biaya']; 
        $waktu = $_POST['waktu'];
        
        //jangan lupa jika memakai masking maka dihilangkan dulu nilai maskingnya agar yang masuk ke db adalah murni numeriknya
        $biaya = preg_replace( '/[^0-9 ]/i', '', $biaya);

        //dapatkan id transaksi untuk pembayaranbeban
        $dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_transaksi = $row->id_transaksi;
        }
        $id_transaksi = $id_transaksi+1; //naikkan 1 untuk id baru modal yang dimasukkan

        //masukkan ke pembayaranbeban
        $sql = "INSERT INTO pembayaran_beban SET id_transaksi = ?, biaya=?, nama=?, waktu=?
                ";
        $hasil = $this->db->query($sql, array($id_transaksi, $biaya, $nama, $waktu));

         //pencatatan jurnal pada saat pembayaran beban menggunakan metode hard code
         $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                     VALUES(?, ?, ?,'d', ?, 1, 'pembayaran_beban')
                ";
         $hasil = $this->db->query($sql, array($id_transaksi, $kodebeban, $waktu, $biaya));

         $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                     VALUES(?,'111', ?,'c', ?, 1,'pembayaran_beban')
                ";
         $hasil = $this->db->query($sql, array($id_transaksi, $waktu, $biaya));

        return $hasil;
    }

    //untuk mendapatkan data kode beban
    public function getBebanData(){
        $dbResult = $this->db->query("SELECT * FROM akun WHERE kode_akun LIKE '6%' AND length(kode_akun)>1");
        return $dbResult->getResult();
    }

     //untuk mendapatkan data list beban
     public function getListBeban(){
        $dbResult = $this->db->query("SELECT * FROM pembayaran_beban");
        return $dbResult->getResult();
    }

    //delete modal
    public function deletepembayaranbeban($id_transaksi){
        $hasil = $this->db->query("DELETE FROM pembayaran_beban WHERE id_transaksi =? ", array($id_transaksi));
        $hasil = $this->db->query("DELETE FROM jurnal WHERE id_transaksi =? ", array($id_transaksi));
        return $hasil;
    }

}