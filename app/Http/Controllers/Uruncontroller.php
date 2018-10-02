<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\urun;

class Uruncontroller extends Controller
{
    public function index($slug_urunadi){
    	$urun=urun::whereSlug('slug',$slug_urunadi)->FirstOrFail();
    	return view('urun');
    }
    }
?>