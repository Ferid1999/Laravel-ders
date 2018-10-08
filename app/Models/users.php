<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    use SoftDeletes;
    protected $table="users";
    const CREATED_AT="yaratma_tarixi";
    const UPDATED_AT="yenileme_tarixi";
    const DELETED_AT="silinme_tarixi";
    protected $fillable = [
        'adsoyad', 'email', 'sifre','aktivasyon_anahtari','aktif_mi'
    ];

    
    protected $hidden = [
        'sifre', 'aktivasyon_anahtari',
    ];
    public function getAuthPassword(){
        return $this->sifre;
    }
    public function detay(){
        return $this->hasOne('App\Models\kullanicidetay');
    }
}
