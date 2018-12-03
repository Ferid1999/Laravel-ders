<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\urun;
use App\Models\kategori;
use App\Models\urundetay;
use App\Models\sifaris;
use App\Models\sepet;




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
        $data=request()->only('urun_adi','slug','aciklama','fiyati');
       if (!request()->has('slug')){
       	 $data['slug']=str_slug(request('urun_adi'));
       	 request()->merge(['slug'=>$data['slug']]);
       }
         $this->validate(request(),[
            'urun_adi'=>'required',
            'fiyati'=>'required',
            'slug'        =>(request('orijinal_slug') != request('slug') ?  'unique:urun,slug' : '')
            
        ]);
       
       
       $data_detay=request()->only('goster_slider','goster_gunun_firsati','goster_one_cikan','goster_cok_satan','goster_indirimli');
       $kategoriler=request('kategoriler');

        if($id>0){
          $entry=urun::where('id',$id)->firstOrFail();

          $entry->update($data);


         $entry->detay()->update($data_detay);

          $entry->kategoriler()->sync($kategoriler);

         }        
        else{

            $entry=urun::create($data);
            $entry->detay()->create($data_detay);
            $entry->kategoriler()->attach($kategoriler);
        }
         
         if (request()->hasFile('urun_resmi')) {
         	
         	$this->validate(request(),[
         		'urun_resmi'=>'image|mimes:jpg,png,jpeg,gif|max:2048'
         	]);
         	$urun_resmi=request()->file('urun_resmi');
         	$urun_resmi=request()->urun_resmi;

         	$dosyaadi=$entry->id ."-" .time() ."." .$urun_resmi->extension();
         	//$dosyaadi=$urun_resmi->getClientOriginalName;
         	//$dosyaadi=$urun_resmi->hashName();
         	
         	if ($urun_resmi->isValid()) {
         		$urun_resmi->move('uploads/urunler',$dosyaadi);
         		urundetay::updateOrCreate(
         			['urun_id' => $entry->id],
         			['urun_resmi'=> $dosyaadi]

         		);
         	}


         }
       

        return redirect()->route('yonetim.urun.duzenle',$entry->id)->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi'))->With('mesaj_tur','succes');
    }
   public  function sil($id){

        
        $urun=urun::find($id);
         $urun->kategoriler()->detach();
         
         $urun->delete();
        return redirect()
        ->route('yonetim.urun')->with('mesaj','kayit silindi')->With('mesaj_tur','succes');
   }
}
