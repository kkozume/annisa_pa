<?php
namespace App\Controllers;

use App\Models\KosanModel;

class Helloworld extends BaseController
{
    public function __construct()
        {
            //load kelas AkunModel
            $this->kategorimodel = new KategoriModel();
        }

	public function index()
	{
        
       		echo "Hello World!";
		
	}

    public function comment()
    {
        echo "Contoh method";
    }

    public function sapaan($nama, $kelas){
        echo "Nama saya adalah : ".$nama;
        echo "<br>";
        echo "Kelas saya adalah : ".$kelas;
        echo "<br>";
    }

    public function aksesdb(){
        $data['umkm_puri_utami'] = $this->kategorimodel->getAll();
        echo view('LihatKategori', $data);
        //print_r($data['umkm_puri_utami']);
    }

    /* tes parsing berita dari newsapi
    public function tesApiNewsAPI(){
        $json = file_get_contents('https://newsapi.org/v2/everything?q=fashion&language=id&country=id9&sortBy=popularity&apiKey=cadf56d3ba2d443d987551c41e030ac6'); 
        $hasil = json_decode($json);
        
        if($hasil->status=="ok"){
            echo "Jumlah Status     : ".$hasil->status."<br>";
            echo "Jumlah Results    : ".$hasil->totalResults."<br>";
            echo "Sumber Artikel-1  : ".$hasil->articles[0]->source->name."<br>";
            echo "Nama Artikel-2    : ".$hasil->articles[1]->title."<br>";
            echo "URL Gambar        : ".$hasil->articles[1]->urlToImage."<br>";

            // dapatkan jumlah datanya
            echo "<hr>";
            foreach ($hasil->articles as $row){
                echo $row->source->name."-".$row->author."-".$row->title."-".$row->url."-".$row->description."-".$row->urlToImage;
                echo "<br>"; 
            } 
        }
    } 
    */       


}