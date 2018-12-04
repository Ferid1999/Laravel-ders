<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\sifaris;
use App\Models\urun;
use App\Models\users;
use App\Models\kategori;

use Hash;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Schema::defaultStringLength(191);
     
          /*  
            $bitiszamani=10;

          $istatistikler = Cache::remember('istatistikler', $bitiszamani, function () {
   

              return [
                    'bekleyen_sifaris' => sifaris::where('durum','Siparisiniz alindi')->count()
                ];

});
       View::share('istatistikler',$istatistikler);*/
       View::composer(['yonetim.*'],function($view){
         $bitiszamani=1;

             $istatistikler = Cache::remember('istatistikler', $bitiszamani, function () {
   

              return [
                    'bekleyen_sifaris' => sifaris::where('durum','Siparisiniz alindi')->count(),
                     'tamamlanan_sifaris' => sifaris::where('durum','Sifaris tamamlandi')->count(),
                     'toplam_urun'=>urun::count(),
                     'toplam_kullanici'=>users::count(),
                     'toplam_kategori'=>kategori::count()


                ];

});
       $view->with('istatistikler',$istatistikler);
       });
      
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
