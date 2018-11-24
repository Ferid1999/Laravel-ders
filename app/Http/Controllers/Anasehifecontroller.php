<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use App\Models\urundetay;
use App\Models\urun;


class Anasehifecontroller extends Controller
{
    public function index(){

    	$kategoriler=kategori::WhereNULL('ust_id')->get();
    	$urunler_slider=urundetay::with('urun')->where('goster_slider',1)->take(5)->get();
    	$urun_gunun_firsati=urun::select('urun.*')->join('urun_detay','urun_detay.urun_id','urun.id')->where('urun_detay.goster_gunun_firsati',1)->orderBy('yenileme_tarixi','desc')->first();
    	$urunler_one_cikan=urundetay::with('urun')->where('goster_one_cikan',1)->take(4)->get();
    	$urunler_cok_satan=urundetay::with('urun')->where('goster_cok_satan',1)->take(4)->get();
    	$urunler_indirimli=urundetay::with('urun')->where('goster_indirimli',1)->take(4)->get();
    	return view('anasehife',compact('kategoriler','urunler_slider','urun_gunun_firsati','urunler_one_cikan','urunler_cok_satan','urunler_indirimli'));
 
    }
}
