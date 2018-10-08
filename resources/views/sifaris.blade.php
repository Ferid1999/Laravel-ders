@extends('layouts.master')
@section('title','Sifaris Detayi')
@section('content')
  <div class="container">
        <div class="bg-content">
            <h2>Sipariş (SP-00123)</h2>
            @if(count($sifarisler)==0)
            <p>Sifarisiniz yoxdu</p>
            @else 
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Sifaris kodu</th>
                    <th>Tutar</th>
                    <th>Toplam urun</th>
                    <th>Durum</th>
                    <th></th>
                </tr>
               @foreach($sifarisler as $sifaris)
                <tr>
                    <td>SP-{{ $sifaris->id}} </td>
                    <td>{{ $sifaris->sifaris_tutari*((100+config('cart.tax'))/100)}}</td>
                    <td>{{$sifaris->sepet->sepet_urun_adet()}}</td>
                    <td>{{$sifaris->durum}}</td>
                    <td>
                        <a href="{{route('sifaris',$sifaris->id)}}" class="btn btm-sm btn-success">Detay</a>
                    </td>
                </tr>
                

            </table>
            @endif
        </div>
    </div>
@endsection