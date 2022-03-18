<?php
function getNamaBulanIndo($bulan){
        switch ($bulan) {
            case "01":
                $hasil =  "Januari";
                break;
            case "02":
                $hasil =  "Februari";
                break;
            case "03":
                $hasil =  "Maret";
                break;
            case "04":
                $hasil =  "April";
                break;
            case "05":
                $hasil =  "Mei";
                break;
            case "06":
        
 $hasil =  "Juni";
                break;   
            case "07":
                $hasil =  "Juli";
                break;  
            case "08":
                $hasil =  "Agustus";
                break;      
            case "09":
                $hasil =  "September";
                break;           
            case "10":
                $hasil =  "Oktober";
                break;       
            case "11":
                $hasil =  "November";
                break;  
            
            case "12":
                $hasil =  "Desember";
                break;  
            default:
                $hasil =  "Tidak Ada";
          }
          return $hasil;
     }

     function selisih($waktu){
        date_default_timezone_set("Asia/Bangkok");
        $waktusekarang =  date("Y-m-d H:i:s");
        $dtNow = new DateTime($waktu);
        $dtToCompare = new DateTime($waktusekarang);
        $diff = $dtNow->diff($dtToCompare);
        $selisihwaktu = '';
        $tahun = $diff->y; $bulan = $diff->m ; $hari = $diff->days; $jam = $diff->h;
        $menit = $diff->i; $detik = $diff->s ;

        if($tahun > 0){
            $selisihwaktu = $tahun.' tahun';
        }
        if($bulan > 0){
            $selisihwaktu = $selisihwaktu.' '.$bulan.' bulan';
        }
        if($hari > 0){
            $selisihwaktu = $selisihwaktu.' '.$hari.' hari';
        }
        if($jam > 0){
            $selisihwaktu = $selisihwaktu.' '.$jam.' jam';
        }
        if($menit > 0){
            $selisihwaktu = $selisihwaktu.' '.$menit.' menit';
        }
        if($detik >    0){
            $selisihwaktu = $selisihwaktu.' '.$detik.' detik';
        }
        return $selisihwaktu;
 }
?>