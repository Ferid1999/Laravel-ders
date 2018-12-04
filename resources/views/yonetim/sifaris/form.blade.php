@extends('yonetim.layouts.master')
@section('title','Sifaris Yonetimi')
@section('content')

 <h1 class="page-header">Sifaris Yonetimi</h1>
                <form method="post" action="{{ route('yonetim.sifaris.kaydet',@$entry->id)}}">
                   
                    {{ csrf_field()}}
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">{{
                            @$entry->id>0 ? "Guncelle" : "Kaydet"
                        }}</button>
                    </div>
                      <h2 class="sub-header">Sifaris {{
                            @$entry->id>0 ? "Duzenle" : "Ekle"
                        }}</h2>
                       @include('layouts.partials.error')

                    @if(session()->has('mesaj'))
                    <div class="container">
                        <div class="alert alert-{{ session('mesaj_tur')}}"> {{session('mesaj')}}</div>
                    </div>
                    @endif
                    
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adsoyad">Ad Soyad</label>
                                <input type="text" class="form-control" id="adsoyad" placeholder="Ad Soyad"  name="adsoyad" value="{{ old('adsoyad',$entry->adsoyad)}}">
                            </div>
                        </div>
                    
                    
                       
                    
                     
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input class="form-control" id="telefon" placeholder="Telefon"  name="telefon" value="{{ old('telefon',$entry->telefon)}}">
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ceptelefon"> Cep Telefonu</label>
                                <input class="form-control" id="ceptelefon" placeholder="Cep Telefonu"  name="ceptelefon" value="{{ old('ceptelefon',$entry->ceptelefon)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                     <div class="col-md-12">
                            <div class="form-group">
                                <label for="adres">Adres</label>
                                
                               <input type="text" class="form-control" id="adres" placeholder="Adres"  name="adres" value="{{ old('adres',$entry->adres)}}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="durum">Durum</label>
                               <select name="durum" id="durum" class="form-control"   >
                                <option {{ old('durum',$entry->durum)=='Siparisiniz alindi' ? 'selected' : ''}}>Siparisiniz alindi</option>
                                <option {{ old('durum',$entry->durum)=='Odeme onaylandi' ? 'selected' : ''}}>Odeme onaylandi</option>
                                <option {{ old('durum',$entry->durum)=='Kargoya verildi' ? 'selected' : ''}}>Kargoya verildi</option>
                                <option {{ old('durum',$entry->durum)=='Sifaris tamamlandi' ? 'selected' : ''}}>Sifaris tamamlandi</option>
                                   
                               </select>                 
                             </div>
                        </div>
                    </div>
                    
                      
                </form>
                <h3>Sipariş (SP-{{$entry->id}})</3>
            
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Urun</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($entry->sepet->sepet_urunler as $sepet_urun)
                <tr>
                    <td style="width: 120px"><a href="{{route('urun',$sepet_urun->urun->slug)}}"><img src="{{ $sepet_urun->urun->detay->urun_resmi!=null ? asset('uploads/urunler/'.$sepet_urun->urun->detay->urun_resmi): 'http://lorempixel.com/400/400/food/1'}}" class="img-responsive" style="width: 200px;"></a></td>
                    <td><a href="{{route('urun',$sepet_urun->urun->slug)}}">{{$sepet_urun->urun->urun_adi}}</a></td>
                    <td>{{$sepet_urun->fiyati}}</td>
                    <td>{{$sepet_urun->adet}}</td>
                    <td>{{$sepet_urun->fiyati*$sepet_urun->adet}}</td>
                    <td>
                       {{$sepet_urun->durum}}
                    </td>
                    
                </tr>
                @endforeach

                <tr>
                    <th colspan="4" class="text-right">Toplam tutar</th>
                    <td colspan="4">{{$entry->siparis_tutari}}</td>
                </tr>
                 <tr>
                    <th colspan="4" class="text-right">Toplam tutar(KDV'li)</th>
                    <td colspan="4">{{ $entry->sifaris_tutari*((100+config('cart.tax'))/100)}}</td>
                </tr>
                 <tr>
                    <th colspan="4" class="text-right">Siparis durum</th>
                    <td colspan="4">{{$entry->durum}}</td>
                </tr>
            </table>

@endsection()