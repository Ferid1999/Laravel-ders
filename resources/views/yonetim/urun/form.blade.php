@extends('yonetim.layouts.master')
@section('title','Urun Yonetimi')
@section('content')

 <h1 class="page-header">Urun Yonetimi</h1>
                <form method="post" action="{{ route('yonetim.urun.kaydet',@$entry->id)}}">
                   
                    {{ csrf_field()}}
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">{{
                            @$entry->id>0 ? "Guncelle" : "Kaydet"
                        }}</button>
                    </div>
                      <h2 class="sub-header">Urun {{
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
                                <label for="urun_adi">Urun adi</label>
                                <input type="text" class="form-control" id="urun_adi" placeholder="Urun adi"  name="urun_adi" value="{{ old('urun_adi',$entry->urun_adi)}}">
                            </div>
                        </div>
                    
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="hidden"  name="orijinal_slug" value="{{ old('slug',$entry->slug)}}">
                               <input type="text" class="form-control" id="slug" placeholder="Slug"  name="slug" value="{{ old('slug',$entry->slug)}}">
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="aciklama">Aciklama</label>
                                <textarea class="form-control" id="aciklama" placeholder="Aciklama"  name="aciklama" >{{ old('aciklama',$entry->urun_adi)}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fiyati">Fiyati</label>
                                <input type="text" class="form-control" id="fiyati" placeholder="Fiyati"  name="fiyati" value="{{ old('fiyati',$entry->fiyati)}}">
                            </div>
                        </div>
                    </div> 
                    <div class="checkbox">
                        <label>
                             <input type="hidden" name="goster_slider" value="0">
                            <input type="checkbox" name="goster_slider" value="1" {{ old('goster_slider',$entry->detay->goster_slider) ? 'checked' : ' '}} >Yonetici Mi
                        </label>
                        <label>
                             <input type="hidden" name="goster_gunun_firsati" value="0">
                            <input type="checkbox" name="goster_gunun_firsati" value="1" {{ old('goster_gunun_firsati',$entry->detay->goster_gunun_firsati) ? 'checked' : ' '}} >Gunun firsatinda goster
                        </label>
                         
                         <label>
                             <input type="hidden" name="goster_one_cikan" value="0">
                            <input type="checkbox" name="goster_one_cikan" value="1" {{ old('goster_one_cikan',$entry->detay->goster_one_cikan) ? 'checked' : ' '}} >One cikan alaninda goster
                        </label>
                         <label>
                             <input type="hidden" name="goster_cok_satan" value="0">
                            <input type="checkbox" name="goster_cok_satan" value="1" {{ old('goster_cok_satan',$entry->detay->goster_cok_satan) ? 'checked' : ' '}} >Cok satan alaninda goster
                        </label>
                        <label>
                             <input type="hidden" name="goster_indirimli" value="0">
                            <input type="checkbox" name="goster_indirimli" value="1" {{ old('goster_indirimli',$entry->detay->goster_indirimli) ? 'checked' : ' '}} >Indirimli urunlerde goster
                        </label>
                    </div>
                    
                    

                    
                </form>
@endsection()