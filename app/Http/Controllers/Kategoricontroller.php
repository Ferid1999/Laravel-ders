<?php  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;

class Kategoricontroller extends Controller
{
    public function index($slug_kategoriadi){
    	$kategori=kategori::where('slug',$slug_kategoriadi)->firstOrFail();
    	$alt_kategoriler=kategori::where('ust_id',$kategori->id)->get();
    	$urunler=$kategori->urunler;
    	return view('kategori',compact('kategori','alt_kategoriler','urunler'));

 
    }
}

?>