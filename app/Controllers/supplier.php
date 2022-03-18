<?php
namespace App\Controllers;

use App\Models\supplierModel;

class supplier extends BaseController
{
	public function __construct()
    {
        //load kelas supplierModel
        $this->supplierModel = new supplierModel();
        //load helper
    }

    public function index()
	{

        //cek dulu apakah kondisi form sudah diisi atau belum, kalau belum berarti tidak perlu memanggil fungsi validasi
        if(isset($_POST['tanggal'])and 
        isset($_POST['nama_suplier']) and 
        isset($_POST['nama_cv']) and 
        isset($_POST['alamat_supplier'])and 
        isset($_POST['no_telp_supplier']) and 
        !isset($_POST['ktp']) ){
            
            $validation =  \Config\Services::validation();
                //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
                if (! $this->validate([
                        'tanggal' => 'required',
                        'nama_suplier' => 'required',
                        'nama_cv' => 'required',
                        'alamat_supplier' => 'required',
                        'no_telp_supplier' => 'required',
                        'ktp' => [
                            'uploaded[ktp]',
                            'mime_in[ktp,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                            'max_size[ktp,10024]' //maksimal 1 M
                        ]
                ],
                        [   // Errors
                            'tanggal' => [
                                'required' => 'Tanggal tidak boleh kosong',
                            ],
                            
                            'nama_suplier' => [
                                'required' => 'Nama tidak boleh kosong',
                            ],
                            'nama_cv' => [
                                'required' => 'Nama cv tidak boleh kosong', 
                            ],
                            'alamat_supplier' => [
                                'required' => 'Alamat tidak boleh kosong',    
                            ],
                            'no_telp_supplier' => [
                                'required' => 'No telp tidak boleh kosong',
                                // 'numeric' => 'Nomor telp harus angka',
                                // 'is_natural' => 'Nomor telp harus dalam angka natural bukan minus (0 s/d 9)'
                            ]
                           
                        ]
                ))
                {                
                    //kirim data error ke views, karena ada isian yang tidak sesuai rules
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('supplier/inputsupplier',[
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
                    $ekstensi_file_gambar_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                    $ktp = $fileName.'.'.$ekstensi_file_gambar_asli;

                    //mengupload ke server ke lokasi public/images/upload
                    $avatar = $this->request->getFile('ktp');
                    $avatar->move(ROOTPATH.'public/images/upload', $ktp); //namafile u12adsasds + . + jpg

                    //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                    //panggil metod dari kategori model untuk diinputkan datanya
                    $hasil = $this->supplierModel->insertData($ktp);
                    if($hasil->connID->affected_rows>0){
                        ?>
                        <script type="text/javascript">
                            alert("Sukses ditambahkan");
                        </script>
                        <?php	
                    }
                    $data['supplier'] = $this->supplierModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('supplier/daftarsupplier', $data);
                }    
        }else{
        //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('supplier/inputsupplier'); 
	}
}

    public function editsupplier($id_supplier){
        $data['supplier'] = $this->supplierModel->editData($id_supplier);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('supplier/editsupplier', $data);
    }

    public function editsupplierproses(){
        $id_supplier= $_POST['id_supplier'];
        $tanggal = $_POST['tanggal'];
        $nama_suplier = $_POST['nama_suplier'];
        $nama_cv = $_POST['nama_cv'];
        $alamat_supplier = $_POST['alamat_supplier'];
        $no_telp_supplier = $_POST['no_telp_supplier'];
        $ktp_lama =!isset( $_POST['old_ktp']); //menyimpan nilai lama gambar
        
        $validation =  \Config\Services::validation();

        //jika input gambar diisi oleh user
        if( !empty($_FILES["ktp"]["name"])){
            $input = $this->validate(
                [
                    'tanggal' => 'required',
                    'nama_suplier' => 'required',
                    'nama_cv' => 'required',
                    'alamat_supplier' => 'required',
                    'no_telp_supplier' => 'required|min_length[5]',
                    'ktp' => [
                        'uploaded[ktp]',
                        'mime_in[ktp,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[ktp,10024]' //maksimal 1 M
                    ]
                ],
                        [   // Errors
                            'tanggal' => [
                                'required' => 'Tanggal tidak boleh kosong',
                               
                            ],
                            'nama_suplier' => [
                                'required' => 'Nama tidak boleh kosong',
                               
                            ],
                            'nama_cv' => [
                                'required' => 'Nama cv tidak boleh kosong', 
                            ],
                            'alamat_supplier' => [
                                'required' => 'Alamat tidak boleh kosong',    
                            ],
                            'no_telp_supplier' => [
                                'required' => 'No telp tidak boleh kosong',
                                // 'numeric' => 'Nomor telp harus angka',
                                // 'is_natural' => 'Nomor telp harus dalam angka natural bukan minus (0 s/d 9)'
                            ]
                        ]
            );
        }else{
            $input = $this->validate(
                [
                    'tanggal' => 'required',
                    'nama_suplier' => 'required',
                    'nama_cv' => 'required',
                    'alamat_supplier' => 'required',
                    'no_telp_supplier' => 'required|min_length[5]|numeric'
                ],
                        [   // Errors
                            'tanggal' => [
                                'required' => 'Tanggal tidak boleh kosong',
                               
                            ],
                            'nama_suplier' => [
                                'required' => 'Nama tidak boleh kosong',
                               
                            ],
                            'nama_cv' => [
                                'required' => 'Nama cv tidak boleh kosong', 
                            ],
                            'alamat_supplier' => [
                                'required' => 'Alamat tidak boleh kosong',    
                            ],
                            'no_telp_supplier' => [
                                'required' => 'No telp tidak boleh kosong',
                                'numeric' => 'Nomor telp harus angka',
                             
                            ]
                        ]
            );
        }
        
         ///////////////
         if (! $input)
         {                
            
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('supplier/editsupplier',[
                'validation' => $this->validator,
                'supplier' => $this->supplierModel->editData($id_supplier)
            ]);

        }
        else{
            //proses upload file ke server dulu
            //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
            $fileName = uniqid();

            //cek apakah file dokumen diupdate
            if(!empty($_FILES["ktp"]["name"])){
                //mendapatkan nama file asli untuk gambar
                $namafileasli = $_FILES['ktp']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_gambar_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $ktp = $fileName.'.'.$ekstensi_file_gambar_asli;

                //mengupload ke server ke lokasi public/images/upload
                $avatar = $this->request->getFile('ktp');
                $avatar->move(ROOTPATH.'public/images/upload', $ktp); //namafile u12adsasds + . + jpg
            }else{
                $ktp = $ktp_lama;
            }
            }

            //validasi tidak menemukan error sehingga bisa langsung di submit ke database
            //blok ini adalah blok jika sukses, yaitu panggil method insertData()
            $hasil = $this->supplierModel->updateData($ktp);
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['supplier'] = $this->supplierModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('supplier/daftarsupplier', $data); 
        }   

    public function daftarsupplier(){
        $data['supplier'] = $this->supplierModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('supplier/daftarsupplier', $data);
    }

    public function deletesupplier($id_supplier){
		$this->supplierModel->deleteData($id_supplier);

		return redirect()->to(base_url('supplier/daftarsupplier')); 
	}
}