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
Route::group(['prefix'=>'yonetim','namespace'=>'yonetim'],function(){
	Route::get('/', function () {
    return redirect('/yonetim/oturumac');
});
	Route::match(['get','post'],'/oturumac','Kullanicicontroller@oturumac')->name('yonetim.oturumac');
	Route::get('/oturumukapat','Kullanicicontroller@oturumukapat')->name('yonetim.oturumukapat');


Route::group(['middleware'=>'yonetim'],function(){

	Route::get('/anasehife','Anasehifecontroller@index')->name('yonetim.anasehife');


	Route::group(['prefix'=>'kullanici'],function(){
	Route::match(['get','post'],'/','Kullanicicontroller@index')->name('yonetim.kullanici');
	Route::get('/yeni','Kullanicicontroller@form')->name('yonetim.kullanici.yeni');
	Route::get('/duzenle{id}','Kullanicicontroller@form')->name('yonetim.kullanici.duzenle');
	Route::match(['get','post'],'/kaydet/{id?}','Kullanicicontroller@kaydet')->name('yonetim.kullanici.kaydet');
	Route::match(['get','post'],'/sil/{id}','Kullanicicontroller@sil')->name('yonetim.kullanici.sil');

});
	
	Route::group(['prefix'=>'kategori'],function(){
	Route::match(['get','post'],'/','Kategoricontroller@index')->name('yonetim.kategori');
	Route::get('/yeni','Kategoricontroller@form')->name('yonetim.kategori.yeni');
	Route::get('/duzenle{id}','Kategoricontroller@form')->name('yonetim.kategori.duzenle');
	Route::match(['get','post'],'/kaydet/{id?}','Kategoricontroller@kaydet')->name('yonetim.kategori.kaydet');
	Route::match(['get','post'],'/sil/{id}','Kategoricontroller@sil')->name('yonetim.kategori.sil');



});
});

});
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
