<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori extends Model
{

	use SoftDeletes;
    protected $table="kategori";
    //protected $fillable=['kategori_adi'];
    
    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
}
