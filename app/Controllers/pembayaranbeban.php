<?php
namespace App\Controllers;

use App\Models\PembayaranbebanModel;

class Pembayaranbeban extends BaseController
{
    public function __construct()
    {
        session_start();
        $this->PembayaranbebanModel = new PembayaranbebanModel();
        helper('rupiah');
    }

	public function inputBeban()
	{
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        if( !isset($_POST['nama']) and !isset($_POST['biaya']) and !isset($_POST['waktu']) ) {
            //tidak perlu divalidasi
            $data['pembayaranbeban'] = $this->PembayaranbebanModel->getBebanData();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('pembayaranbeban/inputBeban', $data);
        }else{
            $validation =  \Config\Services::validation();
            if (! $this->validate(
                    [
                        'nama' => 'required',
                        'biaya' => 'required',
                        'waktu' => 'required'
                    ],
                    [   // Errors
                        'namakosan' => [
                            'required' => 'Nama beban tidak boleh kosong'
                        ],
                        'biaya' => [
                            'required' => 'Besar biaya beban tidak boleh kosong'
                        ],
                        'waktu' => [
                            'required' => 'Tanggal beban tidak boleh kosong'
                        ]
                    ]
                )
            ){
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('pembayaranbeban/inputBeban',[
                    'validation' => $this->validator,
                    'pembayaranbeban' => $this->PembayaranbebanModel->getBebanData()
                ]);
            }else{
                //maka input database
                $hasil = $this->PembayaranbebanModel->inputBeban();
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Sukses menambahkan beban");
                    </script>
                    <?php	
                }
                $data['pembayaranbeban'] = $this->PembayaranbebanModel->getListBeban();
                //maka kembalikan ke awal
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('pembayaranbeban/ListBeban', $data);
            }
        }

	}

    public function ListBeban()
    {
        $data['pembayaranbeban'] = $this->PembayaranbebanModel->getListBeban();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pembayaranbeban/ListBeban', $data);
    }

    //menghapus data
    public function deletepembayaranbeban($id_transaksi){
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

		$this->PembayaranbebanModel->deletepembayaranbeban($id_transaksi);

		return redirect()->to(base_url('pembayaranbeban/ListBeban')); 
	}
}