<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
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

        'yonetici_mi'=>1
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
}
