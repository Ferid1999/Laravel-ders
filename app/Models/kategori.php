<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use app\Models\urun;
class kategori extends Model
{

	use SoftDeletes;
    protected $table="kategori";
    //protected $fillable=['kategori_adi'];
    
    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
    public function urunler(){
    	return $this->belongsToMany('app\Models\urun','kategori_urun');
    }
}
