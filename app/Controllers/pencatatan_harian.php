<?php
namespace App\Controllers;

use App\Models\PencatatanModel;

class pencatatan_harian extends BaseController
{
	public function __construct()
    {
        //load kelas PencatatanModel
        $this->PencatatanModel = new PencatatanModel();
        //load helper
    }

    public function index()
	{

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['kode_barang'])and isset($_POST['tanggal']) and isset($_POST['keterangan']) and isset($_POST['jumlah'])and isset($_POST['posisi_db_kd']) and isset($_POST['saldo'])){
            
            $validation =  \Config\Services::validation();
                //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
                if (! $this->validate([
                        'kode_barang' => 'required|max_length[5]',
                        'tanggal' => 'required',
                        'keterangan' => 'required',
                        'jumlah' => 'required|numeric',
                        'posisi_db_kd' => 'required',
                        'saldo' => 'required|numeric'
                ],
                        [   // Errors
                            'kode_barang' => [
                                'required' => 'Kode barang tidak boleh kosong',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 5' 
                            ],
                            'tanggal' => [
                                'required' => 'Nama kategori tidak boleh kosong' 
                            ],
                            'keterangan' => [
                                'required' => 'Nama kategori tidak boleh kosong'  
                            ],
                            'jumlah' => [
                                'required' => 'Nama kategori tidak boleh kosong',
                                'numeric' => 'Jumlah harus angka' 
                            ],
                            'posisi_db_kd' => [
                                'required' => 'Nama kategori tidak boleh kosong'  
                            ],
                            'saldo' => [
                                'required' => 'Nama kategori tidak boleh kosong',
                                'numeric' => 'Saldo harus angka'
                            ]
                        ]
                ))
                {                
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pencatatan_harian/Inputpencatatan',[
                        'validation' => $this->validator,
                    ]);

                }
                else
                {
                    //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                    //panggil metod dari kategori model untuk diinputkan datanya
                    $hasil = $this->PencatatanModel->insertData();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }
                    $data['pencatatan_harian'] = $this->PencatatanModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pencatatan_harian/daftarpencatatan', $data);
                }    
        }else{
        //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pencatatan_harian/Inputpencatatan'); 
	}
}

    public function daftarpencatatan(){
        $data['pencatatan_harian'] = $this->PencatatanModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pencatatan_harian/daftarpencatatan', $data);
    }

    public function editpencatatan($kode_barang){
        $data['pencatatan_harian'] = $this->PencatatanModel->editData($kode_barang);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pencatatan_harian/editpencatatan', $data);
    }

    public function editpencatatanproses(){
        $kode_barang = $_POST['kode_barang'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $jumlah = $_POST['jumlah'];
        $posisi_db_kd = $_POST['posisi_db_kd'];
        $saldo = $_POST['saldo'];
        

        $validation =  \Config\Services::validation();

        if (! $this->validate([
            'kode_barang' => 'required|max_length[5]',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'posisi_db_kd' => 'required',
            'saldo' => 'required|numeric'
        ],
                [   // Errors
                    'kode_barang' => [
                        'required' => 'Kode barang tidak boleh kosong',
                        'max_length' => 'Panjang karakter tidak lebih besar dari 5' 
                    ],
                    'tanggal' => [
                        'required' => 'Nama kategori tidak boleh kosong' 
                    ],
                    'keterangan' => [
                        'required' => 'Nama kategori tidak boleh kosong'  
                    ],
                    'jumlah' => [
                        'required' => 'Nama kategori tidak boleh kosong',
                        'numeric' => 'Jumlah harus angka' 
                    ],
                    'posisi_db_kd' => [
                        'required' => 'Nama kategori tidak boleh kosong'  
                    ],
                    'saldo' => [
                        'required' => 'Nama kategori tidak boleh kosong',
                        'numeric' => 'Saldo harus angka'
                    ]
                ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('pencatatan_harian/editpencatatan',[
                'validation' => $this->validator,
                'pencatatan_harian' => $this->PencatatanModel->editData($kode_barang)
            ]);

        }
        else
        {
            //panggil metod dari pencatatan model untuk diinputkan datanya
            $hasil = $this->PencatatanModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['pencatatan_harian'] = $this->PencatatanModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('pencatatan_harian/daftarpencatatan', $data);
        }    
    }

    public function deletepencatatan($kode_barang){
		$this->PencatatanModel->deleteData($kode_barang);

		return redirect()->to(base_url('pencatatan_harian/daftarpencatatan')); 
	}
}