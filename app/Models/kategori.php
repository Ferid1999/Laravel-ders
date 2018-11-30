<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class kategori extends Model
{

	use SoftDeletes;
    protected $table="kategori";
    protected $guarded=[];
    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
    
    public function urunler(){
    	return $this->belongsToMany('App\Models\urun','kategori_urun');
    }

    public function ust_kategori(){

    	return $this->belongsTo('App\Models\kategori','ust_id')->withDefault([
    		'kategori_adi'=>'Ana kategori'

         ]);
    }
}
