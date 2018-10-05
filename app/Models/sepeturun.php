<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sepeturun extends Model
{
    use SoftDeletes;
    protected $table="sepet";
    
     protected $guarded=[];

    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
}
