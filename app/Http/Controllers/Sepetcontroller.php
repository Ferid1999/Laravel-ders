<?php

namespace App\Http\Controllers;
use App\Models\urun;
use App\Models\sepet;
use App\Models\sepeturun;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Validator;

class Sepetcontroller extends Controller
{
    

    public function index()
    {
    	return view('sepet');
    }

     public function ekle(){
    	$urun=urun::find(request('id'));
    	$uruncartItem=Cart::add($urun->id,$urun->urun_adi,1,$urun->fiyati,['slug'=>$urun->slug]);
        
        if(auth()->check()){
        	$aktif_sepet_id=session('aktif_sepet_id');
        	if (!isset($aktif_sepet_id)) {
        		
        	
        	$aktif_sepet=sepet::create([
        		'kullanici_id'=>2 //auth()->id()
        	]);
        	$aktif_sepet_id=$aktif_sepet->id;
        	session()->put('$aktif_sepet_id',$aktif_sepet_id);
        }
        sepeturun::updateOrCreate(
           ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$urun->id],
           ['adet'=>$uruncartItem->qty,'fiyati'=>$urun->fiyati,'durum'=>'Beklemede']

        );
    }


    	return redirect()->route('sepet')->with('mesaj_tur','success')->with('mesaj','Urun sepete eklendi');
    }

    public function kaldir($rowid){
    $aktif_sepet_id=1;
    if(auth()->check()){
        	$aktif_sepet_id=session('aktif_sepet_id');
        	$cartItem=Cart::get($rowid);
        	sepeturun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
        }
     Cart::remove($rowid);
     return redirect()->route('sepet')
     ->with('mesaj_tur','success')
     ->with('mesaj','Urun sepetden kaldirildi');
    }

    public function bosalt(){
    	$aktif_sepet_id=1;
   if(auth()->check()){
        	$aktif_sepet_id=session('aktif_sepet_id');
        	sepeturun::where('sepet_id',$aktif_sepet_id)->delete();
        }
     Cart::destroy();
     return redirect()->route('sepet')
     ->with('mesaj_tur','success')
     ->with('mesaj','Sepetiniz bosaltildi');
    }

  public function guncelle($rowid)
  {
    $validator=validator::make(request()->all(),[
    	'adet'=>'required|numeric|between:0,5'
    ]);

    if($validator->fails()){
    	session()->flash('mesaj_tur','succes');
   session()->flash('mesaj','Adet deyeri 1 ile 5 arasi olmalidir');
   return response()->json(['succes'=>false]);
    }
    $aktif_sepet_id=1;
    if(auth()->check()){
        	$aktif_sepet_id=session('aktif_sepet_id');
        	$cartItem=Cart::get($rowid);
        	if (request('adet')==0)
               sepeturun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
        		else
        	sepeturun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->update(['adet'=>request('adet')]);
        }

   Cart::update($rowid,request('adet'));
   session()->flash('mesaj_tur','succes');
   session()->flash('mesaj','Adet bilgisi guncellendi');
   return response()->json(['succes'=>true]);
}

}
?>