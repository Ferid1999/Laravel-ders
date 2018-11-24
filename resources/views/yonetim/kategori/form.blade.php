@extends('yonetim.layouts.master')
@section('title','Kategori Yonetimi')
@section('content')

 <h1 class="page-header">Kategori Yonetimi</h1>
                <form method="post" action="{{ route('yonetim.kategori.kaydet',@$entry->id)}}">
                    {{ csrf_field()}}
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">{{
                            @$entry->id>0 ? "Guncelle" : "Kaydet"
                        }}</button>
                    </div>
                      <h2 class="sub-header">Kullanici {{
                            @$entry->id>0 ? "Duzenle" : "Ekle"
                        }}</h2>
                       @include('layouts.partials.error')

                                          @if(session()->has('mesaj'))
                    <div class="container">
                        <div class="alert alert-{{ session('mesaj_tur')}}"> {{session('mesaj')}}</div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori_adi">Ust Kategori</label>
                                <select name="ust_id" id="ust_id">
                                    <option value="">Ana kategori</option>
                                    @foreach($kategoriler as $kategori)
                                    <option value="{{$kategori->id}}">{{$kategori->kategori_adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori_adi">Kategori adi</label>
                                <input type="text" class="form-control" id="kategori_adi" placeholder="Kategori adi"  name="kategori_adi" value="{{ old('kategori_adi',$entry->kategori_adi)}}">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="hidden"  name="orijinal_slug" value="{{ old('slug',$entry->slug)}}">
                               <input type="text" class="form-control" id="slug" placeholder="Slug"  name="slug" value="{{ old('slug',$entry->slug)}}">
                            </div>
                        </div>
                    </div>
                     
                        
                    
                    

                    
                </form>
@endsection()