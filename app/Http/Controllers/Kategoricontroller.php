<?php  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;

class Kategoricontroller extends Controller
{
    public function index($slug_kategoriadi){
    	$kategori=kategori::where('slug',$slug_kategoriadi)->firstOrFail();
    	$alt_kategoriler=kategori::where('ust_id',$kategori->id)->get();
    	$order=request('order');
    	if ($order=='coksatanlar') {
    		
    		$urunler=$kategori->urunler()->distinct()->join('urun_detay','urun_detay.urun_id','urun.id')->orderBy('urun_detay.goster_cok_satan','desc')->paginate(8);
    	}else if($order=='yeni'){

    		$urunler=$kategori->urunler()->orderBy('yenileme_tarixi','desc')->paginate(3);

    	}else{
    		$urunler=$kategori->urunler()->paginate(3);

    	}
    	
    	return view('kategori',compact('kategori','alt_kategoriler','urunler'));

 
    }
}

?>