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
Route::get('/kategori','Kategoricontroller@index')->name('kategori');
Route::view('/urun','urun');
Route::view('/sepet','sepet');
