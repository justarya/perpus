<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "daftar_buku";
    public $timestamps = false;

    public function Peminjaman(){
        return $this->hasMany('App\Peminjaman','id','id_buku');
    }
    public function StokBuku(){
        return $this->hasMany('App\StokBuku','id','id_buku');
    }
}
