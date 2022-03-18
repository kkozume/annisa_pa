<?php
namespace App\Controllers;

use App\Models\pembelianbbModel;
use App\Models\supplierModel;

class pembelian extends BaseController
{
    public function __construct()
    {
		session_start();
        $this->pembelianbbModel = new pembelianbbModel();
        $this->supplierModel = new supplierModel();
    }

	public function index()
	{
        helper('rupiah');
        //  //tambahkan pengecekan login
        //  if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['kode_pembelian']) and 
        isset($_POST['tgl_pembelian']) and 
        isset($_POST['nama_pembelian']) and 
        // isset($_POST['id_supplier']) and
        isset($_POST['jumlah_pembelian'])and 
        isset($_POST['total_pembelian'])){
                //
                $validation =  \Config\Services::validation();

                if (! $this->validate(
                        [
                            // 'kode_pembelian' => 'required',
                            'tgl_pembelian' => 'required',
                            'nama_pembelian' => 'required',
                            // 'id_supplier'=> 'required',
                            'jumlah_pembelian' => 'required',
                            'total_pembelian' => 'required',
                        ],
                        [   // Errors
                            // 'kode_pembelian' => [
                            //     'required' => 'Kode pembelian tidak boleh kosong'
                            // ],
                            'tgl_pembelian' => [
                                'required' => 'Tgl pembelian tidak boleh kosong'
                            ],
                            'nama_pembelian' => [
                                'required' => 'nama tidak boleh kosong'
                            ],
                            // 'id_supplier' => [
                            //     'required' => 'id supplier tidak boleh kosong'
                            // ],
                            'jumlah_pembelian' => [
                                'required' => 'Jumlah pembelian tidak boleh kosong'
                            ],
                            'total_pembelian' => [
                                'required' => 'Total pembelian tidak boleh kosong'
                            ]
                        ]
                ))
                {                
                    
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pembelian/Inputpembelian',[
                        'validation' => $this->validator,
                        'supplier' => $this->supplierModel->getAll()
                    ]);

                }
                else
                {
                    //panggil metod dari kosan model untuk diinputkan datanya
                    $hasil = $this->pembelianbbModel->setorpembelian();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }

                    $data['pembelian'] = $this->pembelianbbModel->getAll();
                    $data['supplier'] = $this->supplierModel->getAll();

                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pembelian/Listpembelian', $data);
                }    
                //
        }else{
                    //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
                    $data['supplier'] = $this->supplierModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pembelian/Inputpembelian', $data);
        }
	}

    public function Listpembelian()
    {
        helper('rupiah');
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        $data['pembelian'] = $this->pembelianbbModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pembelian/Listpembelian', $data);
    }

    //menghapus data
    public function deletepembelian($id_transaksi){
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

		$this->pembelianbbModel->deletepembelian($id_transaksi);

		return redirect()->to(base_url('pembelian/Listpembelian')); 
	}

}