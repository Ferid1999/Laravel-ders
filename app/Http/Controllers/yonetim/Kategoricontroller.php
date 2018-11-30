<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kategori;

class Kategoricontroller extends Controller
{
     public function index()
    {
        if(request()->has('aranan') || request()->has('ust_id')){
            request()->flash();
            $aranan=request('aranan');
            $ust_id=request('ust_id');
            $list=kategori::with('ust_kategori')
            ->where('kategori_adi','like',"%$aranan%")
            ->where('ust_id','like',$ust_id)
            ->orderByDesc('id')->paginate(2)->appends(['aranan'=>$aranan,'ust_id'=>$ust_id]);
        }
        else{
        	request()->flush();
        $list=kategori::with('ust_kategori')->orderByDesc('id')->paginate(8);
        }
        $anakategoriler=kategori::WhereNULL('ust_id')->get();
        return view('yonetim.kategori.index',compact('list','anakategoriler'));
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
