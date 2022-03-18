<?php

namespace App\Models;

use CodeIgniter\Model;

class pembelianbbModel extends Model
{
    protected $table = 'pembelian';

    public function getAll(){
        $dbResult = $this->db->query("SELECT * FROM pembelian");
        return $dbResult->getResult();
    }

    //untuk memasukkan data modal
    public function setorpembelian(){

        //mendapaatkan id_transaksi terakhir dari seluruh transaksi
        $dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        $hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_transaksi = $row->id_transaksi;
        }

        $id_transaksi = $id_transaksi+1; //naikkan 1 untuk id baru modal yang dimasukkan
        $kode_pembelian = $_POST['kode_pembelian'];//dihilangkan karakter maskingnya karena pakai masking
        $tgl_pembelian = $_POST['tgl_pembelian'];
        $id_supplier = $_POST['id_supplier'];
        $nama_pembelian = $_POST['nama_pembelian'];
        $jumlah_pembelian = $_POST['jumlah_pembelian'];
        $total_pembelian =  preg_replace( '/[^0-9 ]/i', '', $_POST['total_pembelian']);
        $hasil = $this->db->query("INSERT INTO pembelian SET id_transaksi = ?, kode_pembelian=?, id_supplier =?,nama_pembelian=?,tgl_pembelian=?, jumlah_pembelian=?, total_pembelian=? ", 
        array($id_transaksi, $kode_pembelian,$id_supplier,$nama_pembelian, $tgl_pembelian, $jumlah_pembelian, $total_pembelian));
        
        //masukkan ke jurnal
        $sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                    SELECT a.id_transaksi, b.kode_akun,a.tgl_pembelian,b.posisi,a.total_pembelian,b.kelompok,b.transaksi
                    FROM pembelian a
                    CROSS JOIN transaksi_coa b
                    WHERE a.id_transaksi = ? AND b.transaksi = 'pembelian' AND b.kelompok = 1
            ";
        $hasil = $this->db->query($sql, array($id_transaksi));
        // $this->pembelianbbModel->insert($array);


        return $hasil;
    }

    //delete modal
    public function deletepembelian($id_transaksi){
        $hasil = $this->db->query("DELETE FROM pembelian WHERE id_transaksi =? ", array($id_transaksi));
        $hasil = $this->db->query("DELETE FROM jurnal WHERE id_transaksi =? ", array($id_transaksi));
        return $hasil;
    }

    //query  yang ada modalnya
    public function getsupplierModal(){
        $sql = "
                    SELECT a.id_supplier,a.nama_suplier
                    FROM supplier a
                    JOIN pembelian b ON (a.id_supplier=b.id_supplier)
                    GROUP BY a.id_supplier,a.nama_suplier
                    ORDER BY 1 ASC
                ";
        $dbResult = $this->db->query($sql);
        return $dbResult->getResult();
    }

}