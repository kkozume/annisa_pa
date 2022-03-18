<?php

namespace App\Controllers;

// use App\Models\PemodelanModel;
// use App\Models\produkModel;
use App\Models\PembayaranbebanModel;
use App\Models\ModelAkun;
use Dompdf\Options;

class Laporan extends BaseController
{
	public function __construct()
    {
		session_start();
        // $this->PemodelanModel = new PemodelanModel();
        // $this->produkModel = new produkModel();
        $this->PembayaranbebanModel = new PembayaranbebanModel();
        $this->ModelAkun = new ModelAkun();
        helper('rupiah');
        helper('waktu');
    }

    //lihat beban
    public function ListBeban(){
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }

        $data['pembayaranbeban'] = $this->PembayaranbebanModel->getListBeban();
        $data['tahun'] = $this->ModelAkun->getPeriodeTahun();
        //maka kembalikan ke awal
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/ListBeban', $data);
    }

      //proses lihat beban
      public function lihatbeban(){
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }
        $data['pembayaranbeban'] = $this->PembayaranbebanModel->getListBeban($_POST['tahun'], $_POST['bulan']);
        // $data['pembayaranbeban'] = $this->PembayaranbebanModel->editData($_POST['waktu'], $_POST['nama'], $_POST['biaya']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/lihatbeban', $data);
    }

    public function cetakbeban(){
        
        $data['pembayaranbeban'] = $this->PembayaranbebanModel->getListBeban();
        
        // $data['bulan'] = $bulan;
        // $data['tahun'] = $tahun;

        //panggil dom untuk cetak pdf
        //$dompdf = new \Dompdf\Dompdf($options);

        $dompdf = new \Dompdf\Dompdf(); 
        $html = view('Laporan/cetakbeban', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        
        //echo view('Laporan/CetakJurnaldompdf', $data);
    }

    //jurnal umum
    public function jurnalumum(){
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }
        // $data['produk'] = $this->produkModel->getAll();
        $data['tahun'] = $this->ModelAkun->getPeriodeTahun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/jurnalumum', $data);
    }

    //json encode untuk list bulan
    public function listbulan($tahun){
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }
        //encode
        echo json_encode($this->ModelAkun->getPeriodeBulan($tahun));
    }

    //proses lihat jurnal umum
    public function lihatjurnalumum(){
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }
        $data['jurnal'] = $this->ModelAkun->getJurnalUmum($_POST['tahun'], $_POST['bulan']);
        // $data['produk'] = $this->produkModel->editData($_POST['kode_produk']);
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/lihatjurnalumum', $data);
    }

    public function cetakjurnalumum($tahun, $bulan){

        // $data['jurnal'] = $this->ModelAkun->getJurnalUmum($tahun,$bulan);
        $data['jurnal'] = $this->ModelAkun->getJurnalUmum($tahun, $bulan);
        
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        //panggil dom untuk cetak pdf
        //$dompdf = new \Dompdf\Dompdf($options);

        $dompdf = new \Dompdf\Dompdf(); 
        $html = view('Laporan/cetakjurnalumum', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        
        //echo view('Laporan/CetakJurnaldompdf', $data);
    }

    //buku besar
    public function bukubesar(){
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }
        // $data['produk'] = $this->produkModel->getAll();
        $data['tahun'] = $this->ModelAkun->getPeriodeTahun();
        $data['nama_akun'] = $this->ModelAkun->getNamaAkun();
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/bukubesar', $data);
    }

    //proses lihat buku besar
    public function lihatbukubesar(){
        // if(!isset($_SESSION['nama'])){
        //     return redirect()->to(base_url('home')); 
        // }
        $data['jurnal'] = $this->ModelAkun->getJurnalUmum($_POST['tahun'], $_POST['bulan']);
        // $data['produk'] = $this->produkModel->editData($_POST['kode_produk']);
        
        $akun = $_POST['akun'];
        //explode untuk mendapatkan kode akun dan nama akun kode_akun|nama_akun
        $akuncacah = explode("|",$akun);
        //print_r($akuncacah);

        
        $data['bulan'] = $_POST['bulan'];
        $data['tahun'] = $_POST['tahun'];
        $data['kode_akun'] = $akuncacah[0];
        $data['nama_akun'] = $akuncacah[1];
        $data['bukubesar'] = $this->ModelAkun->getBukuBesar($data['tahun'], $data['bulan'], $data['kode_akun']);
        $data['SaldoAwal'] = $this->ModelAkun->getSaldoAwal($data['bulan'],$data['tahun'],$data['kode_akun']);
        $data['PosisiSaldoNormal'] = $this->ModelAkun->getPosisiSaldoNormal($data['kode_akun']);
        echo view('HeaderBootstrap');
        echo view('SidebarBootstrap');
        echo view('Laporan/lihatbukubesar', $data);
        
    }

    // //laba rugi
    // public function labarugi(){
    //     // if(!isset($_SESSION['nama'])){
    //     //     return redirect()->to(base_url('home')); 
    //     // }
    //     // $data['produk'] = $this->produkModel->getAll();
    //     $data['tahun'] = $this->ModelAkun->getPeriodeTahun();

    //     //eksekusi pencatatan akrual jurnal
	// 	// $this->ModelAkun->getPenjualan();

    //     echo view('HeaderBootstrap');
    //     echo view('SidebarBootstrap');
    //     echo view('Laporan/labarugi', $data);
    // }

    // //proses lihat laba rugi
    // public function lihatlabarugi(){
    //     // if(!isset($_SESSION['nama'])){
    //     //     return redirect()->to(base_url('home')); 
    //     // }
    //     // $data['produk'] = $this->produkModel->editData($_POST['kode_produk']);
    //     // $akun = $_POST['akun'];
    //     //explode untuk mendapatkan kode akun dan nama akun kode_akun|nama_akun
    //     // $akuncacah = explode("|",$akun);
    //     //print_r($akuncacah);

    //     $data['bulan'] = $_POST['bulan'];
    //     $data['tahun'] = $_POST['tahun'];
    //     $data['penjualan'] = $this->ModelAkun->getPenjualan($data['tahun'],$data['bulan']);
    //     $data['harga pokok penjualan'] = $this->ModelAkun->getHPP($data['tahun'],$data['bulan']);
    //     $data['pembayaranbeban'] = $this->ModelAkun->getListBeban($data['tahun'],$data['bulan']);

    //     echo view('HeaderBootstrap');
    //     echo view('SidebarBootstrap');
    //     echo view('Laporan/lihatlabarugi', $data);
        
    // }
}    