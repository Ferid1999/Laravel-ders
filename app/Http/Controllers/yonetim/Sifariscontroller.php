<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\sifaris;




class Sifariscontroller extends Controller
{
    public function index()
    {
        if(request()->has('aranan')){
           request()->flash();
            $aranan=request('aranan');
            $list=sifaris::with('sepet.users')->where('adsoyad','like',"%$aranan%")
            ->orWhere('id',$aranan)
            ->orderByDesc('id')->paginate(8)->appends('aranan',$aranan);
            
        }
        else{
        $list=sifaris::orderByDesc('id')->paginate(8);
        }
        return view('yonetim.sifaris.index',compact('list'));
    }
    public function form($id=0){

        

        

          if ($id>0) {
              $entry=sifaris::with('sepet.sepet_urunler.urun')->find($id);
              
          }
         
          return view('yonetim.sifaris.form',compact('entry')); }

    public function kaydet($id=0) {
        
       
         $this->validate(request(),[
            'adsoyad'=>'required',
            'adres'=>'required',
            'telefon'=>'required',
            'durum'=>'required'
            
        ]);
       
       $data=request()->only('adsoyad','adres','telefon','ceptelefon','durum');
       

        if($id>0){
          $entry=sifaris::where('id',$id)->firstOrFail();

          $entry->update($data);



         }        
        
         
        
       

        return redirect()->route('yonetim.sifaris.duzenle',$entry->id)->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi'))->With('mesaj_tur','succes');
    }
   public  function sil($id){

        
        sifaris::destroy($id);
        return redirect()
        ->route('yonetim.sifaris')->with('mesaj','kayit silindi')->With('mesaj_tur','succes');
   }
}
