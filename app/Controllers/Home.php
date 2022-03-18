<?php

namespace App\Controllers;
use App\Models\AkunModel;

class Home extends BaseController
{
	public function __construct()
    {
		session_start();
        //load kelas AkunModel
        $this->akunmodel = new AkunModel();
    }

	public function index()
	{
		return view('welcome_message');
		//echo view('login');
	}

	public function login()
	{
		
		echo view('login');
	}

	public function ceklogin()
	{
		
		$hasil = $this->akunmodel->cekUsernamePwd();

		//iterasi hasil query
		foreach ($hasil as $row)
		{
			$jml = $row->jml;
		}
		
		// Tambahan untuk akses berita menggunakan API
		//	$json = file_get_contents('https://newsapi.org/v2/everything?q=fashion&language=id&country=id9&sortBy=popularity&apiKey=cadf56d3ba2d443d987551c41e030ac6'); 
		//	$data['berita'] = json_decode($json);	

		//nilai jml adalah 1 menunjukkan bahwa pasangan username dan password cocok
		if($jml>0){	
			echo view('HeaderBootstrap');
			echo view('SidebarBootstrap');
			echo view('BodyBootstrap');
		}else{
			//jika tidak sama maka dikembalikan ke ceklogin
			$data['pesan'] = 'Pasangan username dan password tidak tepat';
			
return view('login', $data);
		}
		
	}
}
