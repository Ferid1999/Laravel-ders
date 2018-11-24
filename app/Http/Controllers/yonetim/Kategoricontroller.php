<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kategori;

class Kategoricontroller extends Controller
{
     public function index()
    {
        if(request()->has('aranan')){
            request()->flash();
            $aranan=request('aranan');
            $list=kategori::where('kategori_adi','like',"%$aranan%")
            
            ->orderByDesc('yaratma_tarixi')->paginate(8)->appends('aranan',$aranan);
        }
        else{
        $list=kategori::orderByDesc('yaratma_tarixi')->paginate(8);
        }
        return view('yonetim.kategori.index',compact('list'));
    }
    public function form($id=0){
        $entry=new kategori;
          if ($id>0) {
              $entry=kategori::find($id);
          }
          $kategoriler=kategori::all();
          return view('yonetim.kategori.form',compact('entry','kategoriler')); 
      }

    public function kaydet($id=0) {
       
         $data=request()->only('kategori_adi','slug','ust_id');
       if (!request()->has('slug')){
       	 $data['slug']=str_slug(request('kategori_adi'));
       	 request()->merge(['slug'=>$data['slug']]);
       }
         $this->validate(request(),[
            'kategori_adi'=>'required',
            'slug'        =>(request('orijinal_slug') != request('slug') ?  'unique:kategori,slug' : '')
            
        ]);
       
       
        if($id>0){
          $entry=kategori::where('id',$id)->firstOrFail();

          $entry->update($data);


         

         }        
        else{

            $entry=kategori::create($data);
        }

       

        return redirect()->route('yonetim.kategori.duzenle',$entry->id)->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi'))->With('mesaj_tur','succes');
     }
    
    public  function sil($id){
            
         $kategori=kategori::find($id);
         $kategori->urunler()->detach();
         $kategori->delete();
        return redirect()
        ->route('yonetim.kategori')->with('mesaj','kayit silindi')->With('mesaj_tur','succes');
    }
}
