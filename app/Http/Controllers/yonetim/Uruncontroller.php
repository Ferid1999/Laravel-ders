<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\urun;

class Uruncontroller extends Controller
{
    public function index()
    {
        if(request()->has('aranan')){
            request()->flash();
            $aranan=request('aranan');
            $list=urun::where('urun_adi','like',"%$aranan%")
            ->orWhere('aciklama','like',"%$aranan%")
            ->orderByDesc('yaratma_tarixi')->paginate(8)->appends('aranan',$aranan);
        }
        else{
        $list=urun::orderByDesc('yaratma_tarixi')->paginate(8);
        }
        return view('yonetim.urun.index',compact('list'));
    }
    public function form($id=0){
        $entry=new urun;
          if ($id>0) {
              $entry=urun::find($id);
          }
          return view('yonetim.urun.form',compact('entry')); }

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
       
       dd(request('goster_indirimli'));
       
        if($id>0){
          $entry=urun::where('id',$id)->firstOrFail();

          $entry->update($data);


         

         }        
        else{

            $entry=urun::create($data);
        }

       

        return redirect()->route('yonetim.urun.duzenle',$entry->id)->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi'))->With('mesaj_tur','succes');
    }
   public  function sil($id){

        users::destroy($id);

        return redirect()
        ->route('yonetim.kullanici')->with('mesaj','kayit silindi')->With('mesaj_tur','succes');
   }
}
