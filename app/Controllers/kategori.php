<?php
namespace App\Controllers;

use App\Models\KategoriModel;

class kategori extends BaseController
{
	public function __construct()
    {
        //load kelas KategoriModel
        $this->KategoriModel = new KategoriModel();
    }

    public function index()
	{

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['kode_kategori']) and isset($_POST['nama_kategori'])){
            
            $validation =  \Config\Services::validation();
                //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
                if (! $this->validate([
                    'kode_kategori' => 'required|max_length[5]',    
                    'nama_kategori' => 'required|max_length[20]'
                ],
                        [   // Errors
                            'kode_kategori' => [
                                'required' => 'Kode kategori tidak boleh kosong',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 5' 
                            ],
                            'nama_kategori' => [
                                'required' => 'Nama kategori tidak boleh kosong',
                                'max_length' => 'Panjang karakter tidak lebih besar dari 20'  
                            ]
                        ]
                ))
                {                
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('kategori/Inputkategori',[
                        'validation' => $this->validator,
                    ]);

                }
                else
                {
                    //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                    //panggil metod dari kategori model untuk diinputkan datanya
                    $hasil = $this->KategoriModel->insertData();
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }
                    $data['kategori'] = $this->KategoriModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('kategori/daftarkategori', $data);
                }    
        }else{
        //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('kategori/Inputkategori'); 
	}
}

    public function daftarkategori(){
        $data['kategori'] = $this->KategoriModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('kategori/daftarkategori', $data);
    }

    public function editkategori($kode_kategori){
        $data['kategori'] = $this->KategoriModel->editData($kode_kategori);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('kategori/editkategori', $data);
    }

    public function editkategoriproses(){
        
        $kode_kategori = $_POST['kode_kategori'];
        $nama_kategori = $_POST['nama_kategori'];
        

        $validation =  \Config\Services::validation();

        if (! $this->validate([
                'kode_kategori' => 'required|max_length[5]',    
                'nama_kategori' => 'required|max_length[20]'
        ],
                [   // Errors
                    'kode_kategori' => [
                        'required' => 'Kode kategori tidak boleh kosong',
                        'max_length' => 'Panjang karakter tidak lebih besar dari 5' 
                    ],
                    'nama_kategori' => [
                        'required' => 'Nama kategori tidak boleh kosong',
                        'max_length' => 'Panjang karakter tidak lebih besar dari 20'
                    ]
                ]
        ))
        {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('kategori/editkategori',[
                'validation' => $this->validator,
                'kategori' => $this->KategoriModel->editData($kode_kategori)
            ]);

        }
        else
        {
            //panggil metod dari kategori model untuk diinputkan datanya
            $hasil = $this->KategoriModel->updateData();
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['kategori'] = $this->KategoriModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('kategori/daftarkategori', $data);
        }    
    }

    public function deletekategori($kode_kategori){
		$this->KategoriModel->deleteData($kode_kategori);

		return redirect()->to(base_url('kategori/daftarkategori')); 
	}
}