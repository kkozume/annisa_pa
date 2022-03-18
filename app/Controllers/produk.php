<?php
namespace App\Controllers;

use App\Models\produkModel;

class produk extends BaseController
{
	public function __construct()
    {
        //load kelas form input model
        $this->produkModel = new produkModel();
    }
    public function index(){
        //cek apakah sudah diisi semua, jika kosong semua maka tidak perlu panggil validasi
        if( isset($_POST['kode_produk']) and 
            isset($_POST['nama_produk']) and
            isset($_POST['stok']) and 
            isset($_POST['harga_jual_produk']) and
            !isset($_POST['gambar']) and
            isset($_POST['kode_kategori']) and
            isset($_POST['id_pelanggan'])
        ){
            //jika sudah ada yang diisi berarti sudah diakses dan user memasukkan input, maka perlu memanggil validasi
            $validation =  \Config\Services::validation();
            //di cek dulu apakah data isian memenuhi rules validasi yang dibuat
            if (! $this->validate(
                            [
                                'kode_produk'   => 'required',
                                'nama_produk'   => 'required',
                                'stok'          => 'required',
                                'harga_jual_produk'  => 'required',
                                'gambar' => [
                                    'uploaded[gambar]',
                                    'mime_in[gambar,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                                    'max_size[gambar,1024]' //maksimal 1 M
                                ],
                                'kode_kategori' => 'required',
                                'id_pelanggan'   => 'required'
                            ],
                                    [   // Errors
                                        'kode_produk' => [
                                            'required' => 'Kode produk tidak boleh kosong'
                                        ],
                                        'nama_produk' => [
                                            'required' => 'Nama produk tidak boleh kosong'
                                        ],
                                        'stok' => [
                                            'required' => 'stok tidak boleh kosong'
                                        ],
                                        'harga_jual_produk' => [
                                            'required' => 'Harga produk tidak boleh kosong'
                                        ],
                                        'kode_kategori' => [
                                            'required' => 'Kode kategori produk tidak boleh kosong'
                                        ],
                                        'id_pelanggan' => [
                                            'required' => 'ID karyawan kelamin tidak boleh kosong'
                                        ]
                                    ]
                   )
            ){
                //kembalikan list error ke views
                echo view('HeaderBootstrap');
                echo view('SidebarBootstrap');
                echo view('Inputproduk',[
                    'validation' => $this->validator,
                ]);
            }else{
                //proses upload file ke server dulu
                //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
                $fileName = uniqid();

                //mendapatkan nama file asli untuk gambar
                $namafileasli = $_FILES['gambar']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_gbr_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $gbr = $fileName.'.'.$ekstensi_file_gbr_asli;

                //mengupload ke server ke lokasi public/images/upload
                $avatar = $this->request->getFile('gambar');
                $avatar->move(ROOTPATH.'public/images/upload', $gbr); //namafile u12adsasds + . + jpg

                //validasi tidak menemukan error sehingga bisa langsung di submit ke database
                //blok ini adalah blok jika sukses, yaitu panggil method insertData()
                $hasil = $this->produkModel->insertData($gbr);
                if($hasil->connID->affected_rows>0){
                    ?>
                    <script type="text/javascript">
                        alert("Sukses ditambahkan");
                    </script>
                    <?php	
                }
                $data['produk'] = $this->produkModel->getAll();
                    echo view('HeaderBootstrap');
                    echo view('SidebarBootstrap');
                    echo view('produk/daftarproduk', $data);
                }    
            }else{
            //kondisi awal ketika di akses, jadi tidak perlu memanggil validasi
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('produk/Inputproduk'); 
        }
    }
    public function editproduk($id){
        $data['produk'] = $this->produkModel->editData($id);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('produk/editproduk', $data);
    }
    public function editprodukproses(){
        $gambar_lama = !isset($_POST['old_gambar']); //menyimpan nilai lama gambar
       
        $validation =  \Config\Services::validation();

        //jika input gambar diisi oleh user
        if( !empty($_FILES["gambar"]["name"])){
            $input = $this->validate(
                [
                    'kode_produk'   => 'required',
                    'nama_produk'   => 'required',
                    'stok'          => 'required',
                    'harga_jual_produk'  => 'required',
                    'gambar' => [
                        'uploaded[gambar]',
                        'mime_in[gambar,image/jpg,image/jpeg,image/png]', //dibatasi hanya jpg, jpeg, png
                        'max_size[gambar,1024]' //maksimal 1 M
                    ],
                    'kode_kategori' => 'required'
                ],
                        [   // Errors
                            'kode_produk'  => [
                                'required' => 'Kode produk tidak boleh kosong'
                            ],
                            'nama_produk'  => [
                                'required' => 'Nama produk tidak boleh kosong'
                            ],
                            'stok' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'
                            ],
                            'harga_jual_produk' => [
                                'required' => 'Harga produk tidak boleh kosong'
                            ],
                            'kode_kategori'=> [
                                'required' => 'Kode kategori produk tidak boleh kosong'
                            ]
                        ]
            );
        }else{
            $input = $this->validate(
                [
                    'kode_produk'   => 'required',
                    'nama_produk'   => 'required',
                    'stok'          => 'required',
                    'harga_jual_produk'  => 'required',
                    'kode_kategori' => 'required'
                ],
                        [   // Errors
                            'kode_produk'  => [
                                'required' => 'Kode produk tidak boleh kosong'
                            ],
                            'nama_produk'  => [
                                'required' => 'Nama produk tidak boleh kosong'
                            ],
                            'stok' => [
                                'required' => 'Jenis kelamin tidak boleh kosong'
                            ],
                            'harga_jual_produk' => [
                                'required' => 'Harga produk tidak boleh kosong'
                            ],
                            'kode_kategori'=> [
                                'required' => 'Kode kategori produk tidak boleh kosong'
                            ]
                        ]
            );
        }


        ///////////////
        if (! $input)
        {
            //kembalikan list error ke views
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('produk/editproduk',[
                'validation' => $this->validator,
                'produk' => $this->produkModel->editData($id)
            ]);
        }else{
            //proses upload file ke server dulu
            //memberi nama file dengan nama random, agar tidak terjadi duplikasi data atau data terreplace karena sudah ada
            $fileName = uniqid();

            //cek apakah file dokumen diupdate
            if(!empty($_FILES["gambar"]["name"])){
                //mendapatkan nama file asli untuk gambar
                $namafileasli = $_FILES['gambar']['name'];
                $pos = explode(".",$namafileasli ); //mencacah nama file menjadi array dengan pemisah .
                $ekstensi_file_gbr_asli = $pos[count($pos)-1]; //mendapatkan hasil array yang paling akhir
                $gbr = $fileName.'.'.$ekstensi_file_gbr_asli;

                //mengupload ke server ke lokasi public/images/upload
                $avatar = $this->request->getFile('gambar');
                $avatar->move(ROOTPATH.'public/images/upload', $gbr); //namafile u12adsasds + . + jpg
            }else{
                $gbr = $gambar_lama;
            }
        }
            //validasi tidak menemukan error sehingga bisa langsung di submit ke database
            //blok ini adalah blok jika sukses, yaitu panggil method insertData()
            $hasil = $this->produkModel->updateData($gbr);
            if($hasil->connID->affected_rows>0){
                ?>
                <script type="text/javascript">
                    alert("Sukses diupdate");
                </script>
                <?php	
            }
            $data['produk'] = $this->produkModel->getAll();
            echo view('HeaderBootstrap');
            echo view('SidebarBootstrap');
            echo view('produk/daftarproduk', $data); 
        }   
        public function daftarproduk(){
        $data['produk'] = $this->produkModel->getAll();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('produk/daftarproduk', $data);
    }

    public function deleteproduk($id){
		$this->produkModel->deleteData($id);

		return redirect()->to(base_url('produk/daftarproduk')); 
	}
}