<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sifarislercontroller extends Controller
{
    public function index(){
    	return view('sifarisler');
    }
    public function detay($id){
    	return view('sifaris');
    }
}
?>