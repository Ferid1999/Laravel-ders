<?php  
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kategoricontroller extends Controller
{
    public function index($slug_kategoriadi){
    	return view('kategori');
 
    }
}

?>