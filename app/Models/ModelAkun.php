<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkun extends Model
{
    protected $table = 'akun';

    public function getAll(){
        return $this->findAll();
    }

    //untuk memasukkan data akun
    public function insertData(){
        $kode_akun = $_POST['kode_akun'];
        $nama_akun = $_POST['nama_akun'];
        $header_akun = $_POST['header_akun'];
        $posisi_d_c = $_POST['posisi_d_c'];
        $hasil = $this->db->query("INSERT INTO akun SET kode_akun = ?, nama_akun = ?, header_akun = ?, posisi_d_c = ?", array($kode_akun, $nama_akun, $header_akun, $posisi_d_c));
        return $hasil;
    }

    //untuk mendapatkan data akun sesuai dengan kode_akun untuk diedit
    public function editData($id){
        $dbResult = $this->db->query("SELECT * FROM akun WHERE id = ?", array($id));
        return $dbResult->getResult();
    }

    //untuk mendapatkan data akun sesuai dengan kode_akun untuk diedit
    public function updateData(){
        $id = $_POST['id'];
        $kode_akun = $_POST['kode_akun'];
        $nama_akun = $_POST['nama_akun'];
        $header_akun = $_POST['header_akun'];
        $posisi_d_c = $_POST['posisi_d_c'];
        $hasil = $this->db->query("UPDATE akun SET  kode_akun =?, nama_akun = ?, header_akun = ?, posisi_d_c = ? WHERE id =? ", array($kode_akun, $nama_akun, $header_akun, $posisi_d_c, $id ));
        return $hasil;
    }

    //untuk menghapus data akun sesuai id yang dipilih
    public function deleteData($id){
        $hasil = $this->db->query("DELETE FROM akun WHERE id =? ", array($id));
        return $hasil;
    }

     //untuk list buku besar
     public function getNamaAkun(){
        $sql = "SELECT b.kode_akun, a.nama_akun
                FROM akun a
                JOIN jurnal b on (a.kode_akun=b.kode_akun)
                GROUP BY b.kode_akun, a.nama_akun
                ORDER BY 2";
        $dbResult = $this->db->query($sql);
        return $dbResult->getResult();        
    }

    //untuk data jurnal
    public function getJurnalUmum($tahun, $bulan){
        $sql = "SELECT a.*,b.nama_akun 
                FROM jurnal a
		        JOIN akun b ON (a.kode_akun=b.kode_akun)
                WHERE  year(a.tgl_jurnal) = ? AND DATE_FORMAT(a.tgl_jurnal,'%m') = ?
                ORDER BY a.tgl_jurnal, a.id, a.id_transaksi, a.kelompok,a.posisi_d_c DESC";
        $dbResult = $this->db->query($sql, array($tahun, $bulan));
        return $dbResult->getResult();
    }

    //untuk data list tahun
    public function getPeriodeTahun(){
        $dbResult = $this->db->query("SELECT DISTINCT(YEAR(tgl_jurnal)) as tahun FROM `jurnal` UNION SELECT 2020 as tahun ORDER BY 1");
        return $dbResult->getResult();
    }

    //untuk data list tahun
    public function getPeriodeBulan($tahun){
        $sql = "SELECT DATE_FORMAT(tgl_jurnal,'%M') as bulan, DATE_FORMAT(tgl_jurnal,'%m') as bulan_angka 
                FROM `jurnal` WHERE YEAR(tgl_jurnal) = ?
                GROUP BY DATE_FORMAT(tgl_jurnal,'%M'), DATE_FORMAT(tgl_jurnal,'%m') ORDER BY 2";
        $dbResult = $this->db->query($sql, array($tahun));
        //dikembalikan dalam bentuk array
        return $dbResult->getResult('array');
    }

    //untuk data buku besar
    public function getBukuBesar($tahun, $bulan, $kode_akun){
        $sql = "
                    SELECT a.*,b.nama_akun  
                    FROM jurnal a
                    JOIN akun b ON (a.kode_akun=b.kode_akun)
                    WHERE  year(a.tgl_jurnal) = ? AND DATE_FORMAT(a.tgl_jurnal,'%m') = ?
                    AND b.kode_akun = ?
                    ORDER BY a.tgl_jurnal, a.id, a.id_transaksi, a.kelompok,a.posisi_d_c DESC
                ";
        $dbResult = $this->db->query($sql, array($tahun, $bulan, $kode_akun));
        return $dbResult->getResult();        
    }

    //get data posisi saldo normal
    public function getPosisiSaldoNormal($akun){
        //lihat posisi saldo awal normal
        $sql = "SELECT posisi_d_c
                FROM akun 
                WHERE kode_akun = ?";
        
        $dbResult = $this->db->query($sql, array($akun));
        $hasil = $dbResult->getResult('array');
        foreach($hasil as $cacah):
            $posisi_saldo_normal = $cacah['posisi_d_c'];
        endforeach;
        return $posisi_saldo_normal;
    }

    //untuk mengetahui saldo awal buku besar
    public function getSaldoAwal($bulan,$tahun,$akun){
        $posisi_saldo_normal = $this->getPosisiSaldoNormal($akun);
        $bulan = str_pad($bulan,2,"0",STR_PAD_LEFT);
        $waktu = $tahun."-".$bulan;
        $sql = "
                    SELECT tbl1.posisi_d_c,ifnull(tbl2.total,0) as nominal FROM
                    (
                        SELECT 'd' posisi_d_c
                        UNION
                        SELECT 'c' posisi_d_c
                    ) tbl1
                    LEFT OUTER JOIN
                    (
                        Select a.posisi_d_c,sum(a.nominal) as total
                        FROM jurnal a
                        JOIN akun b ON (a.kode_akun=b.kode_akun)
                        WHERE a.kode_akun = ? 
                        AND date_format(a.tgl_jurnal,'%Y-%m') < ?
                        GROUP BY  a.posisi_d_c
                    ) tbl2
                    ON (tbl1.posisi_d_c = tbl2.posisi_d_c)
        
        ";
        $dbResult = $this->db->query($sql, array($akun, $bulan));
        $hasil = $dbResult->getResult('array');
        $saldo_debet = 0;
        $saldo_kredit = 0;
        foreach($hasil as $cacah):
            if(strcmp($cacah['posisi_d_c'],'d')==0){
                $saldo_debet = $saldo_debet + $cacah['nominal'];
            }else{
                $saldo_kredit = $saldo_kredit + $cacah['nominal'];
            }
        endforeach;

        if(strcmp($posisi_saldo_normal,'d')==0){
            $saldo = $saldo_debet - $saldo_kredit;
        }else{
            $saldo =  $saldo_kredit - $saldo_debet;
        }
        return $saldo;
    }

    //mendapatkan kode akun untuk Beban
    public function getListBeban($bulan, $kode_akun){
        // $bulan = str_pad($bulan,2,"0",STR_PAD_LEFT);
        // $waktu = $bulan."-".$tahun;
        $sql = "SELECT a.kode_akun,a.nama_akun,SUM(nominal) as total
                FROM akun a
                JOIN jurnal b ON (a.kode_akun=b.kode_akun)
                JOIN pembebanan c ON (b.id_transaksi=c.id_transaksi)
                WHERE a.kode_akun LIKE '6%' and length(a.kode_akun)>1
                AND  year(b.tgl_jurnal) = ? AND DATE_FORMAT(b.tgl_jurnal,'%m') = ?
                ";
        $dbResult = $this->db->query($sql, array($bulan, $kode_akun));
        return $dbResult->getResult();   
    }

    // //mendapatkan kode akun untuk Penjualan
    // public function getPenjualan($tahun, $bulan){
    //     // $bulan = str_pad($bulan,2,"0",STR_PAD_LEFT);
    //     // $waktu = $bulan."-".$tahun;
    //     $sql = "SELECT a.kode_akun,a.nama_akun,SUM(nominal) as harga
    //             FROM akun a
    //             JOIN jurnal b ON (a.kode_akun=b.kode_akun)
    //             JOIN penjualan c ON (b.id_transaksi=c.id_transaksi)
    //             WHERE a.kode_akun LIKE '4%' and length(a.kode_akun)>1
    //             AND  year(b.tgl_jurnal) = ? AND DATE_FORMAT(b.tgl_jurnal,'%m') = ?
    //             ";
    //     $dbResult = $this->db->query($sql, array($tahun, $bulan));
    //     return $dbResult->getResult();   
    // }

    // //mendapatkan kode akun untuk Penjualan
    // public function getHPP($tahun, $bulan){
    //     // $bulan = str_pad($bulan,2,"0",STR_PAD_LEFT);
    //     // $waktu = $bulan."-".$tahun;
    //     $sql = "SELECT a.kode_akun,a.nama_akun,SUM(nominal) as hpp
    //             FROM akun a
    //             JOIN jurnal b ON (a.kode_akun=b.kode_akun)
    //             JOIN penjualan c ON (b.id_transaksi=c.id_transaksi)
    //             WHERE a.kode_akun LIKE '5%' and length(a.kode_akun)>1 
    //             AND year(b.tgl_jurnal) = ? AND DATE_FORMAT(b.tgl_jurnal,'%m') = ?
    //             ";
    //     $dbResult = $this->db->query($sql, array($tahun, $bulan));
    //     return $dbResult->getResult();   
    // }
}