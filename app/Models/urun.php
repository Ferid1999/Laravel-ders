<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class urun extends Model
{
    use SoftDeletes;

    	use SoftDeletes;
    protected $table="urun";
    //protected $fillable=['kategori_adi'];
    protected $guarded=[];
    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
}
