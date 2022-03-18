<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model{
    protected $table = 'pembayaran';

    public function getAll(){
        $dbResult = $this->db->query("SELECT * FROM pembayaran");
        return $dbResult->getResult();
    }

    //untuk memasukkan data pembayaran
    public function setorPembayaran(){

        //mendapaatkan id_transaksi terakhir dari seluruh transaksi
        $dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_transaksi = $row->id_transaksi;
        }

        $id_transaksi = $id_transaksi+1; //naikkan 1 untuk id baru modal yang dimasukkan
        $nama_karyawan  = $_POST['nama_karyawan'];
        $waktu          = $_POST['waktu'];
        $kehadiran      = $_POST['kehadiran'];
        $gaji           = preg_replace( '/[^0-9 ]/i', '', $_POST['gaji']);//dihilangkan karakter maskingnya karena pakai masking
        $hasil          = $this->db->query("INSERT INTO pembayaran SET id_transaksi = ?, nama_karyawan =?, waktu=?,kehadiran=?,  gaji=? ",
         array($id_transaksi, $nama_karyawan, $waktu, $kehadiran, $gaji));
        
        //masukkan ke jurnal
        $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                    SELECT a.id_transaksi, b.kode_akun, a.waktu, b.posisi,a.gaji,b. kelompok, b.transaksi
                    FROM pembayaran a
                    CROSS JOIN transaksi_coa b
                    WHERE a.id_transaksi = ? AND b.transaksi = 'pembayaran' AND b.kelompok = 6;
            ";
    $hasil = $this->db->query($sql, array($id_transaksi));
        return $hasil;
    }
  
    //delete pembayaran
    public function deletepembayaran($id_transaksi){
        $hasil = $this->db->query("DELETE FROM pembayaran WHERE id_transaksi =? ", array($id_transaksi));
        $hasil = $this->db->query("DELETE FROM jurnal WHERE id_transaksi =? ", array($id_transaksi));
        return $hasil;
    }

}