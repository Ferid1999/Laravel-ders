@extends('yonetim.layouts.master')
@section('title','Kullanici Yonetimi')
@section('content')

 <h1 class="page-header">Kullanici Yonetimi</h1>
 <h3 class="sub-header">  Kullanici listesi
                </h3> 
                <div class="well">
                    <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        
                        <a href="{{  route('yonetim.kullanici.yeni') }}" class="btn btn-primary">Yeni</a>
                    </div>
                    <form method="post" action="{{ route('yonetim.kullanici')}}" class="form-inline">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <label for="aranan">Ara</label>
                            <input type="text" class="form-control form-control-sm" name="aranan"  id="aranan" placeholder="AD,Email Ara..." value="{{ old('aranan')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ara</button>
                        <a href="{{ route('yonetim.kullanici')}}" class="btn btn-primary">Temizle</a>
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
                                <th>#</th>
                                <th>Ad Soyad</th>
                                <th>Email</th>
                                <th>Aktif MI</th>
                                <th>Yonetici Mi</th>
                                <th>Kayit tarihi</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list)==0)
                            <tr><td colspan="6" class="text-center">Kayit bulunamadi</td></tr>
                            @endif
                            @foreach($list as $entry)
                            <tr>
                                <td>{{ $entry->id}}</td>
                                <td>{{ $entry->adsoyad}}</td>
                                <td>{{ $entry->email}}</td>
                                <td>
                                    @if ($entry->aktif_mi)
                                    <span class="label label-success">Aktif</span>
                                    @else
                                     <span class="label label-warning">Pasif</span>
                                     @endif
                                </td>
                                 <td>
                                    @if ($entry->yonetici_mi)
                                    <span class="label label-success">Yonetici</span>
                                    @else
                                     <span class="label label-warning">Musteri</span>
                                     @endif
                                </td>
                                 <td>{{ $entry->yaratma_tarixi}}</td>
                                <td style="width: 100px">
                                    <a href="{{ route('yonetim.kullanici.duzenle',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Duzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.kullanici.sil',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz?')">
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