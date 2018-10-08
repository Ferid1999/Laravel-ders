@extends('layouts.master')
@section('title','Sepet')
@section('content')

 <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            <div class="container">
    <div class="alert alert-{{ session('mesaj_tur')}}"> {{session('mesaj')}}</div>
</div>
        @if(count(Cart::content())>0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Adet fiyati</th>
                    <th>Adet</th>
                    <th>Adet tutar</th>
                    
                </tr>
                @foreach(Cart::content() as $urunCartItem)
                <tr>
                    <td style="width: 120px;"><a href="{{route('urun',$urunCartItem->options->slug)}}"> <img src="http://lorempixel.com/120/100/food/2"></a></td>
                    <td>
                      <a href="{{route('urun',$urunCartItem->options->slug)}}">
                        {{$urunCartItem->name}}</a>
                     <form action="{{route('sepet.kaldir',$urunCartItem->rowId)}}" method="post">
                        
                         {{ csrf_field()}}
                         {{ method_field('DELETE')}}
                         <input type="submit"  class="btn btn-danger btn-xs" value="Sepetden kaldir">
                     </form>
                        
                    </td>
                    <td>{{$urunCartItem->price}} Tl</td>

                    <td>
                        <a href="/sepet" class="btn btn-xs btn-default urun-adet-azalt " data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty-1}}">-</a>
                        <span style="padding: 10px 20px"> {{$urunCartItem->qty}}
</span>                  
                        <a href="/sepet" class="btn btn-xs btn-default urun-adet-artir" data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty+1}}">+</a>
                    </td>
                    <td class="text-right">{{$urunCartItem->subtotal}} Tl</td>

                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Alt toplam</th>
                    <th class="text-right">{{$urunCartItem->subtotal}} Tl</th>
                    
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <th class="text-right">{{$urunCartItem->tax}} Tl</th>
                    
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Genel toplam</th>
                    <th class="text-right">{{$urunCartItem->total}}  Tl</th>
                    
                </tr>
            </table>
            <div>
                
                <form action="{{route('sepet.bosalt')}}" method="post">
                        
                         {{ csrf_field()}}
                         {{ method_field('DELETE')}}
                         <input type="submit"  class="btn btn-info pull-left" value="Sepeti Boşalt">
                     </form>
                <a href="{{route('odeme')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
            @else
            <p>Sepetinizde urun yok</p>
            @endif
            
        </div>
    </div>

@endsection