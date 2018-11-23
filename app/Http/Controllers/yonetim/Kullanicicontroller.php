<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\users;
use Hash;
class Kullanicicontroller extends Controller{

    public function oturumac(){
    	if(request()->isMethod('POST')){
    		$this->validate(request(),[
              'email'=>'required|email',
            'sifre'=>'required'
    		]);
    	
    	$credentials=[
        'email'=>request()->get('email'),

        'password'=> request()->get('sifre'),

        'yonetici_mi'=>1,
        'aktif_mi'=>1
    	];
    	if(Auth::guard('yonetim')->attempt($credentials,request()->has('benihatirla')))
    	{
    	  return redirect()->route('yonetim.anasehife')	;
    	}
    	else
    	{
    		return back()->withInput()->withErrors(['email'=>'Giris hatali!']);
    	}
    	}
    	return view('yonetim.oturumac');
    }
   public function oturumukapat(){
        Auth::guard('yonetim')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('yonetim.oturumac');
    }

    public function index()
    {
        $list=users::orderBy('yaratma_tarixi')->paginate(8);
        return view('yonetim.kullanici.index',compact('list'));
    }
    public function form($id=0){
        $entry=new users;
          if ($id>0) {
              $entry=users::find($id);
          }
          return view('yonetim.kullanici.form',compact('entry'));
    }
     public function kaydet($id=0){
        $this->validate(request(),[
            'adsoyad'=>'required',
            'email'=> 'required|email'
        ]);
         $data=request()->only('adsoyad','email');

         if (request()->filled('sifre')) {
             $data['sifre']=Hash::make(request('sifre'));
         }
         
          $data['aktif_mi']=request()->has('aktif_mi') ? 1 : 0;
           
          $data['yonetici_mi']=request()->has('yonetici_mi') ? 1 : 0;

        if($id>0){
          $entry=users::where('id','$id')->firstOrFail();

          $entry->update($data);

         }        
        else{
            $entry=users::create($data);
        }
        return retirect()
        ->route('yonetim.kullanici.duzenle',$entry->id)
        ->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi'))
        ->with('mesaj_tur','succes');
    }

}
