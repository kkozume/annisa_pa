<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'akun_login';

    public function cekUsernamePwd(){
        //bind variabel untuk mencegah sql injection
        $nama = $_POST['inputUsername'];
        $sandi = $_POST['inputPassword'];
        $dbResult = $this->db->query("SELECT COUNT(*) as jml FROM akun_login WHERE username = ? AND pwd = ?", array($nama, md5($sandi)));
        return $dbResult->getResult();
    }
}

