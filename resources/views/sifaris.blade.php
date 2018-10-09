@extends('layouts.master')
@section('title','Sifarisler')
@section('content')
 <div class="container">
        <div class="bg-content">
            <a href="{{route('sifarisler')}}" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-arrow-left"></i>Sifarislere don
            </a>
            <h2>Sipariş (SP-{{$sifaris->id}}</h2>
            <p>Henüz siparişiniz yok</p>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Urun</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                    
                </tr>
                @foreach($sifaris->sepet->sepet_urunler as $sepet_urun)
                <tr>
                    <td style="width: 120px"><a href="{{route('urun',$sepet_urun->urun-slug)}}"><img src="http://lorempixel.com/120/100/food/2"></a></td>
                    <td><a href="{{route('urun',$sepet_urun->urun-slug)}}">{{$sepet_urun->urun->urun_adi}}</a></td>
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
                    <td colspan="4">{{$sifaris->siparis_tutari}}</td>
                </tr>
                 <tr>
                    <th colspan="4" class="text-right">Toplam tutar(KDV'li)</th>
                    <td colspan="4">{{ $sifaris->sifaris_tutari*((100+config('cart.tax'))/100)}}</td>
                </tr>
                 <tr>
                    <th colspan="4" class="text-right">Siparis durum</th>
                    <td colspan="4">{{$sifaris->durum}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection