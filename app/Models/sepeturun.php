<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class sepeturun extends Model
{
    use SoftDeletes;
    protected $table="sepet_urun";
    
     protected $guarded=[];

    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
     public function urun(){
        return $this->belongsTo('App\Models\urun');
    }
}
