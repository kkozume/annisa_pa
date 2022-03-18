<?php
namespace App\Controllers;

use App\Models\ChanelModel;

class chanel_penjualan extends BaseController
{
	public function __construct()
    {
        //load kelas ChanelModel
        $this->ChanelModel = new ChanelModel();
    }

    public function index()
	{

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['nama_chanel'])){
            
            $validation =  \Config\Services::validation();
                //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
                if (! $this->validate([
                            'nama_chanel' => 'required|valid_url'
                ],
                        [   // Errors
                            'nama_chanel' => [
                                'required' => 'Nama chanel penjualan tidak boleh kosong',
                                'valid_url' => 'Gagal jika bidang tidak berisi URL yang valid'  
                            ]
                        ]
                ))
                {                
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('chanel_penjualan/Inputchanel',[
                        'validation' => $this->validator,
                    ]);

                }
                else
                {
                    //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                    //panggil metod dari chanel model untuk diinputkan datanya
                    $hasil = $this->ChanelModel->insertData();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }
                    $data['chanel_penjualan'] = $this->ChanelModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('chanel_penjualan/daftarchanel', $data);
                }    
        }else{
        //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('chanel_penjualan/Inputchanel'); 
	}
}

    public function daftarchanel(){
        $data['chanel_penjualan'] = $this->ChanelModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('chanel_penjualan/daftarchanel', $data);
    }

    public function editchanel($id_chanel){
        $data['chanel_penjualan'] = $this->ChanelModel->editData($id_chanel);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('chanel_penjualan/editchanel', $data);
    }

    public function editchanelproses(){
        
        $id_chanel = $_POST['id_chanel'];
        $nama_chanel = $_POST['nama_chanel'];
        

        $validation =  \Config\Services::validation();

        if (! $this->validate([
                    'nama_chanel' => 'required|valid_url'
        ],
                [   // Errors
                    'nama_chanel' => [
                        'required' => 'Nama chanel penjualan tidak boleh kosong',
                        'valid_url' => 'Gagal jika bidang tidak berisi URL yang valid' 
                    ]
                ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('chanel_penjualan/editchanel',[
                'validation' => $this->validator,
                'chanel_penjualan' => $this->ChanelModel->editData($id_chanel)
            ]);

        }
        else
        {
            //panggil metod dari chanel model untuk diinputkan datanya
            $hasil = $this->ChanelModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['chanel_penjualan'] = $this->ChanelModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('chanel_penjualan/daftarchanel', $data);
        }    
    }

    public function deletechanel($id_chanel){
		$this->ChanelModel->deleteData($id_chanel);

		return redirect()->to(base_url('chanel_penjualan/daftarchanel')); 
	}
}