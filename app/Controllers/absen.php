<?php
namespace App\Controllers;

use App\Models\AbsenModel;
use App\Models\KaryawanModel;

class absen extends BaseController{
    public function __construct(){
		session_start();
        $this->AbsenModel = new AbsenModel();
        $this->KaryawanModel   = new KaryawanModel();
    }

	public function index(){

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if( //isset($_POST['nama_karyawan'])and
         
            isset($_POST['waktu']) ){
                //
                $validation =  \Config\Services::validation();

                if (! $this->validate(
                        [  //'id_pembayaran'=>'required`,
                            //'nama_karyawan' => 'required',
                            'waktu'         => 'required'
                         ],
                        [   /* Errors
                            'id_pembayaran' =>[
                                'required' => 'id pembayaran tidak boleh kosong,
                           ],
                           'nama_karyawan' =>[
                               'required' => 'keterangan nama tidak boleh kosong'
                           ],*/
                            'waktu' => [
                                'required' => 'Keterangan tanggal yang disetorkan tidak boleh kosong'
                            ]
                        ]
                ))
                {                
                    
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('absen/inputabsen',[
                        'validation' => $this->validator,
                        'karyawan'   => $this->KaryawanModel->getAll()
                    ]);

                }
                else{
                    //panggil metod dari kosan model untuk diinputkan datanya
                    //$hasil = $this->absenmodel->setorAbsen();
                    $hasil = $this->AbsenModel->inputKehadiran();
                    
                    $data['absen'] = $this->AbsenModel->getAll();
                    $data['karyawan']   = $this->KaryawanModel->getAll();

                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('absen/listabsen', $data);
                }    
                //
        }else{
                    //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
                  
                    $data['karyawan'] = $this->KaryawanModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('absen/inputabsen', $data);
        }
	}

    public function listabsen(){
        //helper('rupiah');
        //tambahkan pengecekan login
        /*if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }*/

        $data['absen'] = $this->AbsenModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('absen/listabsen', $data);
    }

    /*menghapus data
    public function deletepembayaran($id_transaksi){
        /*tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

		$this->PembayaranModel->deleteData($id_transaksi);

        return redirct()->to(base_url('karyawan/daftarkaryawan'));
        $this->PembayaranModel->deletepembayaran($id_transaksi);

		return redirect()->to(base_url('Pembayaran/ListPembayaran')); 
	}


}    
public function daftarabsen(){
    $data['karyawan'] = $this->KehadiranModel->getAll();
    echo view('HeaderBootstrap');
    echo view('SidebarBootstrap');
    echo view('karyawan/daftarabsen', $data);
}*/

    public function tes(){
        echo "ok";
        
        echo "Waktu absensi = ".$_POST['waktu']."<br>";
        
        // looping hasil nya melalui variabel kehadiran<<idkaryawan>>
        $karyawan = $this->KaryawanModel->getAll();
        foreach($karyawan as $row):
            //looping id karyawan untuk mendapatkan statusnya
            echo "kehadiran".$row['id_karyawan']."<br>";
            $kehadirankaryawan = "kehadiran".$row['id_karyawan'] ; // membentuk isi variabel yaitu kehadiran$id
            //dapatkah hasilnya
            echo "isi kehadiran = ".$_POST[$kehadirankaryawan][0]."<br>";

            echo "<hr>";
        endforeach;    

        // coba akses mmethod insert
        $this->AbsenModel->inputKehadiran();
    }    
}