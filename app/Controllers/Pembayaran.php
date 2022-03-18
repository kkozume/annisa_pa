<?php
namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\KaryawanModel;

class Pembayaran extends BaseController{
    public function __construct(){
		session_start();
        $this->PembayaranModel = new PembayaranModel();
        $this->KaryawanModel   = new KaryawanModel();
    }

	public function index(){

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if( //isset($_POST['nama_karyawan'])and
         
            isset($_POST['waktu']) and
            isset($_POST['kehadiran']) and
            isset($_POST['gaji']) ){
                //
                $validation =  \Config\Services::validation();

                if (! $this->validate(
                        [  //'id_pembayaran'=>'required`,
                            //'nama_karyawan' => 'required',
                            'waktu'         => 'required',
                            'kehadiran'     => 'required',
                            'gaji'          => 'required'
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
                            ],
                            'kehadiran' => [
                                'required' => 'kehadiran disetorkan tidak boleh kosong'
                            ],
                            'gaji' => [
                                'required' => 'gaji disetorkan tidak boleh kosong'
                            ]
                        ]
                ))
                {                
                    
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('Pembayaran/InputPembayaran',[
                        'validation' => $this->validator,
                        'karyawan'   => $this->KaryawanModel->getAll()
                    ]);

                }
                else{
                    //panggil metod dari kosan model untuk diinputkan datanya
                    $hasil = $this->PembayaranModel->setorPembayaran();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }

                    $data['pembayaran'] = $this->PembayaranModel->getAll();
                    $data['karyawan']   = $this->KaryawanModel->getAll();

                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('Pembayaran/ListPembayaran', $data);
                }    
                //
        }else{
                    //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
                  
                    $data['karyawan'] = $this->KaryawanModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('Pembayaran/InputPembayaran', $data);
        }
	}

    public function listpembayaran(){
        helper('rupiah');
        //tambahkan pengecekan login
        /*if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }*/

        $data['pembayaran'] = $this->PembayaranModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Pembayaran/ListPembayaran', $data);
    }

    //menghapus data
    public function deletepembayaran($id_transaksi){
        /*tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }*/

		// $this->PembayaranModel->deleteData($id_transaksi);

        // return redirct()->to(base_url('karyawan/daftarkaryawan'));
        $this->PembayaranModel->deletepembayaran($id_transaksi);
		return redirect()->to(base_url('Pembayaran/ListPembayaran')); 
	}
    }