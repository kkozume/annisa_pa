<?php
namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\produkModel;

class Penjualan extends BaseController{
    public function __construct(){
		session_start();
        $this->PenjualanModel = new PenjualanModel();
        $this->produkModel = new produkModel();
    }

	public function index(){
        

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['nama_produk']) and
           isset($_POST['waktu']) and
           isset($_POST['nama_pelanggan']) and
           isset($_POST['jumlah']) and 
           isset($_POST['harga']) and
           isset($_POST['hpp']) and 
           isset($_POST['total']) 
           ){
                //
                $validation =  \Config\Services::validation();

                if (! $this->validate(
                        [
                            'nama_produk'   => 'required',
                            'waktu'         => 'required',
                            'nama_pelanggan'  => 'required',
                            'jumlah'        => 'required',
                            'harga'         => 'required',
                            'hpp'           => 'required',
                            'total'         => 'required'
                        ],
                        [   // Errors
                            'nama_produk' => [
                                'required' => 'Produk tidak boleh kosong'
                            ],
                            'waktu' => [
                                'required' => 'Tanggal penjualan tidak boleh kosong'
                            ],
                            'nama_pelanggan' => [
                                'required' => 'Nama pembeli tidak boleh kosong'
                            ],
                            'jumlah' => [
                                'required' => 'Jumlah produk yang dijual tidak boleh kosong'
                            ],
                            'harga' => [
                                'required' => 'Harga produk tidak boleh kosong'
                            ],
                            'hpp' => [
                                'required' => 'Harga Pokok Penjualan tidak boleh kosong'
                            ],
                            'total' => [
                                'required' => 'Total penjualan tidak boleh kosong'
                            ]
                        ]
                ))
                {                
                    
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('penjualan/InputPenjualan',[
                        'validation' => $this->validator,
                        'produk'     => $this->produkModel->getAll()
                    ]);

                }
                else{
                    //panggil metod dari penjualan model untuk diinputkan datanya
                    $hasil = $this->PenjualanModel->catatPenjualan();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }

                    $data['penjualan'] = $this->PenjualanModel->getAll();
                    $data['produk']    = $this->produkModel->getAll();

                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('penjualan/ListPenjualan', $data);
                }    
                //
        }else{
                    //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
                    $data['produk'] = $this->produkModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('penjualan/InputPenjualan', $data);
        }
	}

    public function ListPenjualan(){
        helper('rupiah');
        //tambahkan pengecekan login
        /*if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }*/

        $data['penjualan'] = $this->PenjualanModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('penjualan/ListPenjualan', $data);
    }

    //menghapus data
    public function deletePenjualan($id_transaksi){
        //tambahkan pengecekan login
        /*if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home'));
        }*/
        
		$this->PenjualanModel->deletePenjualan($id_transaksi);
		return redirect()->to(base_url('penjualan/ListPenjualan')); 
	}
}