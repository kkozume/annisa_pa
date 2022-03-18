<?php
namespace App\Controllers;

use App\Models\ModelAkun;

class akun extends BaseController
{
	public function __construct()
    {
        //load kelas ModelAkun
        $this->ModelAkun = new ModelAkun();
    }

    public function index()
	{

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['kode_akun']) and isset($_POST['nama_akun']) and isset($_POST['header_akun'])and isset($_POST['posisi_d_c'])){
            
            $validation =  \Config\Services::validation();
                //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
                if (! $this->validate([
                    'kode_akun' => 'required|max_length[5]',    
                    'nama_akun' => 'required|max_length[50]',
                    'header_akun' => 'required|numeric',
                    'posisi_d_c' => 'required'
                ],
                        [   // Errors
                            'kode_akun' => [
                                'required' => 'Kode akun tidak boleh kosong',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 5' 
                            ],
                            'nama_akun' => [
                                'required' => 'Nama akun tidak boleh kosong',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 50'  
                            ],
                            'header_akun' => [
                                'required' => 'Header akun tidak boleh kosong',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 20'  
                            ],
                            'posisi_d_c' => [
                                'required' => 'Posisi d_c tidak boleh kosong',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 20'  
                            ]
                        ]
                ))
                {                
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('akun/Inputakun',[
                        'validation' => $this->validator,
                    ]);

                }
                else
                {
                    //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                    //panggil metod dari model akun untuk diinputkan datanya
                    $hasil = $this->ModelAkun->insertData();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }
                    $data['akun'] = $this->ModelAkun->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('akun/daftarakun', $data);
                }    
        }else{
        //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('akun/Inputakun'); 
	}
}

    public function daftarakun(){
        $data['akun'] = $this->ModelAkun->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('akun/daftarakun', $data);
    }

    public function editakun($id){
        $data['akun'] = $this->ModelAkun->editData($id);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('akun/editakun', $data);
    }

    public function editakunproses(){
        $id = $_POST['id'];
        $kode_akun = $_POST['kode_akun'];
        $nama_akun = $_POST['nama_akun'];
        $header_akun = $_POST['header_akun'];
        $posisi_d_c = $_POST['posisi_d_c'];
        

        $validation =  \Config\Services::validation();

        if (! $this->validate([
            'kode_akun' => 'required|max_length[5]',    
            'nama_akun' => 'required|max_length[50]',
            'header_akun' => 'required|numeric',
            'posisi_d_c' => 'required'
        ],
                [   // Errors
                    'kode_akun' => [
                        'required' => 'Kode akun tidak boleh kosong',
                        'max_length' => 'Panjang karakter tidak lebih besar dari 5' 
                    ],
                    'nama_akun' => [
                        'required' => 'Nama akun tidak boleh kosong',
                        'max_length' => 'Panjang karakter tidak lebih besar dari 50'  
                    ],
                    'header_akun' => [
                        'required' => 'Header akun tidak boleh kosong',
                        'numeric' => 'Header akun harus berupa angka'  
                    ],
                    'posisi_d_c' => [
                        'required' => 'Posisi d_c tidak boleh kosong', 
                    ]
                ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('akun/editakun',[
                'validation' => $this->validator,
                'akun' => $this->ModelAkun->editData($id)
            ]);

        }
        else
        {
            //panggil metod dari model akun untuk diinputkan datanya
            $hasil = $this->ModelAkun->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['akun'] = $this->ModelAkun->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('akun/daftarakun', $data);
        }    
    }

    public function deleteakun($id){
		$this->ModelAkun->deleteData($id);

		return redirect()->to(base_url('akun/daftarakun')); 
	}
}