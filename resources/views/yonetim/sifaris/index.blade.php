@extends('yonetim.layouts.master')
@section('title','Sifaris Yonetimi')
@section('content')

 <h1 class="page-header">Sifaris Yonetimi</h1>
 <h3 class="sub-header">  Sifaris listesi
                </h3> 
                <div class="well">
                    
                    <form method="post" action="{{ route('yonetim.sifaris')}}" class="form-inline">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <label for="aranan">Ara</label>
                            <input type="text" class="form-control form-control-sm" name="aranan"  id="aranan" placeholder="Sifaris Ara..." value="{{ old('aranan')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ara</button>
                        <a href="{{ route('yonetim.sifaris')}}" class="btn btn-primary">Temizle</a>
                    </form>
                  </div>
                 @if(session()->has('mesaj'))
                    <div class="container">
                        <div class="alert alert-{{ session('mesaj_tur')}}"> {{session('mesaj')}}</div>
                    </div>
                    @endif
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                 <th>Sifaris kodu</th>
                                <th>Kullanici</th>
                               
                                <th>Tutar</th>
                                <th>Durum</th> 
                                <th>Sifaris tarixi</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list)==0)
                            <tr><td colspan="6" class="text-center">Kayit bulunamadi</td></tr>
                            @endif
                            @foreach($list as $entry)
                            <tr>

                                <td>SP-{{ $entry->id}}</td>
                                
                                <td>{{ $entry->sepet->users->adsoyad }}</td>
                               
                                <td>{{ $entry->siparis_tutari*((100+config('cart.tax'))/100)}}</td>
                                <td>{{ $entry->durum}}</td>
                                <td>{{ $entry->yaratma_tarixi}}</td>
                                <td style="width: 100px">
                                    <a href="{{ route('yonetim.sifaris.duzenle',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Duzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.sifaris.sil',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                    {{ $list->appends('aranan',old('aranan'))->links()}}
                </div>
@endsection()