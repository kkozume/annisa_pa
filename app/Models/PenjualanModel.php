<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model{
    protected $table = 'penjualan';

    public function getAll(){
        $dbResult = $this->db->query("SELECT * FROM penjualan");
        return $dbResult->getResult();
    }

    //untuk memasukkan data penjualan
    public function catatPenjualan(){

        //mendapaatkan id_transaksi terakhir dari seluruh transaksi
        $dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_transaksi = $row->id_transaksi;
        }

        $id_transaksi = $id_transaksi+1; //naikkan 1 untuk id baru penjualan yang dimasukkan
        $nama_produk  = $_POST['nama_produk'];
        $waktu        = $_POST['waktu'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $jumlah       = $_POST['jumlah'];
        $harga        = preg_replace( '/[^0-9 ]/i', '', $_POST['harga']);
        $hpp          = preg_replace( '/[^0-9 ]/i', '', $_POST['hpp']);
        $total        = preg_replace( '/[^0-9 ]/i', '', $_POST['total']);
        $hasil        = $this->db->query("INSERT INTO penjualan SET id_transaksi = ?, nama_produk=?, waktu=?, nama_pelanggan=?, jumlah=?, harga=?, hpp=?, total=?", 
                                   array($id_transaksi, $nama_produk, $waktu, $nama_pelanggan, $jumlah, $harga, $hpp, $total));
        
        //masukkan ke jurnal
        $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                    SELECT a.id_transaksi, b.kode_akun, a.waktu, b.posisi, a.harga, b.kelompok, b.transaksi
                    FROM penjualan a
                    CROSS JOIN transaksi_coa b
                    WHERE a.id_transaksi = ? AND b.transaksi = 'penjualan' AND b.kelompok = 1;
            ";
        $hasil = $this->db->query($sql, array($id_transaksi));
        $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                    SELECT a.id_transaksi, b.kode_akun, a.waktu, b.posisi, a.hpp, b.kelompok, b.transaksi
                    FROM penjualan a
                    CROSS JOIN transaksi_coa b
                    WHERE a.id_transaksi = ? AND b.transaksi = 'penjualan' AND b.kelompok = 3;
            ";
        $hasil = $this->db->query($sql, array($id_transaksi));
        return $hasil;
    }

    //delete penjualan
    public function deletePenjualan($id_transaksi){
        $hasil = $this->db->query("DELETE FROM penjualan WHERE id_transaksi =? ", array($id_transaksi));
        $hasil = $this->db->query("DELETE FROM jurnal WHERE id_transaksi =? ", array($id_transaksi));
        return $hasil;
    }

}