<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\users;
use App\Models\sifaris;
use App\Models\kullanicidetay;

class Odemecontroller extends Controller
{
    public function index(){
           
          if(!auth()->check())
           {
              return redirect()->route('kullanici.oturumac')
              ->with('mesaj_tur','info')
              ->with('mesaj','Odeme islemi ucun oturum acmaniz ve ya kullanici kaydi yapmaniz gereklidi');
           }
           else 
           	if(count(Cart::content())==0)
           	{
           		return redirect()->route('anasehife')
              ->with('mesaj_tur','info')
              ->with('mesaj','Odeme isleme ucun sebetde bir urun olmalidir');
           	}
           
           //$kullanici_detay=auth()->user()->detay();


           $kullanici_detay=kullanicidetay::all()->find(1);
    	return view('odeme',compact('kullanici_detay'));
    }
    public function odemeyap(){
    	$siparis=request()->all();
    	$siparis['sepet_id']=session('aktif_sepet_id');
    	session('aktif_sepet_id');
    	$siparis['banka']="Garanti";
    	$siparis['taksit_sayisi']=1;
    	$siparis['durum']="Siparisiniz alindi";
    	$siparis['siparis_tutari']=Cart::subtotal();


        sifaris::create($siparis);
        Cart::destroy();
       session()->forget('aktif_sepet_id');
        return redirect()->route('sifarisler')
         ->with('mesaj_tur','info')
              ->with('mesaj','Odeme basarili oldu.');
    }
}
?>