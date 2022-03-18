<?php
namespace App\Controllers;

use App\Models\PelangganModel;

class pelanggan extends BaseController
{
	public function __construct()
    {
        //load kelas PelangganModel
        $this->PelangganModel = new PelangganModel();
        //load helper
    }

    public function index()
	{

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if( isset($_POST['nama_pelanggan'])and
            isset($_POST['jenis_kelamin']) and 
            isset($_POST['alamat']) and 
            isset($_POST['no_telp']) and 
            !isset($_POST['ktp'])){
            
            $validation =  \Config\Services::validation();
                //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
                if (! $this->validate([
                        'nama_pelanggan' => 'required',
                        'jenis_kelamin' => 'required',
                        'alamat' => 'required',
                        'no_telp' => 'required',
                        'ktp' => [
                            'uploaded[ktp]',
                            'mime_in[ktp,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                            'max_size[ktp,10024]' //maksimal 1 M
                        ]
                ],
                        [   // Errors
                            'nama_pelanggan' => [
                                'required' => 'Nama pelanggan tidak boleh kosong'
                            ],
                            'jenis_kelamin' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'  
                            ],
                            'alamat' => [
                                'required' => 'Alamat tidak boleh kosong'  
                            ],
                            'no_telp' => [
                                'required' => 'Nomor telepon tidak boleh kosong',
                                // 'numeric' => 'Nomor telepon harus angka',
                                // 'max_length' => 'Panjang karakter tidak lebih besar dari 17'   
                            ]
                        ]
                ))
                {                
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pelanggan/Inputpelanggan',[
                        'validation' => $this->validator,
                    ]);

                }
                else
                {
                     //proses upload file ke server dulu
                    //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
                     $fileName = uniqid();

                    //mendapatkan nama file asli untuk ktp
                    $namafileasli = $_FILES['ktp']['name'];
                    $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                    $ekstensi_file_ktp_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                    $ktp = $fileName.'.'.$ekstensi_file_ktp_asli;

                    //mengupload ke server ke lokasi public/images/upload
                    $avatar = $this->request->getFile('ktp');
                    $avatar->move(ROOTPATH.'public/images/upload', $ktp); //namafile u12adsasds + . + jpg

                    //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                    //panggil metod dari kategori model untuk diinputkan datanya
                    $hasil = $this->PelangganModel->insertData($ktp);
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }
                    $data['pelanggan'] = $this->PelangganModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('pelanggan/daftarpelanggan', $data);
                }    
        }else{
        //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pelanggan/Inputpelanggan'); 
	}
}

    public function editpelanggan($id_pelanggan){
        $data['pelanggan'] = $this->PelangganModel->editData($id_pelanggan);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pelanggan/editpelanggan', $data);
    }

    public function editpelangganproses(){
        $id_pelanggan = $_POST['id_pelanggan'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $no_telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];
        $ktp_lama = !isset($_POST['old_ktp']); //menyimpan nilai lama ktp
        
        $validation =  \Config\Services::validation();

        //jika input ktp diisi oleh user
        if( !empty($_FILES["ktp"]["name"])){
            $input = $this->validate(
                [
                    'nama_pelanggan' => 'required',
                    'jenis_kelamin' => 'required',
                    'no_telp' => 'required',
                    'alamat' => 'required',
                    'ktp' => [
                        'uploaded[ktp]',
                        'mime_in[ktp,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[ktp,10024]' //maksimal 1 M
                    ]
                ],
                        [   // Errors
                            'nama_pelanggan' => [
                                'required' => 'Nama pelanggan tidak boleh kosong'
                            ],
                            'jenis_kelamin' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'  
                            ],
                            'no_telp' => [
                                'required' => 'Nomor telepon tidak boleh kosong',
                                // 'numeric' => 'Nomor telepon harus angka',
                                // 'max_length' => 'Panjang karakter tidak lebih besar dari 17'   
                            ],
                            'alamat' => [
                                'required' => 'Alamat tidak boleh kosong'  
                            ]
                        ]
            );
        }else{
            $input = $this->validate(
                [
                    'nama_pelanggan' => 'required',
                    'jenis_kelamin' => 'required',
                    'no_telp' => 'required',
                    'alamat' => 'required',
                ],
                        [   // Errors
                            'nama_pelanggan' => [
                                'required' => 'Nama pelanggan tidak boleh kosong'
                            ],
                            'jenis_kelamin' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'  
                            ],
                            'no_telp' => [
                                'required' => 'Nomor telepon tidak boleh kosong'
                                // 'numeric' => 'Nomor telepon harus angka' 
                            ],
                            'alamat' => [
                                'required' => 'Alamat tidak boleh kosong'  
                            ]
                        ]
            );
        }
        
         ///////////////
         if (! $input)
         {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('pelanggan/editpelanggan',[
                'validation' => $this->validator,
                'pelanggan' => $this->PelangganModel->editData($id_pelanggan)
            ]);

        }
        else{
            //proses upload file ke server dulu
            //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
            $fileName = uniqid();

            //cek apakah file dokumen diupdate
            if(!empty($_FILES["ktp"]["name"])){
                //mendapatkan nama file asli untuk ktp
                $namafileasli = $_FILES['ktp']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_ktp_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $ktp = $fileName.'.'.$ekstensi_file_ktp_asli;

                //mengupload ke server ke lokasi public/images/upload
                $avatar = $this->request->getFile('ktp');
                $avatar->move(ROOTPATH.'public/images/upload', $ktp); //namafile u12adsasds + . + jpg
            }else{
                $ktp = $ktp_lama;
            }
            }

            //validasi tidak menemukan error sehingga bisa langsung di submit ke database
            //blok ini adalah blok jika sukses, yaitu panggil method insertData()
            $hasil = $this->PelangganModel->updateData($ktp);
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['pelanggan'] = $this->PelangganModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('pelanggan/daftarpelanggan', $data); 
        }   

    public function daftarpelanggan(){
        $data['pelanggan'] = $this->PelangganModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('pelanggan/daftarpelanggan', $data);
    }

    public function deletepelanggan($id_pelanggan){
		$this->PelangganModel->deleteData($id_pelanggan);

		return redirect()->to(base_url('pelanggan/daftarpelanggan')); 
	}
}