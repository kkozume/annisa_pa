<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model{
    protected $table = 'umkm_puri_utami.absen';

    public function getAll(){
        $dbResult = $this->db->query("SELECT * FROM umkm_puri_utami.absen");
        return $dbResult->getResult();
    }

    //untuk memasukkan data absen
    public function setorAbsen(){

        //mendapaatkan id_transaksi terakhir dari seluruh transaksi
        //$dbResult = $this->db->query("SELECT IFNULL(MAX(id_transaksi),0) as id_transaksi from view_transaksi");

        //$hasil = $dbResult->getResult();
        //cacah hasilnya
        foreach ($hasil as $row)
        {
            $id_karyawan = $row->id_karyawan;
        }

        $id_karyawan = $id_karyawan; //naikkan 1 untuk id baru modal yang dimasukkan
        //$nama_karyawan  = $_POST['nama_karyawan'];
        $waktu          = $_POST['waktu'];
        $kehadiran     = $_POST['kehadiran'];
        //$gaji           = preg_replace( '/[^0-9 ]/i', '', $_POST['gaji']);//dihilangkan karakter maskingnya karena pakai masking
        $hasil          = $this->db->query("INSERT INTO absen SET waktu=?, id_karyawan = ?,  kehadiran=? ",
         array($waktu,$id_karyawan,   $kehadiran));
         return $hasil;
        
        //masukkan ke jurnal
        //$sql = "    INSERT INTO jurnal(`id_transaksi`, `kode_akun`, `tgl_jurnal`, `posisi_d_c`, `nominal`, `kelompok`, `transaksi`)
                    //SELECT a.id_transaksi, b.kode_akun, a.waktu, b.posisi,a.gaji,b. kelompok, b.transaksi
                   // FROM pembayaran a
                    //CROSS JOIN transaksi_coa b
                    //WHERE a.id_transaksi = ? AND b.transaksi = 'pembayaran' AND b.kelompok = 1;
           // ";
    //$hasil = $this->db->query($sql, array($id_transaksi));
       // return $hasil;
    }
  
    //delete pembayaran
   // public function deletepembayaran($id_transaksi){
       // $hasil = $this->db->query("DELETE FROM pembayaran WHERE id_transaksi =? ", array($id_transaksi));
       // $hasil = $this->db->query("DELETE FROM jurnal WHERE id_transaksi =? ", array($id_transaksi));
        //return $hasil;
    //}

    // untuk input kehadiran
    public function inputKehadiran(){
        //echo "<hr>";
        $dbResult = $this->db->query("SELECT * FROM umkm_puri_utami.karyawan");
        foreach($dbResult->getResult('array') as $row):
            //looping id karyawan untuk mendapatkan statusnya
            //echo "kehadiran".$row['id_karyawan']."<br>";
            $kehadirankaryawan = "kehadiran".$row['id_karyawan'] ; // membentuk isi variabel yaitu kehadiran$id
            //dapatkah hasilnya
            //echo "isi kehadiran = ".$_POST[$kehadirankaryawan][0]."<br>";
            
            // CEK DULU APAKAH SUDAH ADA UNTUK WAKTU ITU
            // KALAU BELUM ADA  input, kalau sudah ada update
            $sql = "SELECT COUNT(*) as jml FROM umkm_puri_utami.absen WHERE waktu =? and id_karyawan =?";
            $dbResult2 = $this->db->query($sql, array($_POST['waktu'], $row['id_karyawan']));
            foreach($dbResult2->getResult('array') as $row2):
                $jml = $row2['jml'];
            endforeach;    

            if($jml==0){
                // insert dgn queri builder
                $data = [
                    'waktu' => $_POST['waktu'],
                    'id_karyawan'  => $row['id_karyawan'],
                    'nama_karyawan'  => $row['nama_karyawan'],
                    'kehadiran' => $_POST[$kehadirankaryawan][0],
                ];
                
                $this->db->table('umkm_puri_utami.absen')->insert($data);
            }else{
                // update
                
                $sql = "UPDATE umkm_puri_utami.absen SET 
                        kehadiran = ?
                        WHERE waktu = ? AND id_karyawan = ?   
                        ";
                $this->db->query($sql, array($_POST[$kehadirankaryawan][0], $_POST['waktu'], $row['id_karyawan']));
                
            }

            //echo "<hr>";
        endforeach;
    }

}