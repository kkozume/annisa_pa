<?php
namespace App\Controllers;

use App\Models\PemodalanModel;
use App\Models\produkModel;

class pemodalan extends BaseController
{
    public function __construct()
    {
		session_start();
        $this->PemodalanModel = new PemodalanModel();
        $this->produkModel = new produkModel();
    }

	public function setorModal()
	{
        // helper('rupiah');
        //  //tambahkan pengecekan login
        //  if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['besar']) and isset($_POST['nama']) and isset($_POST['waktu'])){
                //
                $validation =  \Config\Services::validation();

                if (! $this->validate(
                        [
                            'besar' => 'required',
                            'nama' => 'required',
                            'waktu' => 'required'
                        ],
                        [   // Errors
                            'besar' => [
                                'required' => 'Besar Modal yang disetor tidak boleh kosong'
                            ],
                            'nama' => [
                                'required' => 'Keterangan modal yang disetorkan tidak boleh kosong'
                            ],
                            'waktu' => [
                                'required' => 'Tanggal Modal disetorkan tidak boleh kosong'
                            ]
                        ]
                ))
                {                
                    
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pemodalan/Inputpemodalan',[
                        'validation' => $this->validator,
                        'produk' => $this->produkModel->getAll()
                    ]);

                }
                else
                {
                    //panggil metod dari produk model untuk diinputkan datanya
                    $hasil = $this->PemodalanModel->setorModal();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }

                    $data['pemodalan'] = $this->PemodalanModel->getAll();
                    $data['produk'] = $this->produkModel->getAll();

                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('Pemodalan/listpemodalan', $data);
                }    
                //
        }else{
                    //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
                    $data['produk'] = $this->produkModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pemodalan/Inputpemodalan', $data);
        }
	}

    public function listpemodalan()
    {
        // helper('rupiah');
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        $data['pemodalan'] = $this->PemodalanModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pemodalan/listpemodalan', $data);
    }

    //menghapus data
    public function deletepemodalan($id_transaksi){
        // //tambahkan pengecekan login
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

		$this->PemodalanModel->deleteModal($id_transaksi);

		return redirect()->to(base_url('pemodalan/listpemodalan')); 
	}

    //menarik data pemodalan
    public function tarikModal(){
        // helper('rupiah');
        //  //tambahkan pengecekan login
        //  if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['besar']) and isset($_POST['nama']) and isset($_POST['waktu'])){
                //
                $validation =  \Config\Services::validation();

                if (! $this->validate(
                        [
                            'besar' => 'required',
                            'nama' => 'required',
                            'waktu' => 'required'
                        ],
                        [   // Errors
                            'namakosan' => [
                                'required' => 'Besar Modal yang ditarik tidak boleh kosong'
                            ],
                            'nama' => [
                                'required' => 'Keterangan modal yang ditarik tidak boleh kosong'
                            ],
                            'waktu' => [
                                'required' => 'Tanggal Modal ditarik tidak boleh kosong'
                            ]
                        ]
                ))
                {                
                    
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pemodalan/tarikModal',[
                        'validation' => $this->validator,
                        'produk' => $this->PemodalanModel->getprodukModal()
                    ]);

                }
                else
                {
                    //panggil metod dari produk model untuk diinputkan datanya
                    //cek dulu apakah besarnya lebih dari besar modal yang belum ditarir
                    $besar = preg_replace( '/[^0-9 ]/i', '', $_POST['besar']);//dihilangkan karakter maskingnya karena pakai masking
                    $kode_produk = $_POST['kode_produk'];
                    $hasil = $this->PemodalanModel->cektarikModal($kode_produk, $besar);

                    //jika hasilnya 1 maka 
                    if($hasil==1){
                        $hasil = $this->PemodalanModel->tarikModal();
                        if($hasil->connID->affected_rows>0){
                            ?>
                            <script type="text/javascript">
                                alert("Sukses ditarik");
                            </script>
                            <?php	
                        }

                        $data['pemodalan'] = $this->PemodalanModel->getAll();
                        $data['produk'] = $this->PemodalanModel->getprodukModal();

                        echo view('HeaderBootstrap');
                        echo view('SidebarBootstrap');
                        echo view('pemodalan/listpemodalan', $data);
                    }else{
                        //jika tidak cukup kembalikan ke awal
                        ?>
                            <script type="text/javascript">
                                alert("Saldo Penarikan Tidak CUkup");
                            </script>
                        <?php
                        $data['pemodalan'] = $this->PemodalanModel->getAll();
                        $data['produk'] = $this->PemodalanModel->getprodukModal();
                         echo view('HeaderBootstrap');
                         echo view('SidebarBootstrap');
                         echo view('pemodalan/listpemodalan', $data);
                        //return redirect()->to(base_url('pemodalan/tarik')); 
                    }

                    
                }    
                //
        }else{
                    //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
                    $data['produk'] = $this->PemodalanModel->getprodukModal();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pemodalan/tarikModal', $data);
        }

    }
}