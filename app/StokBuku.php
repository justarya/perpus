<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokBuku extends Model
{
    protected $table = "stok_buku";
    public $timestamps = false;

    public function Buku(){
        return $this->belongsTo('App\Buku','id_buku','id');
    }
}
