<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sifaris;
use App\Models\sepet;

use  Illuminate\Support\Facades\DB;



class Sifarislercontroller extends Controller
{
    public function index(){
    	
    	$sifarisler=sifaris::with('sepet')->
    	whereHas('sepet',function($query){
    		$query->where('kullanici_id',auth()->id());
    	})
    	->orderByDesc('yaratma_tarixi')->get();

    	return view('sifarisler',compact('sifarisler'));
    }
    public function detay($id){
    	$sifaris=sifaris::with('sepet.sepet_urunler.urun')->
    	whereHas('sepet',function(){
    		$query->where('kullanici_id',auth()->id());
    	})->
    	where('sifaris.id',$id)->firstOrFail();
    	return view('sifaris');
    }
}
?>