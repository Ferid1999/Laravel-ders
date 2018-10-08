<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\kullanicidetay;


use Illuminate\Support\Str;
use App\Mail\kullanicikayitmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use lluminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
class Kullanicicontroller extends Controller
{
    
     public function giris_form(){
      return view('kullanici.oturumac');
    }


    public function giris(){

       $this->validate(request(),[
            'email'=>'required|email',
            'sifre'=>'required'
        ]);
   if(auth()->attempt(['email'=>request('email'),'password'=>request('sifre')],request()->has('benihatirla'))){

    request()->session()->regenerate();
    $aktif_sepet_id=sepet::aktif_sepet_id();
    if(!is_null($aktif_sepet_id)){
        $aktif_sepet=sepet::create(['kullanici_id'=>auth()->id()]);
    }
    session()->put('aktif_sepet_id',$aktif_sepet_id);
    return redirect()->intended('/');
   }else{
    $errors=['email'=>'Hatali giris'];
    return back()->withErrors($errors);
   }
}



public function kaydol_form(){
        return view('kullanici.kaydol');
    }
    public function kaydol(){
    	$this->validate(request(),[
            'adsoyad'=>'required|min:5|max:60',
            'email'=>'required|email|unique:users',
            'sifre'=>'required|confirmed|min:5|max:10'
    	]);

    	$kullanici=users::create([
	    		'adsoyad'=>request('adsoyad'),
	    		'email'=>request('email'),
	    		'sifre'=>Hash::make(request('sifre')),
	    		'aktivasyon_anahtari'=>Str::random(60),
	    		'aktif_mi'=>0
    	]);

    // $kullanici->detay()->save(new kullanicidetay());
    	Mail::to(request('email'))->send(new kullanicikayitmail($kullanici));
    	auth()->login($kullanici);
    	return redirect()->route('anasehife');
    }
    public function aktiflestir($anahtar){

    	$kullanici=users::where('aktivasyon_anahtari',$anahtar)->first();
    	if(!is_null($kullanici)){
    		$kullanici->aktivasyon_anahtari=null;
    		$kullanici->aktif_mi=1;
    		$kullanici->save();
    		return redirect()->to('/')->with('mesaj','Kullanici kaydi aktiflestirildi')->With('mesaj_tur','success');
    	}
        else{
            return redirect()->to('/')->with('mesaj','Kullanici kaydi aktiflestirilemedi')->With('mesaj_tur','warning');
        }
    }
    public function oturumukapat(){
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasehife');
    }
}
