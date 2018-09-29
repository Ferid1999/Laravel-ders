<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kullanicicontroller extends Controller
{
   

    public function kaydol_form(){
    	return view('kullanici.kaydol');
    }
     public function giris_form(){
      return view('kullanici.oturumac');
    }
}
?>