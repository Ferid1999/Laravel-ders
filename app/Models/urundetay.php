<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class urundetay extends Model
{
    protected $table="urun_detay";
    public $timestamps=false;
     protected $guarded=[];
    public function urun(){
        return $this->belongsTo('App\Models\urun');
    }
}
