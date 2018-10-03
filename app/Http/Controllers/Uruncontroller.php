<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\urun;

class Uruncontroller extends Controller
{
    public function index($slug_urunadi){
    	$urun=urun::whereSlug($slug_urunadi)->FirstOrFail();
    	return view('urun',compact('urun'));
    }
public function ara(){
	$aranan=request()->input('aranan');
	$urunler=urun::where('urun_adi','like',"%$aranan%")->orwhere('aciklama','like',"%$aranan%")->paginate(2);
	request()->flash();
	return view('arama',compact('urunler'));
}



    }
?>