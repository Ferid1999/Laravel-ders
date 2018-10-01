<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;

class Anasehifecontroller extends Controller
{
    public function index(){

    	$kategoriler=kategori::WhereRaw('ust_id is null')->get();
    	return view('anasehife',compact('kategoriler'));
 
    }
}
