<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Anasehifecontroller@index')->name('anasehife');
Route::get('/kategori/{slug_kategoriadi}', 'Kategoricontroller@index')->name('kategori');
Route::get('/urun/{slug_urunadi}', 'Uruncontroller@index')->name('urun');
Route::post('/ara','Uruncontroller@ara')->name('urun_ara');
Route::get('/ara','Uruncontroller@ara')->name('urun_ara');

Route::group(['prefix'=>'sepet'],function(){
Route::get('/','Sepetcontroller@index')->name('sepet');
Route::post('/ekle','Sepetcontroller@ekle')->name('sepet.ekle');
Route::delete('/kaldir/{rowid}','Sepetcontroller@kaldir')->name('sepet.kaldir');
Route::delete('/bosalt','Sepetcontroller@bosalt')->name('sepet.bosalt');
Route::patch('/guncelle/{rowid}','Sepetcontroller@guncelle')->name('sepet.guncelle');

});

Route::get('/odeme','Odemecontroller@index')->name('odeme');
Route::post('/odeme','Odemecontroller@odemeyap')->name('odemeyap');


Route::group(['middleware'=>'auth'],function(){

Route::get('/sifarisler','Sifarislercontroller@index')->name('sifarisler');
Route::get('/sifarisler/{id}','Sifarislercontroller@detay')->name('sifaris');
});

Route::group(['prefix'=>'kullanici'],function(){
Route::get('/oturumac','Kullanicicontroller@giris_form')->name('kullanici.oturumac');
Route::post('/oturumac','Kullanicicontroller@giris')->name('kullanici.oturumac');
Route::get('/kaydol','Kullanicicontroller@kaydol_form')->name('kullanici.kaydol');
Route::post('/kaydol','Kullanicicontroller@kaydol')->name('kullanici.kaydol');
Route::get('/aktiflestir/{anahtar}','Kullanicicontroller@aktiflestir')->name('aktiflesdir');
Route::post('/oturumukapat','Kullanicicontroller@oturumukapat')->name('kullanici.oturumukapat');
});

Route::get('/test/mail',function(){
	$kullanici=\App\Models\users::find(1);
return new App\Mail\kullanicikayitmail($kullanici);
});

?>
