<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class sifaris extends Model
{
    use SoftDeletes;
    protected $table="sifaris";
    protected $fillable=['sepet_id','siparis_tutari','durum','adsoyad','adres','telefon','ceptelefonu','banka','taksit_sayisi'];

     const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
    public function sepet(){
    	return $this->belongsTo('App\Models\sepet');
    }
 
 }