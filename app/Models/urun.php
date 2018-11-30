<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class urun extends Model
{
    use SoftDeletes;
    protected $table="urun";
    protected $guarded=[];
    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";

   public function kategoriler(){
        return $this->belongsToMany('App\Models\kategori','kategori_urun');
    }


    public function detay(){
        return $this->hasOne('App\Models\urundetay')->withDefault();
    }
}
