<?php
namespace App\Controllers;

use App\Models\TeleponModel;

class telepon extends BaseController
{
	public function __construct()
    {
        //load kelas TeleponModel
        $this->TeleponModel = new TeleponModel();
    }

    public function index()
	{

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['id_karyawan']) and isset($_POST['no_telepon'])){
            
            $validation =  \Config\Services::validation();
                //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
                if (! $this->validate([
                        'id_karyawan' => 'required',
                        'no_telepon' => 'required|numeric|max_length[12]'
                ],
                        [   // Errors
                            'id_karyawan' => [
                                'required' => 'ID Karyawan tidak boleh kosong', 
                            ],
                            'no_telepon' => [
                                'required' => 'Nomor telepon tidak boleh kosong',
                                'numeric' => 'Nomor telepon harus angka',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 12'  
                            ]
                        ]
                ))
                {                
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('telepon/Inputtelepon',[
                        'validation' => $this->validator,
                    ]);

                }
                else
                {
                    //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                    //panggil metod dari kategori model untuk diinputkan datanya
                    $hasil = $this->TeleponModel->insertData();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }
                    $data['telepon'] = $this->TeleponModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('telepon/daftartelepon', $data);
                }    
        }else{
        //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('telepon/Inputtelepon'); 
	}
}

    public function daftartelepon(){
        $data['telepon'] = $this->TeleponModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('telepon/daftartelepon', $data);
    }

    //  public function tes_masking(){
    //       echo view('HeaderBootstrap');
    //       echo view('SidebarBootstrap');
    //       echo view('telepon/Inputtelepon');
    //  }

    //  public function hasil_submit_masking(){
    //       echo view('HeaderBootstrap');
    //       echo view('SidebarBootstrap');
    //       $data['telepon'] = $_POST['telepon'];
    //       echo view('telepon/daftartelepon', $data);
    //  }

    public function edittelepon($id_karyawan){
        $data['telepon'] = $this->TeleponModel->editData($id_karyawan);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('telepon/edittelepon', $data);
    }

    public function editteleponproses(){
        
        $id_karyawan = $_POST['id_karyawan'];
        $no_telepon = $_POST['no_telepon'];
        

        $validation =  \Config\Services::validation();

        if (! $this->validate([
                'id_karyawan' => 'required',  
                'no_telepon' => 'required|numeric|max_length[12]'
        ],
                [   // Errors
                    'id_karyawan' => [
                        'required' => 'ID Karyawan tidak boleh kosong',   
                    ],
                    'no_telepon' => [
                        'required' => 'Nomor Telepon tidak boleh kosong',
                        'numeric' => 'Nomor telepon harus angka',
                        'max_length' => 'Panjang karakter tidak lebih besar dari 12' 
                    ]
                ]
        ))
        {                
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('telepon/edittelepon',[
                'validation' => $this->validator,
                'telepon' => $this->TeleponModel->editData($id_karyawan)
            ]);

        }
        else
        {
            //panggil metod dari kategori model untuk diinputkan datanya
            $hasil = $this->TeleponModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['telepon'] = $this->TeleponModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('telepon/daftartelepon', $data);
        }    
    }

    public function deletetelepon($id_karyawan){
		$this->TeleponModel->deleteData($id_karyawan);

		return redirect()->to(base_url('telepon/daftartelepon')); 
	}
}