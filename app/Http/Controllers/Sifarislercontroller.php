<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sifarislercontroller extends Controller
{
    public function index(){
    	$sifarisler=sifaris::with('sepet')->orderByDesc('yaratma_tarixi')->get();

    	return view('sifarisler',compact('sifarisler'));
    }
    public function detay($id){
    	return view('sifaris');
    }
}
?>