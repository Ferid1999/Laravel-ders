<?php

namespace App\Http\Controllers;
use App\Models\urun;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class Sepetcontroller extends Controller
{
    public function index(){
    	return view('sepet');
    }
     public function ekle(){
    	$urun=urun::find(request('id'));
    	Cart::add($urun->slug,$urun->urun_adi,1,$urun->fiyati);
    	return redirect()->route('sepet')->with('mesaj_tur','success')->with('mesaj','Urun sepete eklendi');
    }

}
?>